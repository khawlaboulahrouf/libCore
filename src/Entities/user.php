<?php
// ============================================================
//  PARTIE 2 – MEMBRE
//  Fichier : src/Entities/User.php
//  Rôle    : Classe abstraite – socle commun de tout utilisateur
// ============================================================

abstract class User {

    public function __construct(int $id, string $name, string $email)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->email = $email;
    }
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    // Chaque sous-classe définit sa limite d'emprunts
    abstract public function getMaxBooks(): int;
}
