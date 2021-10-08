<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;

    class StudentController
    {
        private $studentDAO;

        public function __construct(){
            $this->studentDAO = new StudentDAO();
        }

        public function Add($userName, $userPassword){
            $newStudent = new Student();
            
            $newStudent->setUserName($userName);
            $newStudent->setUserPassword($userPassword);
    
            $this->studentDAO->add($newStudent);

            $this->List();
        }

        public function List(){
            $studentList = $this->studentDAO->getAll();

            //require_once(VIEWS_PATH."student-list.php");

            foreach($studentList as $eachStudent){
                echo "<br>".$eachStudent;
            }
        }
    }
?> 