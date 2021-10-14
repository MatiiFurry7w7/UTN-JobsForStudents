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
            <td>Address</td>
            <td>About Us</td>
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
                      <button type="submit" name="removedId" value="<?php echo $company->getCompanyId() ?>"> Remove </button>
                      </td>
                    </tr>
                <?php
          }
          ?>
      </tbody>
    </table>
  </form> 
</div>
<?php
  include_once('footer.php');
?>