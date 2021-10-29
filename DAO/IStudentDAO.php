<?php
    namespace DAO;

    use Models\Student as Student;
    use DAO\Connection as Connection;

    interface IStudentDAO{
        function add(Student $student);
        function getAll();
        function deleteById($name);
    }
?>