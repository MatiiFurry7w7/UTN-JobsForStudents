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

        public function DeleteByName($name)
        {
            $this->RetrieveData();

            if(!empty($this->companyList)){
                foreach($this->companyList as $company){
                    if(strcmp($company->getName(), $name) == 0){
                        $index = array_search($company, $this->companyList);
                        unset($this->companyList[$index]);
                    }
                }
            }

            $this->SaveData();
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
                $valuesArray["address"] = $company->getAddress();
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
                    $company->setAddress($valuesArray["address"]);
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