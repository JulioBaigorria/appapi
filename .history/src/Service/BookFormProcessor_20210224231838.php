<?php

namespace App\Service;

use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookFormProcessor
{

    private $bookManager;
    private $categoryManager;
    private $fileUploader;
    
    public function __construct(
        BookManager $bookManager,
        CategoryManager $categoryManager,
        FileUploader $fileUploader
    )
    {
        
    }
    public function __invoke(){

    }
}