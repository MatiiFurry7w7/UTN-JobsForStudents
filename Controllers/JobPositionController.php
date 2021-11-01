<?php
    namespace Controllers;

    use DAO\JobPositionDAO as JobPositionDAO;
    use Models\JobPosition as JobPosition;

    class JobPositionController {
        private $jobPositionDAO;

        public function __construct(){
            $this->jobPositionDAO = new JobPositionDAO();
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function UpdateFromAPI() {
            $this->jobPositionDAO->LoadFromAPI();
        }
    }
?>  