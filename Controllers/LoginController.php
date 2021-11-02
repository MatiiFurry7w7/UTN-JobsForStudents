<?php
    namespace Controllers;

    use DAO\AdministratorDAO as AdministratorDAO;
    use DAO\StudentDAO as StudentDAO;

    use Models\Administrator as Administrator;
    use Models\Student as Student;
    use Controllers\StudentController as StudentController;
    use DAO\CareerDAO;

class LoginController{

        private $studentDAO;
        private $administratorDAO;
        private $careerDAO;

        public function __construct(){
            $this->studentDAO = new StudentDAO();
            $this->administratorDAO = new administratorDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function LogInView($message = ""){
            session_destroy();
            require_once(VIEWS_PATH."login.php");
        }

        public function LogIn($userName, $userPassword){
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
                $UTNAPILIST = $this->studentDAO->loadFromAPI();
                $studentList = $this->studentDAO->getAll();

                if($studentList != null){
                    foreach($studentList as $eachStudent){
                        if($eachStudent->getEmail() == $userName && $eachStudent->getPassword() == $userPassword)
                            foreach($UTNAPILIST as $eachUTNStudent)
                                if($eachStudent->getEmail() == $eachUTNStudent->email){
                                    if($eachUTNStudent->active == true){
                                        $eachStudent->setFirstName($eachUTNStudent->firstName);
                                        $eachStudent->setLastName($eachUTNStudent->lastName);
                                        $eachStudent->setPhoneNumber($eachUTNStudent->phoneNumber);
                                        $eachStudent->setGender($eachUTNStudent->gender);
                                        $eachStudent->setDNI($eachUTNStudent->dni);
                                        $eachStudent->setBirthDate($eachUTNStudent->birthDate);
                                        $eachStudent->setCareer($eachUTNStudent->careerId);
                                        $eachStudent->setFileNumber($eachUTNStudent->fileNumber);
    
                                        $loginUser = $eachStudent;
                                    }
                                    else
                                        $this->LogInView("That student is not active!");
                                }
                    }
                }
            }

            if($loginUser == null){
                $this->LogInView("Those login credentials doesn't exist in our database!");
            }else{
                $_SESSION['currentUser'] = $loginUser;
                $this->careerDAO->LoadFromAPI();
                header("location: ".FRONT_ROOT."Home/Index");
            }
        }
    }
?> 