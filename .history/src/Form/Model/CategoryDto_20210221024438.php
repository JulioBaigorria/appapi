<?php

namespace App\Form\Model;

use App\Entity\Category;

class CategoryDto {
    public $name;

    public static function createFromBook(Category $category): self
    {
        $dto = new self();
        $dto->name = $category->getName();
        return $dto;
    }
}