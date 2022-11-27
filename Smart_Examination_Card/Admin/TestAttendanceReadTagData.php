<?php 

  session_start();
  if (!$_SESSION['email']) {
    header("location:../login.php");
  }

  $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
  file_put_contents('UIDContainer.php',$Write);

  require '../php/phpcode.php';
  $Admin=new Admin;
    $server="localhost";
    $user="root";
    $pass="";
    $dbname="secdb";
    $conn=mysqli_connect($server,$user,$pass,$dbname);
    if(!$conn){
        die('Could not Connect My Sql:' .mysqli_error());
    }

  $id = null;
  
  if ( !empty($_GET['id'])) {
      $id =$_REQUEST['id'];
  }

   $card_no=$sexs=$sex=$card_nos=$time_in=$msg1=$msg2=$time_out=$submit_exam=$fname=$lname=$invalid_id_card1=$invalid_id_card11=$invalid_id_card2=$student_submit_exams=null;
   $sql="SELECT * from ((students_fees inner join register_student on register_student.stu_id=students_fees.fk_student_id)inner join test_attendance on students_fees.stu_id=test_attendance.fk_students_fees_id) where card_no='".$id."'";

   $query=mysqli_query($conn,$sql);
   while ($row=mysqli_fetch_assoc($query)) {
      $fname=$row['firstname'];
      $lname=$row['lastname'];
      $card_no=$row['card_no'];
      $fk_stud_fees_id=$row['fk_students_fees_id'];
      $time_in=$row['time_in'];
      $time_out=$row['time_out'];
      $submit_exam=$row['submit_exam'];
   }

   if ($card_no != $id) {
      $query1="SELECT firstname,lastname,card_no,gender from register_student where card_no='".$id."'";
      $result1=mysqli_query($conn,$query1);
      while ($row1=mysqli_fetch_assoc($result1)) {
          $card_nos=$row1['card_no'];
          $fname=$row1['firstname'];
          $lname=$row1['lastname'];
          $sex=$row1['gender'];
      }

      if ($sex == "M") {
        $sexs="Mr";
      }else{
        $sexs="Ms";
      }
      if ($card_nos == $id) {
          $invalid_id_card1="*  <span class='w3-text-blue'>"."".$sexs." , ".$fname." ".$lname."</span> , you didn't pay the fees !";
          $invalid_id_card11="*You are not on the attendance list of examination !";
      }else{
          $invalid_id_card2="* System not recognize this id card <span class='text-primary'>".$id."</span> ! *";
      }
      
   }elseif ($card_no == $id && $time_in == null && $time_out == null && $submit_exam == null) {
      $msg1="<span class='text-primary'><b>Ooops ,".$fname." ".$lname."</span><span class='text-danger'> You are on examination's attendance list,but you didn't tap a card before enter in an exam room .<a href='TestAllowance.php'>Click here</a></b></span>";
   }elseif ($card_no == $id && $time_in != null && $time_out == null && $submit_exam == null) {

      $time=null;
      date_default_timezone_set("Africa/Kigali");
      $time=date("h:i:s a");

      $student_submit_exams="* Well done <span class='text-danger'>".$fname." ".$lname." "."</span> you submit examination's copy !*";
      
      $update_test="UPDATE test_attendance set submit_exam='Done',time_out='$time' where fk_students_fees_id='$fk_stud_fees_id'";
      $update_test_query=mysqli_query($conn,$update_test);
      if ($update_test_query == 1){}
   }elseif ($card_no == $id && $time_in != null && $time_out != null && $submit_exam != null){
      $msg2="<span class='text-primary'><b>".$fname." ".$lname."</b></span><span class='text-danger'><b> You are already submitted the examination's copy at <span class='text-primary'>".$time_out." !</span></b></span>";
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
  
  <div class="row">
    <div class="col-md-12">
      <?php
           $t_id=$st_id=$sub="";
           $sql="SELECT * from test_attendance";

            $query=mysqli_query($conn,$sql);
            while ($row=mysqli_fetch_assoc($query)) {
              $t_id=$row['t_id'];
              $st_id=$row['fk_students_fees_id'];
              $sub=$row['submit_exam'];
            }

            if ($t_id == null && $st_id == null && $sub == null) {
              echo "";
            }else{
              echo '
                   <form action="ExportStudentAttendaceList.php" method="POST" id="listAttendance">
                      <button type="submit" name="submit" class="btn btn-primary">Export excel file</button>
                   </form>';

              echo "<br>";     
              
              echo '<form method="POST">
                    <button class="btn btn-danger" type="resetdata" name="resetdata"><i class="fa fa-reset">reset</i></button>
                   </form>';

              if (isset($_POST['resetdata'])) {
                  $server="localhost";
                    $user="root";
                    $pass="";
                    $dbname="secdb";
                    $conn=mysqli_connect($server,$user,$pass,$dbname);
                   $sqlereset=mysqli_query($conn,"UPDATE test_attendance SET time_in='',time_out='',submit_exam=''");
                   if ($sqlereset == 1) {
                     echo "<script>alert('data resetted successfully !');</script>";
                   }
              } 
            }


        ?>

        
      <h2><b><u> Examination attendance list </u></b></h2>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="w3-blue"><h2>Scan card to submit the examination's copy</h2> </div>
        </div>
        <div class="col-md-2"></div>
      </div>
      
      <table class="table table-bordered table-striped">
        <thead>
          <tr class="text-white w3-red">
            <!--th>Card id</th--><th>Firstname</th><th>Lastname</th>
            <th>Reg no</th><th>Gender</th><th>Level</th>
            <th>Department</th><th>Time in</th><th>Time out</th><th>Submit Exam</th>
          </tr>
        </thead>
        <?php
          
          $Admin->Examination_Attendance_List();

        ?>
      </table>

      <div class="row">
        <div class="col-md-12">
           <h2 style="color:red;"><b><?php echo  $invalid_id_card1;?></b></h2><br>
           <h2 style="color:red;"><b><?php echo  $invalid_id_card11;?></b></h2>
           <h2 style="color:red;"><b><?php echo  $invalid_id_card2;?></b></h2>
           <h2 style="color:blue;"><b><?php echo  $student_submit_exams;?></b></h2>
           <h2 style="color:blue;"><b><?php echo  $msg1;?></b></h2>
           <h2 style="color:blue;"><b><?php echo  $msg2;?></b></h2>
      </div>
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