<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\APIJobPositionDAO as APIJobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\APICareerDAO as APICareerDAO;
    use Models\JobOffer as JobOffer;
    use Models\Dedication as Dedication;
    use Models\AdministratorDAO as AdministratorDAO;
    use Models\Administrator as Administrator;
    use Helpers\SessionHelper as SessionHelper;
    use Controllers\CompanyController as CompanyController;

    class JobOfferController {
        private $jobOfferDAO;

        public function __construct() {
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function ShowAddView($careerId = "") {
            if((new SessionHelper)->isAdmin()) {
                $careerDAO = new APICareerDAO();
                $careerList = $careerDAO->GetAll();
    
                $jobPositionDAO = new APIJobPositionDAO();
                $allJobPositionList = $jobPositionDAO->GetAll();
                $jobPositionList = [];
    
                if($careerId) {
                    foreach($allJobPositionList as $jobPosition) {
                        if($jobPosition->getCareer()->getCareerId() == $careerId){
                            array_push($jobPositionList, $jobPosition);
                        }
                    }
                }
                $dedicationList = Dedication::GetAll();
    
                $companyDAO = new CompanyDAO();
                $companyList = $companyDAO->GetAll();
    
                if($companyList){
                    $admin = (new SessionHelper)->getCurrentUser();
                    require_once(VIEWS_PATH."add-jobOffer.php");
                }else{
                    echo "<script>alert('There are no companies to add to the job offer!')</script>";
                    (new CompanyController())->ShowAddView();
                }
            } else 
                (new HomeController())->Index();
        }

        public function ShowListView(){
            $jobOfferList = $this->jobOfferDAO->GetAll();

            if(!$jobOfferList) {
                $jobOfferList = new JobOffer();
            }

            $admin = (new SessionHelper)->getCurrentUser();

            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function Add($jobPositionId, $companyId, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $dedication, $administratorId) {
            if((new SessionHelper)->isAdmin()) {
                $jobOffer = new JobOffer();
                
                if($this->checkDates($publishedDate, $finishDate)){

                    $jobPositionDAO = new APIJobPositionDAO();
                    $companyDAO = new CompanyDAO();

                    $jobOffer->setJobPosition($jobPositionDAO->FindById($jobPositionId));
                    $jobOffer->setCompany($companyDAO->FindById($companyId));
                    $jobOffer->setTitle($title);
                    $jobOffer->setPublishedDate($publishedDate);
                    $jobOffer->setFinishDate($finishDate);
                    $jobOffer->setTask($task);
                    $jobOffer->setSkills($skills);
                    $jobOffer->setActive($active);
                    $jobOffer->setRemote($remote);
                    $jobOffer->setSalary($salary);
                    $jobOffer->setDedication($dedication);
                    $jobOffer->setAdministrator($administratorId);

                    $jobOfferList = $this->jobOfferDAO->Add($jobOffer);
                } else {
                    ?> <script>alert('Invalid date!')</script><?php
                }
                $this->ShowAddView();
            } else 
                (new HomeController())->Index();
        }

        public function Remove($removeId){
            if((new SessionHelper)->isAdmin()) {
                $this->jobOfferDAO->DeleteById($removeId);
                $this->ShowListView();
            } else 
                (new HomeController())->Index();
        }

        public function ModifyView($modifyId){
            if((new SessionHelper)->isAdmin()) {
                $jobOffer = $this->jobOfferDAO->FindById($modifyId);
                $dedicationList = Dedication::GetAll();
                
                $jobPositionDAO = new APIJobPositionDAO();
                $jobPositionList = $jobPositionDAO->GetAll();
                $careerId = $jobOffer->getJobPosition()->getCareer()->getCareerId();
                
                $companyDAO = new CompanyDAO();
                $companyList = $companyDAO->GetAll();

                $admin = (new SessionHelper)->getCurrentUser();

                require_once(VIEWS_PATH."modify-jobOffer.php");
            } else 
                (new HomeController())->Index();
        }

        public function ModifyAJobOffer($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $jobPositionId, $dedication, $companyId, $administratorId){
            if((new SessionHelper)->isAdmin()) {
                if($this->checkDates($publishedDate, $finishDate)){

                    $jobOffer = new JobOffer();
                    $jobPositionDAO = new APIJobPositionDAO();
                    $companyDAO = new CompanyDAO();

                    $jobOffer->setJobOfferId($jobOfferId);
                    $jobOffer->setJobPosition($jobPositionDAO->FindById($jobPositionId));
                    $jobOffer->setCompany($companyDAO->FindById($companyId));
                    $jobOffer->setTitle($title);
                    $jobOffer->setPublishedDate($publishedDate);
                    $jobOffer->setFinishDate($finishDate);
                    $jobOffer->setTask($task);
                    $jobOffer->setSkills($skills);
                    $jobOffer->setActive($active);
                    $jobOffer->setRemote($remote);
                    $jobOffer->setSalary($salary);
                    $jobOffer->setDedication($dedication);
                    $jobOffer->setAdministrator($administratorId);

                    $jobOfferList = $this->jobOfferDAO->Modify($jobOffer);

                    $this->jobOfferDAO->Modify($jobOffer);
                } else {
                    ?> <script>alert('Invalid date!')</script><?php
                }
                
                $this->ShowListView();
            } else 
                (new HomeController())->Index();
        }

        public function ViewDetail($jobOfferId) {
            $jobOffer = $this->jobOfferDAO->FindById($jobOfferId);

            $isAdmin = (new SessionHelper)->isAdmin();

            require_once(VIEWS_PATH."jobOffer-viewDetail.php");
        }

        //Validation of the dates (finishedDate can't be earlier than publishedDate)
        private function checkDates($publishedDate, $finishDate){
            $validDate = true;
            
            if($publishedDate > $finishDate || $publishedDate < date("Y-m-d"))
                $validDate = false;

            return $validDate;
        }
    }
?>