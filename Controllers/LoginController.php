<?php
    namespace Controllers;

    use DAO\AdministratorDAO as AdministratorDAO;
    use DAO\StudentDAO as StudentDAO;

    use Models\Administrator as Administrator;
    use Models\Student as Student;
    use Helpers\SessionHelper as SessionHelper;
    use Controllers\StudentController as StudentController;
    use DAO\AppointmentDAO;
    use DAO\APICareerDAO;
    use DAO\UTNAPIStudentDAO;

class LoginController{

        private $studentDAO;
        private $UTNAPIDAO;
        private $administratorDAO;
        private $careerDAO;

        public function __construct(){
            $this->UTNAPIDAO = new UTNAPIStudentDAO();
            $this->studentDAO = new StudentDAO();
            $this->administratorDAO = new administratorDAO();
            $this->careerDAO = new APICareerDAO();
        }

        public function LogInView($message = ""){
            session_destroy();
            require_once(VIEWS_PATH."login.php");
        }

        public function LogIn($email, $userPassword){
            (new SessionHelper())->sessionRestart();

            $loginUser = null;

            //Login if Admin
            foreach($this->administratorDAO->getAll() as $eachAdmin){
                //echo "<br>".$eachAdmin->getusername()." == ".$userName."<br>";
                if($eachAdmin->getEmail() == $email)
                   $loginUser = $eachAdmin;
            }
            
            //Login if Student
            if($loginUser == null){
                $UTNAPILIST = $this->UTNAPIDAO->loadFromAPI();
                $studentList = $this->studentDAO->getAll();

                if($studentList != null){
                    $appointmentList = (new AppointmentDAO)->getAll();
                    foreach($studentList as $eachStudent){
                        if($eachStudent->getEmail() == $email && $eachStudent->getPassword() == $userPassword)
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

                                        if($appointmentList)
                                            foreach($appointmentList as $eachAppointment)
                                                if($eachAppointment->getStudentId() == $eachStudent->getUserId()){
                                                    $eachStudent->setAppointment($eachAppointment);
                                                }

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
                (new SessionHelper())->setCurrentUser($loginUser);
                $this->careerDAO->LoadFromAPI();
                header("location: ".FRONT_ROOT."Home/Index");
            }
        }
    }
?> 