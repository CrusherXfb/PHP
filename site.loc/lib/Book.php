<?php

class Book //класс можно сделать абстрактным
{
    protected string $title;
    protected string $author;
    protected int $year;
    public function __construct(string $title, string $author, int $year)
    {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }
    function getInfo()
    {
        $info = "{$this->author} - {$this->title} ({$this->year})";
        return $info;
    }
}

