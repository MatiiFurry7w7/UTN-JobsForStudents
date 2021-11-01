<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
  <div class="wrapper row3">
      <?php
      foreach($jobOfferList as $jobOffer){ ?>
      <br>
        <table style="width: 80%;">
          <tr>
            <th id="hometh" colspan="2">
              Company
            </th>
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
            <td style='max-width: 230px;;'><?php echo $jobOffer->getActive()?></td>
          </tr> 
          <tr>
            <td>Remote</td>
            <td style='max-width: 230px;;'><?php echo $jobOffer->getRemote()?></td>
          </tr> 
          <tr>
            <td>Salary</td>
            <td style='max-width: 230px;;'><?php echo $jobOffer->getSalary()?></td>
          </tr>
        </table>
      <?php } ?>
  </div>
</center>
<?php
  include_once('footer.php');
?>