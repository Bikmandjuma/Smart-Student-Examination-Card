<?php 
session_start();
if (!$_SESSION['email']) {
  header("location:../login.php");
}

  require '..\php\phpcode.php';

  //call the card_id from RFID code when a card is taped on rfid device 
  $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
  file_put_contents('UIDContainer.php',$Write);

    $admin=new Admin;
    
    $diplicate=$card_id=$reg_no=$firstname=$lastname=$email=$diplicate_regno=$diplicate_email="";

    if (isset($_POST['submitStudentInfo'])) {
        $conn=mysqli_connect('localhost','root','','secdb');
        if(!$conn){
            die('Could not Connect My Sql:' .mysqli_error());
        }

        $card_id=$_POST['card_id'];
        $reg_no=$_POST['reg_no'];
        $email=$_POST['email'];
        $firstname=$_POST['fname'];
        $lastname=$_POST['lname'];
        $level=$_POST['level'];
        $department=$_POST['dept'];
        $gender=$_POST['gender'];        

        $duplicate=mysqli_query($conn,"SELECT * from register_student where card_no='$card_id'");
        if (mysqli_num_rows($duplicate) > 0){
            $diplicate="This card id <span style='color:red;'><b>".$card_id."</b></span> is already registered !";
        }else{
            $duplicate_email=mysqli_query($conn,"SELECT * from register_student where email='$email'");
            if (mysqli_num_rows($duplicate_email) > 0){
                $diplicate_email="This email <span style='color:red;'><b>".$email."</b></span> is already registered !";
            }else{
                $duplicate_regno=mysqli_query($conn,"SELECT * from register_student where reg_no='$reg_no'");
                if (mysqli_num_rows($duplicate_regno) > 0){
                    $diplicate_regno="This reg_no <span style='color:red;'><b>".$reg_no."</b></span> is already registered !";
                }else{
                    $admin->InsertStudentInfo();
                } 
                
            }    
        }     
    }

?>
<!DOCTYPE html>
<html>
<title>Register Students</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="../w3/w3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.min.js"></script>
<script type="text/javascript" src="..\js\index.js"></script>

    <script>
      $(document).ready(function(){
         $("#getUID").load("UIDContainer.php");
          setInterval(function() {
          $("#getUID").load("UIDContainer.php");
        }, 500);
      });
    </script>

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
        $admin->AdminProfilePicture();
      ?>
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php echo $_SESSION['lname']; ?></strong></span><br>
    </div>
  </div>
  <hr>
  <div class="w3-bar-block" style="font-size:20px;" >
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-red" onclick="w3_secs_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>Close menu</a>

    <!--Dashboard link-->
    <a href="index.php?Dashboard" class="dashboard w3-bar-item w3-button w3-padding list-group-item"><i class="fa fa-dashboard fa-fw "></i>&nbsp;Dashboard</a>

    <span onclick="myFunction('link1')" class="w3-block w3-padding dropdown-toggle list-group-item secs_main_links active"><i class="fa fa-graduation-cap"></i>&nbsp;Students</span>
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
    <div class="col-md-8 text-center">

      <div class="card">
        <div class="card-body w3-blue" style="font-size:25px;"><b>Register Student info</b> </div>
        <div class="card-body">
      
        <div class="row">
          <div class="col-md-6">
            <form class="form-horizontal" method="POST" class="form-group">
                <label><?php echo $diplicate;?></label>
                <textarea name="card_id" id="getUID" placeholder="Please Scan your Card to display ID" rows="1" cols="1" required class="form-control" value="<?php echo $card_no;?>" autofocus></textarea>
                <br>
                <input name="fname" type="text" placeholder="Enter firstname" required class="form-control" value="<?php echo $firstname;?>">
                <br>
                <input name="lname" type="text" placeholder="Enter lastname" required class="form-control" value="<?php echo $lastname;?>">
                <br>
                <select class="form-control" name="gender" required>
                  <option value="">Choose gender</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select> <br>

              </div>
              <div class="col-md-6">
                <label><?php echo $diplicate_email;?> </label>
                <br>
                <input name="email" type="email" placeholder="Enter email" required class="form-control" value="<?php echo $email;?>">
                <label><?php echo $diplicate_regno;?></label>
                <br>
                <input name="reg_no" type="text" placeholder="Enter student Reg_no" required class="form-control" value="<?php echo $reg_no;?>">
                <br>
                 <select class="form-control" name="dept" required>
                  <option value="">Choose department</option>
                  <option value="IT">IT</option>
                  <option value="ET">ET</option>
                  <option value="RE">RE</option>
                </select>
                <br>
                <select class="form-control" name="level" required>
                  <option value="">Choose level</option>
                  <option value="1">Level 1</option>
                  <option value="2">Level 2</option>
                  <option value="3">Level 3</option>
                </select>
                <br>
              </div>

              <div class="row">
                <div class="col-md-12 w3-margin-right">
                  <button type="submit" class="btn btn-primary" name="submitStudentInfo"><i class="fa fa-save fa-fw"></i> Register</button>&nbsp;&nbsp;<button type="reset" class="btn btn-danger" name="reset"><i class="fa fa-close fa-fw"></i> Reset</button>
                </div>
              </div>
            </form>
          
         </div> 

        </div>
      </div>

    </div>
    <div class="col-md-2 "> </div>
  </div>
  
  <!-- End page content -->
</div>

<script type="text/javascript"> 
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