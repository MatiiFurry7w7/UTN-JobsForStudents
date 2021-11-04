<?php
  use Models\Administrator; 
  use Models\Student;

  if(!isset($_SESSION['currentUser'])){
    header('location: '.FRONT_ROOT.'Login/LogInView');
  }
?>
<div class="wrapper row2">
  <nav id="navbar">
    <ul>
      <a id="link" href="<?php echo FRONT_ROOT ?>Login/LogInView"><li><i class="fa fa-share"></i></li></a>
      <a id="link" href="<?php echo FRONT_ROOT ?>Company/ShowListView"><li>Companies</li></a>
      <?php if($_SESSION['currentUser'] instanceof Administrator) { ?>  
        <a id="link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView"><li>Job Offers</li></a>
        <a id="link" href="<?php echo FRONT_ROOT ?>Student/ListView"><li>Students List</li></a>
        <a id="link" href="<?php echo FRONT_ROOT ?>Administrator/ListView"><li>Administrators List</li></a>
      <?php }else{ ?>
            <?php 
              if(isset($_SESSION['currentUser']) && $_SESSION['currentUser'] instanceof Student){ 
                $headerUser = $_SESSION['currentUser'];?>
                  <a style="margin-top:5px;" id="link" href="<?php echo FRONT_ROOT ?>Student/ProfileView?email=<?php echo $_SESSION['currentUser']->getEmail(); ?>">
                    <li>
                    <?php echo $headerUser->getFirstName()?>'s Profile&nbsp
                    <i class="fa fa-angle-right" style="color: black;"></i>
                    </li>
                  </a>
                  <?php if($headerUser->getAppointment()){ ?>
                    <a id="link" href="<?php echo FRONT_ROOT ?>Appointment/ViewDetails"><li>My Appointment</li></a>
                  <?php }
                 }?>

        <?php } ?>
        <a id="link" href=""><i id="notificationBell" id="icon" class="fa fa-bell"></i></a>
    </ul>
  </nav>
</div>
<div class="container">