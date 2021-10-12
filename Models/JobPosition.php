<?php
    namespace Models;

    class jobPosition {
        private $idJobPosition;
        private $description;
        private $title;

        //CONSTRUCTOR
        public function __construct($idJobPosition, $description, $title) { 
            $this->idJobPosition = $idJobPosition;
            $this->description = $description;
            $this->title = $title;
        }

        //GETTERS & SETTERS
        public function getIdJobPosition() {
            return $this->idJobPosition;
        }

        public function setIdJobPosition($idJobPosition) {
            $this->idJobPosition = $idJobPosition;
        }

        public function getDescription() {
           return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        //TO STRING METHOD
        public function __toString() {
            return  "<br>ID: ".$this->idJobPosition.
                    "<br>Description: ".$this->description.
                    "<br>Title: ".$this->title;
        }
    }
?>