<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<div class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Company/Modify" method="post">
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
            <td style='min-width:200px;'>Active</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
              <input type="text" name="name" placeholder="<?php echo $company->getName();?>" required>
          </td>
          <td>
              <input type="text" name="cuit" placeholder="<?php echo $company->getCuit();?>" required>
          </td>
          <td>
              <input type="text" name="description" placeholder="<?php echo $company->getDescription();?>" required>
          </td>
          <td>
              <input type="text" name="website" placeholder="<?php echo $company->getWebsite();?>" required>
          </td>
          <td>
              <input type="text" name="street" placeholder="<?php echo $company->getStreet();?>" required>
          </td> 
          <td>
              <input type="text" name="number" placeholder="<?php echo $company->getNumber();?>" required>
          </td>
          <td>
              <input type="text" name="aboutUs" placeholder="<?php echo $company->getAboutUs();?>" required>
          </td>
          <td>
              <input type="radio" name="isActive" value="true" checked required>Active
              <input type="radio" name="isActive" value="false" required>Not active
          </td>            
        </tr>
      </tbody>
    </table>
    <div>
      <input type="submit" class="btn" value="Modify"/>
    </div>
  </form>
</div>
<?php
  include_once('footer.php');
?>