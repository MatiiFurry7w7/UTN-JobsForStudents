<?php
    namespace Controllers;

    use DAO\AppointmentDAO as AppointmentDAO;
    use Plugins\FPDF as FPDF;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\JobOfferDAO;
    use DAO\UserDAO;
    use Helpers\SessionHelper as SessionHelper;
    USE Helpers\MessageHelper as MessageHelper;
    use Models\Appointment as Appointment;
    use Models\CV;
use Models\JobOffer;

class AppointmentController
    {
        private $appointmentDAO;

        public function __construct(){
            $this->appointmentDAO = new AppointmentDAO();
        }

        public function AddView($jobOfferId){
            $currentUser = (new SessionHelper())->getCurrentUser();
            $jobOffer = (new JobOfferDAO)->FindById($jobOfferId);
            require_once(VIEWS_PATH."add-appointment.php");
        }

        public function ViewDetails($jobOfferId){
            $currentStudent = (new SessionHelper())->getCurrentUser();
            if($currentStudent->getAppointment()){
                $appointment = $this->appointmentDAO->FindById($currentStudent->getUserId(), $jobOfferId);
                $jobOffer = (new JobOfferDAO)->FindById($jobOfferId);
                require_once(VIEWS_PATH."appointment-viewDetail.php");
            }else 
                header("location:".FRONT_ROOT."Home/Index");

        }

        public function ListView(){
            $isAdmin = (new SessionHelper())->isAdmin();
            $appointmentList = $this->appointmentDAO->getAll();

            //require_once(VIEWS_PATH."appointment-list.php");
        }

        public function Add($studentId, $jobOfferId, $referenceURL, $comments){
            $currentStudent = (new SessionHelper)->getCurrentUser();        
            $appointmentList = $this->appointmentDAO->GetAll();

            $found = false;

            foreach($appointmentList as $eachAppointment){
                if($eachAppointment->getStudent()->getUserId() == $studentId &&
                   $eachAppointment->getJobOffer()->getJobOfferId() == $jobOfferId)
                    $found = true;
            }

            if(!$found){
                $appointment = new Appointment();
                $userDAO = new UserDAO();
                $jobOfferDAO = new JobOfferDAO();

                $appointment->setStudent($userDAO->FindById($studentId));
                $appointment->setJobOffer($jobOfferDAO->FindById($jobOfferId));
                $appointment->setDateAppointment(date("c"));
    
                if(str_contains($referenceURL, "https://") !== true){
                    $referenceURL = "https://".$referenceURL;
                }
    
                $appointment->setReferenceURL($referenceURL);  
                $appointment->setComments($comments);  
                $appointment->setActive(true);  
    
                $this->appointmentDAO->Add($appointment);
                $appointmentList = $this->appointmentDAO->GetAll();

                $currentStudent->setAppointment($appointment);
                
                $this->AddCv();
            } else{
                $message = MessageHelper::ALREADY_REGISTERED_JO;   

                (new HomeController)->Index($message);
            }
        }

        public function AppointmentView(){
            $studentId = (new SessionHelper)->getCurrentUser()->getUserId();
            $isAdmin = (new SessionHelper())->isAdmin();
            $appointmentList = $this->appointmentDAO->HistoryById($studentId);
            
            require_once(VIEWS_PATH."appointment-list.php");
        }

        public function HistoryView(){
            $studentId = (new SessionHelper)->getCurrentUser()->getUserId();
            $isAdmin = (new SessionHelper())->isAdmin();
            $appointmentList = $this->appointmentDAO->HistoryById($studentId);

            $download = false;
            
            require_once(VIEWS_PATH."appointment-history.php");
        }

        public function Remove($studentId, $jobOfferId){
                $this->appointmentDAO->CancelApplyById($studentId, $jobOfferId);
                (new HomeController)->Index();           
        }

        public function AppointmentsOfJobOffer($jobOfferId){
            $allAppointments = $this->appointmentDAO->getAll();

            $appointmentList = array();
            $isAdmin = (new SessionHelper())->isAdmin();
            $isCompany =  (new SessionHelper())->isCompany();
            $jobOfferDAO = new JobOfferDAO();

            if($allAppointments)
                foreach($allAppointments as $eachAppointment)
                    if($eachAppointment->getJobOffer($jobOfferDAO->FindById($jobOfferId))->getJobOfferId() == $jobOfferId)
                        array_push($appointmentList, $eachAppointment);

            $download = true;
                    
            require_once(VIEWS_PATH."appointment-history.php");
        }

        public function AppointmentsOfStudent($studentId){
            $allAppointments = $this->appointmentDAO->getAll();

            $appointmentList = array();
            $isAdmin = (new SessionHelper())->isAdmin();
            $userDAO = new UserDAO();

            if($allAppointments)
                foreach($allAppointments as $eachAppointment)
                    if($eachAppointment->getStudent($userDAO->FindById($studentId))->getUserId() == $studentId)
                        array_push($appointmentList, $eachAppointment);

            $download = false;
                    
            require_once(VIEWS_PATH."appointment-history.php");
        }

        public function AddCv($message = "") {
            require_once(VIEWS_PATH."add-cv.php");
        }
        
        public function Upload($file){
            try
            {
                $neededExtension = "pdf";
                $fileName = $file["name"];
                $tempFileName = $file["tmp_name"];
                $type = $file["type"];
                                   
                $filePath = UPLOADS_PATH.basename($fileName);            
                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                if ($fileType == $neededExtension){  
                    if (move_uploaded_file($tempFileName, $filePath))
                    {
                        $cv = new CV();
                        $cv->setName($fileName);
                        $currentUser = (new SessionHelper())->getCurrentUser();
                        $cv->setUser($currentUser);
                        $this->appointmentDAO->addCV($cv);

                        $message = MessageHelper::CV_UPLOADED;
                    }
                    else
                        $message = MessageHelper::ERROR_CV;
                }else{
                    $message = MessageHelper::PDF_FORMAT;
                }
            }
            catch(Exception $ex)
            {
                $message = $ex->getMessage();
            }
            (new HomeController)->Index($message);
        }    

        public function DownloadPDF($jobOfferId){
            $allAppointments = $this->appointmentDAO->getAll();
            
            $appointmentList = array();
            $jobOfferDAO = new JobOfferDAO();
            $jobOffer = new JobOffer();

            if($allAppointments)
                foreach($allAppointments as $eachAppointment){
                    $eachJobOffer = $eachAppointment->getJobOffer($jobOfferDAO->FindById($jobOfferId));
                    if($eachJobOffer->getJobOfferId() == $jobOfferId){
                        array_push($appointmentList, $eachAppointment);
                        $jobOffer = $eachJobOffer;
                    }
                }
        
            (new PDFController)->Download($jobOffer, $appointmentList);
        }
    }
?>