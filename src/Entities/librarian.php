<?php

require_once __DIR__ . '/User.php';

class Librarian extends User
{
  



    public function __construct($name, $email) {

        parent::__construct($name, $email);
    }
}

