<?php
    namespace DAO;

    use Models\JobPosition as JobPosition;
    use DAO\IJobPositionDAO as IJobPositionDAO;
    use Models\Career as Career;

class JobPositionDAO implements IJobPositionDAO {

        private $jobPositionList = array();
        private $fileName; 

        public function __construct() {
            $this->fileName = dirname(__DIR__)."\Data\jobPositions.json";
        }

        public function Add(JobPosition $jobPosition) {
            $this->RetrieveData();

            array_push($this->jobPositionList, $jobPosition);

            $this->SaveData();
        }
        
        public function DeleteById($id) {
            $this->RetrieveData();

            if(!empty($this->jobPositionList)){
                foreach($this->jobPositionList as $jobPosition){
                    if($jobPosition->getJobPositionId() == $id){
                        $index = array_search($jobPosition, $this->jobPositionList);
                        unset($this->jobPositionList[$index]);
                    }
                }
            }
            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();

            return $this->jobPositionList;            
        }

        public function LoadFromAPI() {
            $this->jobPositionList = array();

            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/jobPosition');
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($url);
            $toJson = json_decode($response);

            foreach($toJson as $jobPosition) {
                $newJobPosition = new JobPosition();

                $newJobPosition->setJobPositionId($jobPosition->jobPositionId);
                $newJobPosition->setCareerId($jobPosition->careerId);
                $newJobPosition->setDescription($jobPosition->description);

                array_push($this->jobPositionList, $newJobPosition);
            }

            $this->SaveData();
        }

        private function SaveData() {
            $arrayToEncode = array();

            foreach($this->jobPositionList as $jobPosition){
                $valuesArray['jobPositionId'] = $jobPosition->getJobPositionId();
                $valuesArray['careerId'] = $jobPosition->getCareerId();
                $valuesArray['description'] = $jobPosition->getDescription();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData() {
            $this->jobPositionList = array();

            if(file_exists($this->fileName)) { 
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                
                foreach($arrayToDecode as $valuesArray) {
                    $jobPosition = new JobPosition();

                    $jobPosition->setJobPositionId($valuesArray["jobPositionId"]);
                    $jobPosition->setCareerId($valuesArray["careerId"]);
                    $jobPosition->setDescription($valuesArray["description"]);

                    array_push($this->jobPositionList, $jobPosition);
                }
            }
        }
    }
?>