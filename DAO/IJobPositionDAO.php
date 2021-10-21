<?php
    namespace DAO;

    use Models\JobPosition as JobPosition;

    interface IJobPositionDAO
    {
        public function Add(JobPosition $JobPosition);
        public function GetAll();
        public function DeleteById($id);
    }
?>
