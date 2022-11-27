<?php 
session_start();
if (!$_SESSION['email']) {
  header("location:../login.php");
}
  require '../php/phpcode.php';
  $Admin=new Admin;

  $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
  file_put_contents('UIDContainer.php',$Write);

?>
<!DOCTYPE html>
<html>
<title>Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="../w3/w3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<script src="../js/bootstrap.js"></script>
<script type="text/javascript" src="..\js\index.js"></script>

<body class="w3-light-grey">

<!-- Top container -->
<div class="row w3-bar w3-top w3-black w3-large" style="z-index:4">
  <div class="col-md-12">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_secs_open();"><i class="fa fa-bars"></i></button><h4 class="text-center"><?php echo $_SESSION['respons'];?> panel</h4>
  </div>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left secs_Sidebar list-group secs_nav_list" style="z-index:3;width:305px;" id="secs_mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <?php
        $Admin->AdminProfilePicture();
      ?>
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php echo $_SESSION['lname']; ?></strong></span><br>
    </div>
  </div>
  <hr>
  <div class="w3-bar-block" style="font-size:20px;" >
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-red" onclick="w3_secs_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>Close menu (X)</a>

    <!--Dashboard link-->
    <a href="index.php?Dashboard" class="dashboard w3-bar-item w3-button w3-padding list-group-item active"><i class="fa fa-dashboard fa-fw "></i>&nbsp;Dashboard</a>

    <span onclick="myFunction('link1')" class="w3-block w3-padding dropdown-toggle list-group-item secs_main_links"><i class="fa fa-book"></i>&nbsp;Students</span>
      <div id="link1" class="w3-container w3-hide">
        <ul>
          <li class="w3-padding w3-left-align"><a href="RegisterStudent.php"><i class="fa fa-book fa-fw"></i>&nbsp;Registration</a></li>
          <li class="w3-padding w3-left-align"><a href="ListOfStudents.php"><i class="fa fa-list-alt fa-fw"></i>&nbsp;List of students</a></li>
          <li class="w3-padding w3-left-align"><a href="CheckStudentInfo.php"><i class="fa fa-address-card-o fa-fw"></i>&nbsp;Check student info</a></li>
          <li class="w3-padding w3-left-align"><a href="StudentPayment.php"><i class="fa fa-money fa-fw"></i>&nbsp;Students payment</a></li>
          <li class="w3-padding w3-left-align"><a href="TestAllowance.php"><i class="fa fa-question-circle fa-fw"></i>&nbsp;Exam permission</a></li>
          <li class="w3-padding w3-left-align"><a href="TestAttendance.php"><i class="fa fa-check fa-fw"></i>&nbsp;Exam attendance</a></li>
        </ul>

      </div>

      <!--Accounts link to manage Account's staff--> 
    <span onclick="myFunction('account')" class="w3-block w3-padding dropdown-toggle list-group-item secs_main_links"><i class="fa fa-user-o fa-fw"></i>&nbsp;My account</span>
      <div id="account" class="w3-container w3-hide">
        <ul>
          <li class="w3-padding w3-left-align"><a id="mylinks" href="Myinformation.php"><i class="fa fa-address-card-o fa-fw"></i>&nbsp;My information</a></li>
          <li class="w3-padding w3-left-align"><a id="mylinks" href="ProfilePicture.php"><i class="fa fa-image fa-fw"></i>&nbsp;Profile picture</a></li>
          <li class="w3-padding w3-left-align"><a id="mylinks" href="Username.php"><i class="fa fa-user fa-fw"></i>&nbsp;Username</a></li>
          <li class="w3-padding w3-left-align"><a id="mylinks" href="Password.php"><i class="fa fa-key fa-fw"></i>&nbsp;Password</a></li>
          <li class="w3-padding w3-left-align"><a id="mylinks" href="logout.php"><i class="fa fa-lock fa-fw"></i>&nbsp;Logout</a></li>
        </ul>
</span> 
    <br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_secs_close()" style="cursor:pointer" title="close side menu" id="secs_myOverlay"></div>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <form class="form-group secs_search_form" action="search.php" method="POST">
        <input type="text" placeholder="Search hints containts . . . . . ." class="form-control" name="SearchBorrower" autofocus required">
        <button type="submit" name="SearchBorrowerData" style="border:2px solid skyblue;"><img src="../images/search.png" style="width:35px;height: 35px;"></button>
      </form>
  </div>
  <div class="col-md-2"></div>
</div>
  
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 text-center">
      <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-center">
      <div class="card">
            <div class="card-body w3-teal text-center text-white">
              <h1><strong>Update your information</strong></h1>
            </div>
            <div class="card-body">
              <form class="form-group" method="POST">

                <div class="row">
                  
                  <div class="col-md-6"><input type="text" name="c_id" class="form-control" value="<?php echo $_REQUEST['card_id'];?>" readonly title="Card id can't be edittable !"></div>
                  <div class="col-md-6"><input type="text" name="fnames" class="form-control" value="<?php echo $_REQUEST['fname'];?>" placeholder="Enter firstname"></div>

                </div>

                <br>

                  <?php
                    //$Admin->SelectOptionOfEditStudentInfo();
                  if ($_REQUEST['gender'] == "M") {
                    $gender1='<option value="M" selected>Male</option>';
                    $gender2='<option value="F">Female</option>';
                  }elseif($_REQUEST['gender'] == "F"){
                    $gender1='<option value="M">Male</option>';
                    $gender2='<option value="F" selected>Female</option>';
                  }
                  
                  if ($_REQUEST['level'] == '1') {
                    $level1='<option value="1" selected>Level 1</option>';
                    $level2='<option value="2">Level 2</option>';
                    $level3='<option value="3">Level 3</option>';
                  }elseif ($_REQUEST['level'] == '2') {
                    $level1='<option value="1">Level 1</option>';
                    $level2='<option value="2" selected>Level 2</option>';
                    $level3='<option value="3">Level 3</option>';
                  }elseif ($_REQUEST['level'] == '3'){
                    $level1='<option value="1">Level 1</option>';
                    $level2='<option value="2">Level 2</option>';
                    $level3='<option value="3" selected>Level 3</option>';
                  }

                  if ($_REQUEST['dept'] == 'IT') {
                    $IT='<option value="IT" selected>IT</option>';
                    $ET='<option value="ET">ET</option>';
                    $RE='<option value="RE">RE</option>';
                  }elseif ($_REQUEST['dept'] == 'ET') {
                    $IT='<option value="IT">IT</option>';
                    $ET='<option value="ET" selected>ET</option>';
                    $RE='<option value="RE">RE</option>';
                  }elseif ($_REQUEST['dept'] == 'RE') {
                    $IT='<option value="IT">IT</option>';
                    $ET='<option value="ET">ET</option>';
                    $RE='<option value="RE" selected>RE</option>';
                  }
                  ?>
                 <div class="row">

                  <div class="col-md-6"><input type="text" name="lnames" class="form-control" value="<?php echo $_REQUEST['lname'];?>" placeholder="Enter lastname"></div>
                  <div class="col-md-6">
                    <select id="mySelect" name="genders" class="form-control">
                      <option value="">select gender</option>
                      <?php
                        echo $gender1;
                        echo $gender2;
                      ?>
                    </select>
                  </div>

                 </div>

                <br>

                 <div class="row">
                  <div class="col-md-6"><input type="email" name="emails" class="form-control" value="<?php echo $_REQUEST['email'];?>" placeholder="Enter email"></div>
                  <div class="col-md-6"><input type="text" name="reg_nos" class="form-control" value="<?php echo $_REQUEST['regno'];?>" placeholder="Enter student reg_no"></div>
                </div>

                <br>
                
                <div class="row">
                  <div class="col-md-6">
                  <select id="mySelect" name="levels" class="form-control">
                      <option value="">Select level</option>
                      <?php
                      echo $level1;
                      echo $level2;
                      echo $level3;
                      ?>
                    </select></div>
                  <div class="col-md-6">
                    <select id="mySelect" name="depts" class="form-control">
                      <option class="">select deptartment</option>
                      <?php 
                      echo $IT;
                      echo $ET;
                      echo $RE;
                      ?>
                    </select>
                  </div>
                </div>

                <br>
  
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"><button type="submit" name="submitEditStudentInfo" class="btn btn-primary"><i class="fa fa-save"></i> Save change</button></div>
                  <div class="col-md-4"></div>
                </div>
                  
              </form>
            </div>
          </div>
        </div>

    </div>
    <div class="col-md-1"></div>
  </div>

  <!--Edit information php code-->
    <?php

        $server="localhost";
        $user="root";
        $pass="";
        $dbname="secdb";
        $conn=mysqli_connect($server,$user,$pass,$dbname);
        if(!$conn){
            die('Could not Connect My Sql:' .mysqli_error());
        }

        if (isset($_POST['submitEditStudentInfo'])) {

          $id=$_REQUEST['id'];
          $fname=$_REQUEST['fnames'];
          $lname=$_REQUEST['lnames'];
          $gender=$_REQUEST['genders'];
          $reg_no=$_REQUEST['reg_nos'];
          $email=$_REQUEST['emails'];
          $level=$_REQUEST['levels'];
          $depart=$_REQUEST['depts'];

          //mysqli query
          $sql="UPDATE register_student SET firstname='$fname',lastname='$lname',gender='$gender',reg_no='$reg_no',email='$email',level='$level',department='$depart' where stu_id=".$id." ";
          $result=mysqli_query($conn,$sql);
          if ($result == 1){
            echo '<script>
                  window.location.assign("ListOfStudents.php");
                  alert("data is well edittable !");
              </script>';
          }else{
            echo "<script>alert('data not edittable !');</script>";
          }
        }

      ?>

    </div>
    <div class="col-md-2 "> </div>
  </div>
  
  <!-- End page content -->
</div>

<script>
  //Smart examination card javascript codes

    // Get the Sidebar
    var mySidebar = document.getElementById("secs_mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("secs_myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_secs_open() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
            overlayBg.style.display = "none";
        } else {
            mySidebar.style.display = 'block';
            overlayBg.style.display = "block";
        }
    }

    // Close the sidebar with the close button
    function w3_secs_close() {
        mySidebar.style.display = "none";
        overlayBg.style.display = "none";
    }

    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>

</body>
</html>