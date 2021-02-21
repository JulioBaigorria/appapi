<?php

namespace App\Service;
use League\Flysystem\FilesystemOperator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use App\Service\FileUploader;

class FileUpleaderUnitTest extends TestCase {

    public function testSuccess(){
        
        $base64image = "data:image/jpeg;base64,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";

        $data = explode(',', $base64image);

        /**
         * @var FilesystemOperator&MockObject $filesystem
         */
        $filesystem = $this->getMockBuilder(FilesystemOperator::class)
            ->disableOriginalConstructor()
            ->getMock();
        $filesystem
            ->expects($this->once())
            ->method('write')
            ->with($this->isType('string'), base64_decode($data[1]));


        $fileUploader = new FileUploader($filesystem);
        $filename = $fileUploader->uploadBase64File($base64image);
        $this->assertNotEmpty($filename);
        $this->assertStringContainsString('.jpeg', $filename);
  }
}