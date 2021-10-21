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

        public function LogIn($username){
            
                $_SESSION['currentUser'] = $username;
            
            header('location: '.FRONT_ROOT.'Home/Index');
        }

        public function AddView(){
            require_once(VIEWS_PATH."add-Administrator.php");
        }

        public function Add($username, $password){
            $newAdministrator = new Administrator($username, $password);

            $AdministratorList = $this->administratorDAO->getAll();
            $this->setIdByLastId($AdministratorList, $newAdministrator);

            $this->administratorDAO->add($newAdministrator);

            header('location: '.FRONT_ROOT.'Administrator/ListView');
        }
        private function setIdByLastId($AdministratorList, $Administrator){
            if(empty($AdministratorList)){
                $Administrator->setAdministratorId(1); 
             } else {
                 $lastId = end($AdministratorList)->getAdministratorId();
                 $Administrator->setAdministratorId($lastId + 1);
             }
        }
        public function ListView(){
            
            $AdministratorList = $this->administratorDAO->getAll();

            require_once(VIEWS_PATH."Administrator-list.php");
        }

      
    }
?> 