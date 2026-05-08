<?php
// ============================================================
//  PARTIE 2 – MEMBRE
//  Fichier : src/Entities/User.php
//  Rôle    : Classe abstraite – socle commun de tout utilisateur
// ============================================================

abstract class User
{
    private int    $id;
    private string $name;
    private string $email;

    public function __construct(int $id, string $name, string $email)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->email = $email;
    }

    // ── Getters ──────────────────────────────────────────────
    public function getId(): int      { return $this->id; }
    public function getName(): string  { return $this->name; }
    public function getEmail(): string { return $this->email; }

    // ── Setters ──────────────────────────────────────────────
    public function setName(string $name): void   { $this->name  = $name; }
    public function setEmail(string $email): void  { $this->email = $email; }

    // Chaque sous-classe définit sa limite d'emprunts
    abstract public function getMaxBooks(): int;
}
