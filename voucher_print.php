<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<style type="text/css">

table, th, td {
	border:1px solid black;
	border-collapse:collapse;
	border-spacing:0;
}
td{
	border:1px solid;
	padding:10px;	
	font-size:15px;
	font-weight:bold;
	}
table{
	width:70%;
	margin:auto;
	margin-top:20px;
	}
img{
	width:60px;
	height:60px;
	}
h3{
	color:skyblue;
	}


@media print{
	html, body {
		visibility: hidden;
		height:100vh; 
		margin: 0 !important; 
		padding: 0 !important;
		overflow: hidden;
	}
    .myTable{
        visibility: visible;
		border-collapse:collapse;
		border-spacing:0;
        top: 0;
        left: 0;
        position: absolute;
        width: 100%;
    }
}

</style>
   
<div class="grid_10">
	<div class="box round first grid">
		<h2> Voucher Preview</h2>
<?php 
    if (isset($_GET['vid'])) {
        $vid = $_GET['vid'];
        $sql = "SELECT 
        voucher.*,
        ledger_posting_head.posting_head_name
        FROM voucher INNER JOIN ledger_posting_head
        ON voucher.phosting_head_id = ledger_posting_head.ledger_posting_head_id
        WHERE sl_no = '$vid'";
        $result = $db->select($sql);
        if ($result) {
        $vRow = $result->fetch_assoc();
?>
	<table class="myTable">
		<tr>
			<td align="center" colspan="3">
				<img src="<?php 
					if(isset($icon['Company_logo'])){
						echo $icon['Company_logo'];
					}
					?>"> 
				<h1>
					 <?php 
						if(isset($icon['Company_name'])){
							echo $icon['Company_name'];
						}
					 ?>
				</h1>
				<p>Addres:
					<?php 
						if(isset($icon['Address'])){
							echo $icon['Address'];
						}
					?>
				</p>
			</td>    
		</tr>
		<tr>
			<td colspan="3">
				<h3 align="center"><?php echo $vRow['posting_head_name']; ?></h3>
				<h5 align="right">Refer No: <?php echo $vRow['check_no']; ?></h5>
				<h5 align="right">Date: <?php echo $vRow['check_date']; ?></h5>

			</td>    
		</tr>
		<tr height="40">
			<td colspan="3"> Amount:
				<?php 
					if ($vRow['debit_amount'] == null) {
						echo $vRow['Credit_amount'];
					}else{
						 echo $vRow['debit_amount'];
					}
				?>
			</td>
		</tr>
		<tr  height="30">
			<td colspan="3" align="center"><b> Mode of payment<b></td>
		</tr>
				
		<tr  height="30">
			<td colspan="3"> To Whome: <?php echo $vRow['prepared_by']; ?></td>
		</tr>
		<tr>
			<td colspan="2" height="80">Being:
				<?php 
					if ($vRow['debit_amount'] == null){
						echo $vRow['Credit_amount'];
					}else{
						echo $vRow['debit_amount'];
					}
				?>
			</td>
			<td height="40"> Payee: 
				<?php 
				 if ($vRow['debit_amount'] == null) {
						echo $vRow['Credit_amount'];
					}else{
						 echo $vRow['debit_amount'];
					}
				?>
			</td>
		</tr>
		<tr>
			<td height="60"> Approved By: <?php echo $vRow['prepared_by']; ?></td>
			<td height="60"> Paid By:</td>
			<td height="60"> Signature</td>
		</tr>
	</table>
	<div style="height:30px; text-align: center;">
		<button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);">Print</button>
	</div>
	<?php 

			}else{
	            echo "<script>location='index.php'</script>";
	       }
	   	}else{
	        echo "<script>location='index.php'</script>";
	    }	

	?>
	</div>
</div>

<?php include "inc/admin_footer.php"; ?>