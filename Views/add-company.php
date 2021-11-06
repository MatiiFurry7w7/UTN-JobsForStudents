<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
  <div class="wrapper row3">
    <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post">
      <br>
      <table>
        <tr>
          <th colspan="2"><center><h4>Add Company</h4></center></th>
        </tr>
        <tr>
          <td style="width: 200px;"><label for="name">Name<abbr title="required" aria-label="required">*</abbr></label></td> 
          <td>
            <input type="text" name="name" required>
          </td>
        </tr>  
        <tr>
          <td style="width: 200px;"><label for="cuit">CUIT (without hyphen)<abbr title="required" aria-label="required">*</abbr></label></td> 
          <td>
            <input max="999999999999" type="number" name="cuit" required>
          </td>
        </tr> 
        <tr>
          <td style="width: 200px;"><label for="description">Description<abbr title="required" aria-label="required">*</abbr></label></td> 
          <td>
            <input type="text" name="description" required>
          </td>
        </tr>   
        <tr>
          <td style="width: 200px;"><label for="website">Website<abbr title="required" aria-label="required">*</abbr></label></td> 
          <td>
            <input type="text" name="website" required>
          </td>
        </tr>  
        <tr>
          <td style="width: 200px;"><label for="street">Street<abbr title="required" aria-label="required">*</abbr></label></td> 
          <td>
            <input type="text" name="street" required>
          </td>
        </tr>
        <tr>
          <td style="width: 200px;"><label for="number_street">Number<abbr title="required" aria-label="required">*</abbr></label></td> 
          <td>
            <input type="number" name="number_street" required>
          </td>
        </tr>
        <tr>
          <td style="width: 200px;"><label for="aboutUs">About Us<abbr title="required" aria-label="required">*</abbr></label></td> 
          <td>
            <input type="text" name="aboutUs" required>
          </td>
        </tr>   
        <tr>
          <td style="width: 200px;"><label for="industry">Industry<abbr title="required" aria-label="required">*</abbr></label></td> 
          <td>
              <select name="industry">  
                <?php
                  foreach($industryList as $industry) {
                    ?><option value="<?php echo $industry?>" ><?php echo $industry?></option><?php 
                  }
                ?>
              </select>
          </td>
        </tr>  
        <tr>
          <td style="width: 200px;"><label for="active">Active<abbr title="required" aria-label="required">*</abbr></label></td> 
          <td>
          Active: <input type="radio" name="isActive" value="1" checked required>
          Not active:  <input type="radio" name="isActive" value="0" required>
          </td>
        </tr>   
        <tr>
          <td colspan="2">
            <center>
              <input type="submit" class="btn btn-success" value="Add"/>
            </center>
          </td>
        </tr>
      </table>
    </form>
  </div>
</center>
<?php
  include_once('footer.php');
?>