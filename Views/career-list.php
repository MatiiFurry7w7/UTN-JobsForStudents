<?php 
        include_once('header.php');
        include_once('nav-bar.php');
?>
<center>
<div class="wrapper row3">
<table id="CareersTable">
        <tr id="tableIndex">
                <td style='width: 10px;'>ID</td>
                <td>Title</td>
                <td>Description</td>
                <td><button class="btn btn-primary" onclick="window.location.href='<?php echo FRONT_ROOT ?>Career/AddView'">Add</button>
        </tr>
        <?php
        foreach($careerList as $eachCareer){
                echo "<tr>
                        <td style='max-width: 10px; text-align: center;'>".$eachCareer->getCareerId()."</td>
                        <td style='max-width: 100px;'>".$eachCareer->getTitle()."</td>
                        <td style='max-width: 230px;'>".$eachCareer->getDescription()."</td>"; ?>
                        <td><button class="btn btn-warning" onclick="window.location.href='<?php echo FRONT_ROOT ?>Career/ProfileView?CareerId=<?php echo $eachCareer->getCareerId()?>'">Profile</button>                     
                </tr>
        <?php } ?>
        </table>
</div>
</center>
<?php
        include_once('footer.php');
?>