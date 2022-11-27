<?php 

  session_start();
  if (!$_SESSION['email']) {
    header("location:../login.php");
  }

  $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
  file_put_contents('UIDContainer.php',$Write);

  require '../php/phpcode.php';
  $Admin=new Admin;

  $id = null;
  
  if ( !empty($_GET['id'])) {
      $id =$_REQUEST['id'];
  }

  $server="localhost";
  $user="root";
  $pass="";
  $dbname="secdb";
  $conn=mysqli_connect($server,$user,$pass,$dbname);
  if(!$conn){
      die('Could not Connect My Sql:' .mysqli_error());
  }

   $card_no=$time_in=$msg1=$msg2=$stu_id=$time_out=$paymentcheck=$payment=$invalid_id_cards=$submit_exam=$fname=$lname=$invalid_id_card=$student_submit_exams=null;
   $sql="SELECT * from register_student left join students_fees on register_student.stu_id=students_fees.fk_student_id where card_no='".$id."'";
   $submit_examsub="";
   $query=mysqli_query($conn,$sql);
   while ($row=mysqli_fetch_assoc($query)) {
      $fname=$row['firstname'];
      $lname=$row['lastname'];
      $card_no=$row['card_no'];
      $fk_stud_id=$row['fk_student_id'];
      $email=$row['email'];
      $level=$row['level'];
      $reg_no=$row['reg_no'];
      $department=$row['department'];
      $stu_id=$row['stu_id'];
      $gender=$row['gender'];
      $payment=$row['payment'];
   }

   $sqlsub="SELECT * from test_attendance where fk_students_fees_id='$stu_id'";
   $querysub=mysqli_query($conn,$sqlsub);
   while ($rowsub=mysqli_fetch_assoc($querysub)) {
     $submit_examsub=$rowsub['submit_exam'];
   }

   if ($submit_examsub == "Done") {
     $submit_exams="Yes";
   }else{
      $submit_exams="No";
   }

   if ($card_no == $id) {
     ?>
      <style>
        /*#HideTitle{
          display: none;
        }*/
        #ShowsTitle{
          display: block;
        }
      </style>
     <?php
   }elseif ($card_no != $id) {
      
      ?>
      <style>
        #ShowsTitle{
          display:none;
        }
        #StudentInfoDiv{
         display:none; 
        }
      </style>
      <?php

     $invalid_id_cards="<span class='w3-text-blue'><b>System not recognize ,this id card <span class='text-danger'>".$id."</span> !</b></span>";

   }

   if ($payment == "yes") {
     $paymentcheck="Yes";
   }elseif ($payment == null) {
     $paymentcheck="No";
   }
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<script src="../js/bootstrap.js"></script>
<body class="w3-light-grey">
<!-- Sidebar/menu -->

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_secs_close()" style="cursor:pointer" title="close side menu" id="secs_myOverlay"></div>
<!-- !PAGE CONTENT! -->
  <div class="row" id="HideTitle">
    <div class="col-md-12 w3-blue">
      <h1><b>Tap card to check student's informarion !</b></h1>
    </div>
  </div>

  <div class="row" id="ShowsTitle">
    <div class="col-md-12">
    </div>
  </div>
      <h1><?php echo $invalid_id_cards; ?></h1>
  <div class="row">
    <div class="col-md-12 ">

      <div class="row" id="StudentInfoDiv">

        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="card">
            <div class="card-body w3-blue">
              <h2 class="text-white"><b>Information of <span class="w3-text-black"> <?php echo $fname." ".$lname;?></span> !</b></h2>
            </div>

            <div class="card-body">
              <div class="list-group">

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Firstname  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $fname;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row">
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Lastname  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $lname;?></h2></div>
                    <div class="2"></div>
                  </div>
                </div>

                <div class="list-group-item">
                  <div class="row">
                    <div class="2"></div>
                    <div class="col-md-4 "><h2>Gender  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $gender;?></h2></div>
                    <div class="2"></div>
                  </div>
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Registration no  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $reg_no;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row">
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Email Address </h2></div>
                    <div class="col-md-6 text-primary"><h2><?php echo $email;?></h2></div>
                  </div>
                </div>

                <div class="list-group-item">
                  <div class="row">
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Level of study </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $level;?></h2></div>
                    <div class="2"></div>
                  </div>
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Department  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $department;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row">
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Pay fees  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $paymentcheck;?></h2></div>
                    <div class="2"></div>
                  </div>
                </div>

                <div class="list-group-item">
                  <div class="row">
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Did Exams  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $submit_exams;?></h2></div>
                    <div class="2"></div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
        <div class="col-md-1"></div>

      </div>

    </div>
  </div>
  
  <!-- End page content -->

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