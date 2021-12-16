<div class="container">
<center>
<div>
  <form action="<?php echo FRONT_ROOT ?>Login/LogIn" method="POST">
    <table id="loginForm">
      <tr>
        <th colspan="2"><center><h4>Log In</h4></center></th>
      </tr>
      <tr>
        <td><label for="email">Email</label></td>
        <td><input class="inputText" type="email" name="email" required></td>
      </tr>
      <tr>
        <td><label for="userPassword">Password</label></td>
        <td><input class="inputText" type="password" name="userPassword" required></td>
      </tr>
      <tr>
        <td colspan="2"><center><button id="buttonSubmit" type="submit" class="btn btn-primary">Log In</button></center></td>
      </tr>
    </table>
    <br>
    <div id="newHereText">
      <a style="color: white;" href="<?php echo FRONT_ROOT ?>Student/RegisterView">New here? - Register Now!</a>
    </div>
    <?php
      if($message != "")
        echo "<p id='errorMessage'>".$message." </p>";
    ?>
  </form>
</div>
</center>
<?php if($message) { ?>
    <script> alert('<?php echo $message?>'); </script>
<?php } ?>