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
    }}