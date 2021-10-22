<?php
    namespace Controllers;

    use DAO\AdministratorDAO as AdministratorDAO;
    use DAO\StudentDAO as StudentDAO;

    use Models\Administrator as Administrator;
    use Models\Student as Student;

    class LoginController{

        private $studentDAO;
        private $administratorDAO;

        public function __construct(){
            $this->studentDAO = new StudentDAO();
            $this->administratorDAO = new administratorDAO();
        }

        public function LogInView($message = ""){
            session_destroy();
            require_once(VIEWS_PATH."login.php");
            
        }

        public function LogIn($userName){
            session_destroy();
            session_start();

            $loginUser = null;

            //Login if Admin
            foreach($this->administratorDAO->getAll() as $eachAdmin){
                //echo "<br>".$eachAdmin->getusername()." == ".$userName."<br>";
                if($eachAdmin->getUserName() == $userName)
                   $loginUser = $eachAdmin;
            }
            
            //Login if Student
            if($loginUser == null){
                //Update from API before checking Student
                $this->updateFromAPI();
                foreach($this->studentDAO->getAll() as $eachStudent){
                    //echo "<br>".$eachStudent->getEmail()." == ".$userName."<br>";
                    if($eachStudent->getEmail() == $userName)
                       $loginUser = $eachStudent;
                }
            }

            if($loginUser == null){
                $this->LogInView("Those login credentials doesn't exist in our database!");
            }else{
                $_SESSION['currentUser'] = $loginUser;
                header("location: ".FRONT_ROOT."Home/Index");
            }
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        private function updateFromAPI(){
            $this->studentDAO->loadFromAPI();
        }
    }
?> 