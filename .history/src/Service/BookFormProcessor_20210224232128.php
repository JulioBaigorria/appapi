<?php

namespace App\Service;

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
        $this->$bookManager = $bookManager;
        $this->$categoryManager = $categoryManager;
        $this->$fileUploader = $fileUploader;
    }
    public function __invoke(){





    }
}