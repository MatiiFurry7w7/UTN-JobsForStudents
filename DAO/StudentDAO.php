<?php namespace DAO;

    use \Exception as Exception;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;    
    use DAO\Connection as Connection;
    use DAO\CareerDAO as CareerDAO;

    class StudentDAO implements IStudentDAO{
        private $connection;
        private $tableName = "students";
        private $careerDAO;

        public function __construct() {
             $this->careerDAO = new CareerDAO();
        }

        public function add(Student $student){
            try{
                $query = "INSERT INTO ".$this->tableName." (email, password) 
                VALUES (:email, :password);";

                $parameters["email"] = $student->getEmail();
                $parameters["password"] = $student->getPassword();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function getAll(){
            try{
                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if($resultSet){
                    foreach ($resultSet as $row){                
                        $student = new Student();
                        $student->setStudentId($row["studentId"]);
                        $student->setEmail($row["email"]);
                        $student->setPassword($row["password"]);
            
                        array_push($companyList, $student);
                    }
                    return $companyList;
                }
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function deleteById($studentId){
            try{
                $query = "DELETE FROM ".$this->tableName." WHERE studentId = :studentId;";

                $parameters["studentId"] = $studentId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function FindById($studentId){
            try{
                $query = "SELECT * FROM ".$this->tableName.' WHERE (studentId = :studentId);';

                $this->connection = Connection::GetInstance();
                
                $parameters["studentId"] = $studentId;

                $result = $this->connection->Execute($query, $parameters)[0];

                if($result){
                    $student = new Student();
                    $student->setStudentId($result["studentId"]);
                    $student->setEmail($result["email"]);
                    $student->setPassword($result["password"]);
                
                    return $student;
                }
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function modifyById($studentId, $password, $email){
            try{
                $query = "UPDATE ".$this->tableName." SET password=:password, email=:email
                WHERE studentId=:studentId;";

                $parameters["studentId"] = $studentId;
                $parameters["email"] = $email;
                $parameters["password"] = $password;
    
                $this->connection = Connection::GetInstance();
    
                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        //TEST
        public function loadFromAPI(){
            $apiList = array();
            $apiCareers = $this->careerDAO->getAll();

            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Student');
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($url);
            $toJson = json_decode($response);

            foreach($toJson as $eachStudent){
                foreach($apiCareers as $eachCareer){
                    if($eachStudent->careerId == $eachCareer->getCareerId())
                        $eachStudent->careerId = $eachCareer->getDescription();
                }
                array_push($apiList, $eachStudent);
            }
            return $apiList;
        }
    }
?>