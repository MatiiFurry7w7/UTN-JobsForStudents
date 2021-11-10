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
                $query = "INSERT INTO ".$this->tableName." (userName, password) 
                    VALUES (:userName, :password);";

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
    }
?>