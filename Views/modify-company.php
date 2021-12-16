<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Company/ModifyACompany" method="post">
    <input type="hidden" name="companyId" value="<?php echo $company->getCompanyId()?>">
    <table>
            <tr>
              <th colspan="2"><center><h4>Edit View</h4></center></th>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="name">Name</label></td> 
              <td>
                <input type="text" name="name" value="<?php echo $company->getName()?>">
              </td>
            </tr>  
            <tr>
              <td style="width: 200px;"><label for="cuit">CUIT</label></td> 
              <td>
                <input type="text" name="cuit" value="<?php echo $company->getCuit()?>">
              </td>
            </tr> 
            <tr>
              <td style="width: 200px;"><label for="description">Description</label></td> 
              <td>
                <input type="text" name="description" value="<?php echo $company->getDescription()?>">
              </td>
            </tr>   
            <tr>
              <td style="width: 200px;"><label for="website">Website</label></td> 
              <td>
                <input type="text" name="website" value="<?php echo $company->getWebsite()?>">
              </td>
            </tr>  
            <tr>
              <td style="width: 200px;"><label for="street">Street</label></td> 
              <td>
                <input type="text" name="street" value="<?php echo $company->getStreet()?>">
              </td>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="number">Number</label></td> 
              <td>
                <input type="text" name="number" value="<?php echo $company->getNumber()?>">
              </td>
            </tr>
            <tr>
              <td style="width: 200px;"><label for="aboutUs">About Us</label></td> 
              <td>
                <input type="text" name="aboutUs" value="<?php echo $company->getAboutUs()?>">
              </td>
            </tr>  
            <tr>
          <td style="width: 200px;"><label for="industry">Industry</label></td> 
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
              <td style="width: 200px;"><label for="active">Status</label></td> 
              <td>
                <input type="radio" name="active" value="true" checked required>Active
                <input type="radio" name="active" value="false" required>Not active
              </td>
            </tr>
    </table>
    <div>
      <button type="submit" class="btn btn-primary">Edit</button>
    </div>
  </form>
</div>
</center>
<?php
  include_once('footer.php');
?>