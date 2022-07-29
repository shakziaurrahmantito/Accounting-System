<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
.emp-profile{
    margin-top: 1%;
    margin-bottom: 1%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
	width: 250px;
    height: 250px;
}
.profile-img img{
    width: 80%;
    height: 90%;
    border-radius: 5%;
}

.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-work{
    padding: 5%;
    margin-top: -5%;
    margin-left: 2%;
	font-size: 12px;
}
.profile-tab{
	margin-top: -10%;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}

.row{
	width:100%;
	display:flex;
}

// Print Statrt

@page{
	page: auto;
}
@media print{
	html, body {
		visibility: hidden;
		height:100vh; 
		margin: 0 !important; 
		padding: 0 !important;
		overflow: hidden;
	}
	.emp-profile{
		visibility: visible;
		position: absolute;
		left: 0;
		top: 0;
	}

	.profile-head{
		width: 100%;
		margin-left: 50px;
	}

	.profile-tab{
		width: 100%;
		margin-left: 100px;
	}
	.profile-work{
		width: 200px;
	}
	.grid_6{
		width: 200px;
	}
	
}

</style>
</head>
<body>
<?php 
$vid=$_GET['view'];
 $sql = "SELECT * FROM users WHERE users_id = '$vid'";
		$result = $db->select($sql);
		if ($result) {
		while($row = $result->fetch_assoc()){
?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Profile</h2>

			<div class="emp-profile">
                <div class="row">
                    <div class="grid_4">
                        <div class="profile-img">
                            <img src="<?php echo $row['user_image'];?>" alt="<?php echo $row['full_name'];?>">
                        </div>
                    </div>
                    <div class="grid_8">
                        <div class="profile-head">
							<h5>
								<?php echo $row['full_name']; ?>
							</h5>
							<h6>
								<?php  $row['role_id'];
									if ($row['role_id']==1){
										echo 'Admin';
										}else if ($row['role_id']==2){
											echo 'Manager';
											}else{
												echo 'Employee';
												}
								?>
							</h6>
							<hr>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="grid_4">
                        <div class="profile-work">
                            <h5>Last Activities</h5>
        <?php 
		$lsql = "SELECT * FROM log_table  WHERE User_id ='$vid' ORDER BY Log_id DESC LIMIT 1";
		$lresult = $db->select($lsql);
		if ($lresult) {
		while($lrow = $lresult->fetch_assoc()){
		?>	
			<p>Last Login Date : <?php echo $lrow['RecentDate'];?></p>
			<p>Login Time: <?php echo $lrow['Login_time'];?></p>
			<p>Logout Time: <?php if ($lrow['Logout_time'] == null) {
			echo "Runnig";}else{echo $lrow['Logout_time']; }?>
			</p>
			<p>Last IP : <?php echo $lrow['User_ip']; ?></p>
		<?php
				}
			}
		?>
                        </div>
                    </div>
                    <div class="grid_8">
                        <div class="tab-content profile-tab">
								<div class="row">
									<div class="grid_6">
										<label>User Id</label>
									</div>
									<div class="grid_6">
										<p><?php echo $row['users_name']; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="grid_6">
										<label>Name</label>
									</div>
									<div class="grid_6">
										<p><?php echo $row['full_name']; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="grid_6">
										<label>Email</label>
									</div>
									<div class="grid_6">
										<p><?php echo $row['email']; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="grid_6">
										<label>Phone</label>
									</div>
									<div class="grid_6">
										<p><?php echo $row['phone']; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="grid_6">
										<label>Profile Created on</label>
									</div>
									<div class="grid_6">
										<p><?php echo $row['account_creation_date']; ?></p>
									</div>
								</div>								
								<div class="row">
									<div class="grid_6">
										<label>Status</label>
									</div>
									<div class="grid_6">
										<p><?php $row['status']; 
											if($row['status']==1){
											echo 'Active';
											}else{
												echo 'Inactive';
											}
											?>
										</p>
									</div>
								</div>
						<?php
						}
					}
						?>
							</div>
                        </div>
                    </div>
				 </div>
	<div style="height:30px; text-align: center;">
	<button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);}">Print</button>
	</div>
					
               
			</div>
        </div>
 <?php include "inc/admin_footer.php"; ?>
</body>
</html>
