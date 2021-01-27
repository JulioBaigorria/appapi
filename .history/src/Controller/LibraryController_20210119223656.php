<?php 

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController 
{
    private $logger;

    
    /*Con el Request request se pueden pedir parametros por get 
    Así se recuperan también los servicios, en este caso "LoggerInterface".
    Un servicio es una clase que hace algo, en este caso también se usa LoggerInterface
    Ayuda en la reutilizacion del codigo
    */

    /**
     * @Route("library/list", name="library_list")
     */

    public function list( Request $request, LoggerInterface $logger)
    {
        $title = $request->get('title', 'Libro sin definir');
        $logger->info('List action called');
        $response = new JsonResponse();
        $response->setData([
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
            ]
        ]);
        return $response;
    }
    //persist controla el objeto, gracias al entitymanager
    //Para enviarlo, se usa flush()
    public function createBook(Request $request, EntityManager $em){
        $book = new Book();
        $book->setTitle('Mr Mercedes');
        $em->persist($book);
        $em->flush();

    }
}