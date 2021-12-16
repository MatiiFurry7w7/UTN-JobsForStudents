<?php

use Helpers\SessionHelper;

include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px; " class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowAddView" method="POST">
    <table style="width: 55%;">
          <tr>
            <th colspan="2"><center><h4>Adding a Job Offer</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="careerId">Career *</label></td> 
            <td>
                <select name="careerId" required>  
                  <?php
                    foreach($careerList as $career) {
                      ?><option value="<?php echo $career->getCareerId()?>" ><?php echo $career->getDescription()?></option><?php 
                    }
                  ?>
                </select>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <center>
                <input type="submit" class="btn btn-primary" value="Set Career" />
              </center>
            </td>
          </tr>
    </table>
  </form>
</div>
<form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST">
  <table style="width: 55%;">
        <?php
        if($careerId != "") { ?>
          <tr>
            <td style="width: 200px;"><label for="jobPositionId">Job Position *</label></td> 
            <td>
                <select name="jobPositionId" required>  
                  <?php
                    foreach($jobPositionList as $jobPosition) {
                        ?><option value="<?php echo $jobPosition->getJobPositionId()?>" ><?php echo $jobPosition->getDescription()?></option><?php 
                    }
                  ?>
                </select>
            </td>
          </tr>
          <tr>
            <?php if((new SessionHelper)->isAdmin()){ ?>
            <td style="width: 200px;"><label for="companyId">Company *</label></td> 
            <td>
                <select name="companyId" required>  
                  <?php
                    foreach($companyList as $company) {
                      ?><option value="<?php echo $company->getCompanyId()?>" ><?php echo $company->getName()?></option><?php 
                    }
                  ?>
                </select>
            </td>
            <?php } else{?>
              <input type="hidden" name="companyId" value="<?php echo (new SessionHelper)->getCurrentUser()->getCompany()->getCompanyId()?>">
            <?php } ?>

          </tr>
          <tr>
            <td style="width: 150px;"><label for="title">Title *</label></td> 
            <td style="width: 10px;"><input type="text" name="title" required></td>
          </tr>            
          <tr>
            <td><label for="publishedDate">Published Date *</label></td>
            <td><input type="date" name="publishedDate" required></td>
          </tr>   
          <tr>
            <td><label for="finishDate">Finish Date *</label></td>
            <td><input type="date" name="finishDate" required></td>
          </tr>   
          <tr>
            <td><label for="task">Task *</label></td>
            <td><input type="text" name="task" required></td>
          </tr>   
          <tr>
            <td><label for="skills">Skills *</label></td>
            <td><input type="text" name="skills" required></td>
          </tr>   
          <tr>
            <td style="width: 200px;"><label for="active">Status *</label></td> 
            <td>
              Active: <input type="radio" name="active" value="1" checked required>
              Not active: <input type="radio" name="active" value="0" required>
            </td>
          </tr>  
          <tr>
            <td style="width: 200px;"><label for="remote">Remote *</label></td> 
            <td>
            Remote: <input type="radio" name="remote" value="1" checked required>
            Not Remote: <input type="radio" name="remote" value="0" required>
            </td>
          </tr>
          <tr>
            <td><label for="salary">Salary *</label></td>
            <td><input type="number" name="salary" required></td>
          </tr> 
          <tr>
            <td style="width: 200px;"><label for="dedication">Dedication *</label></td> 
            <td>
                <select name="dedication" required>  
                  <?php
                    foreach($dedicationList as $dedication) {
                      ?><option value="<?php echo $dedication?>" ><?php echo $dedication?></option><?php 
                    }
                  ?>
                </select>
            </td>
          </tr> 
          <tr>
            <td colspan="2">
              <center>
                <input type="submit" class="btn btn-primary" value="Add"/>
              </center>
            </td>
          </tr> 
        <?php
        }
        ?>
  </table>
  <font size="3" color="red">* required fields</font>
  <input type="hidden" name="administratorId" value="<?php echo $admin->getUserId() ?>">
</form>
<?php if($message) { ?>
    <script> alert('<?php echo $message?>'); </script>
<?php } ?>
</center>
<?php
  include_once('footer.php');
?>