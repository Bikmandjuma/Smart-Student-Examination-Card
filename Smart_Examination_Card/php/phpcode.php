<?php
	//Admin php code
	class Admin{

		//Admin profile picture (functions)
		function AdminProfilePicture(){
			//Database connection
			  $server="localhost";
			  $user="root";
			  $pass="";
			  $dbname="secdb";
			  $conn=mysqli_connect($server,$user,$pass,$dbname);
			  if(!$conn){
			      die('Could not Connect My Sql:' .mysql_error());
			  }
			$image="";
            $sql="SELECT image FROM sec_users where email='".$_SESSION['email']."'";
            $result=mysqli_query($conn,$sql);
          	while ($row=mysqli_fetch_assoc($result)) {
            	$image=$row['image'];
          	}

          	if ($image == false) {
            	echo '<a href="ProfilePicture.php" class="w3-margin-right w3-circle" title="Click to add profile picture !"><img src="../images/user.png" style="float: center; width:46px;height:46px;border-radius:50%;border:1px solid #aaa;"></a>';
          	}else{
            	echo '<a href="ProfilePicture.php" title="Click to add profile picture !"><img src="'.$image.'" class="w3-margin-right w3-circle" style="float: center; width:46px;height:46px;border:2px solid skyblue;"></a>';
          	}
		}

		//Admin information 
		function Admin_information(){
			$server="localhost";
			$user="root";
			$pass="";
			$dbname="secdb";
			$conn=mysqli_connect($server,$user,$pass,$dbname);
			if(!$conn){
			    die('Could not Connect My Sql:' .mysqli_error());
			}

			$sql="SELECT * FROM sec_users";
			$result=mysqli_query($conn,$sql);

			echo "<table border=2 style='padding:10px;'>";
			while ($row=mysqli_fetch_assoc($result)) {
				$id=$row['su_id'];
				$fname=$row['firstname'];
				$lname=$row['lastname'];
				$email=$row['email'];
				$phone=$row['phone'];
				$dob=$row['dob'];
				$gender=$row['gender'];
				$username=$row['username'];
				$password=$row['password'];
				$responsibility=$row['responsability'];
				$image=$row['image'];
				echo "<div class='list-group w3-white'>
						<div class='row w3-teal' style='border-radius:50px;'>
							<div class='col-md-10 text-center'>
								<h1 class='list-group-item w3-teal text-center'><i class='fa fa-address-card-o fa-fw'></i>&nbsp;My information </h1>
							</div>

							<div class='col-md-2 text-center '>
								<h3 class='list-group-item text-primary  text-center' style='margin-top:7px;border-radius:20px 20px 20px 20px;'><a href='EditInformation.php?id=$id&firstname=$fname&lastname=$lname&email=$email&phone=$phone&gender=$gender&dob=$dob' style='text-decoration:none;'><i class='fa fa-edit'></i>&nbsp;Edit</a></h3>
							</div>
						</div>

						<div class='row '>
							<div class='col-md-6'>
								<h3 class='list-group-item text-primary'>Firstname</h3>		
							</div>
							<div class='col-md-6'>
							<h3 class='list-group-item'>".$fname."</h3>
							</div>
						</div>

						<div class='row'>
							<div class='col-md-6'>
								<h3 class='list-group-item text-primary'>Lastname</h3>		
							</div>
							<div class='col-md-6'>
							<h3 class='list-group-item'>".$lname."</h3>
							</div>
						</div>

						<div class='row'>
							<div class='col-md-6'>
								<h3 class='list-group-item text-primary'>Email Address</h3>		
							</div>
							<div class='col-md-6'>
							<h3 class='list-group-item'>".$email."</h3>
							</div>
						</div>

						<div class='row'>
							<div class='col-md-6'>
								<h3 class='list-group-item text-primary'>Phone number</h3>		
							</div>
							<div class='col-md-6'>
							<h3 class='list-group-item'>".$phone."</h3>
							</div>
						</div>

						<div class='row'>
							<div class='col-md-6'>
								<h3 class='list-group-item text-primary'>Gender</h3>		
							</div>
							<div class='col-md-6'>
							<h3 class='list-group-item'>".$gender."</h3>
							</div>
						</div>

						<div class='row'>
							<div class='col-md-6'>
								<h3 class='list-group-item text-primary'>Date of birth</h3>		
							</div>
							<div class='col-md-6'>
							<h3 class='list-group-item'>".$dob."</h3>
							</div>
						</div>

						<div class='row'>
							<div class='col-md-6'>
								<h3 class='list-group-item text-primary'>Username</h3>		
							</div>
							<div class='col-md-6'>
							<h3 class='list-group-item'>".$username."</h3>
							</div>
						</div>

						<div class='row'>
							<div class='col-md-6'>
								<h3 class='list-group-item text-primary'>Password</h3>		
							</div>
							<div class='col-md-6' style='overflow-x:auto;'>
							<h3 class='list-group-item'>".md5($password)."</h3>
							</div>
						</div>

						<div class='row'>
							<div class='col-md-6'>
								<h3 class='list-group-item text-primary'>Responsability</h3>		
							</div>
							<div class='col-md-6'>
							<h3 class='list-group-item'>".$responsibility."</h3>
							</div>
						</div>

					</div>";

				}
	
		}

		//insert student info php code
		function InsertStudentInfo(){
			 $server="localhost";
			  $user="root";
			  $pass="";
			  $dbname="secdb";
			  $conn=mysqli_connect($server,$user,$pass,$dbname);
			  if(!$conn){
			      die('Could not Connect My Sql:' .mysqli_error());
			  }

			if (isset($_POST['submitStudentInfo'])) {
				$card_id=$_POST['card_id'];
				$fname=$_POST['fname'];
				$lname=$_POST['lname'];
				$gender=$_POST['gender'];
				$reg_no=$_POST['reg_no'];
				$email=$_POST['email'];
				$level=$_POST['level'];
				$depart=$_POST['dept'];
				$diplicate=null;
				$query= "INSERT into register_student values ('','$card_id','$fname','$lname','$gender','$reg_no','$email','$level','$depart')";
				$result=mysqli_query($conn,$query);

				if ($result == 1) {
				echo "<script>window.location.assign('ListOfStudents.php');
						  alert('Data inserted successfully !')</script>;";

				}else{
					echo "<script>alert('No Data inserted !')</script>";
				}
			
				
			}
		}

		//Select all student info
		function Select_student_info(){
			  $server="localhost";
			  $user="root";
			  $pass="";
			  $dbname="secdb";
			  $conn=mysqli_connect($server,$user,$pass,$dbname);
			  if(!$conn){
			      die('Could not Connect My Sql:' .mysqli_error());
			  }
			$query="SELECT * FROM register_student order by level asc";
			$result=mysqli_query($conn,$query);
			$stu_id=$card_id=$fname=$lname=$gender=$reg_no=$email=$level=$dept=null;
			while ($row=mysqli_fetch_assoc($result)) {
				echo '<tr>';
                $stu_id=$row['stu_id'];
                $card_id=$row['card_no'];
                $fname=$row['firstname'];
                $lname=$row['lastname'];
                $gender=$row['gender'];
                $reg_no=$row['reg_no'];
                $email=$row['email'];
                $level=$row['level'];
                $dept=$row['department'];

                echo '<td>'. $row['card_no'] . '</td>';
                echo '<td>'. $row['firstname'] . '</td>';
				echo '<td>'. $row['lastname'] . '</td>';
				echo '<td>'. $row['gender'] . '</td>';
				echo '<td>'. $row['reg_no'] . '</td>';
				echo '<td>'. $row['email'] . '</td>';
				echo '<td>'. $row['level'] . '</td>';
				echo '<td>'. $row['department'] . '</td>';
				echo '<td><a class="btn w3-button w3-blue" href="EditStudentInfo.php?id='.$row['stu_id'].'&card_id='.$row['card_no'].'&fname='.$row['firstname'].'&lname='.$row['lastname'].'&gender='.$row['gender'].'&regno='.$row['reg_no'].'&email='.$row['email'].'&level='.$row['level'].'&dept='.$row['department'].'" title="Edit data of '.$fname.' '.$lname.'"><i class="fa fa-edit"></i></a>';
				echo '</td>';
				echo '<td><a class="btn w3-button w3-red" href="DeleteStudentInfo.php?id='.$stu_id.'" title="Delete data of '.$fname.' '.$lname.'" onclick="return deletefn()"><i class="fa fa-trash"></i></a>';
				echo '</td>';
                echo '</tr>';
                echo "<script>
                		function deletefn(){
                			return confirm('Are u sure, do u want to delete this data ?');
                		}
                	  </script>";
			}

			if ($card_id == null && $fname == null && $lname == null) {
				echo "<tr><td colspan='9'>No student records found !</td></tr>";
			}

		}

		//function php code of EditStudentinfoselection option

		    function SelectOptionOfEditStudentInfo(){
		    	  $server="localhost";
				  $user="root";
				  $pass="";
				  $dbname="secdb";
				  $conn=mysqli_connect($server,$user,$pass,$dbname);
				  if(!$conn){
				      die('Could not Connect My Sql:' .mysqli_error());
				  }
                  if ($_REQUEST['gender'] == "M") {
                    $gender1='<option value="M" selected>Male</option>';
                    $gender2='<option value="F">Female</option>';
                  }elseif($_REQUEST['gender'] == "F"){
                    $gender1='<option value="M">Male</option>';
                    $gender2='<option value="F" selected>Female</option>';
                  }
                  elseif ($_REQUEST['level'] == 'Level 1') {
                    $level1='<option value="Level 1" selected>Level 1</option>';
                    $level2='<option value="Level 2">Level 2</option>';
                    $level3='<option value="Level 3">Level 3</option>';
                  }elseif ($_REQUEST['level'] == 'Level 2') {
                    $level1='<option value="Level 1">Level 1</option>';
                    $level2='<option value="Level 2" selected>Level 2</option>';
                    $level3='<option value="Level 3">Level 3</option>';
                  }elseif ($_REQUEST['level'] == 'Level 3'){
                    $level1='<option value="Level 1">Level 1</option>';
                    $level2='<option value="Level 2">Level 2</option>';
                    $level3='<option value="Level 3" selected>Level 3</option>';
                  }
                  elseif ($_REQUEST['dept'] == 'IT') {
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
		}

		//Delete student info
		function DeleteStudentInfo(){
			$server="localhost";
			  $user="root";
			  $pass="";
			  $dbname="secdb";
			  $conn=mysqli_connect($server,$user,$pass,$dbname);
			  if(!$conn){
			      die('Could not Connect My Sql:' .mysqli_error());
			  }

			$id=$_GET['id'];
			$query="DELETE from register_student where stu_id=".$id."";
			$result=mysqli_query($conn,$query);
			if ($result == 1) {
				echo "<script>
						window.location.assign('ListOfStudents.php');
						alert('Data deleted successfully !');
					</script>";
			}else{

				$sql1="SELECT stu_id from students_fees where fk_student_id=".$id."";
				$results1=mysqli_query($conn,$sql1);
				while ($row=mysqli_fetch_assoc($results1)) {
					$idd=$row['stu_id'];
				}
				$query3="DELETE from test_attendance where fk_students_fees_id=".$idd."";
				$result3=mysqli_query($conn,$query3);
				if ($result3 == TRUE) {

					//delete data of students_fees
					$query2="DELETE from students_fees where fk_student_id=".$id."";
					$result2=mysqli_query($conn,$query2);
					if ($result2 == TRUE) {

						//delete data of register_student
						$query1="DELETE from register_student where stu_id=".$id."";
						$result1=mysqli_query($conn,$query1);
						if ($result1 == TRUE) {
							echo "<script>
								window.location.assign('ListOfStudents.php');
								alert('Data deleted successfully !');
							</script>";	
						}

					}
				}

				
			}
		}

		//student payment
		function student_payment(){
			  $server="localhost";
			  $user="root";
			  $pass="";
			  $dbname="secdb";
			  $conn=mysqli_connect($server,$user,$pass,$dbname);
			  if(!$conn){
			      die('Could not Connect My Sql:' .mysqli_error());
			  }

			$card_id=$fname=$lname=null;
			$sql="SELECT register_student.stu_id,card_no,firstname,lastname,gender,reg_no,level,department from register_student left join students_fees on register_student.stu_id=students_fees.fk_student_id where students_fees.fk_student_id is null";
			$query=mysqli_query($conn,$sql);

			while ($row=mysqli_fetch_assoc($query)) {
				$card_id =$row['card_no'];
				$fname =$row['firstname'];
				$lname =$row['lastname'];

				$checkbox="<input type='checkbox' name='sec_fees[]' value='".$row['stu_id']."'>";

                echo '<tr><!--td>'.$row['card_no']."</td--><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['gender']."</td><td>".$row['reg_no']."</td><td>".$row['level']."</td><td>".$row['department']."</td><td>".$checkbox.'</td></tr>'; 

			}

			if ($card_id == null && $fname == null && $lname == null) {
				echo "<tr><td colspan='8'>No students records found !</td></tr>";
			}else{
				echo "<tr><td class='text-center' colspan='9'><button class='btn btn-primary' type='submit' name='SubmitStudentFees'>Submit</button></td></tr>";
			}
			

	
		}

		function StudentAlreadyPayFees(){
			$server="localhost";
			  $user="root";
			  $pass="";
			  $dbname="secdb";
			  $conn=mysqli_connect($server,$user,$pass,$dbname);
			  if(!$conn){
			      die('Could not Connect My Sql:' .mysqli_error());
			  }
			$card_id=$fname=$lname=null;
			$query="SELECT register_student.stu_id,card_no,firstname,lastname,gender,reg_no,email,level,department from register_student left join students_fees on register_student.stu_id=students_fees.fk_student_id where students_fees.fk_student_id is not null order by level asc";
			$result=mysqli_query($conn,$query);
			while ($row=mysqli_fetch_assoc($result)) {
				$id=$row['stu_id'];
				$card_id =$row['card_no'];
				$fname =$row['firstname'];
				$lname =$row['lastname'];

				echo '<tr><!--td>'.$row['card_no']."</td--><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['gender']."</td><td>".$row['reg_no']."</td><td>".$row['level']."</td><td>".$row['department']."</td><td>".'<img src="../images/ok_check.png" style="width:30px;height:30px;" title="'.$fname.' '.$lname.''.' already pay the school fees !'.'">'."</td><td>".'<a class="btn btn-danger" href="DeleteStudentPayFees.php?id='.$id.'" onclick="return dltstu_Paysfees()" title="Delete '.$fname.' '.$lname.''.' data in fees table !'.'"><i class="fa fa-trash"></i></a>'."</td></tr>"; 
			}

			if ($card_id == null && $fname == null && $lname == null) {
				echo '<tr><td colspan="8">'."No Students records found !"."</td><td>";
			}

			echo "<script>
					function dltstu_Paysfees(){
						return confirm('Are u sure ,do u want to delete this data !');
					}
				</script>";

		}

		//function to delete student who pays fees
		function DeleteStudentPayFeesFN(){
			  $server="localhost";
			  $user="root";
			  $pass="";
			  $dbname="secdb";
			  $conn=mysqli_connect($server,$user,$pass,$dbname);
			  if(!$conn){
			      die('Could not Connect My Sql:' .mysqli_error());
			  }
			
			$id=$_GET['id'];
			$sqldlt="SELECT * from test_attendance inner join students_fees on test_attendance.fk_students_fees_id=students_fees.stu_id where students_fees.fk_student_id=".$id."";
			$querydlt=mysqli_query($conn,$sqldlt);
			while ($row=mysqli_fetch_assoc($querydlt)) {
				$dlt_id=$row['fk_students_fees_id'];
			}

			$query="DELETE from test_attendance where fk_students_fees_id=".$dlt_id."";
			$result=mysqli_query($conn,$query);

			if ($result == 1) {
				$DeletePyFees="DELETE from students_fees where fk_student_id=".$id."";
				$result_pyfees=mysqli_query($conn,$DeletePyFees);
				if ($result_pyfees == 1) {}
				echo "<script>
						window.location.assign('StudentPayment.php');
						alert('Data deleted successfully !');
					</script>";
			}
		} 

		function Examination_Attendance_List(){
			  $server="localhost";
			  $user="root";
			  $pass="";
			  $dbname="secdb";
			  $conn=mysqli_connect($server,$user,$pass,$dbname);
			  if(!$conn){
			      die('Could not Connect My Sql:' .mysqli_error());
			  }
			  $card_no=$firstname=$lastname="";
			  $sql="SELECT * from ((students_fees inner join register_student on register_student.stu_id=students_fees.fk_student_id)inner join test_attendance on students_fees.stu_id=test_attendance.fk_students_fees_id) order by submit_exam desc";

	          $query=mysqli_query($conn,$sql);
	          while ($row=mysqli_fetch_assoc($query)) {
	            $submit_exam="<b>".$row['submit_exam']."</b>";
	            $card_no=$row['card_no'];
	             $gender=$row['gender'];
	            $firstname=$row['firstname'];
	            $lastname=$row['lastname'];
	            $reg_no=$row['reg_no'];
	            $email=$row['email'];
	            $level=$row['level'];
	            $time_in=$row['time_in'];
	            $time_out=$row['time_out'];
	            $department=$row['department'];

	            $times=null;
	            if ($submit_exam == null) {
	            	$times="-";
	            }

	            echo "<tr>
	                  <!--td>".$card_no."</td-->
	                  <td>".$firstname."</td>
	                  <td>".$lastname."</td>
	                  <td>".$reg_no."</td>
	                  <td>".$gender."</td>
	                  <td>".$level."</td>
	                  <td>".$department."</td>
	                  <td>".$time_in."</td>
	                  <td>".$time_out."</td>
	                  <td>".$submit_exam.$times."</td>
	                </tr>";
	          }

	          if ($card_no == null && $firstname == null && $lastname == null) {
	              echo "<tr><td colspan='10'>No students records found !</td></tr>";
	          }
        }


	}


?>