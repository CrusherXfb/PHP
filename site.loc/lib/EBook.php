<?php

class EBook extends Book
{
    private float $fileSize;
    public function __construct(string $title, string $author, int $year, float $fileSize)
    {
        parent::__construct($title, $author, $year);
        $this->fileSize = $fileSize;
    }
    function getInfo()
    {
        return "EBook " . parent::getInfo() . " | Size: {$this->fileSize}MB";
    }
}