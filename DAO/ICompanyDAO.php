<?php
    namespace DAO;

    use Models\Company as Company;

    interface ICompanyDAO
    {
        function Add(Company $company);
        function GetAll();
        function DeleteById($name);
        function SearchByName($name);
        function ModifyById($companyId, $name, $cuit, $description, $website, $street, $number, $aboutUs, $active);
        function FindById($id);
    }
?>