<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\AcademicStatus as AcademicStatus;
    use Models\Career;
    use Models\Student as Student;
    use Models\Administrator as Administrator;

    class StudentController{
        private $studentDAO;

        public function __construct(){
            $this->studentDAO = new StudentDAO();
        }
        
        public function RegisterView($message = ""){
            session_destroy();
            require_once(VIEWS_PATH."add-student.php");
        }

        public function Add($dNI, $fileNumber, $email, $password){
            $newStudent = NULL;
            $studentList = $this->studentDAO->getAll();

            //If already registered
            $found = false;
            if($studentList){
                foreach($studentList as $eachStudent){
                    if($eachStudent->getEmail() == $email){
                        $message = "You´re already registered!";
                        $found = true;
                    }
                }
            }

            //If not registered
            if(!$found){
                $UTNAPILIST = $this->studentDAO->loadFromAPI();

                //Check if UTN student exists..
                foreach($UTNAPILIST as $eachUTNStudent){
                    if($eachUTNStudent->dni == $dNI &&
                       $eachUTNStudent->fileNumber == $fileNumber &&
                       $eachUTNStudent->email == $email){
                            $newStudent = $eachUTNStudent;
                       }
                }

                //If UTN student exists
                if($newStudent){
                    //..but is not active
                    if($newStudent->active == false)
                        $message = "Can´t register!, that student is not active in UTN!";
                    //..and if is active
                    else{
                        $newStudent = new Student();
                        $newStudent->setEmail($email);
                        $newStudent->setPassword($password);
        
                        $this->studentDAO->add($newStudent);
                        $message = "Register complete!";
                    }
                //If UTN student does not exist
                }else{
                    $message = "That information doesn´t match with any UTN student!";
                }
            }
            $this->RegisterView($message);
        }

        public function ListView(){
            if($_SESSION['currentUser'] instanceof Administrator){
                $UTNAPILIST = $this->studentDAO->loadFromAPI();
            $studentList = $this->studentDAO->getAll();
            $newStudentList = array();

            foreach($studentList as $eachStudent){
                foreach($UTNAPILIST as $eachUTNStudent){
                    if($eachStudent->getEmail() == $eachUTNStudent->email){
                        $this->APIStudentToStudent($eachUTNStudent, $eachStudent);
                        array_push($newStudentList, $eachStudent);
                    }
                }
            }

            $studentList = $newStudentList;

            require_once(VIEWS_PATH."student-list.php");
            }else{
                header("location: ".FRONT_ROOT."Home/Index");
            }
        }

        private function getStudentById($id){
            $studentList = $this->studentDAO->getAll();

            $student = null;

            foreach($studentList as $eachStudent){
                if($eachStudent->getStudentId() == $id)
                    $student = $eachStudent;
            }

            return $student;
        }

        public function ProfileView($email){
            $UTNAPILIST = $this->studentDAO->loadFromAPI();
            $studentList = $this->studentDAO->getAll();

            $student = new Student();

            foreach($studentList as $eachStudent){
                foreach($UTNAPILIST as $eachUTNStudent){
                    if($email == $eachUTNStudent->email && $eachUTNStudent->email == $eachStudent->getEmail()){
                        $this->APIStudentToStudent($eachUTNStudent, $student);
                        $student->setStudentId($eachStudent->getStudentId());
                    }
                }
            }

            require_once(VIEWS_PATH."student-profile.php");
        }

        private function APIStudentToStudent($from, Student $to){
            $to->setCareer($from->careerId);
            $to->setFirstName($from->firstName);
            $to->setLastName($from->lastName);
            $to->setDNI($from->dni);
            $to->setFileNumber($from->fileNumber);
            $to->setPhoneNumber($from->phoneNumber);
            $to->setGender($from->gender);
            $to->setEmail($from->email);
            $to->setBirthDate($from->birthDate);
        }
    }
?> 