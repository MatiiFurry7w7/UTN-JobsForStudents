<?php namespace Models;

class Appointment{

  private $cv;
  private $date_appointment;
  private $reference_url;

  Public function __construct($cv, $date_appointment, $reference_url){
    $this->cv= $cv;
    $this->date_appointment = $date_appointment;
    $this->reference_url = $reference_url;
}


  public function getDate_appointment()
  {
    return $this->date_appointment;
  }

  public function setDate_appointment($date_appointment)
  {
    $this->date_appointment = $date_appointment;

    return $this;
  }

  public function getReference_url()
  {
    return $this->reference_url;
  }

  public function setReference_url($reference_url)
  {
    $this->reference_url = $reference_url;

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
           "<br>Date appointment: ".$this->date_appointment.
           "<br>Reference url: ".$this->reference_url;
  }
}

?>