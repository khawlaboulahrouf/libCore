<?php

require_once __DIR__ . '/User.php';

class Librarian extends User
{
    // Le bibliothécaire n'emprunte pas
    public function getMaxBooks(): int { return 0; }

    // Il peut ajouter un livre directement via son action
    public function addBookToLibrary(Library $library, Book $book): void
    {
        $library->addBook($book);
        echo "[{$this->getName()}] a ajouté : '{$book->getTitle()}'.\n";
    }
}
