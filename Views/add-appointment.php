<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Appointment/Add" enctype="multipart/form-data" method="POST">
    <table>
      <tr>
        <th colspan="2"><center><h4>Applying Appointment</h4></center></th>
      </tr>
      <tr>
        <input type="hidden" name="studentId" value="<?php echo $_SESSION['currentUser']->getStudentId() ?>">
        <input type="hidden" name="jobOfferId" value="<?php echo $jobOfferId; ?>">
      </tr>
      <tr>
        <td><label for="cv">Curriculum Vitae</label></td>
        <td><input type="text" name="file" value="" required></td>
      </tr>
      <tr>
        <td><label for="referenceURL">Reference URL</label></td>
        <td><input type="text" name="referenceURL" required></td>
      </tr>      
      <tr>
        <td colspan="2"><center><button type="submit" class="btn btn-success">Apply</button><center></td>
      </tr> 
    </table>
  </form>
</div>
</center>

<?php


  include_once('footer.php');
?>