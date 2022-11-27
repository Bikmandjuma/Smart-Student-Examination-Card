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
        $id = $_REQUEST['id'];
    }

  $server="localhost";
  $user="root";
  $pass="";
  $dbname="secdb";
  $conn=mysqli_connect($server,$user,$pass,$dbname);
  if(!$conn){
      die('Could not Connect My Sql:' .mysqli_error());
  }

  $msg1=$msg2=$msg3=$msg4="";
  $card_id=$payment=$reg_no=$lname=$fname=$gender=$level=$department=$sex="";
  $query = "SELECT * from register_student left join students_fees on register_student.stu_id=students_fees.fk_student_id where register_student.card_no='".$id."'";
  
  $result=mysqli_query($conn,$query);
  
  while ($data=mysqli_fetch_assoc($result)) {
    $card_id=$data['card_no'];
    $fname=$data['firstname'];
    $lname=$data['lastname'];
    $payment=$data['payment'];
    $gender=$data['gender'];
    $reg_no=$data['reg_no'];
    $level=$data['level'];
    $department=$data['department'];
  }

    if ($gender == 'M') {
        $sex='He';
    }else{
        $sex='She';
    }

  if ($card_id == $id && $payment == 'yes') {
    $time=$time_in=$fk_stud_fees_id=$time_out=$submit_exam="";
      

      //insert into test_attendance table in time_in column
      $sql="SELECT * from ((students_fees inner join register_student on register_student.stu_id=students_fees.fk_student_id)inner join test_attendance on students_fees.stu_id=test_attendance.fk_students_fees_id) where card_no='".$id."'";

     $query=mysqli_query($conn,$sql);
     while ($row=mysqli_fetch_assoc($query)) {
        $fnames=$row['firstname'];
        $lnames=$row['lastname'];
        $card_no=$row['card_no'];
        $fk_stud_fees_id=$row['fk_students_fees_id'];
        $time_in=$row['time_in'];
        $time_out=$row['time_out'];
        $submit_exam=$row['submit_exam'];
     }    

     if ($time_in == null) {

        $msg1="<span id='divId'><b> *<span style='color:blue;'>".$fname." ".$lname."</span> ".$sex."'s clear </b>!</span>";
        $msg2="<span id='divId'><b>* Allowed to do examination !</b></span>";  

        date_default_timezone_set("Africa/Kigali");
        $time=date("h:i:s a");
        $queryinsert="UPDATE test_attendance set time_in='$time' where fk_students_fees_id='$fk_stud_fees_id'";
        $resultinsert=mysqli_query($conn,$queryinsert);
        if ($resultinsert == 1) {}

     }elseif ($time_in != null && $time_out != null && $submit_exam != null) {
        
        ?>
          <style>
            #hideStudentInfo{
              display: none;
            }
          </style>
        <?php

        $msg4="<span style='color:blue;'><b>".$fnames." ".$lnames." ,</b></span><b> You submitted  examination's copy at <span style='color:blue;'>".$time_out."</span> !</b>";
     }elseif ($time_in != null) {

        ?>
          <style>
            #hideStudentInfo{
              display: none;
            }
          </style>
        <?php

        $msg3="<span style='color:blue'><b>".$fnames." ".$lnames." ,</b></span><b> You are already allowed to do examination !</b>";
     }

  }elseif ($card_id == $id && $payment == '') {
      $msg1="<b>* <span style='color:blue;'>".$fname." ".$lname."</span> ".$sex."'s not clear </b>!";
      $msg2="<b>* ".$sex." has an issue in finance !</b>";
      $msg3="<b>* Not allowed to do examination !</b>";

  }elseif ($card_id != $id) {
       
       ?>
          <style>
            #hideStudentInfo{
              display: none;
            }
          </style>
        <?php

      $msg1="<b>* The system not recognize this id card <span style='color:blue;'>".$id."</b></span> !";
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

    <div id="hideStudentInfo">
        <table  class="table table-striped table-bordered">
          <thead>
            <tr class="w3-green text-white">
              <th>Card_ID</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Gender</th>
              <th>Reg_no</th>
              <th>Level</th>
              <th>Department</th>
            </tr>
          </thead>
            <tr>
              <td><?php echo $card_id;?></td>
              <td><?php echo $fname;?></td>        
              <td><?php echo $lname;?></td>
              <td><?php echo $gender;?></td>
              <td><?php echo $reg_no;?></td>
              <td><?php echo $level;?></td>
              <td><?php echo $department;?></td>  
            </tr>
        </table>
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

    <h2 style="color:red;"><?php echo  $msg1;?></h2><br>
    <h2 style="color:red;"><?php echo  $msg2;?></h2><br>
    <h2 style="color:red;"><?php echo  $msg3;?></h2><br>
    <h2 style="color:red;"><?php echo  $msg4;?></h2><br>
   

</body>
</html>