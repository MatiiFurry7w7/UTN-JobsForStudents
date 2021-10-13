<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<form action="<?php echo FRONT_ROOT ?>Company/Add" method="post">
          <table> 
            <thead>
              <tr>
                <th>Name</th>
                <th>CUIT</th>
                <th>Description</th>
                <th>Website</th>
                <th>Address</th>
                <th>About Us</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                    <input type="text" name="name">
                </td>
                <td>
                    <input type="text" name="cuit">
                </td>
                <td>
                    <input type="text" name="description">
                </td>
                <td>
                    <input type="text" name="website">
                </td>
                <td>
                    <input type="text" name="address">
                </td>
                <td>
                    <input type="text" name="aboutUs">
                </td>        
              </tr>
              </tbody>
          </table>
          <div>
            <input type="submit" class="btn" value="Add"/>
          </div>
        </form>

<?php
  include_once('footer.php');
?>