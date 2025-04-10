<?php

class PrintedBook extends Book
{
    private int $pageCount;
    public function __construct(string $title, string $author, int $year, int $pageCount)
    {
        parent::__construct($title, $author, $year);
        $this->pageCount = $pageCount;
    }
    function getInfo()
    {
        return "Printed book " . parent::getInfo() . " | Pages: {$this->pageCount}";
    }
}
