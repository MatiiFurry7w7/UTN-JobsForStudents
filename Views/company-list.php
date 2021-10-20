<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<div class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="post">
    <table style="margin-top: 20px;">
        <tr style="background-color: rgb(40, 40, 40);">
            <td><input placeholder="Company name..." type="text" name="searchedCompany"></td>
            <td><button class="btn btn-danger" type="submit">Search</button></td>
            <?php 
              if($searchedCompany != "")
                echo "<td style='color: white; min-width: 150px; display: inline; line-height: 63px;'>Searched: ".$searchedCompany."</td>";
            ?>
        </tr> 
    </table>
  </form>
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
            <td></td>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0;
          if($searchedCompany != ""){
            foreach($companyList as $company){
              if(strpos($company->getName(), $searchedCompany) !== false && $company->getActive() == true){
                $i++;
                ?>
                  <tr>
                    <td><?php echo $company->getName() ?></td>
                    <td><?php echo $company->getCuit() ?></td>
                    <td><?php echo $company->getDescription() ?></td>
                    <td><a style="text-decoration: none; color:black;" href="<?php echo $company->getWebsite() ?>"><?php echo $company->getWebsite() ?></a></td>
                    <td><?php echo $company->getStreet() ?></td>
                    <td><?php echo $company->getNumber() ?></td>
                    <td><?php echo $company->getAboutUs() ?></td>
                    <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/Remove?removeId=<?php echo $company->getCompanyId() ?>'">Remove</button></td>
                    <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/ModifyView?modifyId=<?php echo $company->getCompanyId() ?>'">Modify</button></td>
                  </tr>
                <?php    
              }
            }
          }else{
            foreach($companyList as $company){
              if($company->getActive() == true){
                $i++;
                ?>
                  <tr>
                    <td><?php echo $company->getName() ?></td>
                    <td><?php echo $company->getCuit() ?></td>
                    <td><?php echo $company->getDescription() ?></td>
                    <td><a style="text-decoration: none; color:black;" href="<?php echo $company->getWebsite() ?>"><?php echo $company->getWebsite() ?></a></td>
                    <td><?php echo $company->getStreet() ?></td>
                    <td><?php echo $company->getNumber() ?></td>
                    <td><?php echo $company->getAboutUs() ?></td>
                    <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/Remove?removeId=<?php echo $company->getCompanyId() ?>'">Remove</button></td>
                    <td><button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/ModifyView?modifyId=<?php echo $company->getCompanyId() ?>'">Modify</button></td>
                  </tr>
                <?php
              }     
            }   
          }
          echo "<br><b>There are ".$i." Result/s!</b>"; 
          ?>
      </tbody>
    </table>
    <br>
    <button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/ShowAddView'" style="float: right;" >Go to Add View</button>
</div>
<?php
  include_once('footer.php');
?>