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
      if($this->isAdmin()) {
      ?>
        <button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Company/ShowAddView'" style="float: right;">Add</button>
      <?php
      }
    ?>
    <table id="studentsTable">
      <thead>
        <tr id="tableIndex">
            <td>Name</td>
            <td>CUIT</td>
            <td>Description</td>
            <td>Website</td>
            <td>Address</td>
            <td></td>
            <!--solo ver boton remove/modify sólo para administradores-->
            <?php
              if($this->isAdmin()) {
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
          $this->companyFilter($searchedCompany, $companyList);
        ?>
      </tbody>
    </table>
    <br>
</div>
<?php
  include_once('footer.php');
?>