<?php
    namespace DAO;

    use Models\Student as Student;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\AcademicStatus as AcademicStatus;
    use Models\Career as Career;

class StudentDAO implements IStudentDAO{

        private $studentList = array();
        private $dataFile;

        //PUBLIC --------------------------------------------------

        //Constructor to assign data file directory
        public function __construct(){
            $this->dataFile = dirname(__DIR__)."\Data\students.json";
        }

        //Add Student to repository
        public function add(Student $addingStudent){
            //Get array from data file
            $this->loadData();

            //Insert the new Student in the array
            array_push($this->studentList, $addingStudent);

            //Save array to data file
            $this->saveData();
        }

        //Remove Student from repository
        public function deleteById($id){
            $this->loadData();

            if(!empty($this->studentList)){
                foreach($this->studentList as $student){
                    if($student->getStudentId() == $id){
                        $index = array_search($student, $this->studentList);
                        unset($this->studentList[$index]);
                    }
                }
            }
            $this->saveData();
        }

        //Return the array
        public function getAll(){
            $this->loadData();
            return $this->studentList;            
        }

        //TEST
        public function loadFromAPI(){
            //Empty List
            $this->studentList = array();

            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Student');
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($url);
            $toJson = json_decode($response);

            foreach($toJson as $each){
                //$career = GETCAREERBYID
                $newStudent = new Student
                ($each->firstName, 
                $each->lastName,
                $each->email,
                $each->phoneNumber,
                $each->gender,
                $each->dni,
                $each->birthDate);
                $newStudent->setStudentId($each->studentId);

                //FIX CAREER
                $newCareer = new Career($each->careerId, "FOO", "BAR");
                $newStudent->setCareer($newCareer);

                $newAcademicStatus = new AcademicStatus($each->active, "N/A", $each->fileNumber);
                $newStudent->setAcademicStatus($newAcademicStatus);

                array_push($this->studentList, $newStudent);
            }

            //Save changes
            $this->saveData();
        }

        //PRIVATE -------------------------------------------------

        //Save array to file
        private function saveData(){
            //Array to save each Student data
            $encodingArray = array();

            //Each Student->value will be saved in the encoding array
            foreach($this->studentList as $each){
                $arrayValue['studentId'] = $each->getStudentId();
                $arrayValue['careerId'] = $each->getCareer()->getCareerId();
                $arrayValue['firstName'] = $each->getFirstName();
                $arrayValue['lastName'] = $each->getLastName();
                $arrayValue['dni'] = $each->getDNI();
                $arrayValue['fileNumber'] = $each->getAcademicStatus()->getFileNumber();
                $arrayValue['gender'] = $each->getGender();
                $arrayValue['birthDate'] = $each->getBirthDate();
                $arrayValue['email'] = $each->getEmail();
                $arrayValue['phoneNumber'] = $each->getPhoneNumber();
                $arrayValue['active'] = $each->getAcademicStatus()->getActive();

                array_push($encodingArray, $arrayValue);
            }

            //Actual encoding of the array to JSON
            $dataToFile = json_encode($encodingArray, JSON_PRETTY_PRINT);

            //Saving all the JSON converted data to file (creating it if not exists)
            file_put_contents($this->dataFile, $dataToFile);
        }

        //Load array from file
        private function loadData(){
            //Clear the actual array list
            $this->studentList = array();

            if(file_exists($this->dataFile)){
                //Load json data from file
                $jsonContent = file_get_contents($this->dataFile);

                //Actual decoding of the json data into an array
                $decodingArray = ($jsonContent) ? json_decode($jsonContent, true) : array();
                
                //Each decoded value into actual array list
                foreach($decodingArray as $eachValue){
                    $firstName = $eachValue["firstName"];
                    $lastName = $eachValue["lastName"];
                    $email = $eachValue["email"];
                    $phoneNumber = $eachValue["phoneNumber"];
                    $gender = $eachValue["gender"];
                    $dNI = $eachValue["dni"];
                    $birthDate = $eachValue["birthDate"];

                    $Student = new Student($firstName, $lastName, $email, $phoneNumber, $gender, $dNI, $birthDate);
                    
                    $Career = new Career($eachValue["careerId"], "N/A", "N/A");
                    $AcademicStatus = new AcademicStatus($eachValue["active"], "N/A", $eachValue["fileNumber"]);

                    $Student->setStudentId($eachValue['studentId']);
                    $Student->setCareer($Career);
                    $Student->setAcademicStatus($AcademicStatus);

                    array_push($this->studentList, $Student);
                }
            }
        }
    }
?>