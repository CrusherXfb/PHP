<?php

require_once(dirname(__FILE__) . "/Book.php");
require_once(dirname(__FILE__) . "/EBook.php");
require_once(dirname(__FILE__) . "/PrintedBook.php");
require_once(dirname(__FILE__) . "/Library.php");

$library = new Library();

$ebook1 = new EBook("1984", "George Orwell", 1949, 1.2);
$ebook2 = new EBook("The Catcher in the Rye", "J.D. Salinger", 1951, 0.5);
$printedBook1 = new PrintedBook("To Kill a Mockingbird", "Harper Lee", 1960, 281);
$printedBook2 = new PrintedBook("The Great Gatsby", "F. Scott Fitzgerald", 1925, 180);
//Очень завидую людям которые любят читать

$library->addBook($ebook1);
$library->addBook($ebook2);
$library->addBook($printedBook1);
$library->addBook($printedBook2);

$library->listBooks();