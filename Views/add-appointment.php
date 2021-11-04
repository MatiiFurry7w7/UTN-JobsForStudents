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
            <td><label for="studentId">Student ID</label></td>
            <td><input type="text" name="studentId" value="<?php echo $_SESSION['currentUser']->getStudentId() ?>"></td>
          </tr>
          <tr>
            <td><label for="referenceURL">Job Offer ID</label></td>
            <td><input type="text" name="jobOfferId" value="<?php echo "0" ?>"></td>
          </tr>
          <tr>
            <td><label for="cv">Curriculum Vitae</label></td> <!-- Se manda la direccion donde se encuentra el CV-->
            <td><input type="file" name="file"></td>
          </tr> 
          <tr>
            <td><label for="referenceURL">Reference URL</label></td>
            <td><input type="text" name="referenceURL"></td>
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