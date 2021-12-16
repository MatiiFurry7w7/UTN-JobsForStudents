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
            <td style="width: 200px;"><label for="dNI">DNI *</label></td> 
            <td style="width: 10px;"><input type="text" name="dNI" placeholder="XX-XXX-XXXX" required></td>
          </tr>            
          <tr>
            <td><label for="fileNumber">File number *</label></td>
            <td><input type="text" name="fileNumber" placeholder="XX-XXX-XXXX" required></td>
          </tr>   
          <tr>
            <td><label for="email">E-mail *</label></td>
            <td><input type="text" name="email" required></td>
          </tr>   
          <tr>
            <td><label for="password">Password *</label></td>
            <td><input type="password" name="password" required></td>
          </tr>   
          <tr>
            <td><label for="password">Repeat password *</label></td>
            <td><input type="password" name="password2" required></td>
          </tr>  
          <tr>
            <td><button class="btn btn-primary" onclick="window.location.href='<?php echo FRONT_ROOT ?>Login/LoginView'">Login</button></td>
            <td><button type="submit" class="btn btn-primary">Register</button></td>
          </tr> 
          
    </table>
    <font size="3" color="red">* required fields</font>
    <?php
      if($message != "")
        echo "<p id='errorMessage'>".$message." </p>";
    ?>
  </form>
</div>
</center>
<?php if($message) { ?>
    <script> alert('<?php echo $message?>'); </script>
<?php } ?>
<?php
  include_once('footer.php');
?>