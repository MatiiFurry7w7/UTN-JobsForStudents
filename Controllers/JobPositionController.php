<?php
    namespace Controllers;

    use DAO\JobPositionDAO as JobPositionDAO;
    use Models\JobPosition as JobPosition;

    class JobPositionController {
        private $jobPositionDAO;

        public function __construct(){
            $this->jobPositionDAO = new JobPositionDAO();
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."add-jobPosition.php");
        }

        public function ShowListView(){
            $jobPositionList = $this->jobPositionDAO->GetAll();

            require_once(VIEWS_PATH."jobPosition-list.php");
        }

        public function Add($carrerId, $description){
            $jobPosition = new JobPosition();
            
            $jobPositionList = $this->jobPositionDAO->GetAll();

            $this->setIdByLastId($jobPositionList, $jobPosition);

            $jobPosition->setCareerId($carrerId);
            $jobPosition->setDescription($description);
            
            $this->jobPositionDAO->Add($jobPosition);

            $this->ShowAddView();
        }

        private function setIdByLastId($jobPositionList, $jobPosition){
            if(empty($jobPositionList)){
                $jobPosition->setJobPositionId(1); 
             } else {
                 $lastId = end($jobPositionList)->getJobPositionId();
                 $jobPosition->setJobPositionId($lastId + 1);
             }
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function UpdateFromAPI() {
            $this->jobPositionDAO->LoadFromAPI();

            $this->ShowListView();
        }
    }
?>  