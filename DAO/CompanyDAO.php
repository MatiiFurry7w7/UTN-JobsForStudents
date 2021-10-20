<?php
    namespace DAO;

    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;

    class CompanyDAO implements ICompanyDAO
    {        
        private $companyList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/companies.json";
        }

        public function Add(Company $company)
        {
            $this->RetrieveData();
            
            array_push($this->companyList, $company);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->companyList;
        }

        public function DeleteById($id)
        {
            $this->RetrieveData();

            if(!empty($this->companyList)){
                foreach($this->companyList as $company){
                    if($company->getCompanyId() == $id){
                        $index = array_search($company, $this->companyList);
                        unset($this->companyList[$index]);
                    }
                }
            }
            $this->SaveData();
        }

        public function FindById($id)
        {
            $this->RetrieveData();

            if(!empty($this->companyList)){
                foreach($this->companyList as $company){
                    if($company->getCompanyId() == $id){
                        $index = array_search($company, $this->companyList);
                        $modifyCompany = $this->companyList[$index];
                    }
                }
            }
            return $modifyCompany;
        }

        public function ModifyById($companyId, $name, $cuit, $description, $website, $street, $number, $aboutUs, $active)
        {
            $modifyCompany = $this->FindById($companyId);

            $modifyCompany->setName($name);
            $modifyCompany->setCuit($cuit);
            $modifyCompany->setDescription($description);
            $modifyCompany->setWebsite($website);
            $modifyCompany->setStreet($street);
            $modifyCompany->setNumber($number);
            $modifyCompany->setAboutUs($aboutUs);
            $modifyCompany->setActive($active);      
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["companyId"] = $company->getCompanyId();
                $valuesArray["name"] = $company->getName();
                $valuesArray["cuit"] = $company->getCuit();
                $valuesArray["description"] = $company->getDescription();
                $valuesArray["website"] = $company->getWebsite();
                $valuesArray["street"] = $company->getStreet();
                $valuesArray["number"] = $company->getNumber();
                $valuesArray["aboutUs"] = $company->getAboutUs();
                $valuesArray["active"] = $company->getActive();
                //industries
                //jobOffer
                //administrator

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->companyList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    
                    $company = new Company();
                    $company->setCompanyId($valuesArray["companyId"]);
                    $company->setName($valuesArray["name"]);
                    $company->setCuit($valuesArray["cuit"]);
                    $company->setDescription($valuesArray["description"]);
                    $company->setWebsite($valuesArray["website"]);
                    $company->setStreet($valuesArray["street"]);
                    $company->setNumber($valuesArray["number"]);
                    $company->setAboutUs($valuesArray["aboutUs"]);
                    $company->setActive($valuesArray["active"]);
                    //industries
                    //jobOffer
                    //administrator

                    array_push($this->companyList, $company);
                }
            }
        }
    }
?>