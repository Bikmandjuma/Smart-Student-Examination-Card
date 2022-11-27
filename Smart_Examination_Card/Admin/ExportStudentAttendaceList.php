<?php
if (isset($_POST['submit'])) {
	require ('..\php\phpcode.php');

	$server="localhost";
  $user="root";
  $pass="";
  $dbname="secdb";
  $conn=mysqli_connect($server,$user,$pass,$dbname);
  if(!$conn){
      die('Could not Connect My Sql:' .mysqli_error());
  }
		
  $sql="SELECT firstname,lastname,gender,reg_no,level,department,time_in,time_out,submit_exam from ((students_fees inner join register_student on register_student.stu_id=students_fees.fk_student_id)inner join test_attendance on students_fees.stu_id=test_attendance.fk_students_fees_id)";

      $setRec=mysqli_query($conn,$sql);
      $columnHeader = '';
      $columnHeader = "firstname" . "\t" . "lastname" . "\t" . "gender" . "\t". "reg_no" . "\t". "level" . "\t". "department" ."\t". "time_in" ."\t". "time_out" ."\t". "submit_exam" . "\t";
      $setData = '';  

      while ($rec = mysqli_fetch_row($setRec)) {  
        $rowData = '';  
        foreach ($rec as $value) {  
            $value = '"' . $value . '"' . "\t";  
            $rowData .= $value;
        }  
        $setData .= trim($rowData) . "\n";  
      } 
      header("Content-type: application/octet-stream");  
      header("Content-Disposition: attachment; filename=Examination_List.xls");  
      header("Pragma: no-cache"); 
      header("Expires: 0");  
      echo ucwords($columnHeader) . "\n" . $setData . "\n";
}
?>