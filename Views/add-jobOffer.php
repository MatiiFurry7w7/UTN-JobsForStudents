<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>
<center>
<div style="margin-top: 20px;" class="wrapper row3">
  <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST">
    <table>
          <tr>
            <th colspan="2"><center><h4>Adding a Job Offer</h4></center></th>
          </tr>
          <tr>
            <td style="width: 200px;"><label for="title">Title</label></td> 
            <td style="width: 10px;"><input type="text" name="title" required></td>
          </tr>            
          <tr>
            <td><label for="publishedDate">Published Date</label></td>
            <td><input type="date" name="publishedDate" required></td>
          </tr>   
          <tr>
            <td><label for="finishDate">Finish Date</label></td>
            <td><input type="date" name="finishDate" required></td>
          </tr>   
          <tr>
            <td><label for="task">Task</label></td>
            <td><input type="text" name="task" required></td>
          </tr>   
          <tr>
            <td><label for="skills">Skills</label></td>
            <td><input type="text" name="skills" required></td>
          </tr>   
          <tr>
            <td style="width: 200px;"><label for="active">Active</label></td> 
            <td>
                <input type="radio" name="active" value="true" checked required>Active
                <input type="radio" name="active" value="false" required>Not active
            </td>
          </tr>  
          <tr>
            <td style="width: 200px;"><label for="remote">Remote</label></td> 
            <td>
                <input type="radio" name="remote" value="true" checked required>Remote
                <input type="radio" name="remote" value="false" required>Not Remote
            </td>
          </tr>
          <tr>
            <td><label for="salary">Salary</label></td>
            <td><input type="text" name="salary" required></td>
          </tr> 
    </table>
    <div>
        <input type="submit" class="btn btn-success" value="Add"/>
    </div>
  </form>
</div>
</center>
<?php
  include_once('footer.php');
?>