<?php

namespace App\Controller;

use App\Entity\Book;
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

    public function list(Request $request)
    {
        $title = $request->get('title', 'Libro sin definir');

        $response = new JsonResponse();
        
        $response->setData(
            [
                'success' => true,
                'data' => [
                    [
                        'id' => 1,
                        'title' => 'Mas alla del bien y el mal'
                    ],
                    [
                        'id' => 2,
                        'title' => 'El Anticristo'
                    ],
                    [
                        'id' => 3,
                        'title' => $title
                    ],
                    [
                        'id' => 4,
                        'title' => 'asi fue'
                    ]
                ]

            ]
        );

        if ($title === 'Trigger') {

            $response->setData(
                [
                    'success' => false,
                    'data' => [
                        'id' => 'corrupto',
                        'title' => 'corrupto'
                    ]
                ]
            );
        }

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
