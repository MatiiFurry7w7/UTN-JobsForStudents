<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\Administrator as Administrator;
    use Models\JobOffer as JobOffer;

    class HomeController
    {
        private $jobOfferDAO;
        private $jobPositionDAO;
        private $careerDAO;

        public function __construct(){
            $this->jobOfferDAO = new JobOfferDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function Index($message = ""){
            $jobOfferList = null;

            $jobOfferList = $this->jobOfferDAO->GetAll();

            $i = count($jobOfferList);

            $jobPositionList = $this->jobPositionDAO->GetAll();

            $careerList = $this->careerDAO->GetAll();

            $isAdmin = $_SESSION['currentUser'] instanceof Administrator ? true : false;
            
            require_once(VIEWS_PATH."home.php");
        }   

        public function Filters($careerId, $jobPositionSearch = "") {
            $isAdmin = $_SESSION['currentUser'] instanceof Administrator ? true : false;

            $jobOfferList = $this->jobOfferDAO->GetAll();

            $jobPositionList = $this->jobPositionDAO->GetAll();

            $careerList = $this->careerDAO->GetAll();

            $newJOList = []; 
            
            foreach($jobOfferList as $jobOffer){
                if(strpos(strtolower($jobOffer->getJobPosition()->getDescription()), strtolower($jobPositionSearch)) !== false && 
                    $jobOffer->getJobPosition()->getCareer()->getCareerId() == $careerId){
                    array_push($newJOList, $jobOffer);
                }
            }

            $i = count($newJOList);

            if($newJOList) { 
                $jobOfferList = $newJOList;
            } else {
                $jobOfferList = null;
            }
            
            require_once(VIEWS_PATH."home.php");
        }
    }
?>