<?php 
        include_once('header.php');
        include_once('nav-bar.php');
?>
<div class="wrapper row3">
<table id="studentsTable">
        <tr id="tableIndex">
                <td>Title</td>
                <td>Published Date</td>
                <td>Finish Date</td>
                <td>Task</td>
                <td>Active</td>
                <td>Remote</td>
                <td>Salary</td>
        </tr>
        <?php
        foreach($jobOfferList as $jobOffer){
                echo "<tr>
                        <td style='max-width: 230px;;'>".$jobOffer->getTitle()."</td>
                        <td style='max-width: 230px;'>".$jobOffer->getPublishedDate()."</td>
                        <td style='max-width: 230px;;'>".$jobOffer->getFinishDate()."</td>
                        <td style='max-width: 230px;;'>".$jobOffer->getTask()."</td>
                        <td style='max-width: 230px;;'>".$jobOffer->getActive()."</td>
                        <td style='max-width: 230px;;'>".$jobOffer->getRemote()."</td>
                        <td style='max-width: 230px;;'>".$jobOffer->getSalary()."</td>"; ?>                 
                </tr>
        <?php } ?>
        </table>
</div>
<?php
        include_once('footer.php');
?>