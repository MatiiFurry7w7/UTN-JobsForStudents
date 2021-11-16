<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
  <div class="wrapper row3">
    <form action="<?php echo FRONT_ROOT ?>Home/Filters" method="POST">
    <table style="margin-top: 20px; width: 40%;">
          <tr style="background-color: rgb(40, 40, 40);">
            <td style="width: 200px; color: white; ">Filter:</td> 
            <td>
                <select name="careerId">  
                <option value="" >By Careers</option>
                  <?php
                    foreach($careerList as $career) {
                      ?><option value="<?php echo $career->getCareerId()?>"><?php echo $career->getDescription()?></option><?php 
                    }
                  ?>
                </select>
            </td>
            <td>
              <label for="jobPosition"></label><input type="text" name="jobPositionSearch" placeholder="Job Position...">
            </td>
            <td>
              <button class="btn btn-danger" type="submit">Search</button>
            </td>
          </tr> 
    </table>
    </form>
    <br>
    <?php
      if($isAdmin){
        ?><button style="float:right;" class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/ShowAddView'" style="float: right;" >Add a Job Offer</button>
      <br><br>
    <?php } ?>
      <?php 
      echo "<b>There are ".$i." Result/s!</b>";
      if($jobOfferList){
        foreach($jobOfferList as $jobOffer){ 
          if($jobOffer->getActive()){
          $isRemote = $jobOffer->getRemote() == 1 ? "Yes" : "No";?>
          <br>
            <table id="jobOfferTable" style="width: 60%;">
              <th colspan="2" id="hometh">
                From <?php echo $jobOffer->getCompany()->getName(); ?>
              </th>
              <tr>
                <td>Career</td>
                <td style='max-width: 230px;'><?php echo $jobOffer->getJobPosition()->getCareer()->getDescription()?></td>
              </tr> 
              <tr>
                <td>Job Position</td>
                <td style='max-width: 230px;'><?php echo $jobOffer->getJobPosition()->getDescription()?></td>
              </tr> 
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
          <?php }} 
      } else {
        if (!isset($careerId)){
          echo "<p style='margin-top: 3vh'>Please choose a Career to filter.</p>";
        } else {
          echo "<p style='margin-top: 3vh'>There is no Job Offer to show.</p>";
        }
      } ?>
  </div>
</center>
<?php if($message) { ?>
    <script> alert('<?php echo $message?>'); </script>
  <?php } ?>
<?php
  include_once('footer.php');
?>