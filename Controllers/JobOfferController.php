<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\JobOffer as JobOffer;
    use Models\Dedication as Dedication;
    use Models\AdministratorDAO as AdministratorDAO;
    use Models\Administrator as Administrator;
    use Controllers\CompanyController as CompanyController;

    class JobOfferController {
        private $jobOfferDAO;

        public function __construct() {
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function ShowAddView($careerId = ""){
            $careerDAO = new CareerDAO();
            $careerList = $careerDAO->GetAll();

            $jobPositionDAO = new JobPositionDAO();
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
                $admin = $_SESSION["currentUser"];
                require_once(VIEWS_PATH."add-jobOffer.php");
            }else{
                echo "<script>alert('There are no companies to add to the job offer!')</script>";
                (new CompanyController())->ShowAddView();
            }
            
        }

        public function ShowListView(){
            $jobOfferList = $this->jobOfferDAO->GetAll();

            if(!$jobOfferList) {
                $jobOfferList = new JobOffer();
            }

            $admin = $_SESSION["currentUser"];

            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function Add($jobPositionId, $companyId, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $dedication, $administratorId) {
            $jobOffer = new JobOffer();
            
            if($this->checkDates($publishedDate, $finishDate)){
                $jobOffer->setJobPosition($jobPositionId);
                $jobOffer->setCompany($companyId);
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
                ?> <script>alert('The end date cannot be earlier than published date!')</script><?php
            }
            $this->ShowAddView();
        }

        public function Remove($removeId){
            $this->jobOfferDAO->DeleteById($removeId);
            $this->ShowListView();
        }

        public function ModifyView($modifyId){
            $jobOffer = $this->jobOfferDAO->FindById($modifyId);
            $dedicationList = Dedication::GetAll();
            
            $jobPositionDAO = new JobPositionDAO();
            $jobPositionList = $jobPositionDAO->GetAll();
            
            $companyDAO = new CompanyDAO();
            $companyList = $companyDAO->GetAll();

            $admin = $_SESSION["currentUser"];

            require_once(VIEWS_PATH."modify-jobOffer.php");
        }

        public function ModifyAJobOffer($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $jobPositionId, $dedication, $companyId, $administratorId){
            if($this->checkDates($publishedDate, $finishDate)){
                $this->jobOfferDAO->ModifyById($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $jobPositionId, $dedication, $companyId, $administratorId);
            
            } else {
                ?> <script>alert('The end date cannot be earlier than published date!')</script><?php
            }
            
            $this->ShowListView();
        }

        public function ViewDetail($jobOfferId) {
            $jobOffer = $this->jobOfferDAO->FindById($jobOfferId);

            $isAdmin = $_SESSION['currentUser'] instanceof Administrator ? true : false;

            require_once(VIEWS_PATH."jobOffer-viewDetail.php");
        }

        //Validation of the dates (finishedDate can't be earlier than publishedDate)
        private function checkDates($publishedDate, $finishDate){
            $validDate = true;

            if($publishedDate > $finishDate)
                $validDate = false;

            return $validDate;
        }
    }
?>