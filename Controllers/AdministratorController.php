<?php
    namespace Controllers;

    use DAO\AdministratorDAO as AdministratorDAO;
    
    use Models\Administrator as Administrator;

    class AdministratorController
    {
        private $administratorDAO;

        public function __construct(){
            $this->administratorDAO = new AdministratorDAO();
        }

        public function LogInView(){
            session_destroy();
            require_once(VIEWS_PATH."login.php");
        }

        public function LogIn($userName){
            
                $_SESSION['currentUser'] = $userName;
            
            header('location: '.FRONT_ROOT.'Home/Index');
        }

        public function AddView(){
            require_once(VIEWS_PATH."add-administrator.php");
        }

        public function Add($userName, $password){
            $newAdministrator = new Administrator($userName, $password);

            $administratorList = $this->administratorDAO->getAll();
            $this->setIdByLastId($administratorList, $newAdministrator);

            $this->administratorDAO->add($newAdministrator);

            header('location: '.FRONT_ROOT.'administrator/ListView');
        }
        private function setIdByLastId($administratorList, $administrator){
            if(empty($administratorList)){
                $administrator->setAdministratorId(1); 
             } else {
                 $lastId = end($administratorList)->getAdministratorId();
                 $administrator->setAdministratorId($lastId + 1);
             }
        }
        public function ListView(){
            
            $administratorList = $this->administratorDAO->getAll();

            require_once(VIEWS_PATH."administrator-list.php");
        }

      
    }
?> 