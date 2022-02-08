<?php
    include_once('header.php');
    include_once('nav-bar.php');
?>
<center>
    <table style="margin-top: 30px; width: 50%;">
        <th style="text-align: left;" colspan="2">
            <h3>Profile</h3>
        </th>
        <td style="background-color: #1f1f1f;">
            <?php if($userCV){ ?>
            <a target="_blank" href="<?php echo FRONT_ROOT.UPLOADS_PATH.$userCV->getName();?>">
	            <button class="btn btn-success" type="button">Download CV</button>
            </a>
            <?php } ?>
        </td>
        <tr>
            <td><label>ID</label></td>
            <td colspan="2" style="text-align: center;"><input class="inputText" type="text" value="<?php echo $student->getUserId() ?>" disabled></td>
        </tr>
        <tr>
            <td><label>DNI</label></td>
            <td colspan="2" style="text-align: center;"><input class="inputText" type="text" value="<?php echo $student->getDNI() ?>" disabled></td>
        </tr>
        <tr>
            <td><label>Full name</label></td>
            <td colspan="2" style="text-align: center;"><input class="inputText" type="text" value="<?php echo $student->getFirstName()." ".$student->getLastName() ?>" disabled></td>
        </tr>
        <tr>
            <td><label>Birth Date</label></td>
            <td colspan="2" style="text-align: center;"><input class="inputText" type="text" value="<?php echo $student->getBirthDate() ?>" disabled></td>
        </tr>
        <tr>
            <td><label>Gender</label></td>
            <td colspan="2" style="text-align: center;"><input class="inputText" type="text" value="<?php echo $student->getGender() ?>" disabled></td>
        </tr>
        <tr>
            <td><label>Phone</label></td>
            <td colspan="2" style="text-align: center;"><input class="inputText" type="text" value="<?php echo $student->getPhoneNumber() ?>" disabled></td>
        </tr>
        <tr>
            <td><label>Email</label></td>
            <td colspan="2" style="text-align: center;"><input class="inputText" type="text" value="<?php echo $student->getEmail() ?>" disabled></td>
        </tr>
        <!--  --- NOT STUDENT PERSON DATA --- -->
        <tr>
            <td><label>Career</label></td>
            <td colspan="2" style="text-align: center;"><input style="width: 100%;" class="inputText" type="text" value="<?php echo $student->getCareer() ?>" disabled></td>
        </tr>
        <tr>
            <td><label>File number</label></td>
            <td colspan="2" style="text-align: center; padding-bottom: 20px;"><input class="inputText" type="text" value="<?php echo $student->getFileNumber() ?>" disabled></td>
        </tr>
    </table>
</center>
<?php
    include_once('footer.php');
?>