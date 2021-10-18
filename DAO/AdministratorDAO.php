<?php
    namespace DAO;

    use DAO\IAdministratorDAO as IAdministratorDAO;
    use Models\Administrator as Administrator;

class AdministratorDAO implements IAdministratorDAO{

        private $administratorList = array();
        private $dataFile;

        public function __construct(){
            $this->dataFile = dirname(__DIR__)."\Data\administrator.json";
        }

        public function add(Administrator $addingAdministrator){
    
            $this->loadData();
            array_push($this->administratorList, $addingAdministrator);
            $this->saveData();
        }

        public function deleteById($id){
            $this->loadData();
            if(!empty($this->administratorList)){
                foreach($this->administratorList as $Administrator){
                    if($Administrator->getAdministratorId() == $id){
                        $index = array_search($Administrator, $this->administratorList);
                        unset($this->administratorList[$index]);
                    }
                }
            }
            $this->saveData();
        }

        public function getAll(){
            $this->loadData();
            return $this->administratorList;            
        }

        private function saveData(){
            
            $encodingArray = array();

            foreach($this->administratorList as $eachAdministrator){
                $arrayValue['AdministratorId'] = $eachAdministrator->getAdministratorId();
                $arrayValue['password'] = $eachAdministrator->getpassword();
                $arrayValue['username'] = $eachAdministrator->getusername();

                array_push($encodingArray, $arrayValue);
            }

            $dataToFile = json_encode($encodingArray, JSON_PRETTY_PRINT);

            file_put_contents($this->dataFile, $dataToFile);
        }

        private function loadData(){
           
            $this->administratorList = array();

            if(file_exists($this->dataFile)){

                $jsonContent = file_get_contents($this->dataFile);

                $decodingArray = ($jsonContent) ? json_decode($jsonContent, true) : array();
                
                foreach($decodingArray as $eachValue){
                    $password = $eachValue["password"];
                    $username = $eachValue["username"];

                    $Administrator = new Administrator($password, $username);

                    $Administrator->setAdministratorId($eachValue['AdministratorId']);

                    array_push($this->administratorList, $Administrator);
                }
            }
        }

    }
?>