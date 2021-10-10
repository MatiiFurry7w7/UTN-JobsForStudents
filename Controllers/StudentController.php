<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\AcademicStatus as AcademicStatus;
    use Models\Student as Student;

    //WONT USE THESE
    use Models\Dedication as Dedication;
    use Models\Industry as Industry;

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

            require_once(VIEWS_PATH."student-list.php");
        }

        public function TEST(){
            $matiMercado = new Student(1, "Matias", "Mercado", "mati@hotmail.com", 152431512, "Masculine", 43444555, "01/01/2001");
            $matiMercado->setAcademicStatus(new AcademicStatus(8.77, 43444555));
            $matiMercado->setCareer("Analista en Sistemas");
            echo $matiMercado;

            echo "<br><br> Dedication Example: ".Dedication::FULLTIME;
            echo "<br> Industry Example: ".Industry::IT;
        }
    }
?> 