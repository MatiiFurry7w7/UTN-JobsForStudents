<?php
    namespace DAO;

    use Models\Career as Career;

    interface ICareerDAO
    {
        public function Add(Career $career);
        public function GetAll();
        public function DeleteById($id);
    }
?>