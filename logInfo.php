<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User Activities</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL No.</th>
					<th>Username</th>
					<th>Login Time</th>
					<th>Logout Time</th>
					<th>User IP</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = "SELECT log_table.*, users.users_name FROM log_table INNER JOIN  users ON log_table.User_id = users.users_id ORDER BY log_table.RecentDate DESC, log_table.Login_time DESC";

					$result = $db->select($sql);
					if ($result) {
					$i = 1;
					while ($row = $result->fetch_assoc()) {
				?>
				<tr class="odd gradeX">
					<td><?php echo $i++; ?></td>
					<td><?php echo $row['users_name']; ?></td>
					<td><?php echo date("h:i:s A", strtotime($row['Login_time'])); ?></td>
					<td><?php
						if ($row['Logout_time'] == null) {
							echo "Runnig";
						}else{
							echo date("h:i:s A", strtotime($row['Logout_time'])); 
						}
					?></td>
					<td><?php echo $row['User_ip']; ?></td>
				</tr>
				<?php
						}
					}
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
