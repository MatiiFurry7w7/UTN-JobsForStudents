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
                <td><?php if((new SessionHelper())->isAdmin()){ ?>
                        <button class="btn btn-primary" onclick="window.location.href='<?php echo FRONT_ROOT ?>Appointment/AddView'">Add</button>
                    <?php } ?>
                </td>
        </tr>
        <?php
        foreach($appointmentList as $eachAppointment){ ?>
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
        <?php } ?>
        </table>
</div>
</center>
<?php
        include_once('footer.php');
?>