<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IJobOfferDAO as IJobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\APIJobPositionDAO as APIJobPositionDAO;
    use Models\JobOffer as JobOffer;    
    use DAO\Connection as Connection;

    class JobOfferDAO implements IJobOfferDAO
    {
        private $connection;
        private $tableName = "jobOffers";

        public function Add(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, companyId, title, publishedDate, finishDate, task, skills, active, remote, salary, dedication, administratorId) 
                    VALUES (:jobPositionId, :companyId, :title, :publishedDate, :finishDate, :task, :skills, :active, :remote, :salary, :dedication, :administratorId);";

                $parameters["jobPositionId"] = $jobOffer->getJobPosition();
                $parameters["companyId"] = $jobOffer->getCompany();
                $parameters["title"] = $jobOffer->getTitle();
                $parameters["publishedDate"] = $jobOffer->getPublishedDate();
                $parameters["finishDate"] = $jobOffer->getFinishDate();
                $parameters["task"] = $jobOffer->getTask();
                $parameters["skills"] = $jobOffer->getSkills();
                $parameters["active"] = $jobOffer->getActive();
                $parameters["remote"] = $jobOffer->getRemote();
                $parameters["salary"] = $jobOffer->getSalary();
                $parameters["dedication"] = $jobOffer->getDedication();
                $parameters["administratorId"] = $jobOffer->getAdministrator();

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
                $jobOfferList = array();

                $query = "SELECT * FROM ".$this->tableName." ORDER BY publishedDate DESC";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                if($resultSet) {
                    foreach ($resultSet as $row)
                    {                
                        $jobOffer = new JobOffer();
                        $companyDAO = new CompanyDAO();
                        $jobPositionDAO = new APIJobPositionDAO();

                        $jobOffer->setJobOfferId($row["jobOfferId"]);
                        $jobOffer->setTitle($row["title"]);
                        $jobOffer->setPublishedDate($row["publishedDate"]);
                        $jobOffer->setFinishDate($row["finishDate"]);
                        $jobOffer->setTask($row["task"]);
                        $jobOffer->setSkills($row["skills"]);
                        $jobOffer->setActive($row["active"]);
                        $jobOffer->setRemote($row["remote"]);
                        $jobOffer->setSalary($row["salary"]);
                        //appointment
                        $jobOffer->setJobPosition($jobPositionDAO->FindById($row["jobPositionId"]));
                        $jobOffer->setDedication($row["dedication"]);
                        $jobOffer->setCompany($companyDAO->FindById($row["companyId"]));
                        $jobOffer->setAdministrator($row["administratorId"]);
            
                        array_push($jobOfferList, $jobOffer);
                    }
                    return $jobOfferList;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function DeleteById($jobOfferId)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET active = 0 WHERE jobOfferId = :jobOfferId;";

                $parameters["jobOfferId"] = $jobOfferId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function FindById($jobOfferId)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName.' WHERE (jobOfferId = :jobOfferId);';

                $this->connection = Connection::GetInstance();
                
                $parameters["jobOfferId"] = $jobOfferId;

                $result = $this->connection->Execute($query, $parameters)[0];

                $companyDAO = new CompanyDAO();
                        
                $jobPositionDAO = new APIJobPositionDAO();

                if($result) {
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($result["jobOfferId"]);
                    $jobOffer->setTitle($result["title"]);
                    $jobOffer->setPublishedDate($result["publishedDate"]);
                    $jobOffer->setFinishDate($result["finishDate"]);
                    $jobOffer->setTask($result["task"]);
                    $jobOffer->setSkills($result["skills"]);
                    $jobOffer->setActive($result["active"]);
                    $jobOffer->setRemote($result["remote"]);
                    $jobOffer->setSalary($result["salary"]);
                    //appointment
                    $jobOffer->setJobPosition($jobPositionDAO->FindById($result["jobPositionId"]));
                    $jobOffer->setDedication($result["dedication"]);
                    $jobOffer->setCompany($companyDAO->FindById($result["companyId"]));
                    $jobOffer->setAdministrator($result["administratorId"]);
                    
                    return $jobOffer;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function ModifyById($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $jobPositionId, $dedication, $companyId, $administratorId)
        {
            {
                try
                {
                    $query = "UPDATE ".$this->tableName." SET title=:title, publishedDate=:publishedDate, finishDate=:finishDate, task=:task, skills=:skills, active=:active, remote=:remote, salary=:salary, jobPositionId=:jobPositionId, dedication=:dedication, companyId=:companyId, administratorId=:administratorId
                    WHERE jobOfferId=:jobOfferId;";

                    $parameters["jobOfferId"] = $jobOfferId;
                    $parameters["title"] = $title;
                    $parameters["publishedDate"] = $publishedDate;
                    $parameters["finishDate"] = $finishDate;
                    $parameters["task"] = $task;
                    $parameters["skills"] = $skills;
                    $parameters["active"] = $active;
                    $parameters["remote"] = $remote;
                    $parameters["salary"] = $salary;
                    //appointment
                    $parameters["jobPositionId"] = $jobPositionId;
                    $parameters["dedication"] = $dedication;
                    $parameters["companyId"] = $companyId;
                    $parameters["administratorId"] = $administratorId;
    
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