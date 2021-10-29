<?php namespace Models;

class Appointment{

  private $cv; //<------------------ adjuntar CV por datafile
  private $dateAppointment;
  private $referenceURL;
  //AGREGAR JOBOFFER Y STUDENT 

  /*Public function __construct($cv, $dateAppointment, $referenceURL){
    $this->cv= $cv;
    $this->dateAppointment = $dateAppointment;
    $this->referenceURL = $referenceURL;
 }*/

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
}

?>