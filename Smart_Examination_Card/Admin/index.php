<?php 
session_start();
if (!$_SESSION['email']) {
  header("location:../login.php");
}

  $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
  file_put_contents('UIDContainer.php',$Write);

  require '../php/phpcode.php';
  $Admin=new Admin;

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

    <span onclick="myFunction('link1')" class="w3-block w3-padding dropdown-toggle list-group-item secs_main_links"><i class="fa fa-graduation-cap fa-fw"></i> &nbsp;Students</span>
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
    <div class="col-md-1"></div>
    <div class="col-md-2">
      <button class="btn btn-primary"><b>Dashboard</b></button>
    </div>
    <div class="col-md-9"></div>
  </div>

  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-center">

        <div class="w3-content w3-section text-center">
          <img class="mySlides" src="..\images\ouput_images\StudentRegister.png" style="width:802px;height:400px;">
          <img class="mySlides" src="..\images\ouput_images\list_of_student.png" style="width:802px;height:400px;">
          <img class="mySlides" src="..\images\ouput_images\tick_students_payefees.png" style="width:802px;height:400px;">
          <img class="mySlides" src="..\images\ouput_images\payfees_students.png" style="width:802px;height:400px;">
          <img class="mySlides" src="..\images\ouput_images\scan.png" style="width:802px;height:400px;">
          <img class="mySlides" src="..\images\ouput_images\allowed.png" style="width:802px;height:400px;">
          <img class="mySlides" src="..\images\ouput_images\not_allowed.png" style="width:802px;height:400px;">
          <img class="mySlides" src="..\images\ouput_images\invalid_card_id.png" style="width:802px;height:400px;">
          <img class="mySlides" src="..\images\ouput_images\attendance_list.png" style="width:802px;height:400px;">

        </div>

        <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
               x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}    
            x[myIndex-1].style.display = "block";  
            setTimeout(carousel, 3000); // Change image every 2 seconds
        }
        </script>

    </div>
    <div class="col-md-1"></div>
  </div>
  
  <!-- End page content -->
</div>

<script type="text/javascript">
    //Smart examination card javascript codes
    //search btn 
    function clickonsearchbtnfn(){
      document.getElementById('search_form').style.display="block";
      document.getElementById('searchbtn').style.display="none";
    }

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