<?php
    namespace Models;

    class Student{
        private $studentId;
        private $userName;
        private $userPassword;

        public function getStudentId(){
            return $this->studentId;
        }

        public function setStudentId($studentId){
            $this->studentId = $studentId;
        }

        public function getUserName(){
            return $this->userName;
        }

        public function setUserName($userName){
            $this->userName = $userName;
        }

        public function getUserPassword(){
            return $this->userPassword;
        }

        public function setUserPassword($userPassword){
            $this->userPassword = $userPassword;
        }

        //toString();
        public function __tostring(){
            return "<br>ID: ".$this->studentId.
                   "<br>Username: ".$this->userName.
                   "<br>Password: ".$this->userPassword;
        }
    };
?>