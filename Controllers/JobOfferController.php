<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use Models\JobOffer as JobOffer;
    use Models\Dedication as Dedication;
    use Models\AdministratorDAO as AdministratorDAO;

    class JobOfferController {
        private $jobOfferDAO;

        public function __construct() {
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function ShowAddView(){
            $dedicationList = Dedication::GetAll();
            $jobPositionDAO = new JobPositionDAO();
            $jobPositionList = $jobPositionDAO->GetAll();
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

            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function Add($title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $jobPositionId, $dedication, $administratorId) {
            $jobOffer = new JobOffer();
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
            $jobOffer->setAdministrator($administratorId);

            $jobOfferList = $this->jobOfferDAO->Add($jobOffer);

            $this->ShowAddView();
        }
    }
?>