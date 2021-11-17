<?php 
        include_once('header.php');
        include_once('nav-bar.php');
?>
<center>
<div class="wrapper row3">
<table id="studentsTable" style="width: 50%;">
        <tr>
                <th colspan="3"><center>Company Users</center></th>
        </tr>
        <tr id="tableIndex">
                <td style='max-width: 10px;'>ID</td>
                <td>UserName</td>
                <td><button class="btn btn-primary" onclick="window.location.href='<?php echo FRONT_ROOT ?>CompanyUser/AddView'">Add</button>
        </tr>
        <?php
        foreach($companyUserList as $eachCompanyUser){
                echo "<tr>
                        <td style='max-width: 10px; text-align: center;'>".$eachCompanyUser->getUserId()."</td>
                        <td style='max-width: 100px;'>".$eachCompanyUser->getEmail()."</td>"; ?>
                        <td></td>                    
                </tr>
        <?php } ?>
        </table>
</div>
</center>
<?php
        include_once('footer.php');
?>