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
                <?php if($isAdmin){ ?>
                        <td>Student</td>
                <?php } ?>
                <td>Job Offer</td>
                <td>Date Appointment</td>
                <td>Reference URL</td>
                <td>Active</td>
        </tr>
        <?php
        foreach($appointmentList as $eachAppointment){ 
                if($eachAppointment->getActive() == 0) {?>
                <tr>
                        <?php if($isAdmin){ ?>
                                <td><button class="btn btn-success" onclick="window.location.href='<?php echo FRONT_ROOT ?>Student/ViewStudentDetails?studentId=<?php echo $eachAppointment->getStudent()->getUserId() ?>'">See Student</button></td>
                        <?php } ?>
                        <td> <button class="btn btn-success" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/ViewDetail?jobOfferId=<?php echo $eachAppointment->getJobOffer()->getJobOfferId() ?>'">See Job Offer</button></td>
                        <td><?php echo $eachAppointment->getDateAppointment() ?></td>
                        <td><a href="<?php echo $eachAppointment->getReferenceURL()?>"><?php echo $eachAppointment->getReferenceURL()?></a></td>
                        <td>
                                <?php
                                        echo $eachAppointment->getActive() == 1 ? "Yes" : "No";
                                ?>
                        </td>
                        
                </tr>
        <?php   }
        } ?>
        </table>
</div>
</center>
<?php
        include_once('footer.php');
?>