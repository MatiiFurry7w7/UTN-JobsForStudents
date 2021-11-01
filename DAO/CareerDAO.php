<?php
    namespace DAO;

    use Models\Career as Career;
    use DAO\ICareerDAO as ICareerDAO;

    class CareerDAO implements ICareerDAO{

        public function getAll(){
            $apiCareers = array();
            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/career');
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($url);
            $toJson = json_decode($response);

            foreach($toJson as $eachCareer){
                $newcareer = new Career();
                $newcareer->setCareerId($eachCareer->careerId);
                $newcareer->setDescription($eachCareer->description);
                $newcareer->setActive($eachCareer->active);

                array_push($apiCareers, $newcareer);
            }

            return $apiCareers;
        }
    }
?>