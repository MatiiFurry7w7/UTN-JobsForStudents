<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Appointment/Add" method="POST">
    <table>
          <tr>
            <th colspan="2"><center><h4>Adding Appointment</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="studentId">ID Stundet</label></td> 
            <td style="width: 10px;"><input type="text" name="studentId"></td>
          </tr>            
          <tr>
            <td><label for="jobOfferId">ID Job Offer</label></td>
            <td><input type="text" name="jobOfferId"></td>
          </tr>
          <tr>
            <td><label for="cv">Curriculum Vitae</label></td> <!-- Se manda la direccion donde se encuentra el CV-->
            <td><input type="text" name="cv"></td>
          </tr> 
          <tr>
            <td><label for="dateAppointment">Date Appointment</label></td>
            <td><input type="datetime-local" name="dateAppointment"></td>
          </tr> 
          <tr>
            <td><label for="referenceURL">Reference URL</label></td>
            <td><input type="text" name="referenceURL"></td>
          </tr>      
          <tr>
            <td colspan="2"><button type="submit" class="btn btn-primary">Add</button></td>
          </tr> 
    </table>
  </form>
</div>
</center>
<?php
  include_once('footer.php');
?>