<?php
 $conn = odbc_connect ("YURA", "YURIY", "12345");
	
 
	function ValidateEmail($value){
		$regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
 
		if($value == '') { 
			return false;
		} else {
			$string = preg_replace($regex, '', $value);
		}
 
		return empty($string) ? true : false;
	}
 
	$post = (!empty($_POST)) ? true : false;
 
	if($post){
 
		$name = stripslashes($_POST['Name']);
		$faculty = stripslashes($_POST['Faculty']);
		$email = stripslashes($_POST['Email']);
		$password = stripslashes($_POST['Password']);
		$sql="
		INSERT INTO Respondents 
		VALUES('$name', '$email', '$faculty', '$password')";
	
		odbc_exec($conn,$sql);
	        if (!odbc_error()){
	          odbc ($conn);
	          echo "You are successfully registered!"; 
	          break; }
	        else{
	        	odbc($conn);
	        	echo "Please try again...";
	        }

		if (!ValidateEmail($email)){
			$error = 'wrong email !';
		}
 
		if(!$error){
			echo 'OK';
			}
		}else{
			echo '<div class="bg-danger">'.$error.'</div>';
		}
 
	}
?>