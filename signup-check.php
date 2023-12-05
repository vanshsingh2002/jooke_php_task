<?php 
session_start(); 
include "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty($_POST["uname"])) {
        header("Location: signup.php?error=Email is required");
        exit();
    } elseif (!filter_var($_POST["uname"], FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=Invalid email address");
        exit();
    }

	if (strlen($_POST["password"]) < 8) {
		header("Location: signup.php?error=Password must be at least 8 characters");
		exit();
	}
	
	if (!preg_match("/[0-9]/", $_POST["password"])) {
		header("Location: signup.php?error=Password must contain at least one numeric character");
		exit();
	}
	
	if (!preg_match("/[!@#$%^&*]/", $_POST["password"])) {
		header("Location: signup.php?error=Password must contain at least one special character (!@#$%^&*)");
		exit();
	}
}

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['address']) && isset($_POST['re_password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	$re_pass = validate($_POST['re_password']);
	$phone_number = validate($_POST['phone_number']);
	$address = validate($_POST['address']);
	

	$user_data = 'uname='. $uname. '&name='. $name;


	if (empty($uname)) {
		header("Location: signup.php?error=User Name is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=Re Password is required&$user_data");
	    exit();
	}

	else if(empty($phone_number)){
        header("Location: signup.php?error=Phone Number is required&$user_data");
	    exit();
	}

	else if(empty($address)){
        header("Location: signup.php?error=Address is required&$user_data");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: signup.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}

	else{

		// hashing the password
        $pass = md5($pass);

	    $sql = "SELECT * FROM users WHERE user_name='$uname' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO users(user_name, password, phone_number, address) VALUES('$uname', '$pass', '$phone_number', '$address')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: signup.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}