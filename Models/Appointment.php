<?php namespace Models;

class Appointment{

  private $cv;
  private $dateAppointment;
  private $referenceURL;

  Public function __construct($cv, $dateAppointment, $referenceURL){
    $this->cv= $cv;
    $this->dateAppointment = $dateAppointment;
    $this->referenceURL = $referenceURL;
}


  public function getdateAppointment()
  {
    return $this->dateAppointment;
  }

  public function setdateAppointment($dateAppointment)
  {
    $this->dateAppointment = $dateAppointment;

    return $this;
  }

  public function getreferenceURL()
  {
    return $this->referenceURL;
  }

  public function setreferenceURL($referenceURL)
  {
    $this->referenceURL = $referenceURL;

    return $this;
  }

  public function getCv()
  {
    return $this->cv;
  }

  public function setCv($cv)
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