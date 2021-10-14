<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController{
        private $companyDAO;

        public function __construct(){
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."add-company.php");
        }

        public function ShowListView(){
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function Add($name, $cuit, $description, $website, $address, $aboutUs){
            $company = new Company();
            $companyList = $this->companyDAO->GetAll();

            $this->setIdByLastId($companyList, $company);

            $company->setName($name);
            $company->setCuit($cuit);
            $company->setDescription($description);
            $company->setWebsite($website);
            $company->setAddress($address);
            $company->setAboutUs($aboutUs);

            $this->companyDAO->Add($company);

            $this->ShowAddView();
        }

        public function Remove($removedId){
            $this->companyDAO->DeleteById($removedId);
            $this->ShowListView();
        }

        private function setIdByLastId($companyList, $company){
            if(empty($companyList)){
                $company->setCompanyId(1); 
             } else {
                 $lastId = end($companyList)->getCompanyId();
                 $company->setCompanyId($lastId + 1);
             }
        }
    }
?>