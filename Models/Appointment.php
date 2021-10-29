<?php namespace Models;

class Appointment{

  private $cv; //<------------------ adjuntar CV por datafile por fileName
  private $dateAppointment;
  private $referenceURL;
  private $jobOffer;//<----------------------------- se manda el ID(es la clave primaria de Appointment)
  private $student;//<----------------------------- se manda el ID(es la clave primaria de Appointment)

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

  public function __tostring(){
    return "<br>CV: ".$this->cv.
           "<br>Date appointment: ".$this->dateAppointment.
           "<br>Reference url: ".$this->referenceURL;
  }

  public function getJobOffer()
  {
    return $this->jobOffer;
  }

  public function setJobOffer($jobOffer)
  {
    $this->jobOffer = $jobOffer;

    return $this;
  }
 
  public function getStudent()
  {
    return $this->student;
  }

  public function setStudent($student)
  {
    $this->student = $student;

    return $this;
  }
}

?>