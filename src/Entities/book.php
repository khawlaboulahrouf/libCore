<?php
// ============================================================
//  PARTIE 2 – MEMBRE
//  Fichier : src/Entities/Book.php
//  Rôle    : Représente un livre
//            Le livre sait lui-même s'il est disponible
// ============================================================

class Book
{
    private int    $id;
    private string $title;
    private string $author;
    private string $isbn;
    private string $status; // 'available' | 'borrowed' | 'lost' | 'repair'

    public function __construct(int $id, string $title, string $author, string $isbn, string $status = 'available')
    {
        $this->id     = $id;
        $this->title  = $title;
        $this->author = $author;
        $this->isbn   = $isbn;
        $this->status = $status;
    }

    // ── Getters ──────────────────────────────────────────────
    public function getId(): int       { return $this->id; }
    public function getTitle(): string  { return $this->title; }
    public function getAuthor(): string { return $this->author; }
    public function getIsbn(): string   { return $this->isbn; }
    public function getStatus(): string { return $this->status; }

    // ── Setters ──────────────────────────────────────────────
    public function setStatus(string $status): void { $this->status = $status; }

    // ── Méthode intelligente : le livre sait s'il est dispo ──
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    // ── Affichage ─────────────────────────────────────────────
    public function __toString(): string
    {
        $icon = match($this->status) {
            'available' => ' Disponible',
            'borrowed'  => ' Emprunté',
            'lost'      => ' Perdu',
            'repair'    => 'En réparation',
            default     => ' Inconnu',
        };
        return "[ID:{$this->id}] {$this->title} — {$this->author} | {$icon}";
    }
}
