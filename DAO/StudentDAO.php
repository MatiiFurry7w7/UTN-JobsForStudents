<?php
    namespace DAO;

    use Models\Student as Student;

    class StudentDAO{

        private $studentList = array();

        //PUBLIC --------------------------------------------------

        //Add Student to repository
        public function add(Student $addingStudent){
            //Get array from data file
            $this->loadData();

            //Insert the new Student in the array
            array_push($this->studentList, $addingStudent);

            //Save array to data file
            $this->saveData();
        }

        //Remove Student from repository
        public function remove(Student $removingStudent){
            //Get array from data file
            $this->loadData();
        
            //Search Student in the array
            if(($index = array_search($removingStudent, $this->studentList)) !== false){
                //Remove it from array if found 
                unset($this->studentList[$index]);
            }
        
            //Save array to data file
            $this->saveData();
        }

        //Return the array
        public function getAll(){
            $this->loadData();
            return $this->studentList;            
        }

        //PRIVATE -------------------------------------------------

        //Save array to file
        private function saveData(){
            //Array to save each Student data
            $encodingArray = array();

            require_once ROOT."Config/Connection.php";
            var_dump($connection);

            try{            
                foreach($this->studentList as $eachStudent){
                    $eachUserName = $eachStudent->getUserName();
                    $eachPassword = $eachStudent->getUserPassword();

                    $query = $connection->prepare("INSERT INTO students (userName, userPassword)
                    VALUES (:userName, :userPassword)");

                    $query->bindParam(":userName", $eachUserName);
                    $query->bindParam(":userPassword", $eachPassword);

                    $query->execute();  
                }
            }catch(PDOException $e){
                echo "An error has ocurred: ".$e->getMessage();
            }
        }

        //Load array from file
        private function loadData(){
            //Clear the actual array list
            $this->studentList = array();

            require_once ROOT."Config/Connection.php";

            try{
                $query = $connection->prepare("SELECT studentId, userName, userPassword FROM students");
                $query->execute();
    
                $result = $query->fetchAll();
    
                foreach($result as $eachValue){
                    $Student = new Student();
                    $Student->setStudentId($eachValue['studentId']);
                    $Student->setUserName($eachValue['userName']);
                    $Student->setUserPassword($eachValue['userPassword']);
                    
                    array_push($this->studentList, $Student);
                }
            }catch(PDOException $e){
                echo "An error has ocurred: ".$e->getMessage();
            }
        }
        
    }
?>