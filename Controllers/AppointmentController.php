<?php
    namespace Controllers;

    use DAO\appointmentDAO as appointmentDAO;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\appointment as appointment;

    class appointmentController
    {
        private $appointmentDAO;

        public function __construct(){
            $this->appointmentDAO = new AppointmentDAO();
        }

        public function AddView(){
            require_once(VIEWS_PATH."add-appointment.php");
        }

        public function ListView(){
            
            $appointmentList = $this->appointmentDAO->getAll();

            require_once(VIEWS_PATH."appointment-list.php");
        }

        public function Add( $studentId, $jobOfferId, $cv, $referenceURL){

            $appointment = new appointment();
            
            $appointmentList = $this->appointmentDAO->GetAll();

            foreach($appointmentList as $eachappointment) {
                if($eachappointment->getStudentId() == $studentId){
                    $appointment = $eachappointment;
                }
            }

            if(!$appointment){
                $appointment->setStudentId($studentId);
                $appointment->setJobOfferId($jobOfferId);
                $appointment->setCv($cv);
                $appointment->setDateAppointment(date("h:i:s"));
                $appointment->setReferenceURL($referenceURL);
                
                $this->appointmentDAO->Add($appointment);
            }else {
                ?>
                    <script>alert('The student is already on a job offer or the student does not exist!');</script>
                <?php
            }
            
            header('location: '.FRONT_ROOT.'appointment/ListView');
        }

        public function Remove($removeId){  //<--------------------------------------- Podriamos crear una variable en student que se llame jobOfferActive para utilizarlo como booleanos y asi podes limitarlo a 1 solo jobOffer por estudiante
            $this->appointmentDAO->DeleteById($removeId);
            $this->ListView();
        }

    }
?>