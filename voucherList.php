<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>


<?php 
	
	if (isset($_GET['action']) && $_GET['action'] == "confirm") {
		
		$trnsId = $_GET['trnsId'];

		$sql = "SELECT * FROM voucher WHERE sl_no = '$trnsId'";
		$result = $db->select($sql);
		$row = $result->fetch_assoc();

		$voucher_no 		= $row['voucher_no'];
		$ledger_id 			= $row['ledger_id'];
		$sub_goup_id 		= $row['sub_goup_id'];
		$phosting_head_id 	= $row['phosting_head_id'];
		$debit_amount 		= $row['debit_amount'];
		$Credit_amount 		= $row['Credit_amount'];

		$amount = 0;

		if ($debit_amount !== null) {
			$Debit_credit = "dr";
			$amount =  $row['debit_amount'];
		}else if($Credit_amount !== null){
			$Debit_credit = "cr";
			$amount =  $row['Credit_amount'];
		}

		$isql = "INSERT INTO opening_balance(
                        Voucher_no,
                        ledger_id,
                        Sub_group_id,
                        Posting_head_id,
                        Debit_credit,
                        Amount) 
                        VALUES('$voucher_no',
                            '$ledger_id',
                            '$sub_goup_id',
                            '$phosting_head_id',
                             '$Debit_credit',
                            '$amount')";
            $result = $db->insert($isql);

            $sql = "UPDATE voucher SET voucher_status ='0' WHERE sl_no = '$trnsId'";
            $userResult = $db->update($sql);

            if ($result && $userResult) {
            	echo "<script>location='voucherList.php'</script>";
            }



	}

?>








<div class="grid_10">
    <div class="box round first grid">
        <h2>Voucher List</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="5%">SL</th>
					<th width="10%">Voucher No</th>
					<th width="10%">Date</th>
					<th width="10%">Title</th>
					<th width="8%">Debit</th>
					<th width="8%">Credit</th>
					<th width="15%">Check No</th>
					<th width="10%">Status</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = "SELECT 
					voucher.*,
					ledger_posting_head.posting_head_name FROM
					voucher INNER JOIN ledger_posting_head
					ON voucher.phosting_head_id = ledger_posting_head.ledger_posting_head_id ORDER BY voucher.sl_no DESC";

					$result = $db->select($sql);
					if ($result) {
					$i = 1;
					while ($row = $result->fetch_assoc()) {
				?>
				<tr class="odd gradeX">
					<td><?php echo $i++; ?></td>
					<td><?php echo $row['voucher_no']; ?></td>
					<td><?php echo $row['voucher_date']; ?></td>
					<td><?php echo $row['posting_head_name']; ?></td>
					<td><?php echo $row['debit_amount']; ?></td>
					<td><?php echo $row['Credit_amount']; ?></td>
					<td><?php echo $row['check_no']; ?></td>
					<td>
						<?php
						 	if ($row['voucher_status'] == "0") {
						 	 	echo "Paid";
						 	 }else{
						?>
						<a href="?action=confirm&trnsId=<?php echo $row['sl_no']; ?>" onclick="return confirm('Are you sure to pay?')">Unpaid</a>
						<?php
						 	 }
						 ?>
					</td>
					<td>
						<?php
							if ($row['voucher_status'] == 1) {
						?>
						<a href="voucherUpdate.php?update=<?php echo $row['sl_no']; ?>">Edit</a> || 
					<?php
						 } else{
						 	echo "N/A || "; 
						 }
					?>
					<a href="voucher_print.php?vid=<?php echo $row['sl_no']; ?>">View</a>
					</td>
				</tr>
				<?php
					}}
				 ?>

			</tbody>
		</table>
       </div>
    </div>
</div>

 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();
        });
</script>

<?php include "inc/admin_footer.php"; ?>
