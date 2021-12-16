<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>Appointment/Upload" method="POST" enctype="multipart/form-data">
    <table style="width: 80vh;">
      <tr>
        <th colspan="2"><center><h4>Adding CV</h4></center></th>
      </tr>
      <tr>
        <td><label for="cv">Curriculum Vitae * (PDF)</label></td>
        <td><input type="file" name="file" id="file" class="form-control-file" required></td>
      </tr>
      <tr>
        <td colspan="2"><center><button type="submit" class="btn btn-primary">Upload</button><center></td>
      </tr> 
    </table>
  </form>
</div>
</center>
<?php if($message) { ?>
    <script> alert('<?php echo $message?>'); </script>
<?php } ?>
<?php
  include_once('footer.php');
?>