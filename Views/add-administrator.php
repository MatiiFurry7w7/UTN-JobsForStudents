<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Administrator/Add" method="POST">
    <table>
          <tr>
            <th colspan="2"><center><h4>Adding Administrator</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="username">Username</label></td> 
            <td style="width: 10px;"><input type="text" name="userName"></td>
          </tr>            
          <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" name="password"></td>
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