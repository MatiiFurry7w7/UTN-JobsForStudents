<?php
    namespace DAO;

    use Models\Career as Career;
    use DAO\IcareerDAO as IcareerDAO;

class CareerDAO implements ICareerDAO {

        private $careerList = array();
        private $fileName; 

        public function __construct() {
            $this->fileName = dirname(__DIR__)."\Data\careers.json";
        }

        public function Add(Career $career) {
            $this->RetrieveData();

            array_push($this->careerList, $career);

            $this->SaveData();
        }
        
        public function DeleteById($id) {
            $this->RetrieveData();

            if(!empty($this->careerList)){
                foreach($this->careerList as $career){
                    if($career->getCareerId() == $id){
                        $index = array_search($career, $this->careerList);
                        unset($this->careerList[$index]);
                    }
                }
            }
            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();

            return $this->careerList;            
        }

        public function LoadFromAPI() {
            $this->careerList = array();

            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Career');
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($url);
            $toJson = json_decode($response);

            foreach($toJson as $career) {
                
                $newCareer = new Career();

                $newCareer->setCareerId($career->careerId);
                $newCareer->setTitle($career->title);
                $newCareer->setDescription($career->description);
                $newCareer->setActive($career->active);

                array_push($this->careerList, $newCareer);
            }

            $this->SaveData();
        }

        private function SaveData() {
            $arrayToEncode = array();

            foreach($this->careerList as $career){
                $valuesArray['careerId'] = $career->getcareerId();
                $valuesArray['title'] = $career->getTitleId();
                $valuesArray['description'] = $career->getDescription();
                $valuesArray['active'] = $career->getActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData() {
            $this->careerList = array();

            if(file_exists($this->fileName)) { 
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                
                foreach($arrayToDecode as $valuesArray) {
                    $career = new Career();

                    $career->setcareerId($valuesArray["careerId"]);
                    $career->setTitle($valuesArray["title"]);
                    $career->setDescription($valuesArray["description"]);
                    $career->setActive($valuesArray["active"]);

                    array_push($this->careerList, $career);
                }
            }
        }
    }
?>