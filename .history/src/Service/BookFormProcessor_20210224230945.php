<?php

namespace App\Service;


class BookFormProcessor
{
    public function __construct(
        EntityManagerInterface $em,
        BookRepository $bookRepository,
        CategoryRepository $categoryRepository,
        FileUploader $fileUploader
    )
    {
        
    }
    public function __invoke()
}