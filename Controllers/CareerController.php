<?php
    namespace Controllers;

    use DAO\CareerDAO as CareerDAO;
    use Models\Career as Career;

    class CareerController {
        private $careerDAO;

        public function __construct(){
            $this->careerDAO = new CareerDAO();
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function UpdateFromAPI() {
            $this->careerDAO->LoadFromAPI();

            $this->ShowListView();
        }
    }
?>  