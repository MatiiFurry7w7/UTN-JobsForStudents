<?php
    namespace DAO;

    use Models\Career as Career;
    use DAO\IcareerDAO as IcareerDAO;
    use \Exception as Exception;
    use DAO\Connection as Connection;

class CareerDAO implements IcareerDAO {

        private $connection;
        private $tableName = "careers";

        public function Add(Career $career) {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (careerId, title, description, active) 
                    VALUES (:careerId, :title, :description, :active);";

                $parameters["careerId"] = $career->getCareerId();
                $parameters["title"] = $career->getTitle();
                $parameters["description"] = $career->getDescription();
                $parameters["active"] = $career->getActive();

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
                $careerList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $career = new career();
                    
                    $career->setCareerId($row["careerId"]);
                    $career->setTitle($row["title"]);
                    $career->setDescription($row["description"]);
                    $career->setDescription($row["active"]);
        
                    array_push($careerList, $career);
                }
                
                return $careerList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function DeleteById($careerId)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE careerId = :careerId;";

                $parameters["careerId"] = $careerId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function LoadFromAPI() {
            $this->careerList = array();

            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/career');
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($url);
            $toJson = json_decode($response);

            foreach($toJson as $career) {
                
                $newcareer = new career();

                $newcareer->setcareerId($career->careerId);
                $newcareer->setTitle($career->title);
                $newcareer->setDescription($career->description);
                $newcareer->setActive($career->active);

                array_push($this->careerList, $newcareer);
            }

            $this->SaveData();
        }

        private function SaveData() {
            $arrayToEncode = array();

            foreach($this->careerList as $career){
                $valuesArray['careerId'] = $career->getcareerId();
                $valuesArray['title'] = $career->getTitleId();
                $valuesArray['description'] = $career->getDescription();
                $valuesArray['active'] = $career->getActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData() {
            $this->careerList = array();

            if(file_exists($this->fileName)) { 
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                
                foreach($arrayToDecode as $valuesArray) {
                    $career = new career();

                    $career->setcareerId($valuesArray["careerId"]);
                    $career->setTitle($valuesArray["title"]);
                    $career->setDescription($valuesArray["description"]);
                    $career->setActive($valuesArray["active"]);

                    array_push($this->careerList, $career);
                }
            }
        }
    }
         
        /*
        private $careerList = array();
        private $fileName;

          public function __construct() {
            $this->fileName = dirname(__DIR__)."\Data\careers.json";
        }

        public function Add(career $career) {
            $this->RetrieveData();

            array_push($this->careerList, $career);

            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();

            return $this->careerList;            
        }

        public function DeleteById($id) {
            $this->RetrieveData();

            if(!empty($this->careerList)){
                foreach($this->careerList as $career){
                    if($career->getcareerId() == $id){
                        $index = array_search($career, $this->careerList);
                        unset($this->careerList[$index]);
                    }
                }
            }
            $this->SaveData();
        }
        */
?>