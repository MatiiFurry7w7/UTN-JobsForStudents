<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;    
    use DAO\Connection as Connection;

    class CompanyDAO implements ICompanyDAO
    {
        private $connection;
        private $tableName = "companies";

        public function Add(Company $company)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (name, cuit, description, website, street, number_street, aboutUs, active) 
                    VALUES (:name, :cuit, :description, :website, :street, :number_street, :aboutUs, :active);";

                $parameters["name"] = $company->getName();
                $parameters["cuit"] = $company->getCuit();
                $parameters["description"] = $company->getDescription();
                $parameters["website"] = $company->getWebsite();
                $parameters["street"] = $company->getStreet();
                $parameters["number_street"] = $company->getNumber();
                $parameters["aboutUs"] = $company->getAboutUs();
                $parameters["active"] = $company->getActive();
                //industries
                //jobOffer
                //administrator

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
                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setCompanyId($row["companyId"]);
                    $company->setName($row["name"]);
                    $company->setCuit($row["cuit"]);
                    $company->setDescription($row["description"]);
                    $company->setWebsite($row["website"]);
                    $company->setStreet($row["street"]);
                    $company->setNumber($row["number_street"]);
                    $company->setAboutUs($row["aboutUs"]);
                    $company->setActive($row["active"]);
                    //industries
                    //jobOffer
                    //administrator
        
                    array_push($companyList, $company);
                }
                
                return $companyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function DeleteById($companyId)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE companyId = :companyId;";

                $parameters["companyId"] = $companyId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function FindById($companyId)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName.' WHERE (companyId = :companyId);';

                $this->connection = Connection::GetInstance();
                
                $parameters["companyId"] = $companyId;

                $result = $this->connection->Execute($query, $parameters);

                $company = new Company();
                $company->setCompanyId($result[0]["companyId"]);
                $company->setName($result[0]["name"]);
                $company->setCuit($result[0]["cuit"]);
                $company->setDescription($result[0]["description"]);
                $company->setWebsite($result[0]["website"]);
                $company->setStreet($result[0]["street"]);
                $company->setNumber($result[0]["number_street"]);
                $company->setAboutUs($result[0]["aboutUs"]);
                $company->setActive($result[0]["active"]);
                //industries
                //jobOffer
                //administrator
                
                return $company;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function ModifyById($companyId, $name, $cuit, $description, $website, $street, $number, $aboutUs, $active)
        {
            {
                try
                {
                    $query = "UPDATE ".$this->tableName." SET name=:name, cuit=:cuit, description=:description, website=:website, street=:street, number_street=:number_street, aboutUs=:aboutUs, active=:active 
                    WHERE companyId=:companyId;";

                    $parameters["companyId"] = $companyId;
                    $parameters["name"] = $name;
                    $parameters["cuit"] = $cuit;
                    $parameters["description"] = $description;
                    $parameters["website"] = $website;
                    $parameters["street"] = $street;
                    $parameters["number_street"] = $number;
                    $parameters["aboutUs"] = $aboutUs;
                    $parameters["active"] = $active;
                    //industries
                    //jobOffer
                    //administrator
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
            }
        }
    }
?>