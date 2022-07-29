<?php
    include_once("lib/Database.php");
    include_once("lib/Session.php");
    Session::init();
    if (Session::get("session") == false) {
        header("location:login.php");
    }
    $db = new Database();

    if (isset($_GET['action']) && $_GET['action'] == "logout") {
        date_default_timezone_set("Asia/Dhaka");
        $log_time = date("h:i:s A");
        $insert_Id = Session::get("insert_Id");
        $sql = "UPDATE log_table SET Logout_time = '$log_time' WHERE Log_id = '$insert_Id'";
        $db->update($sql);
        Session::destroy();
        header("location:login.php");
    }
?>

<?php 

	if (isset($_REQUEST['groupType'])) {
		$groupType = trim($_REQUEST['groupType']);

	$sql = "SELECT * FROM group_type WHERE group_type_name = '$groupType'";

		$result = $db->select($sql);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_REQUEST['ledger_name'])){

		$ledger_name = trim($_REQUEST['ledger_name']);

		$sql = "SELECT * FROM ledger_group WHERE ledger_name = '$ledger_name'";
		$result = $db->select($sql);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}

	}else if(isset($_REQUEST['posting_head_name'])){

		$posting_head_name = trim($_REQUEST['posting_head_name']);

		$sql = "SELECT * FROM ledger_posting_head WHERE posting_head_name = '$posting_head_name'";
		$result = $db->select($sql);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_REQUEST['ledger_sub_group_name'])){

		$ledger_sub_group_name = trim($_REQUEST['ledger_sub_group_name']);

		$sql = "SELECT * FROM ledger_sub_group WHERE ledger_sub_group_name = '$ledger_sub_group_name'";
		$result = $db->select($sql);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_REQUEST['city_name'])){

		$city_name = trim($_REQUEST['city_name']);

		$sql = "SELECT * FROM countrycity WHERE city_name = '$city_name'";
		$result = $db->select($sql);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_REQUEST['Business_type'])){

		$Business_type = trim($_REQUEST['Business_type']);

		$sql = "SELECT * FROM business_type WHERE Business_type = '$Business_type'";
		$result = $db->select($sql);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_REQUEST['company_type'])){

		$company_type = trim($_REQUEST['company_type']);

		$sql = "SELECT * FROM company_type WHERE company_type = '$company_type'";
		$result = $db->select($sql);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_REQUEST['voucher_type_name'])){
		 $voucher_type_name   = $db->link->real_escape_string(trim($_REQUEST['voucher_type_name']));

		$sql = "SELECT * FROM voucher_type WHERE voucher_type_name = '$voucher_type_name'";
		$result = $db->select($sql);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_REQUEST['get_username'])){
		 $get_username   = $db->link->real_escape_string(trim($_REQUEST['get_username']));
		$sql = "SELECT * FROM users WHERE users_name = '$get_username'";
		$result = $db->select($sql);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}
	

?> 