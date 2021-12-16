<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<div class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="post">
    <table style="margin-top: 20px; width: 50%;">
        <tr style="background-color: rgb(40, 40, 40);">
            <td><input placeholder="Company name..." type="text" name="searchedCompany"></td>
            <td><button class="btn btn-danger" type="submit">Search</button></td>
            <?php 
              if($searchedCompany != "")?>
                <td style="color: white; width: 400px; display: inline; line-height: 63px;">Searched:</td>
                <td style="color: white; text-align: left;"><?php echo $searchedCompany ?></td>
        </tr> 
    </table>
  </form>
  <?php
      if($isAdmin) {
      ?>
        <button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/ShowAddView'" style="float: right;">Add</button>
      <?php
      }
    ?>
    <br>
    <table id="studentsTable">
      <thead>
        <tr id="tableIndex">
            <td>Status</td>
            <td>Name</td>
            <td>CUIT</td>
            <td>Description</td>
            <td>Address</td>
            <td></td>
            <td></td>
            <!--solo ver boton remove/modify sólo para administradores-->
            <?php
              if($isAdmin) {
              ?>
                <td></td>
                <td></td>
              <?php
              }
            ?>
        </tr>
      </thead>
      <tbody>
        <?php 
          $i = 0;
          if($searchedCompany != ""){
              foreach($companyList as $company){
                  if(strpos(strtolower($company->getName()), strtolower($searchedCompany)) !== false){
                      $i++;
                     ?>
                      <tr> 
                        <td><?php echo $company->getActive() == 1 ? "Active" : "Inactive" ?></td>
                        <td><?php echo $company->getName() ?></td>
                        <td><?php echo $company->getCuit() ?></td>
                        <td><?php echo $company->getDescription() ?></td>
                        <td><?php echo $company->getStreet()." ".$company->getNumber() ?></td>
                        <td style="align='right'"><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/ViewDetail?companyId=<?php echo $company->getCompanyId() ?>'">Details</button></td>
                        <td style="align='right'"><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/JobOffersFromCompany?companyId=<?php echo $company->getCompanyId() ?>'">Job Offers</button></td>
                      <?php
                          if($isAdmin) {
                          ?>
                              <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/Remove?removeId=<?php echo $company->getCompanyId() ?>'">Inactive</button></td>
                              <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/ModifyView?modifyId=<?php echo $company->getCompanyId() ?>'">Edit</button></td>
                          <?php
                          }
                          ?>
                      </tr>
                      <?php
                  }
              }
          }else{
              foreach($companyList as $company){
                      if($isAdmin || $company->getActive() == 1) {
                      ?>
                      <tr>
                        <td><?php echo $company->getActive() == 1 ? "Active" : "Inactive" ?></td>
                        <td><?php echo $company->getName() ?></td>
                        <td><?php echo $company->getCuit() ?></td>
                        <td><?php echo $company->getDescription() ?></td>
                        <td><?php echo $company->getStreet()." ".$company->getNumber() ?></td>
                        <td style="align='right'"><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/ViewDetail?companyId=<?php echo $company->getCompanyId() ?>'">Details</button></td>
                        <td style="align='right'"><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/JobOffersFromCompany?companyId=<?php echo $company->getCompanyId() ?>'">Job Offers</button></td>

                      <?php
                         } else {
                          $i++;
                         }
                         if($isAdmin) {
                          ?>
                              <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/Remove?removeId=<?php echo $company->getCompanyId() ?>'">Change Status</button></td>
                              <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/ModifyView?modifyId=<?php echo $company->getCompanyId() ?>'">Edit</button></td>
                          <?php
                          }
                          ?>
                      </tr>
                      <?php   
              }   
          }
        ?>
      </tbody>
    </table>
    <br>
</div>
<?php
  include_once('footer.php');
?>