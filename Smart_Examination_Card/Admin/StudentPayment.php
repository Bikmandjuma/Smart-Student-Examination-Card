<?php 
session_start();
if (!$_SESSION['email']) {
  header("location:../login.php");
}
  require '../php/phpcode.php';
  $admin=new Admin;

  $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
  file_put_contents('UIDContainer.php',$Write);


    $server="localhost";
    $user="root";
    $pass="";
    $dbname="secdb";
    $conn=mysqli_connect($server,$user,$pass,$dbname);
    if(!$conn){
        die('Could not Connect My Sql:' .mysqli_error());
    }

  if(isset($_POST['SubmitStudentFees'])){
     $checkbox = $_POST['sec_fees'];         
     for($i=0;$i<count($checkbox);$i++){
         $check_id = $checkbox[$i];
         $query="INSERT into students_fees values ('','".$check_id."','yes')";
         $result=mysqli_query($conn,$query);

         if ($checkbox == ' ') {
             $empty="<script>alert(' Checkbox is required !')</script>";
         }else{

            //inserty data into test_attendance table
            $sql_stu_id="SELECT students_fees.stu_id from register_student inner join students_fees on register_student.stu_id=students_fees.fk_student_id where register_student.stu_id='".$check_id."'";
            
            $query_stu_id=mysqli_query($conn,$sql_stu_id);
            while ($row_stu_id=mysqli_fetch_assoc($query_stu_id)){
                $students_id=$row_stu_id['stu_id'];
            }

            $sql="INSERT INTO test_attendance values ('','$students_id','','','')";
            $query=mysqli_query($conn,$sql);
            if ($query == 1) {}

             if ($result==1) {
                echo "<script>window.location.assign('StudentPayment.php');
                         alert('data inserted succesfully !');
                      </script>";
              }else{
                  echo "<script>alert('No data inserted  !');
                          window.location.assign('StudentPayment.php');
                        </script>";
              }
         }
              
     }
  }

?>
<!DOCTYPE html>
<html>
<title>Student's payment</title>
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
        $admin->AdminProfilePicture();
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

  <div class="row" style="overflow: auto;">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-center w3-white">
      <div class="w3-dark-grey">
        <h2><b>Tick student who pays fees</b></h2>
      </div>
      <form method="POST">
      <table class="table table-bordered table-striped">
        <tr>
          <thead class="w3-dark-grey text-white">
            <!--th>Card_id</th-->
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Reg_number</th>
            <th>Level</th>
            <th>Department</th>
            <th>Pay_fees</th>
          </thead>
        </tr>
        <?php
          $admin->student_payment();
        ?>
      </table>
      </form>
    </div>
    <div class="col-md-1"> </div>
  </div>

  <br>
  <br>
  

  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-center w3-white">

      <div class="w3-green">
      <h2><b>List of students who already pays the fees</b></h2>
      </div> 
      
        <table class="table table-striped table-bordered">
          <tr>
            <thead class="w3-green text-white">
              <!--th>Card_id</th-->
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Gender</th>
              <th>Reg_number</th>
              <th>Level</th>
              <th>Department</th>
              <th>Pay_fees</th>
              <th>Delete</th>
            </thead>
          </tr>

          <?php
            $admin->StudentAlreadyPayFees();
          ?>
        </table>
    </div>
    <div class="col-md-1"></div>
  </div>
  
  <!-- End of page content -->
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