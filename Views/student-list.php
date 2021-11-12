<?php 
        include_once('header.php');
        include_once('nav-bar.php');
?>
<div class="wrapper row3">
<center>
<table id="studentsTable">
        <tr id="tableIndex">
                <td>DNI</td>
                <td>Name</td>
                <td>Surname</td>
                <td>Phone</td>
                <td>Email</td>
                <td colspan="2"></td>
        </tr>
        <?php
        $i = 0;
        foreach($studentList as $eachStudent){
                $i+=1;
                echo "<tr>
                        <td style='min-width: 150px;'>".$eachStudent->getDNI()."</td>
                        <td style='min-width: 150px;'>".$eachStudent->getFirstName()."</td>
                        <td style='min-width: 150px;'>".$eachStudent->getlastName()."</td>
                        <td style='min-width: 150px;'>".$eachStudent->getPhoneNumber()."</td>
                        <td style='min-width: 150px;'>".$eachStudent->getEmail()."</td>"; ?>
                        <td><button class="btn btn-warning" onclick="window.location.href='<?php echo FRONT_ROOT ?>Student/ProfileView?email=<?php echo $eachStudent->getEmail()?>'">Profile</button>                     
                        <td><button class="btn btn-warning" onclick="window.location.href='<?php echo FRONT_ROOT ?>Appointment/AppointmentsOfStudent?studentId=<?php echo $eachStudent->getUserId()?>'">Appointments</button>                     

                </tr>
        <?php } 
        ?>
        <p style="margin-top: 20px;">There are <?php echo $i ?> registered student/s.</p>
        </table>
        </center>
</div>
<?php
        include_once('footer.php');
?>