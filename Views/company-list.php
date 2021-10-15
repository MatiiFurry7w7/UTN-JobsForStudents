<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<div class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Company/Remove" method="post">
    <table id="studentsTable">
      <thead>
        <tr id="tableIndex">
            <td>Name</td>
            <td>CUIT</td>
            <td>Description</td>
            <td>Website</td>
            <td>Street</td>
            <td>Number</td>
            <td>About Us</td>
            <!--solo ver boton remove/modify sólo para administradores-->
            <td></td>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($companyList as $company){
            if($company->getActive() == true){
              ?>
                <tr>
                  <td><?php echo $company->getName() ?></td>
                  <td><?php echo $company->getCuit() ?></td>
                  <td><?php echo $company->getDescription() ?></td>
                  <td><a style="text-decoration: none; color:black;" href="<?php echo $company->getWebsite() ?>"><?php echo $company->getWebsite() ?></a></td>
                  <td><?php echo $company->getStreet() ?></td>
                  <td><?php echo $company->getNumber() ?></td>
                  <td><?php echo $company->getAboutUs() ?></td>
                  <td>
                    <button class="btn btn-danger" type="submit" name="removedId" value="<?php echo $company->getCompanyId() ?>"> Remove </button>
                  </td>
                </tr>
              <?php
            }     
          }
          ?>
      </tbody>
    </table>
  </form> 
</div>
<?php
  include_once('footer.php');
?>