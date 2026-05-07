<?php
// ============================================================
//  PARTIE 1 – ADMIN
//  Fichier : src/Entities/Book.php
//  Rôle    : Représente un livre dans le catalogue
// ============================================================

class Book
{
    // Toutes les propriétés sont PRIVATE (encapsulation)
    private int    $id;
    private string $title;
    private string $author;
    private string $isbn;
    private string $status; // 'available' | 'borrowed' | 'lost' | 'repair'

    // ── Constructeur ─────────────────────────────────────────
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
    public function setTitle(string $title): void   { $this->title  = $title; }
    public function setStatus(string $status): void { $this->status = $status; }

    // ── Le livre sait s'il est disponible ────────────────────
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    // ── Affichage dans le terminal ────────────────────────────
    public function __toString(): string
    {
        $icon = match($this->status) {
            'available' => '🟢 Disponible',
            'borrowed'  => '🔴 Emprunté',
            'lost'      => '⚫ Perdu',
            'repair'    => '🟡 En réparation',
            default     => '⚪ Inconnu',
        };
        return "[ID:{$this->id}] {$this->title} — {$this->author} | ISBN: {$this->isbn} | {$icon}";
    }
}
