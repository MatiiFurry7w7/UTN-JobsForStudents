<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IJobOfferDAO as IJobOfferDAO;
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
                $query = "INSERT INTO ".$this->tableName." (title, publishedDate, finishDate, task, skills, active, remote, salary) 
                    VALUES (:title, :publishedDate, :finishDate, :task, :skills, :active, :remote, :salary);";

                $parameters["title"] = $jobOffer->getTitle();
                $parameters["publishedDate"] = $jobOffer->getPublishedDate();
                $parameters["finishDate"] = $jobOffer->getFinishDate();
                $parameters["task"] = $jobOffer->getTask();
                $parameters["skills"] = $jobOffer->getSkills();
                $parameters["active"] = $jobOffer->getActive();
                $parameters["remote"] = $jobOffer->getRemote();
                $parameters["salary"] = $jobOffer->getSalary();
                //appointment
                //jobPosition

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

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();
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
                    //jobPosition
        
                    array_push($jobOfferList, $jobOffer);
                }
                
                return $jobOfferList;
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
                $query = "DELETE FROM ".$this->tableName." WHERE jobOfferId = :jobOfferId;";

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

                $result = $this->connection->Execute($query, $parameters);

                $jobOffer = new JobOffer();
                $jobOffer->setJobOfferId($result[0]["jobOfferId"]);
                $jobOffer->setTitle($result[0]["title"]);
                $jobOffer->setPublishedDate($result[0]["publishedDate"]);
                $jobOffer->setFinishDate($result[0]["finishDate"]);
                $jobOffer->setTask($result[0]["task"]);
                $jobOffer->setSkills($result[0]["skills"]);
                $jobOffer->setActive($result[0]["active"]);
                $jobOffer->setRemote($result[0]["remote"]);
                $jobOffer->setSalary($result[0]["salary"]);
                //appointment
                //jobPosition
                
                return $jobOffer;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function ModifyById($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary)
        {
            {
                try
                {
                    $query = "UPDATE ".$this->tableName." SET title=:title, publishedDate=:publishedDate, finishDate=:finishDate, task=:task, skills=:skills, active=:active, remote=:remote, salary=:salary
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
                    //jobPosition
    
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