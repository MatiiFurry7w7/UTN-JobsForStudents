<?php
    namespace DAO;

    use DAO\IAppointmentDAO as IAppointmentDAO;
    use Models\Appointment as Appointment;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\CV;
    use Models\JobOffer;

class AppointmentDAO implements IAppointmentDAO{

        private $connection;
        private $tableName = "appointments";

        public function Add(Appointment $appointment) {
            $this->setInactive($appointment->getStudentId());
            try
            {
                $query = "INSERT INTO ".$this->tableName." (studentId, jobOfferId, cv, dateAppointment, referenceURL, comments, active) 
                    VALUES (:studentId, :jobOfferId, :cv, :dateAppointment, :referenceURL, :comments, :active);";

                $parameters["studentId"] = $appointment->getStudentId();
                $parameters["jobOfferId"] = $appointment->getJobOfferId();    
                $parameters["cv"] = $appointment->getCv();
                $parameters["dateAppointment"] = $appointment->getDateAppointment();
                $parameters["referenceURL"] = $appointment->getReferenceURL();
                $parameters["comments"] = $appointment->getComments();
                $parameters["active"] = $appointment->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        private function setInactive($studentId) {
            try
            {
                $query = "UPDATE ".$this->tableName." SET active = 0 WHERE studentId =:studentId";

                $parameters["studentId"] = $studentId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function addCV($cv, $studentId, $jobOfferId){
            try
            {
                $query = "CALL cv_add(?);";
                
                $parameters["name"] = $cv->getName();
                $parameters["stuId"] = $studentId;
                $parameters["jobId"] = $jobOfferId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $appointmentList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $appointment = new Appointment();
                    
                    $appointment->setStudentId($row["studentId"]);
                    $appointment->setJobOfferId($row["jobOfferId"]);
                    $appointment->setCv($row["cv"]);
                    $appointment->setDateAppointment($row["dateAppointment"]);
                    $appointment->setReferenceURL($row["referenceURL"]);
                    $appointment->setComments($row["comments"]);
                    $appointment->setActive($row["active"]);
        
                    array_push($appointmentList, $appointment);
                }
                
                return $appointmentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetHistoryById($studentId)
        {
            try
            {
                $appointmentList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE studentd = :studentId";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $appointment = new Appointment();
                    
                    $appointment->setStudentId($row["studentId"]);
                    $appointment->setJobOfferId($row["jobOfferId"]);
                    $appointment->setCv($row["cv"]);
                    $appointment->setDateAppointment($row["dateAppointment"]);
                    $appointment->setReferenceURL($row["referenceURL"]);
                    $appointment->setComments($row["comments"]);
                    $appointment->setActive($row["active"]);
        
                    array_push($appointmentList, $appointment);
                }
                
                return $appointmentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function FindById($studentId, $jobOfferId){
            try{
                $query = "SELECT * FROM ".$this->tableName." WHERE studentId =:studentId AND jobOfferId =:jobOfferId;";

                $parameters["studentId"] = $studentId;
                $parameters["jobOfferId"] = $jobOfferId;
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters)[0];
                if($resultSet){
                    $appointment = new Appointment();
                    
                    $appointment->setStudentId($resultSet["studentId"]);
                    $appointment->setJobOfferId($resultSet["jobOfferId"]);
                    $appointment->setCv($resultSet["cv"]);
                    $appointment->setDateAppointment($resultSet["dateAppointment"]);
                    $appointment->setReferenceURL($resultSet["referenceURL"]);
                    $appointment->setComments($resultSet["comments"]);
                    $appointment->setActive($resultSet["active"]);

                    return $appointment;
                }
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function CancelApplyById($studentId, $jobOfferId){
            try{
                $query = "UPDATE ".$this->tableName." SET active = 0 WHERE studentId = :studentId; AND jobOfferId = :jobOfferId";

                $parameters["studentId"] = $studentId;
                $parameters["jobOfferId"] = $jobOfferId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function HistoryById($studentId)//<------------------ ver si lo utilizamos
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName.' WHERE (studentId = :studentId);';

                $this->connection = Connection::GetInstance();
                
                $parameters["studentId"] = $studentId;

                $result = $this->connection->Execute($query, $parameters);

                if($result){ 
                    $historyList = array(); 
                    foreach($result as $eachResult) {
                        $appointment = new Appointment();
                        $appointment->setStudentId($eachResult["studentId"]);
                        $appointment->setJobOfferId($eachResult["jobOfferId"]);
                        $appointment->setCv($eachResult["cv"]);
                        $appointment->setDateAppointment($eachResult["dateAppointment"]);
                        $appointment->setReferenceURL($eachResult["referenceURL"]);  
                        $appointment->setActive($eachResult["active"]);  
                        
                        array_push($historyList, $appointment);                     
                    }
                return $historyList;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    
    }
?>