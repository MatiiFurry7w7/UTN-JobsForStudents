<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST">
    <table>
          <tr>
            <th colspan="2"><center><h4>Adding a Job Offer</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="title">Title</label></td> 
            <td style="width: 10px;"><input type="text" name="title" required></td>
          </tr>            
          <tr>
            <td><label for="publishedDate">Published Date</label></td>
            <td><input type="date" name="publishedDate" required></td>
          </tr>   
          <tr>
            <td><label for="finishDate">Finish Date</label></td>
            <td><input type="date" name="finishDate" required></td>
          </tr>   
          <tr>
            <td><label for="task">Task</label></td>
            <td><input type="text" name="task" required></td>
          </tr>   
          <tr>
            <td><label for="skills">Skills</label></td>
            <td><input type="text" name="skills" required></td>
          </tr>   
          <tr>
            <td style="width: 200px;"><label for="active">Active</label></td> 
            <td>
                <input type="radio" name="active" value="1" checked required>Active
                <input type="radio" name="active" value="0" required>Not active
            </td>
          </tr>  
          <tr>
            <td style="width: 200px;"><label for="remote">Remote</label></td> 
            <td>
                <input type="radio" name="remote" value="1" checked required>Remote
                <input type="radio" name="remote" value="0" required>Not Remote
            </td>
          </tr>
          <tr>
            <td><label for="salary">Salary</label></td>
            <td><input type="number" name="salary" required></td>
          </tr> 
          <tr>
            <td style="width: 200px;"><label for="jobPositionId">Job Position</label></td> 
            <td>
                <select name="jobPositionId">  
                  <?php
                    foreach($jobPositionList as $jobPosition) {
                      ?><option value="<?php echo $jobPosition->getJobPositionId()?>" ><?php echo $jobPosition->getDescription()?></option><?php 
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
                      ?><option value="<?php echo $dedication?>" ><?php echo $dedication?></option><?php 
                    }
                  ?>
                </select>
            </td>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="companyId">Company</label></td> 
            <td>
                <select name="companyId">  
                  <?php
                    foreach($companyList as $company) {
                      ?><option value="<?php echo $company->getCompanyId()?>" ><?php echo $company->getName()?></option><?php 
                    }
                  ?>
                </select>
            </td>
          </tr>
    </table>
    <div>
        <input type="submit" class="btn btn-success" value="Add"/>
    </div>
    <input type="hidden" name="administratorId" value="<?php echo $admin->getAdministratorId() ?>">
  </form>
</div>
</center>
<?php
  include_once('footer.php');
?>