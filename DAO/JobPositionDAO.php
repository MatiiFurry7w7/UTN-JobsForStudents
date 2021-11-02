<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\JobPosition as JobPosition;
    use DAO\IJobPositionDAO as IJobPositionDAO;
    use DAO\CareerDAO as CareerDAO;

    class JobPositionDAO implements IJobPositionDAO {

        private $connection;
        private $tableName = "jobPositions";

        public function Add(JobPosition $jobPosition) {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, careerId, description) 
                    VALUES (:jobPositionId, :careerId, :description);";

                $parameters["jobPositionId"] = $jobPosition->getJobPositionId();
                $parameters["careerId"] = $jobPosition->getCareer();
                $parameters["description"] = $jobPosition->getDescription();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $jobPositionList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobPosition = new JobPosition();

                    $careerDAO = new CareerDAO();
                    
                    $jobPosition->setJobPositionId($row["jobPositionId"]);
                    $jobPosition->setCareer($row["careerId"]);
                    //$jobPosition->setCareer($careerDAO->FindById($row["careerId"]));
                    $jobPosition->setDescription($row["description"]);
        
                    array_push($jobPositionList, $jobPosition);
                }
                
                return $jobPositionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function FindById($jobPositionId)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName.' WHERE (jobPositionId = :jobPositionId);';

                $this->connection = Connection::GetInstance();
                
                $parameters["jobPositionId"] = $jobPositionId;

                $result = $this->connection->Execute($query, $parameters)[0];

                $careerDAO = new CareerDAO();

                if($result) {
                    $jobPosition = new JobPosition();
                    $jobPosition->setJobPositionId($result["jobPositionId"]);
                    $jobPosition->setCareer($result["careerId"]);
                    //$jobPosition->setCareer($careerDAO->FindById($result["careerId"]));
                    $jobPosition->setDescription($result["description"]);
                    
                    return $jobPosition;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function LoadFromAPI() {
            $this->jobPositionList = array();

            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/jobPosition');
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($url);
            $toJson = json_decode($response);
            

            foreach($toJson as $jobPosition) {
                $newJobPosition = new JobPosition();

                $newJobPosition->setJobPositionId($jobPosition->jobPositionId);
                $newJobPosition->setCareer($jobPosition->careerId);
                $newJobPosition->setDescription($jobPosition->description);

                $this->Add($newJobPosition);
            }
        }
    }
?>