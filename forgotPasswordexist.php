<?php
    include_once("lib/Database.php");
    include_once("lib/Session.php");
    Session::init();
    $db = new Database();
?>

<?php 
	

	if(isset($_REQUEST['for_get_email'])){
		$for_get_email   = $db->link->real_escape_string(trim($_REQUEST['for_get_email']));
		$sql = "SELECT * FROM users WHERE email = '$for_get_email'";
		$result = $db->select($sql);
		if ($result) {
		    $value = 123456;
		    $shuffle = str_shuffle($value);
			$sql = "UPDATE users SET otp = '$shuffle' WHERE email = '$for_get_email'";
			$db->update($sql);
			Session::set("got_password","success");
			Session::set("valid_email","$for_get_email");

	//---------------For mail------------------------------

			/*

			$subject = "Password OTP";
			$body = "Your OTP is: ".$shuffle."\n Power by Accounting group tram";
			$from = "noreplay@gmail.com";
			mail($for_get_email, $subject, $body, $from);


			*/

			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_REQUEST['opt'])){
		$otp   = $db->link->real_escape_string(trim($_REQUEST['opt']));
		$email   = $db->link->real_escape_string(trim($_REQUEST['email']));
		$email = trim($email);

		$sql = "SELECT * FROM users WHERE otp = '$otp' AND email ='$email'";
		$result = $db->select($sql);
		if ($result) {
			Session::set("confirm_password","correct");
			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_REQUEST['new_pass']) && isset($_REQUEST['con_pass'])){
		$new_pass   = $db->link->real_escape_string(trim($_REQUEST['new_pass']));
		$con_pass   = $db->link->real_escape_string(trim($_REQUEST['con_pass']));
		$email_confirm   = $db->link->real_escape_string(trim($_REQUEST['email_confirm']));
		$con_pass = md5($con_pass);
		$sql = "UPDATE users SET password = '$con_pass', otp ='' WHERE email ='$email_confirm'";
		$result = $db->update($sql);
		if ($result) {
			session_destroy();
			echo 1;
		}
	}


?>