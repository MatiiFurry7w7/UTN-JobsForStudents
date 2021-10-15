<?php   namespace Models;

    class AcademicStatus{
        private $active;
        private $average;
        private $fileNumber;

        public function __construct($active, $average, $fileNumber){
            $this->active = $active;
            $this->average = $average;
            $this->fileNumber = $fileNumber;
        }

        //GET/SET
        public function getActive(){
            return $this->active;
        }

        public function setActive($active){
            $this->active = $active;
        }

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