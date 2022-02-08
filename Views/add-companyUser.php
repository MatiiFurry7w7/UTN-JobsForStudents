<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>CompanyUser/Add" method="POST">
    <table>
          <tr>
            <th colspan="2"><center><h4>Adding Company User</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="email">E-mail *</label></td> 
            <td style="width: 10px;"><input type="email" name="email" required></td>
          </tr>            
          <tr>
            <td><label for="password">Password *</label></td>
            <td><input type="password" name="password" required></td>
          </tr>
          <tr>
            <td><label for="password">Repeat password *</label></td>
            <td><input type="password" name="checkPassword" required></td>
          </tr>   
          <tr>
            <td colspan="2"><button type="submit" class="btn btn-primary">Add</button></td>
          </tr> 
    </table>
    <font size="3" color="red">* required fields</font>
  </form>
</div>
</center>
<?php if($message != "") { ?>
    <script> alert('<?php echo $message?>'); </script>
<?php } ?>
<?php
  include_once('footer.php');
?>