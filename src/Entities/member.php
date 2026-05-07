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
}