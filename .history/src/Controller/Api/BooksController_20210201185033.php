<?php
namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BookRepository;

class BooksController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/books")
     * @Rest\View(serializerGroups={"book"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(
        BookRepository $bookRepository
    ) {
        return $bookRepository->findAll();
    }

    /**
     * @Rest\post(path="/books")
     * @Rest\View(serializerGroups={"book"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(
        Request $request, EntityManagerInterface $em
    ) {
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
    }
    
}