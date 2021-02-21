<?php
namespace App\Service;
use League\Flysystem\FilesystemInterface;

class FileUploader {
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        
    }
}

