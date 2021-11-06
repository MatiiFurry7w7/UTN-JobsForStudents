<?php

use Models\Administrator;

include_once('header.php');
        include_once('nav-bar.php');
?>
<div class="wrapper row3">
<table id="studentsTable">
        <tr id="tableIndex">
                <td>Title</td>
                <td>Job Position</td>
                <td>Career</td>
                <td>Published Date</td>
                <td>Active</td>
                <td>Dedication</td>
                <?php
                                if($admin instanceof Administrator){
                                        ?>   
                                                <td>Administrator</td>   
                                                <td></td>           
                                                <td></td>
                                                
                                        <?php } ?>
        <td><button class="btn btn-success" onclick="window.location.href='<?php echo FRONT_ROOT ?>Joboffer/ShowAddView'">Add</button>
        </tr>
        <?php
        foreach($jobOfferList as $jobOffer){

                $isActive = $jobOffer->getActive() == 1 ? "Yes" : "No";
                $isRemote = $jobOffer->getRemote() == 1 ? "Yes" : "No";
                ?><tr>
                        <td style='max-width: 230px;'><?php echo $jobOffer->getTitle() ?></td>
                        <td style='max-width: 230px;'><?php echo $jobOffer->getJobPosition()->getDescription() ?></td>
                        <td style='max-width: 230px;'><?php echo $jobOffer->getJobPosition()->getCareer()->getDescription() ?></td>  
                        <td style='max-width: 230px;'><?php echo $jobOffer->getPublishedDate() ?></td>
                        <td style='max-width: 230px;'><?php echo $isActive ?></td>                   
                        <td style='max-width: 230px;'><?php echo $jobOffer->getDedication() ?></td>
                        <td style="align='right'"><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/ViewDetail?jobOfferId=<?php echo $jobOffer->getJobOfferId() ?>'">Details</button></td>

                        <?php
                                if($admin instanceof Administrator){
                                        ?>                    
                                                <td style='max-width: 230px;'><?php echo $admin->getUserName() ?></td>                
                                                <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/Remove?removeId=<?php echo $jobOffer->getJobOfferId() ?>'">Remove</button></td>
                                                <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/ModifyView?modifyId=<?php echo $jobOffer->getJobOfferId() ?>'">Edit</button></td>
                                       <?php
                                }
                        ?>
                        </tr>
        <?php } ?>
        </table>
</div>
<?php
        include_once('footer.php');
?>


