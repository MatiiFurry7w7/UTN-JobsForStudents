<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
  <div class="wrapper row3">
    <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post">
      <table>
        <tr>
          <th colspan="2"><center><h4>Add Company</h4></center></th>
        </tr>
        <tr>
          <td style="width: 200px;"><label for="name">Name</label></td> 
          <td>
            <input type="text" name="name" required>
          </td>
        </tr>  
        <tr>
          <td style="width: 200px;"><label for="cuit">CUIT</label></td> 
          <td>
            <input type="text" name="cuit" required>
          </td>
        </tr> 
        <tr>
          <td style="width: 200px;"><label for="description">Description</label></td> 
          <td>
            <input type="text" name="description" required>
          </td>
        </tr>   
        <tr>
          <td style="width: 200px;"><label for="website">Website</label></td> 
          <td>
            <input type="text" name="website" required>
          </td>
        </tr>  
        <tr>
          <td style="width: 200px;"><label for="street">Street</label></td> 
          <td>
            <input type="text" name="street" required>
          </td>
        </tr>
        <tr>
          <td style="width: 200px;"><label for="number_street">Number</label></td> 
          <td>
            <input type="text" name="number_street" required>
          </td>
        </tr>
        <tr>
          <td style="width: 200px;"><label for="aboutUs">About Us</label></td> 
          <td>
            <input type="text" name="aboutUs" required>
          </td>
        </tr>    
        <tr>
          <td style="width: 200px;"><label for="active">Active</label></td> 
          <td>
            <input type="radio" name="isActive" value="true" checked required>Active
            <input type="radio" name="isActive" value="false" required>Not active
          </td>
        </tr>   
      </table>
      <div>
        <input type="submit" class="btn btn-success" value="Add"/>
      </div>
    </form>
  </div>
</center>
<?php
  include_once('footer.php');
?>