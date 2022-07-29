<?php 

	include_once("lib/Database.php");
    include_once("lib/Session.php");
    Session::init();
    if (Session::get("session") == false) {
        header("location:login.php");
    }

    $db = new Database();

	if (isset($_GET['action']) && $_GET['action'] == 'group_type') {
		$id = $_GET['id'];
		$sql = "DELETE FROM group_type WHERE group_type_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:group_type.php");
		}
	}else if (isset($_GET['action']) && $_GET['action'] == 'users') {
		$id = $_GET['id'];
		$sql 	= "SELECT * FROM users WHERE users_id = '$id'";
		$result = $db->select($sql);
		$row 	= $result->fetch_assoc();
		$image 	= $row['user_image'];
		unlink($image);
		$sql = "DELETE FROM users WHERE users_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:user.php");
		}

	}else if (isset($_GET['action']) && $_GET['action'] == 'company_type') {

		$id = $_GET['id'];
		$sql = "DELETE FROM company_type WHERE type_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:company_type.php");
		}
		

	}else if (isset($_GET['action']) && $_GET['action'] == 'ledger_group') {

		$id = $_GET['id'];
		$sql = "DELETE FROM ledger_group WHERE ledger_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:ledger.php");
		}
		

	}else if (isset($_GET['action']) && $_GET['action'] == 'ledger_posting_head') {

		$id = $_GET['id'];
		$sql = "DELETE FROM ledger_posting_head WHERE ledger_posting_head_id  = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:ledger_sub_head_posting.php");
		}
		

	}else if (isset($_GET['action']) && $_GET['action'] == 'ledger_sub_group') {

		$id = $_GET['id'];
		$sql = "DELETE FROM ledger_sub_group WHERE ledger_sub_group_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:ledger_sub.php");
		}
		

	}else if (isset($_GET['action']) && $_GET['action'] == 'Business_type') {

		$id = $_GET['id'];
		$sql = "DELETE FROM Business_type WHERE Business_type_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:Businesstype.php");
		}
		

	}else if (isset($_GET['action']) && $_GET['action'] == 'countrycity') {

		$id = $_GET['id'];
		$sql = "DELETE FROM countrycity WHERE c_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:country.php");
		}
		

	}else if (isset($_GET['action']) && $_GET['action'] == 'Business_type') {

		$id = $_GET['id'];
		$sql = "DELETE FROM Business_type WHERE Business_type_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:Businesstype.php");
		}
		

	}else if (isset($_GET['action']) && $_GET['action'] == 'branch') {
		$id = $_GET['id'];
		$sql = "DELETE FROM branch WHERE Branch_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:addbranch.php");
		}
	}else if (isset($_GET['action']) && $_GET['action'] == 'budget') {

		$id = $_GET['id'];
		$sql = "DELETE FROM budget WHERE Budget_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:addbudget.php");
		}
		
	}else if (isset($_GET['action']) && $_GET['action'] == 'voucher_type') {

		$id = $_GET['id'];
		$sql = "DELETE FROM voucher_type WHERE voucher_type_id = '$id'";
		$result = $db->delete($sql);
		if ($result) {
			header("location:voucher_type.php");
		}
		
	}else{
		header("location:index.php");
	}


	


?>