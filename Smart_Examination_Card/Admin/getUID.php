<!DOCTYPE html>
<html>
<head>
	<title>Get UID</title>
</head>
<body>
<form action="" method="POST">
	<label>Enter code of CARD</label>
	<input type="text" name="code" required>
	<button name="check" type="submit">Check</button>
</form>

</body>
</html>
<?php
	if (isset($_POST['check'])) {
		$UIDresult=$_POST['code'];
		// $UIDresult=$_POST["UIDresult"];
		$Write="<?php $" . "UIDresult='" . $UIDresult . "'; " . "echo $" . "UIDresult;" . " ?>";
		file_put_contents('UIDContainer.php',$Write);

	}
	
	
?>
	