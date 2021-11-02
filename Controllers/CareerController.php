<?php
    namespace Controllers;

    use DAO\CareerDAO as CareerDAO;
    use Models\Career as Career;

    class CareerController {
        private $careerDAO;

        public function __construct(){
            $this->careerDAO = new CareerDAO();
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."add-career.php");
        }

        public function ShowListView(){
            $careerList = $this->careerDAO->GetAll();

            require_once(VIEWS_PATH."career-list.php");
        }


        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function UpdateFromAPI() {
            $this->careerDAO->LoadFromAPI();

            $this->ShowListView();
        }
    }
?>  