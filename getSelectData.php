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
	//------------------ Condition Start----------------

if (isset($_REQUEST['ledger_group_id'])) {

?>

 <option value="">Select sub group Type</option>
<?php

	$ledger_group_id = $_REQUEST['ledger_group_id'];
	$sql = "SELECT * FROM ledger_sub_group WHERE ledger_sub_group_parent_id = '$ledger_group_id'";
	$result = $db->select($sql);
	if ($result) {
	while($row = $result->fetch_assoc()){
?>
<option value="<?php echo $row['ledger_sub_group_id']; ?>"><?php echo $row['ledger_sub_group_name']; ?></option>
<?php }} ?>

<?php 
}
//--------------Condition End--------
	
?>

<?php 
	//------------------ Condition Start----------------

if (isset($_REQUEST['Group_id'])) {

?>

 <option value="">Select Sub Group</option>
<?php

	$Group_id = $_REQUEST['Group_id'];
	$sql = "SELECT * FROM ledger_sub_group WHERE ledger_sub_group_parent_id = '$Group_id'";
	$result = $db->select($sql);
	if ($result) {
	while($row = $result->fetch_assoc()){
?>
<option value="<?php echo $row['ledger_sub_group_id']; ?>"><?php echo $row['ledger_sub_group_name']; ?></option>
<?php }} ?>

<?php 
}
//--------------Condition End--------
	
?>

<?php 
	//------------------ Condition Start----------------

if (isset($_REQUEST['Sub_group_id'])) {

?>

 <option value="">Select Posting Head</option>
<?php

	$Sub_group_id = $_REQUEST['Sub_group_id'];
	$sql = "SELECT * FROM ledger_posting_head WHERE ledger_sub_group_id = '$Sub_group_id'";
	$result = $db->select($sql);
	if ($result) {
	while($row = $result->fetch_assoc()){
?>
<option value="<?php echo $row['ledger_posting_head_id']; ?>"><?php echo $row['posting_head_name']; ?></option>
<?php }} ?>

<?php 
}
//--------------Condition End--------
	
?>






<?php 
	//------------------ Condition Start----------------

if (isset($_REQUEST['ledger_id'])) {

?>

 <option value="">Select ledger group type</option>
<?php

	$ledger_id = $_REQUEST['ledger_id'];

	$sql = "SELECT * FROM ledger_sub_group WHERE ledger_sub_group_parent_id = '$ledger_id'";

	$result = $db->select($sql);
	if ($result) {
	while($row = $result->fetch_assoc()){
?>
<option value="<?php echo $row['ledger_sub_group_id']; ?>"><?php echo $row['ledger_sub_group_name']; ?></option>
<?php }} ?>

<?php 
}
//--------------Condition End--------
	
?>



<?php 
	//------------------ Condition Start----------------

if (isset($_REQUEST['sub_goup_id'])) {

?>

 <option value="">Select posting type</option>
<?php

	$sub_goup_id = $_REQUEST['sub_goup_id'];

	$sql = "SELECT * FROM ledger_posting_head WHERE ledger_sub_group_id = '$sub_goup_id'";

	$result = $db->select($sql);
	if ($result) {
	while($row = $result->fetch_assoc()){
?>
<option value="<?php echo $row['ledger_posting_head_id']; ?>"><?php echo $row['posting_head_name']; ?></option>
<?php }} ?>

<?php 
}
//--------------Condition End--------
	
?>

<?php 
	//------------------Get_ledger_id Start----------------

if (isset($_REQUEST['get_ledger_id'])) {

		$get_ledger_id = $_REQUEST['get_ledger_id'];

		$sql = "SELECT ledger_group.*,
	 	group_type.debit_credit FROM 
	 	ledger_group INNER JOIN group_type
	   	ON ledger_group.group_id = group_type.group_type_id WHERE ledger_group.ledger_id = '$get_ledger_id'";

		$result = $db->select($sql);
		if ($result) {
		$row = $result->fetch_assoc();
			echo $row['debit_credit'];
		}
	}



//--------------Get_ledger_id End--------
	
?>


<?php 
	//------------------Merge value Start----------------

if (isset($_REQUEST['voucher_type']) && isset($_REQUEST['debit_amount'])) {

		$totalBalance = 0;

		$voucher_type = $_REQUEST['voucher_type'];
		$debit_amount = $_REQUEST['debit_amount'];

		$sql = "SELECT * FROM voucher_type WHERE voucher_type_id = '$voucher_type'";
		$result = $db->select($sql);

		if ($result) {
			$row = $result->fetch_assoc();
			if ($row['voucher_type_nature'] == "out") {


				$sqls = "SELECT * FROM opening_balance WHERE Debit_credit = 'cr'";
		        $crresult = $db->select($sqls);
		        if ($crresult) {
		            $crTotal = 0;
		            while($row = $crresult->fetch_assoc()){
		                $crTotal += $row['Amount'];
		            }
		        }

		        $sql = "SELECT * FROM opening_balance WHERE Debit_credit = 'dr'";
		        $result = $db->select($sql);
		        if ($result) {
		            $drTotal = 0;
		            while($row = $result->fetch_assoc()){
		                $drTotal += $row['Amount'];
		            }
		          
		        }


		        $totalBalance = (int) $crTotal-$drTotal;

		        if ($totalBalance < $debit_amount OR $totalBalance < 0) {
		        	echo 1;
		        }else{
		        	echo 0;
		        }
			}
		}


		if ($totalBalance == 0) {
		    echo 1;
		 }else{
		    echo 0;
		}


	}



	//------------------Merge value Start----------------
	
?>



<?php 
	//------------------Get Voucher No Start----------------
	
if (isset($_REQUEST['getvoucher_no']) && isset($_REQUEST['branch_id']) ) {
		$branch_id = $_REQUEST['branch_id'];
		$sql = "SELECT voucher_no FROM voucher WHERE branch_id = '$branch_id' ORDER BY sl_no DESC LIMIT 1";
		$result = $db->select($sql);
		if($result){
			$row = $result->fetch_assoc();
			$int = (int) filter_var($row['voucher_no'],FILTER_SANITIZE_NUMBER_INT);
			echo $int+1;
			
		}else{
			
			echo "";
		}
}

		//------------------Get Voucher No End----------------
	
?>

