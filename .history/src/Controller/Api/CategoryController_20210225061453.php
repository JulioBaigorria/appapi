<?php

namespace App\Controller;

use App\Service\CategoryManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class BooksController extends AbstractFOSRestController
{

    /**
     * @Rest\Get(path="/books", requirements={"id"="\d+"})
     * @Rest\View(serializerGroups={"book"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAllAction(
        
        CategoryManager $categoryManager
    ) {
        return $categoryManager->findAll();
    }
}