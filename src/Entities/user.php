<?php

abstract class User
{
    private int    $id;
    private string $name;
    private string $email;

    // ── Constructeur ─────────────────────────────────────────
    public function __construct(int $id, string $name, string $email)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->email = $email;
    }

}
