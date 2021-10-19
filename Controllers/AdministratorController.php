<?php
    namespace Controllers;

    use DAO\AdministratorDAO as AdministratorDAO;
    
    use Models\Administrator as Administrator;

    class AdministratorController
    {
        private $administratorDao;

        public function __construct(){
            $this->administratorDao = new AdministratorDAO();
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

        public function Add($id, $password, $username){
            $newAdministrator = new Administrator($id, $password, $username);

            $AdministratorList = $this->administratorDao->getAll();
            $this->setIdByLastId($AdministratorList, $newAdministrator);

            $this->administratorDao->add($newAdministrator);

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
            
            $AdministratorList = $this->administratorDao->getAll();

            require_once(VIEWS_PATH."Administrator-list.php");
        }

      
    }
?> 