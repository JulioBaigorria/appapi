<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\Type\BookFormType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{

    /*Con el Request request se pueden pedir parametros por get 
    Así se recuperan también los servicios, en este caso "LoggerInterface".
    Un servicio es una clase que hace algo, en este caso también se usa LoggerInterface
    Ayuda en la reutilizacion del codigo
    */

    /**
     * @Route("/books", name="books_get")
     */

    public function listBook(BookRepository $bookRepository)
    {
        //Retornar todos los libros
        $books = $bookRepository->findAll();
        $booksAsArray = [];
        foreach ($books as $book) {
            $booksAsArray[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'image' => $book->getImage()
            ];
        };
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => $booksAsArray
        ]);

        return $response;
    }

    /**
     * @Route("/book", name="books_get")
     */
    //Agregar Validacion si es null, o el numero está fuera del índice
    public function findBook(Request $request, BookRepository $bookRepository)
    {
        //Retornar libro por id 
        $id = $request->get('id', null);
        $book = $bookRepository->find($id);
        $response = new JsonResponse();
        if(empty($book)){
            $response->setData([
            
                'success' => false,
                'error' => 'Ingrese numero de id'
            ]
        ); 
        return $response;   
        }
        $response->setData([
            
                'success' => true,
                'data' => [
                    'id' => $book->getId(),
                    'title' => $book->getTitle(),
                    'image' => $book->getImage()
                ]
            ]
        );
        return $response;
    }


    //persist controla el objeto, gracias al entitymanager
    //Para enviarlo, se usa flush()

    /**
     * @Route("book/create", name="book_create")
     */

    public function createBook(Request $request, EntityManagerInterface $em)
    {
        $book = new Book();
        $response = new JsonResponse();
        $title = $request->get('title', null);
        if (empty($title)) {
            $response->setData(
                [
                    'success' => false,
                    'error' => 'Title cannot be empty',
                    'data' => null
                ]
            );
            return $response;
        }
        $book->setTitle($title);
        $em->persist($book);
        $em->flush();
        $response->setData([
            'success' => true,
            'data' => [
                'id' => $book->getId(),
                'title' => $book->getTitle()
            ]
        ]);
        return $response;
    }

    /**
     * @Route("book/create_form", name="book_create_form")
     */

    public function postAction(
        EntityManagerInterface $em,
        Request $request
    )
    {
        $book = new Book();
        $form = $this->createForm(BookFormType::class, $book);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($book);
            $em->flush();
            return $book;
        }
        return $form;
    }
}

