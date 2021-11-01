<?php namespace Models;

class Appointment{

  private $jobOfferID;//<----------------------------- se manda el ID(es la clave primaria de Appointment)
  private $studentID;//<----------------------------- se manda el ID(es la clave primaria de Appointment)
  private $cv; //<------------------ adjuntar CV por datafile por fileName
  private $dateAppointment;
  private $referenceURL;


  public function getDateAppointment()
  {
    return $this->dateAppointment;
  }

  public function setDateAppointment($dateAppointment)
  {
    $this->dateAppointment = $dateAppointment;

    return $this;
  }

  public function getReferenceURL()
  {
    return $this->referenceURL;
  }

  public function setReferenceURL($referenceURL)
  {
    $this->referenceURL = $referenceURL;

    return $this;
  }

  public function getCV()
  {
    return $this->cv;
  }

  public function setCV($cv)
  {
    $this->cv = $cv;

    return $this;
  }

  public function getJobOfferId()
  {
    return $this->jobOffer;
  }

  public function setJobOfferId($jobOffer)
  {
    $this->jobOffer = $jobOffer;

    return $this;
  }
 
  public function getStudentId()
  {
    return $this->student;
  }

  public function setStudentId($student)
  {
    $this->student = $student;

    return $this;
  }
  
  public function __tostring(){
    return "<br>CV: ".$this->cv.
           "<br>Date appointment: ".$this->dateAppointment.
           "<br>Reference url: ".$this->referenceURL;
  }
}
?>