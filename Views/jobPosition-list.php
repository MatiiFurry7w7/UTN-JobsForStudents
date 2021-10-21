<?php 
    include_once('header.php');
    include_once('nav-bar.php');

    foreach($jobPositionList as $jobPosition) {
        echo "<br>ID: ".$jobPosition->getJobPositionId().
            "<br>Carrer ID: ".$jobPosition->getCareerId().
            "<br>Description: ".$jobPosition->getDescription()."<br>";
    }

    include_once('footer.php');
?>

