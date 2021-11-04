<?php
    namespace Models;

    class CV
    {
        private $cv;
        
        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }        
    }
?>