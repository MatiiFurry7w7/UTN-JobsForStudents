<?php
    namespace DAO;

    use Models\JobPosition as JobPosition;

    interface IJobPositionDAO
    {
        public function Add(JobPosition $jobPosition);
        public function GetAll();
        public function FindById($jobPositionId);
    }
?>
