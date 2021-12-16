<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
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
  <br>
  <form action="<?php echo FRONT_ROOT ?>Appointment/Add" method="POST">
    <table style="width: 80vh;">
      <tr>
        <th colspan="2"><center><h4>Applying Appointment</h4></center></th>
      </tr>
      <tr>
        <input type="hidden" name="studentId" value="<?php echo $currentUser->getUserId() ?>">
        <input type="hidden" name="jobOfferId" value="<?php echo $jobOfferId; ?>">
      </tr>
      <tr>
        <td><label for="referenceURL">Reference URL *</label></td>
        <td><input type="text" name="referenceURL" required></td>
      </tr> 
      <tr>
        <td><label for="comments">Comments</label></td>
        <td><textarea placeholder="Max 150 characters..." maxlength="150" name="comments" cols="23" rows="3"></textarea> </td>
      </tr>      
      <tr>
        <td colspan="2"><center><button type="submit" class="btn btn-primary">Apply</button><center></td>
      </tr> 
    </table>
    <font size="3" color="red">* required fields</font>
  </form>
</div>
</center>
<?php if(isset($message)) { ?>
    <script> alert('<?php echo $message?>'); </script>
<?php } ?>
<?php
  include_once('footer.php');
?>