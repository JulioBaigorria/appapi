<?php

namespace App\Controller;

use App\Service\CategoryManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class CategoryController extends AbstractFOSRestController
{

    /**
     * @Rest\Get(path="/categories")
     * @Rest\View(serializerGroups={"book"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAllAction(
        
        CategoryManager $categoryManager
    ) {
        return $categoryManager->findAll();
    }
}