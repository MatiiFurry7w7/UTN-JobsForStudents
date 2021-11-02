<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;

    interface IJobOfferDAO
    {
        function Add(JobOffer $jobOffer);
        function GetAll();
        function DeleteById($jobOfferId);
        function FindById($jobOfferId);
        function ModifyById($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $active, $remote, $salary, $jobPositionId, $dedication, $companyId, $administratorId);
    }
?>