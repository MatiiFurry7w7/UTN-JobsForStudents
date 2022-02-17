<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>JobOffer/ModifyAJobOffer" method="post">
    <input type="hidden" name="jobOfferId" value="<?php echo $jobOffer->getJobOfferId()?>">
    <table>
            <tr>
              <th colspan="2"><center><h4>Edit View</h4></center></th>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="title">Title</label></td> 
              <td>
                <input type="text" name="title" value="<?php echo $jobOffer->getTitle()?>">
              </td>
            </tr>  
            <tr>
              <td style="width: 200px;"><label for="publishedDate">Published Date</label></td> 
              <td>
                <input type="date" name="publishedDate" value="<?php echo $jobOffer->getPublishedDate()?>">
              </td>
            </tr> 
            <tr>
              <td style="width: 200px;"><label for="finishDate">Until</label></td> 
              <td>
                <input type="date" name="finishDate" value="<?php echo $jobOffer->getFinishDate()?>">
              </td>
            </tr>   
            <tr>
              <td style="width: 200px;"><label for="task">Task</label></td> 
              <td>
                <input type="text" name="task" value="<?php echo $jobOffer->getTask()?>">
              </td>
            </tr>  
            <tr>
              <td style="width: 200px;"><label for="skills">Skills</label></td> 
              <td>
                <input type="text" name="skills" value="<?php echo $jobOffer->getSkills()?>">
              </td>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="active">Status</label></td> 
              <td>
                <input type="radio" name="active" value="1" checked required>Active
                <input type="radio" name="active" value="0" required>Not active
              </td>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="remote">Remote</label></td> 
              <td>
                <input type="radio" name="remote" value="1" checked required>Remote
                <input type="radio" name="remote" value="0" required>Not remote
              </td>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="salary">Salary</label></td> 
              <td>
                <input type="text" name="salary" value="<?php echo $jobOffer->getSalary()?>">
              </td>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="jobPositionId">Job Position</label></td> 
              <td>
                  <select name="jobPositionId">">  
                    <?php
                      foreach($jobPositionList as $jobPosition) {
                        if($jobPosition->getCareer()->getCareerId() == $careerId){
                          ?><option value="<?php echo $jobPosition->getJobPositionId()?>" ><?php echo $jobPosition->getDescription()?></option>
                          <?php 
                        }
                      }
                    ?>
                  </select>
              </td>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="dedication">Dedication</label></td> 
              <td>
                  <select name="dedication">  
                    <?php
                      foreach($dedicationList as $dedication) {
                        ?><option value="<?php echo $dedication?>" ><?php echo $dedication?></option>
                        <?php 
                      }
                    ?>
                  </select>
              </td>
            </tr>
            <tr>
                  <input hidden name="companyId" value="<?php echo $user->getCompany()->getCompanyId(); ?>" >
            </tr>
            <tr>
              <td></td><td><button type="submit" class="btn btn-primary">Edit</button></td>
            </tr>
    </table>
  </form>
</div>
</center>
<?php
  include_once('footer.php');
?>