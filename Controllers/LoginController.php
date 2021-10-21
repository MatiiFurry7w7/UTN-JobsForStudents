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
        public function LogIn($userName){
            session_destroy();

            $loginUser = null;

            //Login if Student
            foreach($this->studentDAO->getAll() as $eachStudent){
                //echo "<br>".$eachStudent->getEmail()." == ".$userName."<br>";
                if($eachStudent->getEmail() == $userName)
                   $loginUser = $eachStudent;
            }

            //Login if Admin
            if($loginUser == null){
                foreach($this->administratorDAO->getAll() as $eachAdmin){
                    //echo "<br>".$eachAdmin->getusername()." == ".$userName."<br>";
                    if($eachAdmin->getusername() == $userName)
                       $loginUser = $eachAdmin;
                }
            }

            session_start();
            if($loginUser != null)
                $_SESSION['currentUser'] = $loginUser;
                        
            header("location: ".FRONT_ROOT."Home/Index");
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        private function updateFromAPI(){
            $this->studentDAO->loadFromAPI();
        }
    }
?> 