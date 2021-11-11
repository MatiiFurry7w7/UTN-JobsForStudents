<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Administrator as Administrator;
    use Models\Industry as Industry;

    class CompanyController{
        private $companyDAO;

        public function __construct(){
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView(){
            if((new SessionHelper)->isAdmin()) {   
                $industryList = Industry::GetAll();
                require_once(VIEWS_PATH."add-company.php");

            } else 
                (new HomeController())->Index();
        }

        public function ShowListView($searchedCompany = ""){
            $companyList = $this->companyDAO->GetAll();
            $isAdmin = (new SessionHelper)->isAdmin();

            if(!$companyList) {
                $companyList = new Company();
            }

            require_once(VIEWS_PATH."company-list.php");
        }

        public function Add($name, $cuit, $description, $website, $street, $number_street, $aboutUs, $isActive, $industry){
            if((new SessionHelper)->isAdmin()) {   
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

                        $company->setName($name);
                        $company->setCuit($cuit);
                        $company->setDescription($description);
                        $company->setWebsite($website);
                        $company->setStreet($street);
                        $company->setNumber($number_street);
                        $company->setAboutUs($aboutUs);
                        $company->setActive($isActive);
                        $company->setIndustry($industry);

                        $this->companyDAO->Add($company);
        
                    } else {
                        ?>
                            <script>alert('The company already exists!');</script>
                        <?php
                    }

                } else {
                        $company->setName($name);
                        $company->setCuit($cuit);
                        $company->setDescription($description);
                        $company->setWebsite($website);
                        $company->setStreet($street);
                        $company->setNumber($number_street);
                        $company->setAboutUs($aboutUs);
                        $company->setActive($isActive);
                        $company->setIndustry($industry);
                        
                        $this->companyDAO->Add($company);
                }

                $this->ShowAddView();
            } else 
                (new HomeController())->Index();
        }

        public function Remove($removeId){
            if((new SessionHelper)->isAdmin()) {   
                $this->companyDAO->DeleteById($removeId);
                $this->ShowListView();
            } else 
                (new HomeController())->Index();
        }

        public function ModifyView($modifyId){
            if((new SessionHelper)->isAdmin()) {   
                $industryList = Industry::GetAll();
                $company = $this->companyDAO->FindById($modifyId);

                require_once(VIEWS_PATH."modify-company.php");
            } else 
                (new HomeController())->Index();
        }

        public function ModifyACompany($companyId, $name, $cuit, $description, $website, $street, $number, $aboutUs,$active, $industry){
            if((new SessionHelper)->isAdmin()) {   
                $addingCompany = new Company();
                
                if(str_contains($website, "https://") !== true){
                    $website = "https://".$website;
                }

                $addingCompany->setCompanyId($companyId);
                $addingCompany->setName($name);
                $addingCompany->setCuit($cuit);
                $addingCompany->setDescription($description);
                $addingCompany->setWebsite($website);
                $addingCompany->setStreet($street);
                $addingCompany->setNumber($number);
                $addingCompany->setAboutUs($aboutUs);
                $addingCompany->setActive($active);
                $addingCompany->setIndustry($industry);

                $this->companyDAO->ModifyById($addingCompany);
                
                $this->ShowListView();
            } else {

            }
                //(new HomeController())->Index();
        }

        public function ViewDetail($companyId) {
            $company = $this->companyDAO->FindById($companyId);

            require_once(VIEWS_PATH."company-viewDetail.php");
        }
    }
?>