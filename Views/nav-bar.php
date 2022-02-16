<?php
  use Models\Administrator; 
  use Models\Student;
  use Helpers\SessionHelper;
use Models\CompanyUser;

$headerUser = (new SessionHelper())->getCurrentUser();
  
  if(!isset($headerUser)){
    header('location: '.FRONT_ROOT.'Login/LogInView');
  }
?>
<div class="wrapper row2">
  <nav id="navbar">
    <ul>
      <a id="link" href="<?php echo FRONT_ROOT ?>Login/LogInView"><li><i class="fa fa-share"></i></li></a>
      <?php if($headerUser instanceof Administrator) { ?>  
        <a id="link" href="<?php echo FRONT_ROOT ?>Company/ShowListView"><li>Companies</li></a>
        <a id="link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView"><li>Job Offers</li></a>
        <a id="link" href="<?php echo FRONT_ROOT ?>Student/ListView"><li>Students List</li></a>
        <a id="link" href="<?php echo FRONT_ROOT ?>Administrator/ListView"><li>Administrators List</li></a>
        <a id="link" href="<?php echo FRONT_ROOT ?>CompanyUser/ListView"><li>Company Users List</li></a>
      <?php }if($headerUser instanceof Student){ ?>
        <a id="link" href="<?php echo FRONT_ROOT ?>Company/ShowListView"><li>Companies</li></a>
              <a style="margin-top:5px;" id="link" href="<?php echo FRONT_ROOT ?>Student/ProfileView?email=<?php echo $_SESSION['currentUser']->getEmail(); ?>">
                <li>
                <?php echo $headerUser->getFirstName()?>'s Profile&nbsp
                <i class="fa fa-angle-right" style="color: black;"></i>
                </li>
              </a>
              <a id="link" href="<?php echo FRONT_ROOT ?>Appointment/AddCV<?php ?>"><li>Upload CV</li></a>
              <?php if($headerUser->getAppointment()){ ?>
                <a id="link" href="<?php echo FRONT_ROOT ?>Appointment/AppointmentView<?php ?>"><li>My Appointments</li></a>
              <?php }
              
            }?>
      <?php if($headerUser instanceof CompanyUser) { 
        if(!$headerUser->getCompany()){?>  
          <a id="link" href="<?php echo FRONT_ROOT ?>Company/ShowAddView"><li>Add my company</li></a>
        <?php }else{ ?>
          <a id="link" href="<?php echo FRONT_ROOT ?>Company/ViewDetail?companyId=<?php echo (new SessionHelper)->getCurrentUser()->getCompany()->getCompanyId() ?>"><li>My Company</li></a>
          <a id="link" href="<?php echo FRONT_ROOT ?>JobOffer/JobOffersFromCompany?companyId=<?php echo (new SessionHelper)->getCurrentUser()->getCompany()->getCompanyId() ?>"><li>Job Offers</li></a>
        <?php } ?>
        <a id="link" href="<?php echo FRONT_ROOT ?>Student/ListView"><li>Students List</li></a>
      <?php } ?>
    </ul>
  </nav>
</div>
<div class="container">