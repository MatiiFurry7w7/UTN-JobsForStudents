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

        public function ShowListView($searchedCompany = ""){
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function Add($name, $cuit, $description, $website, $street, $number, $aboutUs, $active){
            $company = new Company();
            
            $companyList = $this->companyDAO->GetAll();

            $this->setIdByLastId($companyList, $company);

            $company->setName($name);
            $company->setCuit($cuit);
            $company->setDescription($description);
            $company->setWebsite($website);
            $company->setStreet($street);
            $company->setNumber($number);
            $company->setAboutUs($aboutUs);
            
            $active = $this->activeToBoolean($active);

            $company->setActive($active);

            $this->companyDAO->Add($company);

            $this->ShowAddView();
        }

        public function Remove($removeId){
            $this->companyDAO->DeleteById($removeId);
            $this->ShowListView();
        }

        public function ModifyView($modifyId){
            $company = $this->companyDAO->FindById($modifyId);

            require_once(VIEWS_PATH."modify-company.php");
        }

        public function ModifyACompany($companyId, $name, $cuit, $description, $website, $street, $number, $aboutUs, $active){
            //no recibe el id
            $this->companyDAO->ModifyById($companyId, $name, $cuit, $description, $website, $street, $number, $aboutUs, $active);
            
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

        private function activeToBoolean($active){
            if($active == "true"){
                $active = true;
            } else {
                $active = false;
            }
            return $active;
        }
    }
?>