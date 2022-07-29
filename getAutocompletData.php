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
	
	$name 		= $_REQUEST['term'];
	$sql 		= "SELECT * FROM districts WHERE name LIKE '$name%'";
	$result 	= $db->select($sql);
	if ($result) {
		while ($row  = $result->fetch_assoc()) {
			$data[] = $row['name']; 
		}
		echo json_encode($data);
	}

?>