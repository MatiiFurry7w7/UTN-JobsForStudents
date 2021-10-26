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
                $query = "INSERT INTO ".$this->tableName." (companyId, name, cuit, description, website, street, number_street, aboutUs, active) 
                    VALUES (:companyId, :name, :cuit, :description, :website, :street, :number_street, :aboutUs, :active);";

                $parameters["companyId"] = $company->getCompanyId();
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
    }
?>