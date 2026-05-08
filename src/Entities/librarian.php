<?php

require_once 'User.php';

class Librarian extends User {

    public function __construct($name, $email) {

        parent::__construct($name, $email);
    }
}