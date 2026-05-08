<?php
class Member extends User
{
    // Liste des livres actuellement empruntés
    private array $borrowedBooks = [];

    // Limite par défaut (remplacée par les sous-classes)
    public function getMaxBooks(): int { return 3; }

    // ─── US6 : Emprunter un livre ────────────────────────────
    public function borrowBook(Book $book): bool
    {
        // Règle 1 : le livre doit être disponible
        if (!$book->isAvailable()) {
            echo " Impossible : '{$book->getTitle()}' n'est pas disponible (statut : {$book->getStatus()}).\n";
            return false;
        }

        // Règle 2 : le membre ne doit pas avoir atteint sa limite
        if (count($this->borrowedBooks) >= $this->getMaxBooks()) {
            echo " Impossible : {$this->getName()} a déjà atteint sa limite de {$this->getMaxBooks()} livre(s).\n";
            return false;
        }

        // Tout est OK → on met à jour le statut et on ajoute à la liste
        $book->setStatus('borrowed');
        $this->borrowedBooks[] = $book;
        echo " '{$book->getTitle()}' emprunté avec succès par {$this->getName()}.\n";
        return true;
    }

    // ─── US7 : Rendre un livre ───────────────────────────────
    public function returnBook(Book $book): bool
    {
        foreach ($this->borrowedBooks as $key => $b) {
            if ($b->getId() === $book->getId()) {
                // Le livre redevient disponible
                $book->setStatus('available');
                unset($this->borrowedBooks[$key]);
                $this->borrowedBooks = array_values($this->borrowedBooks);
                echo "'{$book->getTitle()}' rendu. Il est de nouveau disponible.\n";
                return true;
            }
        }
        echo " Vous n'avez pas le livre '{$book->getTitle()}' en votre possession.\n";
        return false;
    }

    // ─── US8 : Mes livres empruntés ──────────────────────────
    public function getBorrowedBooks(): array { return $this->borrowedBooks; }

    public function displayBorrowedBooks(): void
    {
        if (empty($this->borrowedBooks)) {
            echo " Vous n'avez aucun livre en cours d'emprunt.\n";
            return;
        }
        echo "\n Vos livres empruntés (" . count($this->borrowedBooks) . "/{$this->getMaxBooks()}) :\n";
        foreach ($this->borrowedBooks as $book) {
            echo "   → " . $book . "\n";
        }
    }
}


//  Student – maximum 3 livres
class Student extends Member
{
    public function getMaxBooks(): int { return 3; }
}

//  Teacher – maximum 10 livres
class Teacher extends Member
{
    public function getMaxBooks(): int { return 10; }
}
