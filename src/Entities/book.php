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

    public function getIsbn() {
        return $this->isbn;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getIsAvailable() {
        return $this->isAvailable;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getIdLibrary() {
        return $this->idLibrary;
    }

 

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setAvailable($status) {
        $this->isAvailable = $status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setIdLibrary($idLibrary) {
        $this->idLibrary = $idLibrary;
    }
}