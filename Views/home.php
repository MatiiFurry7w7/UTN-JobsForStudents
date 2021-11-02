<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
  <div class="wrapper row3">
    <table style="margin-top: 20px;">
          <tr style="background-color: rgb(40, 40, 40);">
              <td><input placeholder="Insert a Career or Job Position..." type="text" name="searchedJobOffer"></td>
              <td><button class="btn btn-danger" type="submit">Search</button></td>
              <?php 
                if($searchedJobOffer != "")
                  echo "<td style='color: white; min-width: 150px; display: inline; line-height: 63px;'>Searched: ".$searchedJobOffer."</td>";
              ?>
          </tr> 
    </table>
      <?php
      if($jobOfferList){
        foreach($jobOfferList as $jobOffer){ 
          $isActive = $jobOffer->getActive() == 1 ? "Yes" : "No";
          $isRemote = $jobOffer->getRemote() == 1 ? "Yes" : "No";?>
          <br>
            <table style="width: 60%;">
              <th colspan="2" id="hometh">
                From <?php echo '$jobOffer->getCompany()->getName();' ?>
              </th>
              <tr>
                <td>Title</td>
                <td style='max-width: 230px;'><?php echo $jobOffer->getTitle()?></td>
              </tr>  
              <tr>
                <td>Date published</td>
                <td style='max-width: 230px;'><?php echo $jobOffer->getPublishedDate()?></td>
              </tr> 
              <tr>
                <td>Until</td>
                <td style='max-width: 230px;'><?php echo $jobOffer->getFinishDate()?></td>
              </tr> 
              <tr>
                <td>Task</td>
                <td style='max-width: 230px;'><?php echo $jobOffer->getTask()?></td>
              </tr> 
              <tr>
                <td>Active</td>
                <td style='max-width: 230px;'><?php echo $isActive?></td>
              </tr> 
              <tr>
                <td>Remote</td>
                <td style='max-width: 230px;'><?php echo $isRemote?></td>
              </tr> 
              <tr>
                <td>Salary</td>
                <td style='max-width: 230px;'>$<?php echo $jobOffer->getSalary()?></td>
              </tr>
              <tr>
                <td></td>
                <td align="right"><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/ViewDetail?jobOfferId=<?php echo $jobOffer->getJobOfferId() ?>'">View More</button></td>
              </tr>
            </table>
          <?php } 
      } else {
        echo "<p style='margin-top: 3vh'>There is no Job Offer to show. Please add a new Job Offer.</p>";
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