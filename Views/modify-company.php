<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Company/ModifyCompany" method="post">
  <table>
          <tr>
            <th colspan="2"><center><h4>Modify</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="name">Name</label></td> 
            <td>
              <input type="text" name="name" placeholder="<?php echo $company->getName();?>">
            </td>
          </tr>  
          <tr>
            <td style="width: 200px;"><label for="cuit">CUIT</label></td> 
            <td>
              <input type="text" name="cuit" placeholder="<?php echo $company->getCuit();?>">
            </td>
          </tr> 
          <tr>
            <td style="width: 200px;"><label for="description">Description</label></td> 
            <td>
              <input type="text" name="description" placeholder="<?php echo $company->getDescription();?>">
            </td>
          </tr>   
          <tr>
            <td style="width: 200px;"><label for="website">Website</label></td> 
            <td>
              <input type="text" name="website" placeholder="<?php echo $company->getWebsite();?>">
            </td>
          </tr>  
          <tr>
            <td style="width: 200px;"><label for="street">Street</label></td> 
            <td>
              <input type="text" name="street" placeholder="<?php echo $company->getStreet();?>">
            </td>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="number">Number</label></td> 
            <td>
              <input type="text" name="number" placeholder="<?php echo $company->getNumber();?>">
            </td>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="aboutUs">About Us</label></td> 
            <td>
              <input type="text" name="aboutUs" placeholder="<?php echo $company->getAboutUs();?>" value="<?php echo $company->getAboutUs();?>">
            </td>
          </tr>    
          <tr>
            <td style="width: 200px;"><label for="active">Active</label></td> 
            <td>
            <input type="text" name="active" placeholder="<?php echo $company->getActive();?>" value="<?php echo $company->getActive();?>">
            </td>
          </tr>  
    </table>
    <div>
      <button type="submit" class="btn btn-success" name="id" value="<?php echo $company->getCompanyId(); ?>">Modify</button>
    </div>
  </form>
</div>
</center>
<?php
  include_once('footer.php');
?>