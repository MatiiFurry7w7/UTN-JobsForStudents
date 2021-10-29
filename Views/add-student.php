<?php 
  include_once('header.php');
?>
<center>
<div class="container">
<div style="margin-top: 70px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Student/Add" method="POST">
    <table>
          <tr>
            <th colspan="2"><center><h4>Register</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="dNI">DNI</label></td> 
            <td style="width: 10px;"><input type="text" name="dNI" placeholder="XX-XXX-XXXX"></td>
          </tr>            
          <tr>
            <td><label for="fileNumber">File number</label></td>
            <td><input type="text" name="fileNumber" placeholder="XX-XXX-XXXX"></td>
          </tr>   
          <tr>
            <td><label for="email">E-mail</label></td>
            <td><input type="text" name="email"></td>
          </tr>   
          <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" name="password"></td>
          </tr>    
          <tr>
            <td colspan="2"><button type="submit" class="btn btn-primary">Add</button></td>
          </tr> 
    </table>
    <?php
      if($message != "")
        echo "<p id='errorMessage'>".$message." </p>";
    ?>
  </form>
</div>
</center>
<?php
  include_once('footer.php');
?>