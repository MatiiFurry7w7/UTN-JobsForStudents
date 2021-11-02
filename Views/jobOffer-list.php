<?php 
        include_once('header.php');
        include_once('nav-bar.php');
?>
<div class="wrapper row3">
<table id="studentsTable">
        <tr id="tableIndex">
                <td>Title</td>
                <td>Published Date</td>
                <td>Until</td>
                <td>Task</td>
                <td>Skills</td>
                <td>Active</td>
                <td>Remote</td>
                <td>Salary</td>
                <td>Job Position</td>
                <td>Dedication</td>
                <td>Company</td>
                <td>Administrator</td>
                <td></td>
                <td></td>
        </tr>
        <?php
        foreach($jobOfferList as $jobOffer){

                $isActive = $jobOffer->getActive() == 1 ? "Yes" : "No";
                $isRemote = $jobOffer->getRemote() == 1 ? "Yes" : "No";
                ?><tr>
                        <td style='max-width: 230px;;'><?php echo $jobOffer->getTitle() ?></td>
                        <td style='max-width: 230px;'><?php echo $jobOffer->getPublishedDate() ?></td>
                        <td style='max-width: 230px;;'><?php echo $jobOffer->getFinishDate() ?></td>
                        <td style='max-width: 230px;;'><?php echo $jobOffer->getTask() ?></td>
                        <td style='max-width: 230px;;'><?php echo $jobOffer->getSkills() ?></td>
                        <td style='max-width: 230px;;'><?php echo $isActive ?></td>
                        <td style='max-width: 230px;;'><?php echo $isRemote ?></td>
                        <td style='max-width: 230px;;'><?php echo $jobOffer->getSalary() ?></td>
                        <td style='max-width: 230px;;'><?php echo $jobOffer->getJobPosition()->getDescription() ?></td>
                        <td style='max-width: 230px;;'><?php echo $jobOffer->getDedication() ?></td>
                        <td style='max-width: 230px;;'><?php echo $jobOffer->getCompany()->getName() ?></td>
                        <td style='max-width: 230px;;'><?php echo $admin->getUserName() ?></td>                
                        
                        <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/Remove?removeId=<?php echo $jobOffer->getJobOfferId() ?>'">Remove</button></td>
                        <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/ModifyView?modifyId=<?php echo $jobOffer->getJobOfferId() ?>'">Edit</button></td>
                </tr>
        <?php } ?>
        </table>
</div>
<?php
        include_once('footer.php');
?>