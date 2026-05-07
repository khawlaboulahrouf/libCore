<?php

require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Book.php';

class Member extends User
{
    private array $borrowedBooks = []; // livres actuellement empruntés

    // Limite par défaut (Student et Teacher la surchargent)
    public function getMaxBooks(): int { return 3; }

    // ── Emprunter ─────────────────────────────────────────────
    public function borrowBook(Book $book): bool
    {
        if (!$book->isAvailable()) {
            echo "'{$book->getTitle()}' n'est pas disponible.\n";
            return false;
        }
        if (count($this->borrowedBooks) >= $this->getMaxBooks()) {
            echo "Limite atteinte ({$this->getMaxBooks()} livres max).\n";
            return false;
        }
        $book->setStatus('borrowed');
        $this->borrowedBooks[] = $book;
        echo "'{$book->getTitle()}' emprunté par {$this->getName()}.\n";
        return true;
    }

    // ── Rendre ────────────────────────────────────────────────
    public function returnBook(Book $book): bool
    {
        foreach ($this->borrowedBooks as $key => $b) {
            if ($b->getId() === $book->getId()) {
                $book->setStatus('available');
                unset($this->borrowedBooks[$key]);
                $this->borrowedBooks = array_values($this->borrowedBooks);
                echo "'{$book->getTitle()}' rendu.\n";
                return true;
            }
        }
        echo "Vous n'avez pas ce livre.\n";
        return false;
    }

    public function getBorrowedBooks(): array { return $this->borrowedBooks; }
}

// ─────────────────────────────────────────────────────────────
//  Student – max 3 livres
// ─────────────────────────────────────────────────────────────
class Student extends Member
{
    public function getMaxBooks(): int { return 3; }
}

// ─────────────────────────────────────────────────────────────
//  Teacher – max 10 livres
// ─────────────────────────────────────────────────────────────
class Teacher extends Member
{
    public function getMaxBooks(): int { return 10; }
}
