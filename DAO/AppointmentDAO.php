<?php
    namespace DAO;

    use DAO\IAppointmentDAO as IAppointmentDAO;
    use Models\Appointment as Appointment;
    use \Exception as Exception;
    use DAO\Connection as Connection;
use Models\CV;

class AppointmentDAO implements IAppointmentDAO{

        private $connection;
        private $tableName = "appointments";

        public function Add(Appointment $appointment) {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (studentId, jobOfferId, cv, dateAppointment, referenceURL) 
                    VALUES (:studentId, :jobOfferId, :cv, :dateAppointment, :referenceURL );";

                $parameters["studentId"] = $appointment->getStudentId();
                $parameters["jobOfferId"] = $appointment->getJobOfferId();    
                $parameters["cv"] = $appointment->getCv();
                $parameters["dateAppointment"] = $appointment->getDateAppointment();
                $parameters["referenceURL"] = $appointment->getReferenceURL();
                
             
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
                
                $parameters["name"] = $cv;
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
        
                    array_push($appointmentList, $appointment);
                }
                
                return $appointmentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function DeleteById($stundentId)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE stundentId = :stundentId;";

                $parameters["stundentId"] = $stundentId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function FindById($studentId)//<------------------ ver si lo utilizamos
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName.' WHERE (studentId = :studentId);';

                $this->connection = Connection::GetInstance();
                
                $parameters["studentId"] = $studentId;

                $result = $this->connection->Execute($query, $parameters)[0];

                if($result) {
                    $appointment = new Appointment();
                    $appointment->setStudentId($result["studentId"]);
                    $appointment->setJobOfferId($result["jobOfferId"]);
                    $appointment->setCv($result["cv"]);
                    $appointment->setDateAppointment($result["dateAppointment"]);
                    $appointment->setReferenceURL($result["referenceURL"]);
                
                    return $appointment;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>