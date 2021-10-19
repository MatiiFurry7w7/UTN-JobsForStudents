<?php 
        include_once('header.php');
        include_once('nav-bar.php');
?>
<div class="wrapper row3">
<table id="studentsTable">
        <tr id="tableIndex">
                <td style='width: 10px;'>ID</td>
                <td>DNI</td>
                <td>Name</td>
                <td>Surname</td>
                <td>Phone</td>
                <td>Email</td>
                <td><button class="btn btn-primary" onclick="window.location.href='<?php echo FRONT_ROOT ?>Student/AddView'">Add</button>
        </tr>
        <?php
        foreach($studentList as $eachStudent){
                echo "<tr>
                        <td style='max-width: 10px; text-align: center;'>".$eachStudent->getStudentId()."</td>
                        <td style='width: 120px; text-align: center;'>".$eachStudent->getDNI()."</td>
                        <td style='max-width: 100px;'>".$eachStudent->getFirstName()."</td>
                        <td style='max-width: 100px;'>".$eachStudent->getlastName()."</td>
                        <td style='max-width: 200px;'>".$eachStudent->getPhoneNumber()."</td>
                        <td style='max-width: 230px;'>".$eachStudent->getEmail()."</td>"; ?>
                        <td><button class="btn btn-warning" onclick="window.location.href='<?php echo FRONT_ROOT ?>Student/ProfileView?studentId=<?php echo $eachStudent->getStudentId()?>'">Profile</button>                     
                </tr>
        <?php } ?>
        </table>
</div>
<?php
        include_once('footer.php');
?>