<?php

class Library
{
    protected array $books = [];
    function addBook(Book $book)
    {
        $this->books[] = $book;
    }

    function listBooks()
    {
        foreach ($this->books as $book) {
            echo $book->getInfo() . "<br>";
        }
    }
}