<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<style type="text/css">

	.tg{
		text-align:center;
		width:70%;
		border-collapse:collapse;
		border-spacing:0;
		margin: 0 auto;
		margin-top:20px;
	}
	.tg th, td{
		vertical-align:top;
	}
	.tg img{
		max-width: 200px;
		max-height: 190px;
		box-shadow: 0px 0px 5px 0px gray;
		border-radius:15px !important;
		height: auto;
	    width: 180px;
	    margin-top: 13px;
	}
	.tg #name_deg{
		margin-bottom:30px;
		margin-top:10px;
		background:#f7f2f2;
		padding-top:10px;
		border-radius:10px !important;
		box-shadow: 0px 0px 3px 0px gray;
	}
	.tg .tg-0lax{
		min-width:220px;
		max-width:250px;
		background:#f7f2f2;
		padding:10px 0px 10px 10px;
	}
	.tg .tg-0rax{
		min-width:320px;
		max-width:380px;
		background:snow;
		padding:0px 10px 10px 10px;
	}
	.info{
		max-width: 400px;
		text-align:left;
	}	
	.info th{
		width:50%;
		text-align:right;
		padding-right:3%;
	}
	.tg #activity{
		text-align:left;
		background:#ede9e9;
		padding:10px 0px 10px 10px;
		margin-right:10px;
		border-radius:10px;
		box-shadow: 0px 1px 3px 0px gray;
		
	}

	@media print{

		html, body{
			visibility: hidden !important;
			height:100vh; 
			margin: 0 !important; 
			padding: 0 !important;
			overflow: hidden;
			position: relative;
		}


		.myTable{
			visibility: visible;
			border-collapse:collapse;
			border-spacing:0;
	        top: 0;
	        left: 0;
	        position: absolute;
	        width: 100%;
			border:2px dashed gray;
		}



		.info{
			max-width: 400px;
			text-align:left;
			overflow: hidden;
		}	

		.info th{
			margin-top: 20px;
			text-align:right;
			padding-right:3%;
			overflow: hidden;
		}

		

		.tg th, td{
			vertical-align:middle;
		}

		@page{
			size: auto;
	
		}
	}

</style>


    <div class="grid_10">
        <div class="box round first grid">
            <h2>Profile Preview</h2>
<?php 
$vid=$_GET['view'];
 $sql = "SELECT * FROM users WHERE users_id = '$vid'";
		$result = $db->select($sql);
		if ($result) {
		while($row = $result->fetch_assoc()){
?>

<table class="tg myTable">
	<tr>
		<td class="tg-0lax">
			<img src="<?php echo $row['user_image'];?>" alt="<?php echo $row['full_name'];?>">
		</td>
		<td class="tg-0rax" rowspan="2">
			<div id="name_deg">
				<h3><?php echo $row['full_name']; ?></h3>
				<p>
					<?php  $row['role_id'];
						if ($row['role_id']==1){
							echo 'Super Admin';
							}else if ($row['role_id']==2){
								echo 'Admin';
								}else{
									echo 'User';
									}
					?>
				</p>
			</div>
			<table class="info">
				<tr>
					<th>
					<label>User Id : </label>
					</th>
					<td>
					<p><?php echo $row['users_name']; ?></p>
					</td>
				</tr>
				<tr>
					<th>
					<label>Name : </label>
					</th>
					<td>
					<p><?php echo $row['full_name']; ?></p>
					</td>
				</tr>
				<tr>
					<th>
					<label>Email : </label>
					</th>
					<td>
					<p><?php echo $row['email']; ?></p>
					</td>
				</tr>
				<tr>
					<th>
					<label>Phone : </label>
					</th>
					<td>
					<p><?php echo $row['phone']; ?></p>
					</td>
				</tr>				
				<tr>
					<th>
					<label>Profile Created on : </label>
					</th>
					<td>
					<p><?php echo $row['account_creation_date']; ?></p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="tg-0lax">
			<div id="activity">
			<h5>Last Activities</h5>
			<label>Status : </label>	
				<?php $row['status']; 
							if($row['status']==1){
							echo 'Active';
							}else{
								echo 'Inactive';
							}
				
				?><br>
			<?php 
			$lsql = "SELECT * FROM log_table  WHERE User_id ='$vid' ORDER BY Log_id DESC LIMIT 1";
			$lresult = $db->select($lsql);
			if ($lresult) {
			while($lrow = $lresult->fetch_assoc()){
			?>	
			
				<label>Last Login Date : </label><?php echo $lrow['RecentDate'];?><br>
				<label>Login Time : </label><?php echo date("h:i:s A", strtotime($lrow['Login_time']));?><br>
				<label>Logout Time : </label><?php if ($lrow['Logout_time'] == null) {
				echo "Runnig";}else{echo date("h:i:s A", strtotime($lrow['Logout_time'])); }?>
				<br>
				<label>Last IP : </label><?php echo $lrow['User_ip']; ?><br>
			<?php
					}
				}
			?>
			</div>
		</td>
	</tr>
</table>
		<div style="height:30px; text-align: center;">
		<button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);">Print</button>
		</div>
<?php
		}
	}else{
	    echo "<script>location='index.php'</script>";
	}
?>
	</div>
</div>

 <?php include "inc/admin_footer.php"; ?>
