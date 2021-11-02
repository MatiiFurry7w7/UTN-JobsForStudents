<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
  <div class="wrapper row3">
      <?php
      if($jobOfferList){
        foreach($jobOfferList as $jobOffer){ 
          $isActive = $jobOffer->getActive() == 1 ? "Yes" : "No";
          $isRemote = $jobOffer->getRemote() == 1 ? "Yes" : "No";?>
          <br>
            <table style="width: 60%;">
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
                <td style='max-width: 230px;;'><?php echo $isActive?></td>
              </tr> 
              <tr>
                <td>Remote</td>
                <td style='max-width: 230px;;'><?php echo $isRemote?></td>
              </tr> 
              <tr>
                <td>Salary</td>
                <td style='max-width: 230px;;'><?php echo $jobOffer->getSalary()?></td>
              </tr>
              <tr>
                <td></td>
                <td align="right"><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/ViewDetail?jobOfferId=<?php echo $jobOffer->getJobOfferId() ?>'">View More</button></td>
              </tr>
            </table>
          <?php } 
      } else {
        echo "There is no Job Offer to show. Please add a new Job Offer.";
      } ?>
  </div>
  <?php
  if($isAdmin){
    ?><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/ShowAddView'" style="float: right;" >Add a Job Offer</button>
  <?php
  }
  ?>
</center>
<?php
  include_once('footer.php');
?>