<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<div class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post">
    <table id="studentsTable">
      <thead>
        <tr id="tableIndex">
            <td>Name</td>
            <td>CUIT</td>
            <td>Description</td>
            <td>Website</td>
            <td>Address</td>
            <td>About Us</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
              <input type="text" name="name" style='width: 100px;'>
          </td>
          <td>
              <input type="text" name="cuit" style='width: 100px;'>
          </td>
          <td>
              <input type="text" name="description" style='width: 100px;'>
          </td>
          <td>
              <input type="text" name="website" style='width: 100px;'>
          </td>
          <td>
              <input type="text" name="address" style='width: 100px;'>
          </td>
          <td>
              <input type="text" name="aboutUs" style='width: 100px;'>
          </td>        
        </tr>
      </tbody>
    </table>
    <div>
      <input type="submit" class="btn" value="Add"/>
    </div>
  </form>
</div>
<?php
  include_once('footer.php');
?>