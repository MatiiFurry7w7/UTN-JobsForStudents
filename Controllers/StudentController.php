<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\AcademicStatus as AcademicStatus;
    use Models\Career;
    use Models\Student as Student;

class StudentController
    {
        private $studentDAO;

        public function __construct(){
            $this->studentDAO = new StudentDAO();
        }

        public function LogInView(){
            session_destroy();
            require_once(VIEWS_PATH."login.php");
        }

        public function LogIn($userName){
            //ALL VALIDATIONS IN HERE!!
            $studentList = $this->studentDAO->getAll();
            foreach($studentList as $eachStudent){
                if($eachStudent->getEmail() == $userName){
                    $_SESSION['currentUser'] = $eachStudent;
                }
            }
            
            header('location: '.FRONT_ROOT.'Home/Index');
        }

        public function AddView(){
            require_once(VIEWS_PATH."add-student.php");
        }

        public function Add($firstName, $lastName, $email, $phoneNumber, $gender, $dNI, $birthDate){
            $newStudent = new Student($firstName, $lastName, $email, $phoneNumber, $gender, $dNI, $birthDate);

            $studentList = $this->studentDAO->getAll();
            $this->setIdByLastId($studentList, $newStudent);

            //DEFAULT VALUES, CHANGE LATER!
            $newAcademicStatus = new AcademicStatus(true, "N/A", "N/A");
            $newStudent->setAcademicStatus($newAcademicStatus);

            $newCareer = new Career("N/A", "N/A", "N/A");
            $newStudent->setCareer($newCareer);

            $this->studentDAO->add($newStudent);

            header('location: '.FRONT_ROOT.'Student/ListView');
        }

        public function ListView(){
            $studentList = $this->studentDAO->getAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        private function setIdByLastId($studentList, $student){
            if(empty($studentList)){
                $student->setstudentId(1); 
             } else {
                 $lastId = end($studentList)->getStudentId();
                 $student->setStudentId($lastId + 1);
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

        public function ProfileView($studentId){
            $student = $this->getStudentById($studentId);

            require_once(VIEWS_PATH."student-profile.php");
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function updateFromAPI(){
            $this->studentDAO->loadFromAPI();

            $this->ListView();
        }
    }
?> 