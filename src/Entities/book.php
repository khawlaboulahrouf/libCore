<?php

class Book {

    private $id;
    private $isbn;
    private $title;
    private $author;
    private $isAvailable;
    private $status;
    private $idLibrary;

    public function __construct($isbn, $title, $author, $idLibrary) {

        $this->isbn = $isbn;
        $this->title = $title;
        $this->author = $author;
        $this->idLibrary = $idLibrary;

        $this->isAvailable = true;
        $this->status = "disponible";
    }



    public function getId() {
        return $this->id;
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