<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\JobOffer as JobOffer;
    use Models\Dedication as Dedication;
    use Models\AdministratorDAO as AdministratorDAO;
    use Models\Administrator as Administrator;

    class JobOfferController {
        private $jobOfferDAO;

        public function __construct() {
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function ShowAddView(){
            $dedicationList = Dedication::GetAll();
            
            $jobPositionDAO = new JobPositionDAO();
            $jobPositionList = $jobPositionDAO->GetAll();

            $companyDAO = new CompanyDAO();
            $companyList = $companyDAO->GetAll();

            $admin = $_SESSION["currentUser"];

            require_once(VIEWS_PATH."add-jobOffer.php");
        }

        public function ShowListView(){
            $jobOfferList = $this->jobOfferDAO->GetAll();

            if(!$jobOfferList) {
                $jobOfferList = new JobOffer();
            }

            $admin = $_SESSION["currentUser"];
            
            $jobPositionDAO = new JobPositionDAO();
            
            $companyDAO = new CompanyDAO();

            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function Add($title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $jobPositionId, $dedication, $companyId, $administratorId) {
            $jobOffer = new JobOffer();

            //Validation of the dates (finishedDate can't be earlier than publishedDate)
            if($publishedDate <= $finishDate){
                $jobOffer->setTitle($title);
                $jobOffer->setPublishedDate($publishedDate);
                $jobOffer->setFinishDate($finishDate);
                $jobOffer->setTask($task);
                $jobOffer->setSkills($skills);
                $jobOffer->setActive($active);
                $jobOffer->setRemote($remote);
                $jobOffer->setSalary($salary);
                //appointment
                $jobOffer->setJobPosition($jobPositionId);
                $jobOffer->setDedication($dedication);
                $jobOffer->setCompanyId($companyId);
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
            $this->jobOfferDAO->ModifyById($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $jobPositionId, $dedication, $companyId, $administratorId);
            
            $this->ShowListView();
        }

        public function ViewDetail($jobOfferId) {
            $jobOffer = $this->jobOfferDAO->FindById($jobOfferId);
            
            $jobPositionDAO = new JobPositionDAO();
            $jobPosition = $jobPositionDAO->FindById($jobOffer->getJobPosition());
            
            $companyDAO = new CompanyDAO();
            $company = $companyDAO->FindById($jobOffer->getCompanyId());

            $isAdmin = $_SESSION['currentUser'] instanceof Administrator ? true : false;

            require_once(VIEWS_PATH."jobOffer-viewDetail.php");
        }
    }
?>