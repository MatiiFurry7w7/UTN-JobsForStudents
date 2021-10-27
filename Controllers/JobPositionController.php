<?php
    namespace Controllers;

    use DAO\JobPositionDAO as JobPositionDAO;
    use Models\JobPosition as JobPosition;

    class JobPositionController {
        private $jobPositionDAO;

        public function __construct(){
            $this->jobPositionDAO = new JobPositionDAO();
        }

        public function ShowListView(){
            $jobPositionList = $this->jobPositionDAO->GetAll();

            require_once(VIEWS_PATH."jobPosition-list.php");
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function UpdateFromAPI() {
            $this->jobPositionDAO->LoadFromAPI();

            $this->ShowListView();
        }
    }
?>  