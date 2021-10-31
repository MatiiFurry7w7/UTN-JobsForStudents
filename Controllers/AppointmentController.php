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

        public function Add( $studentId, $jobOfferId, $cv, $dateAppointment, $referenceURL){

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
                $appointment->setDateAppointment($dateAppointment);
                $appointment->setReferenceURL($referenceURL);
                
                $this->appointmentDAO->Add($appointment);
            }else {
                ?>
                    <script>alert('The student is already on a job offer or the student does not exist!');</script>
                <?php
            }

            $this->ListView();
            //header('location: '.FRONT_ROOT.'appointment/ListView');
        }

        public function Remove($removeId){
            $this->appointmentDAO->DeleteById($removeId);
            $this->ListView();
        }

        public function Modifyappointment($studentId, $jobOfferId, $cv, $dateAppointment, $referenceURL){
            $this->appointmentDAO->ModifyById($studentId, $jobOfferId, $cv, $dateAppointment, $referenceURL);
            
            $this->ListView();
        }

        public function ModifyView($modifyId){
            $appointment = $this->appointmentDAO->FindById($modifyId);

            require_once(VIEWS_PATH."modify-appointment.php");
        }
    }
?>