<?php 
        include_once('header.php');
        include_once('nav-bar.php');
?>
<center>
<div class="wrapper row3">
        <br>
        <form action="<?php echo FRONT_ROOT ?>Appointment/Remove" method="POST">
          <table style="width: 80vh;">
            <tr>
              <th style="border-radius: 0px;" colspan="5"><center><h4>My Appointment</h4></center></th>
            </tr>
            <input type="hidden" name="studentId" value="<?php echo $currentStudent->getUserId()?>">
            <input type="hidden" name="jobOfferId" value="<?php echo $appointment->getJobOffer()->getJobOfferId() ?>">
            <tr id="tableIndex">
                    <td>Date</td>
                    <td>Reference</td>
                    <td>Comments</td>
                    <?php if($appointment->getActive() == 1){ ?>
                      <td><button type='submit' class='btn btn-danger'>Remove</button>
                   <?php  }?>
                    
            </tr>
            <tr>
                    <td style='max-width: 100px;'><?php echo $appointment->getDateAppointment() ?></td>
                    <td><a href="<?php echo $appointment->getReferenceURL()?>"><?php echo $currentStudent->getAppointment()->getReferenceURL()?></a></td>
                    <td style='max-width: 100px;'><?php echo $appointment->getComments() ?></td>
                    <?php if($appointment->getActive() == 1){ ?>
                    <td></td>
                    <?php  }?>
            </tr>
          </table>
        </form>
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