<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Student/Add" method="POST">
    <table>
          <tr>
            <th colspan="2"><center><h4>Adding Student</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="firstName">First name</label></td> 
            <td style="width: 10px;"><input type="text" name="firstName"></td>
          </tr>            
          <tr>
            <td><label for="lastName">Last name</label></td>
            <td><input type="text" name="lastName"></td>
          </tr>   
          <tr>
            <td><label for="email">E-mail</label></td>
            <td><input type="text" name="email"></td>
          </tr>   
          <tr>
            <td><label for="phoneNumber">Phone number</label></td>
            <td><input type="text" name="phoneNumber"></td>
          </tr>   
          <tr>
            <td><label for="gender">Gender</label></td>
            <td><input type="text" name="gender"></td>
          </tr>   
          <tr>
            <td><label for="dNI">DNI</label></td>
            <td><input type="text" name="dNI"></td>
          </tr>   
          <tr>
            <td><label for="birthDate">Birth date</label></td>
            <td><input type="date" name="birthDate"></td>
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