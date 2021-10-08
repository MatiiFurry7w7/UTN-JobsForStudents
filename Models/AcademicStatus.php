<?php   namespace Models;

    class AcademicStatus{
        private $average;
        private $fileNumber;

        public function __construct($average, $fileNumber){
            $this->average = $average;
            $this->fileNumber = $fileNumber;
        }

        //GET/SET
        public function getAverage(){
            return $this->average;
        }

        public function setAverage($average){
            $this->average = $average;
        }

        public function getFileNumber(){
                return $this->fileNumber;
        }

        public function setFileNumber($fileNumber){
                $this->fileNumber = $fileNumber;
        }

        //toString
        public function __tostring(){
            return "<br>Average grade: ".$this->average.
                   "<br>File Number: #".$this->fileNumber;
        }
    };
?>