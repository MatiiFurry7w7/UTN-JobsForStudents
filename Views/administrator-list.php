<?php 
        include_once('header.php');
        include_once('nav-bar.php');
?>
<center>
<div class="wrapper row3">
<table id="studentsTable" style="width: 60%;">
        <tr id="tableIndex">
                <td style='max-width: 10px;'>ID</td>
                <td>UserName</td>
                <td>Password</td>
                <td><button class="btn btn-primary" onclick="window.location.href='<?php echo FRONT_ROOT ?>Administrator/AddView'">Add</button>
        </tr>
        <?php
        foreach($administratorList as $eachAdministrator){
                echo "<tr>
                        <td style='max-width: 10px; text-align: center;'>".$eachAdministrator->getAdministratorId()."</td>
                        <td style='max-width: 100px;'>".$eachAdministrator->getUserName()."</td>
                        <td style='max-width: 230px;'>".$eachAdministrator->getPassword()."</td>"; ?>
                        <td></td>                    
                </tr>
        <?php } ?>
        </table>
</div>
</center>
<?php
        include_once('footer.php');
?>