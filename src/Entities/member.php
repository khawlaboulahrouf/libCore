<?php
class Member extends User
{
    // Liste des livres actuellement empruntés
    private array $borrowedBooks = [];

    // Limite par défaut (remplacée par les sous-classes)
    public function getMaxBooks(): int { return 3; }

}