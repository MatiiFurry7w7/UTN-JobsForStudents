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

        public function Add($careerId, $title, $description, $isActive){
            $career = new Career();
            
            $careerList = $this->careerDAO->GetAll();

            foreach($careerList as $eachCareer) {
                if($eachCareer->getTitle() == $title){
                    $career = $eachCareer;
                }
            }

            if(!$career){
                $career->setCareerId($careerId);
                $career->setDescription($description);
                $career->setTitle($title);
                $career->setActive($isActive);

                $this->careerDAO->Add($career);
            }else {
                ?>
                    <script>alert('The career already exists!');</script>
                <?php
            }

            $this->ShowAddView();
        }

        public function Remove($removeId){
            $this->careerDAO->DeleteById($removeId);
            $this->ShowListView();
        }

        private function setIdByLastId($careerList, $career){
            if(empty($careerList)){
                $career->setcareerId(1); 
             } else {
                 $lastId = end($careerList)->getCareerId();
                 $career->setCareerId($lastId + 1);
             }
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function UpdateFromAPI() {
            $this->careerDAO->LoadFromAPI();

            $this->ShowListView();
        }
    }
?>  