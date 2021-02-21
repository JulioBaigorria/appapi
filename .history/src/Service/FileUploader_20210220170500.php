<?php
namespace App\Service;
use League\Flysystem\FileSystemInterface;

class FileUploader {
    private $filesystem;

    public function __construct(FileSystemInterface $defaultStorage)
    {
        $this->defaultStorage = $defaultStorage;
    }
}

