<?php
  use Models\Administrator; 
  use Models\Student;
  use Helpers\SessionHelper;
  
  $currentUser = (new SessionHelper())->getCurrentUser();
  
  if(!isset($currentUser)){
    header('location: '.FRONT_ROOT.'Login/LogInView');
  }
?>
<div class="wrapper row2">
  <nav id="navbar">
    <ul>
      <a id="link" href="<?php echo FRONT_ROOT ?>Login/LogInView"><li><i class="fa fa-share"></i></li></a>
      <a id="link" href="<?php echo FRONT_ROOT ?>Company/ShowListView"><li>Companies</li></a>
      <?php if($currentUser) { ?>  
        <a id="link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView"><li>Job Offers</li></a>
        <a id="link" href="<?php echo FRONT_ROOT ?>Student/ListView"><li>Students List</li></a>
        <a id="link" href="<?php echo FRONT_ROOT ?>Administrator/ListView"><li>Administrators List</li></a>
      <?php }else{ ?>
            <?php 
              if(isset($currentUser) && $currentUser instanceof Student){ 
                $headerUser = $currentUser;?>
                  <a style="margin-top:5px;" id="link" href="<?php echo FRONT_ROOT ?>Student/ProfileView?email=<?php echo $_SESSION['currentUser']->getEmail(); ?>">
                    <li>
                    <?php echo $headerUser->getFirstName()?>'s Profile&nbsp
                    <i class="fa fa-angle-right" style="color: black;"></i>
                    </li>
                  </a>
                  <?php if($headerUser->getAppointment()){ ?>
                    <a id="link" href="<?php echo FRONT_ROOT ?>Appointment/HistoryView<?php ?>"><li>My Appointments</li></a>
                  <?php }
                 }?>

        <?php } ?>
        <a id="link" href=""><i id="notificationBell" id="icon" class="fa fa-bell"></i></a>
    </ul>
  </nav>
</div>
<div class="container">