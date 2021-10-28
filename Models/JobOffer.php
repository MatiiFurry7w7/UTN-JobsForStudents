<?php
    namespace Models;

    class JobOffer {

        private $JobOfferId;
        private $title;
        private $publishedDate;
        private $finishDate;
        private $task;
        private $skills;
        private $active;
        private $remote;
        private $salary;
        private $appointment; //relation one to one
        private $jobPosition; //relation one to one

        // //CONSTRUCTOR
        // public function __construct($idJobOffer, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary) {
        //     $this->idJobOffer = $idJobOffer;
        //     $this->title = $title;
        //     $this->publishedDate = $publishedDate;
        //     $this->finishedDate = $finishedDate;
        //     $this->task = $task;
        //     $this->skills = $skills;
        //     $this->active = $active;
        //     $this->remote = $remote;
        //     $this->salary = $salary;
        // }
        //GETTERS & SETTERS
        public function getJobOfferId() {
            return $this->jobOfferId;
        }

        public function setJobOfferId($jobOfferId) {
            $this->jobOfferId = $jobOfferId;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        public function getPublishedDate() {
            return $this->publishedDate;
        }

        public function setPublishedDate($publishedDate) {
            $this->publishedDate = $publishedDate;
        }

        public function getFinishDate() {
            return $this->finishDate;
        }
 
        public function setFinishDate($finishDate) {
            $this->finishDate = $finishDate;
        }

        public function getTask() {
            return $this->task;
        }

        public function setTask($task) {
            $this->task = $task;
        }

        public function getSkills() {
            return $this->skills;
        }

        public function setSkills($skills) {
            $this->skills = $skills;
        }

        public function getActive() {
            return $this->active;
        }

        public function setActive($active) {
            $this->active = $active;
        }

        public function getRemote() {
            return $this->remote;
        }

        public function setRemote($remote) {
            $this->remote = $remote;;
        }

        public function getSalary() {
            return $this->salary;
        }

        public function setSalary($salary) {
            $this->salary = $salary;
        }

        public function getAppointment() {
            return $this->appointment;
        }

        public function setAppointment($appointment) {
            $this->appointment = $appointment;
        }

        public function getJobPosition() {
            return $this->jobPosition;
        }

        public function setJobPosition($jobPosition) {
            $this->jobPosition = $jobPosition;
        }

        //TO STRING METHOD
        public function __toString() {
            return  "<br>ID: ".$this->idJobPosition.
                    "<br>Title: ".$this->title.
                    "<br>Published: ".$this->publishedDate.
                    "<br>Finished Date: ".$this->finishedDate.
                    "<br>Task: ".$this->task.
                    "<br>Skills: ".$this->skills.
                    "<br>Active: ".$this->active.
                    "<br>Remote: ".$this->remote.
                    "<br>Salary: ".$this->salary.
                    "<br>Appointment: ".
                    "<br>-------------------------------".$this->appointment.
                    "<br>Job Position: ".
                    "<br>-------------------------------".$this->jobPosition;
        }
    }
    
?>