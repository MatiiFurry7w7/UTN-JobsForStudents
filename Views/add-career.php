<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Career/Add" method="POST">
    <table>
          <tr>
            <th colspan="2"><center><h4>Adding Career</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="title">Title</label></td> 
            <td style="width: 10px;"><input type="text" name="title"></td>
          </tr>            
          <tr>
            <td><label for="description">Description</label></td>
            <td><input type="text" name="description"></td>
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