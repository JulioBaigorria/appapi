<?php

namespace App\Service;

use App\Entity\Book;
use App\Form\Model\BookDto;
use App\Form\Model\CategoryDto;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookFormProcessor
{

    private $bookManager;
    private $categoryManager;
    private $fileUploader;
    private $formFactory;

    public function __construct(
        BookManager $bookManager,
        CategoryManager $categoryManager,
        FileUploader $fileUploader,
        FormFactoryInterface $formFactory
    )
    {
        $this->$bookManager = $bookManager;
        $this->$categoryManager = $categoryManager;
        $this->$fileUploader = $fileUploader;
    }
    public function __invoke(Book $book, Request $request){


        $bookDto = BookDto::createFromBook($book);
        
        $originalCategories = new ArrayCollection();
        foreach ($book->getCategories() as $category) {
            $categoryDto = CategoryDto::createFromCategory($category);
            $bookDto->categories[] = $categoryDto;
            $originalCategories->add($categoryDto);
        }

        //invocar formulario
        $form = $this->formFactory->createForm(BookFormType::class, $bookDto);
        $form->handleRequest($request);
         
        if (!$form->isSubmitted()) {
            return new Response('', Response::HTTP_BAD_REQUEST);
        }
        if ($form->isValid()) {
            //Remove categories
            foreach ($originalCategories as $originalCategoryDto) {
                if (!in_array($originalCategoryDto, $bookDto->categories)) {
                    $category = $categoryRepository->find($originalCategoryDto->id);
                    $book->removeCategory($category);
                }
            }
            //Create categories
            foreach ($bookDto->categories as $newCategoryDto) {
                if (!$originalCategories->contains($newCategoryDto)) {
                    $category = $categoryRepository->find($newCategoryDto->id ?? 0);
                    if (!$category) {
                        $category = new Category();
                        $category->setName($newCategoryDto->name);
                        $em->persist($category);
                    }
                    $book->addCategory($category);
                }
            }
            $book->setTitle($bookDto->title);
            if ($bookDto->image) {
                $filename = $fileUploader = $fileUploader->uploadBase64File($bookDto->image);
                $book->setImage($filename);
            }
            $em->persist($book);
            $em->flush();
            $em->refresh($book);
            return $book;
        }
    
        return $form;


    }
}