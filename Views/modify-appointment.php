<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Appointment/ModifyAappointment" method="post">
    <input type="hidden" name="appointmentId" value="<?php echo $appointment->getappointmentId()?>">
    <table>
            <tr>
              <th colspan="2"><center><h4>Modify</h4></center></th>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="studentId">ID Student</label></td> 
              <td>
                <input type="text" name="studentId" value="<?php echo $appointment->geStudentId()?>">
              </td>
            </tr>  
            <tr>
              <td style="width: 200px;"><label for="jobOfferId">ID Student</label></td> 
              <td>
                <input type="text" name="jobOfferId" value="<?php echo $appointment->getjobOfferId()?>">
              </td>
            </tr> 
            <tr>
              <td style="width: 200px;"><label for="cv">Curriculum Vitae</label></td> 
              <td>
                <input type="text" name="cv" value="<?php echo $appointment->getCv()?>">
              </td>
            </tr>   
            <tr>
              <td style="width: 200px;"><label for="referenceURL">Reference URL</label></td> 
              <td>
                <input type="text" name="referenceURL" value="<?php echo $appointment->getReferenceURL()?>">
              </td>
            </tr>
    </table>
    <div>
      <button type="submit" class="btn btn-success">Modify</button>
    </div>
  </form>
</div>
</center>
<?php
  include_once('footer.php');
?>