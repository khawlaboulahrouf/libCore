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

    // ─── US4 : Retirer un livre du catalogue ─────────────────
    public function removeBook(int $bookId): void
    {
        if (isset($this->books[$bookId])) {
            $titre = $this->books[$bookId]->getTitle();
            unset($this->books[$bookId]);
            echo "'{$titre}' retiré du catalogue.\n";
        } else {
            echo "Livre ID:{$bookId} introuvable.\n";
        }
    }

    // ─── US4 : Modifier l'état d'un livre ────────────────────
    public function setBookStatus(int $bookId, string $status): void
    {
        if (isset($this->books[$bookId])) {
            $this->books[$bookId]->setStatus($status);
            echo "Livre ID:{$bookId} → statut : {$status}\n";
        } else {
            echo "Livre ID:{$bookId} introuvable.\n";
        }
    }

    // ─── US3 : Lister tous les livres ────────────────────────
    public function listBooks(): void
    {
        if (empty($this->books)) {
            echo "📭 Catalogue vide.\n";
            return;
        }
        echo "\n╔══════════════════════════════════════════════════════╗\n";
        echo "║                    CATALOGUE                         ║\n";
        echo "╚══════════════════════════════════════════════════════╝\n";
        foreach ($this->books as $book) {
            echo "  " . $book . "\n";
        }
        echo str_repeat("─", 56) . "\n";
    }

    // ─── US2 : Enregistrer un membre ─────────────────────────
    public function registerMember(Member $member): void
    {
        $this->members[$member->getId()] = $member;
        $type = ($member instanceof Teacher) ? 'Teacher' : 'Student';
        echo "Membre enregistré : {$member->getName()} | {$type} | max {$member->getMaxBooks()} livres\n";
    }

    // ─── Afficher tous les membres ───────────────────────────
    public function listMembers(): void
    {
        if (empty($this->members)) {
            echo "📭 Aucun membre.\n";
            return;
        }
        echo "\n nombre \n";
        
        foreach ($this->members as $m) {
            $type    = ($m instanceof Teacher) ? 'Teacher' : 'Student';
            $nbLivres = count($m->getBorrowedBooks());
            echo "  [ID:{$m->getId()}] {$m->getName()} | {$m->getEmail()} | {$type} | {$nbLivres}/{$m->getMaxBooks()} livres\n";
        }
        echo str_repeat("─", 38) . "\n";
    }

    // ─── Helpers ─────────────────────────────────────────────
    public function getBook(int $id): ?Book     { return $this->books[$id]   ?? null; }
    public function getMember(int $id): ?Member { return $this->members[$id] ?? null; }
}
