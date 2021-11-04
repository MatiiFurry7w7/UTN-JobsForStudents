<?php
    namespace DAO;

    use Models\Company as Company;
    use DAO\Connection as Connection;

    interface ICompanyDAO
    {
        function Add(Company $company);
        function GetAll();
        function DeleteById($companyId);
        function FindById($companyId);
        function ModifyById($companyId, $name, $cuit, $description, $website, $street, $number, $aboutUs, $active, $industry);
    }
?>