<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use Models\JobOffer as JobOffer;
    
    class JobOfferController {
        private $jobOfferDAO;

        public function __construct() {
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."add-jobOffer.php");
        }

        public function ShowListView(){
            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function Add($title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary) {
            $jobOffer = new JobOffer();
            $jobOffer->setTitle($title);
            $jobOffer->setPublishedDate($publishedDate);
            $jobOffer->setFinishDate($finishDate);
            $jobOffer->setTask($task);
            $jobOffer->setSkills($skills);
            $jobOffer->setActive($active);
            $jobOffer->setRemote($remote);
            $jobOffer->setSalary($salary);

            $jobOfferList = $this->jobOfferDAO->Add($jobOffer);

            $this->ShowAddView();
        }
    }
?>