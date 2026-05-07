<?php


require_once __DIR__ . '/../Entities/Book.php';
require_once __DIR__ . '/../Entities/User.php';
require_once __DIR__ . '/../Entities/Member.php';
require_once __DIR__ . '/../Entities/Librarian.php';

class Library
{
    private array $books   = [];
    private array $members = [];

    // ─── US1 : Ajouter un livre ──────────────────────────────
    public function addBook(Book $book): void
    {
        $this->books[$book->getId()] = $book;
        echo "Livre ajouté : {$book->getTitle()} (ID:{$book->getId()})\n";
    }    
}
