<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>

<form action="<?php echo FRONT_ROOT ?>Company/Remove" method="post">
        <table style="text-align:center;">
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
            <?php
              foreach($companyList as $company){
                    ?>
                        <tr>
                          <td><?php echo $company->getName() ?></td>
                          <td><?php echo $company->getCuit() ?></td>
                          <td><?php echo $company->getDescription() ?></td>
                          <td><?php echo $company->getWebsite() ?></td>
                          <td><?php echo $company->getAddress() ?></td>
                          <td><?php echo $company->getAboutUs() ?></td>
                          <td>
                          <button type="submit" name="removedName" value="<?php echo $company->getName() ?>"> Remove </button>
                          </td>
                        </tr>
                    <?php
              }
              ?>
          </tbody>
        </table></form> 

<?php
  include_once('footer.php');
?>