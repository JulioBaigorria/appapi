<?php

namespace App\Form\Model;

use App\Entity\Book;

class BookDto {
    public $title;
    public $image;
    public $categories;

    public function __construct()
    {
        $this->categories = [];
    }

    public static function createFromBook(Book $book): self
    {
        $dto = new self();
        $dto->title = $book->getTitle();
        return $dto;
    }
}