<?php

use Models\Administrator;

include_once('header.php');
        include_once('nav-bar.php');
?>
<center>
        <br>
<div class="wrapper row3">
<table id="studentsTable" style="width: 90vh;">
        <tr id="tableIndex">
                <td>ID</td>
                <td>Job Offer</td>
                <td>Curriculum Vitae</td>
                <td>Date Appointment</td>
                <td>Reference URL</td>
                <td>Active</td>
                <td></td>
        </tr>
        <?php
        if($appointmentList)
                foreach($appointmentList as $eachAppointment){ 
                        if($isAdmin || $eachAppointment->getActive() == 1) {?>
                        <tr>
                                <td><?php echo $eachAppointment->getStudentId() ?></td>
                                <td><?php echo $eachAppointment->getJobOfferId() ?></td>
                                <td><?php echo $eachAppointment->getCv() ?></td>
                                <td><?php echo $eachAppointment->getDateAppointment() ?></td>
                                <td><a href="<?php echo $eachAppointment->getReferenceURL()?>"><?php echo $eachAppointment->getReferenceURL()?></a></td>
                                <td>
                                        <?php
                                                echo $eachAppointment->getActive() == 1 ? "Yes" : "No";
                                        ?>
                                </td>
                                <td><button class="btn btn-warning" onclick="window.location.href='<?php echo FRONT_ROOT ?>Appointment/ViewDetails?AppointmentId=<?php echo $eachAppointment->getJobOfferId()?>'">Details</button>               
                        </tr>
                <?php   } 
                } ?>
        </table>
        <br>
        <button class="btn btn-success" onclick="window.location.href='<?php echo FRONT_ROOT ?>Appointment/HistoryView?AppointmentId=<?php echo $eachAppointment->getStudentId()?>'">View History</button>
</div>
</center>
<?php
        include_once('footer.php');
?>