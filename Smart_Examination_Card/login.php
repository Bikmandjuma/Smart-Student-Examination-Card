<?php
session_start();
require 'php\phpcode.php';
  $admin=new Admin;
  $server="localhost";
  $user="root";
  $pass="";
  $dbname="secdb";
  $conn=mysqli_connect($server,$user,$pass,$dbname);
  if(!$conn){
      die('Could not Connect My Sql:' .mysqli_error());
  }
?>
 <?php
      $Username=$password=$firstname=$user=$pass=$wrongCred=$mandatory="";
      
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $Username=test_input($_POST['uname']);
        $password=test_input($_POST['pwd']);
        if (!$Username || !$password) {
            $mandatory="<span class='w3-text-red'>All fields are required !</span>";
        } 

        else{
          
          $sql="SELECT * from sec_users where username='".$Username."' and password='".$password."' ";
          $result=mysqli_query($conn,$sql);
          while ($row=mysqli_fetch_assoc($result)) {
              $user=$row['username'];
              $pass=$row['password'];
              $respons=$row['responsability'];
              $email=$row['email'];
              $lastname=$row['lastname'];
              $firstname=$row['firstname'];
              $id=$row['su_id'];

              //this session will be needed in the management page
              $_SESSION['respons']=$respons;
              $_SESSION['email']=$email;
              $_SESSION['lname']=$lastname;
              $_SESSION['fname']=$firstname;
              $_SESSION['id']=$id;
              
          }

          if ($Username != $user) {
              $wrongCred="<span class='w3-text-red'>Incorrect username/password !</span>";
          }else{
              header('location:..\Smart_Examination_Card\Admin\index.php');
          }
          
        }

    }

    function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

?>
<!DOCTYPE html>
<html>
<head>
   <title>Login users</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="w3/w3.css">
   <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="js/jquery.js"></script>
   <script src="js/bootstrap.js"></script>
</head>
<body>
<div class="container">
  <br>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 text-center w3-teal" id="title" style="box-shadow:1px 10px 10px 1px grey;"><h2><b>Smart student card</b></h2></div>
    <div class="col-md-2"></div>
  </div>
  <br>
  
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8" style="box-shadow:1px 10px 10px 1px black;">
        <div class="card">
          <div class="card-body text-center text-white w3-teal"><h1><b>Login here</b></h1></div>

            <div class="row">
              <div class="col-md-12 text-center">
                <?php echo $wrongCred;?>
                <?php echo $mandatory;?>
              </div>
            </div>
          
          <div class="card-body">
            <form class="form-group" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

              <div class="row">
                <div class="col-md-1">
                    <i class="fa fa-user w3-margin-left"></i>
                </div>
                <div class="col-md-10">
                    <input type="text" name="uname" class="form-control w3-margin-right" placeholder="Username" autofocus value="<?php echo $user;?>">
                </div>
                 <div class="col-md-1"></div>
              </div>

              <br>

              <div class="row">
                <div class="col-md-1" style="margin-right:0px;">
                    <i class="fa fa-lock w3-margin-left"></i>
                </div>
                <div class="col-md-10">
                    <input type="password" name="pwd" class="form-control w3-margin-right" placeholder="Password"  value="<?php echo $pass;?>">
                </div>
              </div>

              <br>
              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"><button type="submit" name="submit" class="form-control btn btn-primary">Login <i class="fa fa-unlock fa-fw"></i></button></div>
                <div class="col-md-4"></div>
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
 
</div>
</body>
</html>
