<?php

namespace App\Form\Model;

class BookDto {
    public $title;
    public $image;
    public $categories;

    public function __construct()
    {
        $this->categories = [];
    }


}