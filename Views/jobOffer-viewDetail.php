<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <table style="width: 60%;">
        <tr>
          <th colspan="2"><center><h4>Job Offer Detail</h4></center></th>
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
          <td style='max-width: 230px;;'><?php echo $jobPosition->getDescription()?></td>
        </tr>
        <tr>
          <td>Dedication</td>
          <td style='max-width: 230px;;'><?php echo $jobOffer->getDedication()?></td>
        </tr>
        <tr>
          <td>Salary</td>
          <td style='max-width: 230px;;'><?php echo $jobOffer->getSalary()?> $</td>
        </tr> 
        <tr>
          <?php if($isAdmin) { 
            var_dump($isAdmin);
            ?><td></td>
            <td><button class="btn btn-success" value="edit">Edit</button></td> <?php
          } else {
            ?>
            <td></td>
            <td><button class="btn btn-success" value="apply">Apply</button></td> <?php
          }
          ?>
        </tr>
  </table>
</div>
</center>
<?php
  include_once('footer.php');
?>