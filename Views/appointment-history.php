<?php
        include_once('header.php');
        include_once('nav-bar.php');
?>
<center>
<br>
<div class="wrapper row3">
<table id="studentsTable" style="width: 90vh;">
        <tr id="tableIndex">
                <?php if(isset($isCompany) || isset($isAdmin)){ ?>
                        <td>Student</td>
                <?php } ?>
                <td>Job Offer</td>
                <td>Date Appointment</td>
                <td>Reference URL</td>
                <td>Active</td>
                <?php if(count($appointmentList) > 0 && $download){ ?>
                <td><button class="btn btn-primary" onclick="window.location.href='<?php echo FRONT_ROOT ?>Appointment/DownloadPDF?jobOfferId=<?php echo $eachAppointment->getJobOffer()->getJobOfferId() ?>'">Download PDF List</button></td>
                <?php } ?>
        </tr>
        <?php
        foreach($appointmentList as $eachAppointment){?>
                <tr>
                        <?php if(isset($isCompany) || isset($isAdmin)){ ?>
                                <td><button class="btn btn-primary" onclick="window.location.href='<?php echo FRONT_ROOT ?>Student/ViewStudentDetails?studentId=<?php echo $eachAppointment->getStudent()->getUserId() ?>'">See Student</button></td>
                        <?php } ?>
                        <td> <button class="btn btn-primary" onclick="window.location.href='<?php echo FRONT_ROOT ?>JobOffer/ViewDetail?jobOfferId=<?php echo $eachAppointment->getJobOffer()->getJobOfferId() ?>'">See Job Offer</button></td>
                        <td><?php echo $eachAppointment->getDateAppointment() ?></td>
                        <td><a href="<?php echo $eachAppointment->getReferenceURL()?>"><?php echo $eachAppointment->getReferenceURL()?></a></td>
                        <td>
                                <?php
                                        echo $eachAppointment->getActive() == 1 ? "Yes" : "No";
                                ?>
                        </td>
                        <?php if(count($appointmentList) > 0 && $download){ ?>
                        <td>
                                <?php if(isset($isCompany) && $eachAppointment->getActive() == 1){ ?>
                                        <button class="btn btn-danger" onclick="window.location.href='<?php echo FRONT_ROOT ?>Appointment/Decline?studentId=<?php echo $eachAppointment->getStudent()->getUserId()?>&jobOfferId=<?php echo $eachAppointment->getJobOffer()->getJobOfferId() ?>'">Decline</button>
                                <?php } ?>
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