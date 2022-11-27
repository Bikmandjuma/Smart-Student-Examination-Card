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
<title>Profile picture</title>
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
    <a href="index.php?Dashboard" class="dashboard w3-bar-item w3-button w3-padding list-group-item"><i class="fa fa-dashboard fa-fw "></i>&nbsp;Dashboard</a>

    <span onclick="myFunction('link1')" class="w3-block w3-padding dropdown-toggle list-group-item secs_main_links"><i class="fa fa-graduation-cap fa-fw"></i>&nbsp;Students</span>
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
  
   <div class="row text-center">
    <div class="col-md-12"><h1><span class="w3-text-blue"><b><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></span> profile picture</b></h1></div>
   </div>

   <br>
   
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 text-center">

      <div class="row">
        <div class="col-md-12">
          <?php
            $server="localhost";
            $user="root";
            $pass="";
            $dbname="secdb";
            $conn=mysqli_connect($server,$user,$pass,$dbname);
            if(!$conn){
                die('Could not Connect My Sql:' .mysqli_error());
            }

            $image="";
            $sql="SELECT image FROM sec_users where email='".$_SESSION['email']."'";
            $result=mysqli_query($conn,$sql);
            while ($row=mysqli_fetch_assoc($result)) {
                $image=$row['image'];
            }

            if ($image == false) {
                echo '<a href="ProfilePicture.php" class="w3-margin-right w3-circle" title="Click to add profile picture !"><img src="../images/user.png" style="float: center; width:300px;height:300px;border-radius:50%;border:1px solid #aaa;"></a>';
            }else{
                echo '<a href="ProfilePicture.php" title="Click to add profile picture !"><img src="'.$image.'" class="w3-margin-right w3-circle" style="float: center; width:300px;height:300px;border:2px solid skyblue;"></a>';
            }
          ?>
        </div>
      </div>

      <?php
          $id=$image=null;
          $sql="SELECT * FROM sec_users where email='".$_SESSION['email']."'";
          $result=mysqli_query($conn,$sql);
          while ($row=mysqli_fetch_assoc($result)) {
              $id=$row['su_id'];
              $image=$row['image'];
          }

          if ($image != null) {
            echo '
              <!--Edit and delete-->
              <div class="row"> 
                <div class="col-md-6">
                  <a href="EditProfilePicture.php?id='.$id.'" class="btn btn-primary" title="Edit '.$_SESSION['respons'].' profile picture !">
                    <i class="fa fa-edit"></i>
                  </a>
                </div>
                <div class="col-md-6">
                  <a href="DeleteProfilePicture.php?id='.$id.'" class="btn btn-danger" title="Delete '.$_SESSION['respons'].' profile picture !" onclick="return dltprofpic()">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </div>
                    ';

            echo "<script>
                  function dltprofpic(){
                    return confirm('Are u sure , do u want to delete this picture !');
                  }
                </script>";

          }else{
            echo '<div class="btn btn-danger" style="font-size:20px;cursor:pointer;" id="showUploadInput" onclick="showAdminProf()" title="Click to add profile picture !"><i class="fa fa-image"></i></div>';
            echo '
                <div class="row" id="AdminProfPic" style="display:none;">
                  <br>
                  <span style="color:red;"><b>Your image size must be less than 2MB<b></span>
                  <br>

                  <!--div class="col-md-7"></div-->
                  <div class="col-md-12 text-center">
                      <form method="POST" enctype="multipart/form-data" action="'.htmlspecialchars($_SERVER['PHP_SELF']).'">
                        <label><b>Add profile picture</b></label>
                        <input type="file" name="fileToUpload" class="form-control" required><br>
                        <button class="btn btn-primary" type="submit" name="SubmitAdminProfPicture">Upload</button>
                      </form>
                  </div>
                  <!--div class="col-md-1"></div-->
                </div>
                  
                  ';

            echo '
              <script>
                  function showAdminProf(){
                    document.getElementById("showUploadInput").style.display="none";
                    document.getElementById("AdminProfPic").style.display="block";
                  }
              </script>
            ';

          }
            

      ?>

          <!--Add profile picture php code-->
          
          <?php

              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fileToUpload=null;
                $target_dir = "../images/";
                $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if(isset($_POST["SubmitAdminProfPicture"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    $filename=basename( $_FILES["fileToUpload"]["name"]);
                    
                    if($check !== false) {
                        echo $check["mime"] . ".";
                        $uploadOk = 1;
                    
                    } else {
                        echo "<br>File is not an image.";
                        $uploadOk = 0;
                    }
                            // Check if file already exists
                    if (file_exists($target_file)) {
                        //echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
                    // Check file size //2MB
                    if ($_FILES["fileToUpload"]["size"] >= 20000000) {
                        echo "<br>Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "<br>Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            echo '<script>
                              window.location.assign("ProfilePicture.php");
                              alert("The file '. $filename.' has been uploaded");
                            </script>';
                            
                        } else {
                            echo "<br>Sorry, there was an error uploading your file.";
                        }

                        try{
                        $sql="UPDATE sec_users SET image='".$target_file."' where email='".$_SESSION['email']."' ";
                        $result=mysqli_query($conn,$sql);
                        // use exec() because no results are returned
                        if ($result) {
                            echo "<script>window.location.assign('location:ProfilePicture.php');</script>";
                          
                        }
                            
                        }catch(PDOException $e){
                            echo $sql . "no picture inserted " . $e->getMessage();
                        }
                }
                    $conn = null;
                }
                
              }
          ?>

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