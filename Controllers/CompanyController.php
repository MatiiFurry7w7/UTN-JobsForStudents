<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use Models\Administrator as Administrator;
    use Models\Industry as Industry;

    class CompanyController{
        private $companyDAO;

        public function __construct(){
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView(){
            $industryList = Industry::GetAll();
            require_once(VIEWS_PATH."add-company.php");
        }

        public function ShowListView($searchedCompany = ""){
            $companyList = $this->companyDAO->GetAll();

            if(!$companyList) {
                $companyList = new Company();
            }

            require_once(VIEWS_PATH."company-list.php");
        }

        public function Add($name, $cuit, $description, $website, $street, $number_street, $aboutUs, $isActive, $industry){
            $company = new Company();

            $companyExist = false;
            
            $companyList = $this->companyDAO->GetAll();
            
            if($companyList){
                foreach($companyList as $eachCompany) {
                    if($eachCompany->getName() == $name || $eachCompany->getCuit() == $cuit){
                        $companyExist = true;
                    }
                }

                if($companyExist == false){
                    if(str_contains($website, "https://") !== true){
                        $website = "https://".$website;
                    }

                    $company = $this->setCompany($name, $cuit, $description, $website, $street, $number_street, $aboutUs, $isActive, $industry);
                    
                    $this->companyDAO->Add($company);
    
                } else {
                    ?>
                        <script>alert('The company already exists!');</script>
                    <?php
                }

            } else {
                $company = $this->setCompany($name, $cuit, $description, $website, $street, $number_street, $aboutUs, $isActive, $industry);
                
                $this->companyDAO->Add($company);
            }

            $this->ShowAddView();
        }

        private function setCompany($name, $cuit, $description, $website, $street, $number_street, $aboutUs, $isActive, $industry) {
            $company = new Company();

            $company->setName($name);
            $company->setCuit($cuit);
            $company->setDescription($description);
            $company->setWebsite($website);
            $company->setStreet($street);
            $company->setNumber($number_street);
            $company->setAboutUs($aboutUs);
            $company->setActive($isActive);
            $company->setIndustry($industry);

            return $company;
        }

        public function Remove($removeId){
            $this->companyDAO->DeleteById($removeId);
            $this->ShowListView();
        }

        public function ModifyView($modifyId){
            $industryList = Industry::GetAll();
            $company = $this->companyDAO->FindById($modifyId);

            require_once(VIEWS_PATH."modify-company.php");
        }

        public function ModifyACompany($companyId, $name, $cuit, $description, $website, $street, $number, $aboutUs, $active, $industry){
            $this->companyDAO->ModifyById($companyId, $name, $cuit, $description, $website, $street, $number, $aboutUs, $isActive, $industry);
            
            $this->ShowListView();
        }

        public function ViewDetail($companyId) {
            $company = $this->companyDAO->FindById($companyId);

            require_once(VIEWS_PATH."company-viewDetail.php");
        }

        public function isAdmin() {
            $isAdmin = false;

            if($_SESSION['currentUser'] instanceof Administrator) {
                $isAdmin = true;
            }

            return $isAdmin;
        }
    }
?>