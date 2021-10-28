<?php
  if(!isset($_SESSION['currentUser'])){
    header('location: '.FRONT_ROOT.'Login/LogInView');
  }
?>
<div class="wrapper row2">
  <nav id="navbar">
    <ul>
    <a id="link" href="<?php echo FRONT_ROOT ?>Login/LogInView"><li><i class="fa fa-share"></i></li></a>
      <a id="link" href="<?php echo FRONT_ROOT ?>Company/ShowListView"><li>Companies</li></a>
      <a id="link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView"><li>Job Offers</li></a>
      <a id="link" href="<?php echo FRONT_ROOT ?>Student/ListView"><li>Students List</li></a>
      <a id="link" href="<?php echo FRONT_ROOT ?>Administrator/ListView"><li>Administrators List</li></a>
      <a id="link" href=""><i id="notificationBell" id="icon" class="fa fa-bell"></i></a>
    </ul>
  </nav>
</div>
<div class="container">