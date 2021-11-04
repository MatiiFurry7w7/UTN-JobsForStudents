<?php 
        include_once('header.php');
        include_once('nav-bar.php');
?>
<center>
<div class="wrapper row3">
        <br>
        <table style="width: 80vh;">
        <tr>
          <th style="border-radius: 0px;" colspan="5"><center><h4>My Appointment</h4></center></th>
        </tr>
                <tr id="tableIndex">
                        <td style='width: 10px;'>ID</td>
                        <td>Curriculum Vitae</td>
                        <td>Date</td>
                        <td>Reference</td>
                        <td><button class="btn btn-danger" onclick="window.location.href='<?php echo '#' ?>//Appointment/AddView'">Remove</button>
                </tr>
                <tr>
                        <td style='max-width: 10px; text-align: center;'><?php echo $currentStudent->getAppointment()->getJobOfferId() ?></td>
                        <td style='max-width: 100px;'><?php echo $currentStudent->getAppointment()->getCv()?></td>
                        <td style='max-width: 100px;'><?php echo $currentStudent->getAppointment()->getDateAppointment() ?></td>
                        <td style='max-width: 100px;'><?php echo $currentStudent->getAppointment()->getReferenceURL() ?></td>
                        <td></td>
                </tr>
        </table>
        <br>
        <table style="width: 80vh;">
        <tr>
          <th style="border-radius: 0px;" colspan="2"><center><h4>From <b><?php echo $jobOffer->getCompany()->getName()?></b> Company</h4></center></th>
        </tr>
        <tr>
          <td>Title</td>
          <td style='max-width: 230px;;'><?php echo $jobOffer->getTitle()?></td>
        </tr>  
        <tr>
          <td>Date published</td>
          <td style='max-width: 230px;;'><?php echo $jobOffer->getPublishedDate()?></td>
        </tr> 
        <tr>
          <td>Until</td>
          <td style='max-width: 230px;;'><?php echo $jobOffer->getFinishDate()?></td>
        </tr> 
        <tr>
          <td>Task</td>
          <td style='max-width: 230px;;'><?php echo $jobOffer->getTask()?></td>
        </tr> 
        <tr>
          <td>Active</td>
          <td style='max-width: 230px;;'><?php $isActive = $jobOffer->getActive() == 1 ? "Yes" : "No"; echo $isActive;?></td>
        </tr> 
        <tr>
          <td>Remote</td>
          <td style='max-width: 230px;;'><?php $isRemote = $jobOffer->getRemote() == 1 ? "Yes" : "No"; echo $isRemote?></td>
        </tr> 
        <tr>
          <td>Job Position</td>
          <td style='max-width: 230px;;'><?php echo $jobOffer->getJobPosition()->getDescription()?></td>
        </tr>
        <tr>
          <td>Dedication</td>
          <td style='max-width: 230px;;'><?php echo $jobOffer->getDedication()?></td>
        </tr>
        <tr>
          <td>Salary</td>
          <td style='max-width: 230px;;'><?php echo '$'.$jobOffer->getSalary()?> </td>
        </tr>
  </table>
</div>
</center>
<?php
        include_once('footer.php');
?>