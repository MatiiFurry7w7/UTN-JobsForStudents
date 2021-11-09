<?php
    namespace Controllers;

    use DAO\AppointmentDAO as AppointmentDAO;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\JobOfferDAO;
    use Models\Appointment as Appointment;
    use Models\CV;

class AppointmentController
    {
        private $appointmentDAO;

        public function __construct(){
            $this->appointmentDAO = new AppointmentDAO();
        }

        public function AddView($jobOfferId){
            $jobOffer = (new JobOfferDAO)->FindById($jobOfferId);
            require_once(VIEWS_PATH."add-appointment.php");
        }

        public function ViewDetails($jobOfferId){
            $currentStudent = $_SESSION['currentUser'];
            
            if($currentStudent->getAppointment()){
                $appointment = $this->appointmentDAO->FindById($currentStudent->getStudentId(), $jobOfferId);
                $jobOffer = (new JobOfferDAO)->FindById($jobOfferId);

                require_once(VIEWS_PATH."appointment-viewDetail.php");
            }else 
                header("location:".FRONT_ROOT."Home/Index");
        }

        public function ListView(){
            
            $appointmentList = $this->appointmentDAO->getAll();

            require_once(VIEWS_PATH."appointment-list.php");
        }

        public function Add($studentId, $jobOfferId, $file, $referenceURL, $comments){
            $currentStudent = $_SESSION['currentUser'];        
            $appointmentList = $this->appointmentDAO->GetAll();

            $appointment = new Appointment();

            $appointment->setStudentId($studentId);
            $appointment->setJobOfferId($jobOfferId);
            $appointment->setCV($file);
            $appointment->setDateAppointment(date("c"));

            if(str_contains($referenceURL, "https://") !== true){
                $referenceURL = "https://".$referenceURL;
            }

            $appointment->setReferenceURL($referenceURL);  
            $appointment->setComments($comments);  

            $this->appointmentDAO->Add($appointment);
            $appointmentList = $this->appointmentDAO->GetAll();

            if($appointmentList)
                foreach($appointmentList as $eachAppointment)
                    if($eachAppointment->getStudentId() == $currentStudent->getStudentId())
                        $currentStudent->setAppointment($eachAppointment);
            //$this->Upload($file, $studentId, $jobOfferId);
            
            (new HomeController)->Index();
        }

        public function HistoryView(){
            $studentId = $_SESSION['currentUser']->getStudentId();
            $appointmentList = $this->appointmentDAO->HistoryById($studentId);
            
            require_once(VIEWS_PATH."appointment-list.php");
        }

        public function Remove($studentId){
            $this->appointmentDAO->DeleteById($studentId);
            $_SESSION['currentUser']->setAppointment(null);
            (new HomeController)->Index();
        }

        public function Upload($file, $studentId, $jobOfferId)
        {
            try
            {
                $fileName = $file["name"];
                $tempFileName = $file["tmp_name"];
                $type = $file["type"];
                
                $filePath = UPLOADS_PATH.basename($fileName);            

                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                if (move_uploaded_file($tempFileName, $filePath))
                {
                    $cv = new CV();
                    $cv->setName($fileName);
                    $this->appointmentDAO->addCV($cv, $studentId, $jobOfferId);
                    $message = "CV successfully uploaded!";
                }
                else
                    $message = "There was an error adding the CV!";
            }
            catch(Exception $ex)
            {
                $message = $ex->getMessage();
            }
        }    
    }
?>