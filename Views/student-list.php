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
                <td>Birth Date</td>
                <td>Gender</td>
                <td>Phone</td>
                <td>Email</td>
        </tr>
<?php
        foreach($studentList as $eachStudent){
                echo "<tr>
                        <td style='width: 10px; text-align: center;'>".$eachStudent->getStudentId()."</td>
                        <td>".$eachStudent->getDNI()."</td>
                        <td>".$eachStudent->getFirstName()."</td>
                        <td>".$eachStudent->getlastName()."</td>
                        <td>".$eachStudent->getBirthDate()."</td>
                        <td>".$eachStudent->getGender()."</td>
                        <td>".$eachStudent->getPhoneNumber()."</td>
                        <td>".$eachStudent->getEmail()."</td>
                     </tr>";
        }
?>
        </table>
</div>
<?php
        include_once('footer.php');
?>