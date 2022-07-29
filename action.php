<?php 

	include_once("lib/Database.php");
    include_once("lib/Session.php");
    Session::init();
    if (Session::get("session") == false) {
        header("location:login.php");
    }

    $db = new Database();


    

	if (isset($_GET['action']) && $_GET['action'] == 'roleUpdate') {

		$id = $_GET['id'];

		$user_id = Session::get("users_id");
		if ($id == $user_id) {
			Session::set("msg","<script>alert('Admin can`t self deactive!')</script>");
			header("location:user.php");
		}else{

			$sql 		= "SELECT * FROM users WHERE users_id = '$id'";
			$result 	= $db->select($sql);
			$row 		= $result->fetch_assoc();
			$status 	= $row['status'];

			if ($status == 1) {
				$sql = "UPDATE users SET status = '0' WHERE users_id = '$id'";
				$result = $db->update($sql);
				if ($result) {
					header("location:user.php");
				}
			}else{
				$sql = "UPDATE users SET status = '1' WHERE users_id = '$id'";
				$result = $db->update($sql);
				if ($result) {
					header("location:user.php");
				}
			}


			



		}

		


	}

?>