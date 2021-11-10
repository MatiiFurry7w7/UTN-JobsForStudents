<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\APIJobPositionDAO as APIJobPositionDAO;
    use DAO\APICareerDAO as APICareerDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Administrator as Administrator;
    use Models\JobOffer as JobOffer;

    class HomeController
    {
        private $jobOfferDAO;
        private $jobPositionDAO;
        private $careerDAO;

        public function __construct(){
            $this->jobOfferDAO = new JobOfferDAO();
            $this->jobPositionDAO = new APIJobPositionDAO();
            $this->careerDAO = new APICareerDAO();
        }

        public function Index($message = ""){
            $jobOfferList = $this->jobOfferDAO->GetAll();

            if($jobOfferList)
                $i = count($jobOfferList);
            else    
                $i = 0;

            $jobPositionList = $this->jobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();

            $isAdmin = (new SessionHelper())->isAdmin();   
                     
            require_once(VIEWS_PATH."home.php");
        }   

        public function Filters($careerId, $jobPositionSearch = "") {
            $isAdmin = (new SessionHelper())->isAdmin();

            $jobOfferList = $this->jobOfferDAO->GetAll();

            $jobPositionList = $this->jobPositionDAO->GetAll();

            $careerList = $this->careerDAO->GetAll();

            $newJOList = []; 

            if($jobOfferList){
                foreach($jobOfferList as $jobOffer){
                    if(strpos(strtolower($jobOffer->getJobPosition()->getDescription()), strtolower($jobPositionSearch)) !== false && 
                        $jobOffer->getJobPosition()->getCareer()->getCareerId() == $careerId){
                        array_push($newJOList, $jobOffer);
                    }
                }
                $i = count($newJOList);
            }else
                $i = 0;  

            if($newJOList) { 
                $jobOfferList = $newJOList;
            } else {
                $jobOfferList = null;
            }
            
            require_once(VIEWS_PATH."home.php");
        }
    }
?>