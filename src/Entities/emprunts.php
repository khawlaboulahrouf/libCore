<?php
class emprunts {
    private $dateemprunt;
    private $dateretoure;
    private $id_book;
    private $id_member;

    public function __construct($dateemprunt,$dateretoure, $id_book,$id_member)
    {
        $this->dateemprunt = $dateemprunt;
        $this->dateretoure = $dateretoure;
        $this->id_book = $id_book;
        $this->id_member = $id_member;
    }
    public function getDateemprunt(){
        return $this->dateemprunt;
    }
    public function getDateretoure(){
        return $this->dateretoure;
    }
     public function getIdBook(){
        return $this->id_book;
    }
     public function getIdMemeber(){
        return $this->id_member;
    }

    public function setDateemprunt(){
        return $this->dateemprunt;
    }
    public function setDateretoure(){
        return $this->dateretoure;
    }
    public function setIDBook(){
        return $this->id_book;
    }
    public function setIdMember(){
        return $this->id_member;
    }
}