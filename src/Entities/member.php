<?php
require_once './User.php';

class Members extends  User{
        private $type;
        private $browerbook;

        public function __construct($name, $email,$type,$browerbook)
        {
            return parent::__construct($name, $email);
            $this->type = $type;
            $this->browerbook = $browerbook;
        }

        public function getType(){
            return $this->type;
        }
        public function getBrowerbook(){
            return $this->browerbook;
        }
        public function setType(){
            return $this->type;
        }
        public function setBrowbook(){
            return $this->browerbook;
        }
       
}