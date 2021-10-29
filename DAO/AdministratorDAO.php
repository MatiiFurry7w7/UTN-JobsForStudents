<?php
    namespace DAO;

    use DAO\IAdministratorDAO as IAdministratorDAO;
    use Models\Administrator as Administrator;
    use \Exception as Exception;
    use DAO\Connection as Connection;

class AdministratorDAO implements IAdministratorDAO{

        private $connection;
        private $tableName = "administrators";

        public function __construct(){
            $this->dataFile = dirname(__DIR__)."\Data\administrator.json";
        }

        public function Add(Administrator $administrator) {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (administratorId, userName, password) 
                    VALUES (:administratorId, :userName, :password);";

                $parameters["administratorId"] = $administrator->getAdministratorId();
                $parameters["userName"] = $administrator->getUserName();
                $parameters["password"] = $administrator->getPassword();
             
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
                $administratorList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $administrator = new administrator();
                    
                    $administrator->setAdministratorId($row["administratorId"]);
                    $administrator->setUserName($row["userName"]);
                    $administrator->setPassword($row["password"]);
        
                    array_push($administratorList, $administrator);
                }
                
                return $administratorList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function DeleteById($administratorId)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE administratorId = :administratorId;";

                $parameters["administratorId"] = $administratorId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function ModifyById($administratorId, $userName, $password)
        {
            {
                try
                {
                    $query = "UPDATE ".$this->tableName." SET userName=:userName, password=:password
                    WHERE administratorId=:administratorId;";

                    $parameters["administratorId"] = $administratorId;
                    $parameters["userName"] = $userName;
                    $parameters["password"] = $password;
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
            }
        }

        public function FindById($administratorId)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName.' WHERE (administratorId = :administratorId);';

                $this->connection = Connection::GetInstance();
                
                $parameters["administratorId"] = $administratorId;

                $result = $this->connection->Execute($query, $parameters)[0];

                if($result) {
                    $administrator = new administrator();
                    $administrator->setadministratorId($result["administratorId"]);
                    $administrator->setUserName($result["userName"]);
                    $administrator->setPassword($result["password"]);
                
                    return $administrator;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        ##################################### JSON #################################################
        /*public function add(Administrator $addingAdministrator){
    
            $this->loadData();
            array_push($this->administratorList, $addingAdministrator);
            $this->saveData();
        }

        public function getAll(){
            $this->loadData();
            return $this->administratorList;            
        }


        public function deleteById($id){
            $this->loadData();
            if(!empty($this->administratorList)){
                foreach($this->administratorList as $administrator){
                    if($administrator->getAdministratorId() == $id){
                        $index = array_search($administrator, $this->administratorList);
                        unset($this->administratorList[$index]);
                    }
                }
            }
            $this->saveData();
        }
        
        private function saveData(){
            
            $encodingArray = array();

            foreach($this->administratorList as $eachAdministrator){
                $arrayValue['administratorId'] = $eachAdministrator->getAdministratorId();
                $arrayValue['password'] = $eachAdministrator->getPassword();
                $arrayValue['userName'] = $eachAdministrator->getUserName();

                array_push($encodingArray, $arrayValue);
            }

            $dataToFile = json_encode($encodingArray, JSON_PRETTY_PRINT);

            file_put_contents($this->dataFile, $dataToFile);
        }

        private function loadData(){
           
            $this->administratorList = array();

            if(file_exists($this->dataFile)){

                $jsonContent = file_get_contents($this->dataFile);

                $decodingArray = ($jsonContent) ? json_decode($jsonContent, true) : array();
                
                foreach($decodingArray as $eachValue){
                    $password = $eachValue["password"];
                    $userName = $eachValue["userName"];

                    $administrator = new Administrator($userName, $password);

                    $administrator->setAdministratorId($eachValue['administratorId']);

                    array_push($this->administratorList, $administrator);
                }
            }
        }
        
        */
        
    }
?>