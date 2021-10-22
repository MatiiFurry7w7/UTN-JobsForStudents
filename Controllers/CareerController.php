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

        public function Add($carrerId, $description){
            $career = new Career();
            
            $careerList = $this->careerDAO->GetAll();

            $this->setIdByLastId($careerList, $career);

            $career->setCareerId($carrerId);
            $career->setDescription($description);
            
            $this->careerDAO->Add($career);

            $this->ShowAddView();
        }

        private function setIdByLastId($careerList, $career){
            if(empty($careerList)){
                $career->setcareerId(1); 
             } else {
                 $lastId = end($careerList)->getcareerId();
                 $career->setcareerId($lastId + 1);
             }
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function UpdateFromAPI() {
            $this->careerDAO->LoadFromAPI();

            $this->ShowListView();
        }
    }
?>  