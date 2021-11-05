<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <table style="width: 60%;">
        <tr>
          <th colspan="2"><center><h4><b><?php echo $company->getName()?></b> Company</h4></center></th>
        </tr>
        <tr>
          <td>CUIT</td>
          <td style='max-width: 230px;'><?php echo $company->getCuit()?></td>
        </tr>  
        <tr>
          <td>Description</td>
          <td style='max-width: 230px;'><?php echo $company->getDescription()?></td>
        </tr> 
        <tr>
          <td>Website</td>
          <td><a href="<?php echo $company->getWebsite() ?>"><?php echo $company->getWebsite() ?></a></td>
        </tr> 
        <tr>
          <td>Address</td>
          <td style='max-width: 230px;'><?php echo $company->getStreet()." ".$company->getNumber()?></td>
        </tr> 
        <tr>
          <td>About us</td>
          <td style='max-width: 230px;'><?php echo $company->getAboutUs() ?></td>
        </tr> 
        <tr>
          <td>Industry</td>
          <td style='max-width: 230px;;'><?php echo $company->getIndustry() ?></td>
        </tr> 
  </table>
</div>
</center>
<?php
  include_once('footer.php');
?>