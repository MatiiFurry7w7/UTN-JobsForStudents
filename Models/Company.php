<?php
    namespace Models;

    class Company {
        private $companyId;
        private $name;
        private $cuit;
        private $description;
        private $website;
        private $street;
        private $number;
        private $aboutUs;
        private $active;
        private $industries; //relation one to many
        private $jobOffer; //relation one to many
        private $administrator; //relation one to one

        //CONSTRUCTOR
        // public function __construct($name, $cuit, $description, $website, $address, $aboutUs, $active) {
        //     $this->name = $name;
        //     $this->cuit = $cuit;
        //     $this->description = $description;
        //     $this->website = $website;
        //     $this->address = $address;
        //     $this->aboutUs = $aboutUs;
        //     $this->active = $active;
        // }

        //GETTERS & SETTERS
        public function getCompanyId() {
            return $this->companyId;
        }

        public function setCompanyId($companyId) {
            $this->companyId = $companyId;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function getCuit() {
            return $this->cuit;
        }

        public function setCuit($cuit) {
            $this->cuit = $cuit;
        } 

        public function getDescription() {
            return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function getWebsite() {
            return $this->website;
        }
 
        public function setWebsite($website) {
            $this->website = $website;
        }

        public function getStreet() {
            return $this->street;
        }

        public function setStreet($street) {
            $this->street = $street;
        }

        public function getNumber() {
            return $this->number;
        }

        public function setNumber($number) {
            $this->number = $number;
        }

        public function getAboutUs() {
            return $this->aboutUs;
        }

        public function setAboutUs($aboutUs) {
            $this->aboutUs = $aboutUs;
        }

        public function getActive() {
            return $this->active;
        }
 
        public function setActive($active) {
            $this->active = $active;
        }

        public function getIndustries() {
            return $this->industries;
        }

        public function setIndustries($industries) {
            $this->industries = $industries;
        }

        public function getJobOffer() {
             return $this->jobOffer;
        }

        public function setJobOffer($jobOffer) {
            $this->jobOffer = $jobOffer;
        }

        public function getAdministrator() {
            return $this->administrator;
        }
 
        public function setAdministrator($administrator) {
            $this->administrator = $administrator;
        }

        //TO STRING METHOD
        public function __toString() {
            return  "<br>ID: ".$this->companyId.
                    "<br>Name: ".$this->name.
                    "<br>CUIT: ".$this->cuit.
                    "<br>Description: ".$this->description.
                    "<br>Web Site: ".$this->website.
                    "<br>Address: ".$this->address.
                    "<br>About us: ".$this->aboutUs.
                    "<br>Active: ".$this->active.
                    "<br>Industries: ".
                    "<br>-------------------------------".$this->industries.
                    "<br>Job Offer: ".
                    "<br>-------------------------------".$this->jobOffer.
                    "<br>Administrator: ".
                    "<br>-------------------------------".$this->administrator;
        }
    }
?>