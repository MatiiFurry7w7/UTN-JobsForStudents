<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use Models\Administrator as Administrator;

    class HomeController
    {
        private $jobOfferDAO;

        public function __construct(){
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function Index($message = "", $searchedJobOffer = ""){
            $jobOfferList = null;
            
            $jobOfferList = $this->jobOfferDAO->GetAll();

            $isAdmin = $_SESSION['currentUser'] instanceof Administrator ? true : false;
            
            require_once(VIEWS_PATH."home.php");
        }   
    }
?>