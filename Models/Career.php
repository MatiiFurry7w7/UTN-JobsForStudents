<?php namespace Models;

class Career{

    private $title;
    private $description;
    private $active = true;

    Public function __construct($title, $description){
        $this->title= $title;
        $this->description = $description;
    }
    
    public function gettitle()
    {
        return $this->title;
    }

    public function settitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getdescription()
    {
        return $this->description;
    }

    public function setdescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function __tostring(){
        return "<br>Title: ".$this->title.
               "<br>Description: ".$this->description.
               "<br>Active: ".$this->active;
    }
}
