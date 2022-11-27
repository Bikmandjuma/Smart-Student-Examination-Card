<?php 
session_start();
if (!$_SESSION['email']) {
  header("location:../login.php");
}
require '..\php\phpcode.php';
$Admin=new Admin;
  $server="localhost";
  $user="root";
  $pass="";
  $dbname="secdb";
  $conn=mysqli_connect($server,$user,$pass,$dbname);
  if(!$conn){
      die('Could not Connect My Sql:' .mysqli_error());
  }
?>
<!DOCTYPE html>
<html>
<title>Username</title>
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
    <a href="index.php?Dashboard" class="dashboard w3-bar-item w3-button w3-padding list-group-item "><i class="fa fa-dashboard fa-fw "></i>&nbsp;Dashboard</a>

    <span onclick="myFunction('link1')" class="w3-block w3-padding dropdown-toggle list-group-item secs_main_links"><i class="fa fa-graduation-cap fa fa-fw"></i>&nbsp;Students</span>
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
    <span onclick="myFunction('account')" class="w3-block w3-padding dropdown-toggle list-group-item secs_main_links active"><i class="fa fa-user-o fa-fw"></i>&nbsp;My account</span>
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
  
  <br>
  <br>
  
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-9">
      <?php
            $username=$lastname=$firstname= $emptyfield="";
            $sql="SELECT firstname,lastname,username FROM sec_users where email='".$_SESSION['email']."'";
            $result=mysqli_query($conn,$sql);
            while ($row=mysqli_fetch_assoc($result)) {
              $username=$row['username'];
              $firstname=$row['firstname'];
              $lastname=$row['lastname'];
            }
          ?>
          <div class="row">
            <div class="col-md-12">
              <h2><b>**</b> Hi ,<b><?php echo $firstname." ".$lastname;?></b></h2>
              <h3><b>**</b> This username <b><span style="color: blue;" id="usernamecgncolor"><?php echo $username;?></span></b> is not your firstname or lastname but can be look like .</h3>
              <h3><b>**</b> it is your credential login username. <b><a style="cursor:pointer;color: blue;" onclick="clicklinkfn()" id="ClicktoChangeUname">Click here to change it !</b></a></h3>
            </div>
          </div>

            <br>

      <!--profile picture crud-->
      <div class="row" style="display:none;" id="username_input">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <form method="POST" class="form-group" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <label><b>Username</b></label>
            <?php echo $emptyfield;?>
            <input type="text" name="uname" class="form-control" value="<?php echo $username;?>" autofocus>
        </div>
        <div class="col-md-4">
          <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>&nbsp;Save change</button>
          </form>
        </div>
      </div>
          <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit'])) {
               
                $uname=test_input($_REQUEST['uname']);
                if (empty($uname)) {
                    $emptyfield="<span style='color:red;'>This field is required !</span>";
                }else{
                    $sql="UPDATE sec_users SET username='".$uname."' where email='".$_SESSION['email']."'";
                    $result=mysqli_query($conn,$sql);
                    if ($result) {
                        echo '<script>
                            alert("Username changed successfully");
                            window.location.assign("Username.php");
                            </script>';
                    }  
                }
                
              }
          }

          function test_input($data){
              $data=trim($data);
              $data=stripcslashes($data);
              $data=htmlspecialchars($data);
              return $data;
          }
          
        ?>
    </div>
    <div class="col-md-2"></div>
  </div>

  
  <!-- End page content -->
</div>

<script type="text/javascript">
  
    //Smart examination card javascript codes
    //js codes to diplay and dissapear the input field of username

    function clicklinkfn(){
        document.getElementById('ClicktoChangeUname').style.display='none';
        document.getElementById('username_input').style.display='block';
        document.getElementById('usernamecgncolor').style.color='red';

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