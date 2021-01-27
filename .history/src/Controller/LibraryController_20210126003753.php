<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
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

    public function list(BookRepository $bookRepository)
    {
        //Retornar todos los libros
        $books = $bookRepository->findAll();
        $booksAsArray = [];
        foreach ($books as $book){
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



    //persist controla el objeto, gracias al entitymanager
    //Para enviarlo, se usa flush()

    /**
     * @Route("book/create", name="book_create")
     */

    public function createBook(Request $request, EntityManagerInterface $em)
    {
        $book = new Book();
        $book->setTitle('Isaura la esclava');
        $em->persist($book);
        $em->flush();
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => [

                'id' => $book->getId(),
                'title' => $book->getTitle()
            ]
        ]);
        return $response;
    }
}
