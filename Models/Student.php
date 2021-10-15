<?php   namespace Models;

    class Student{
        private $studentId;
        private $firstName;
        private $lastName;
        private $email;
        private $phoneNumber;
        private $gender;
        private $dNI;
        private $birthDate;
        private $career;
        private $academicStatus;

        public function __construct($firstName, $lastName, $email, $phoneNumber, $gender, $dNI, $birthDate){
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->phoneNumber = $phoneNumber;
            $this->gender = $gender;
            $this->dNI = $dNI;
            $this->birthDate = $birthDate;
        }

        //GET/SET
        public function getStudentId(){
            return $this->studentId;
        }

        public function setStudentId($studentId){
            $this->studentId = $studentId;
        }
        
        public function getFirstName(){
            return $this->firstName;
        }

        public function setFirstName($firstName){
            $this->firstName = $firstName;
        }
        
        public function getLastName(){
            return $this->lastName;
        }

        public function setLastName($lastName){
            $this->lastName = $lastName;
        }

        public function getEmail(){
                return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getPhoneNumber(){
            return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber){
            $this->phoneNumber = $phoneNumber;
        }

        public function getGender(){
            return $this->gender;
        }

        public function setGender($gender){
            $this->gender = $gender;
        }

        public function getDNI(){
            return $this->dNI;
        }

        public function setDNI($dNI){
            $this->dNI = $dNI;
        }

        public function getBirthDate(){
            return $this->birthDate;
        }

        public function setBirthDate($birthDate){
            $this->birthDate = $birthDate;
        }

        public function getCareer(){
            return $this->career;
        }

        public function setCareer($career){
            $this->career = $career;
        }

        public function getAcademicStatus(){
            return $this->academicStatus;
        }

        public function setAcademicStatus($academicStatus){
            $this->academicStatus = $academicStatus;
        }

        //toString
        public function __tostring(){
            return "<br>ID: ".$this->studentId.
                   "<br>DNI: ".$this->dNI.
                   "<br>Full name: ".$this->firstName." ".$this->lastName.
                   "<br>Born in ".$this->birthDate.
                   "<br>Gender: ".$this->gender.
                   "<br>Phone: ".$this->phoneNumber.
                   "<br>Email: ".$this->email.
                   "<br>Career: ".$this->career.
                   "<br>Academic Status".
                   "<br>--------------------".
                   $this->academicStatus;
        }
    };
?>