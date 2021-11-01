<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;

    class HomeController
    {
        private $jobOfferDAO;

        public function __construct(){
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function Index($message = ""){
            $jobOfferList = $this->jobOfferDAO->getAll();
            
            require_once(VIEWS_PATH."home.php");
        }        
    }
?>