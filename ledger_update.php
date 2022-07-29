<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<?php
    $role_id = Session::get("role_id");
    if ($role_id == 3) {
        echo "<script>location='index.php';</script>";
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Ledger Group</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['lupdate'])) {
				
				 $update = $_GET['update'];
				
                if(empty($_POST['ledger_name']) || empty($_POST['group_id'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else{

                    $ledger_name = trim($_POST['ledger_name']);
                    $group_id = $_POST['group_id'];
                    $sql = "UPDATE ledger_group SET ledger_name = '$ledger_name', group_id = '$group_id' WHERE ledger_id  = '$update'"; 


                    $result = $db->update($sql);
					if ($result) {
                        echo "<script>window.location='ledger.php';</script>";
                    }else{
                       echo "<script>window.location='ledger.php';</script>";
                    }
                }
            }
        ?>
		
		<?php 
            if (isset($_GET['update'])) {
               $update = $_GET['update'];
               $sql = "SELECT  
                    ledger_group.*,
                    group_type.group_type_name FROM
                    ledger_group INNER JOIN group_type
                    ON ledger_group.group_id = group_type.group_type_id
					WHERE ledger_group.ledger_id  = '$update'";
               $uresult = $db->select($sql);
               if ($uresult) {
               $urow = $uresult->fetch_assoc();
        ?>
		
         <form action="" method="post" id="myForm">
            <table class="form">
				<tr>
                    <td>
                        <label>Group Type</label>
                    </td>
                    <td>
                        <select name="group_id" id="group_id" onchange="emptValid(this.id,'errgroup_id','select')">
                           <option value="">Select group Type</option>
        <?php
                $sql = "SELECT * FROM group_type ORDER BY group_type_name ASC";
                $result = $db->select($sql);
                if ($result) {
					while($row = $result->fetch_assoc()){
						if ($row['group_type_id'] == $urow['group_id']) {
        ?>
				<option selected value="<?php echo $row['group_type_id']; ?>"><?php echo $row['group_type_name']; ?></option>
		<?php
						}else{
        ?>
			<option value="<?php echo $row['group_type_id']; ?>"><?php echo $row['group_type_name']; ?></option>
        <?php 
						}
					}
				}
        ?>        </select>
             <small style="display:block;" id="errgroup_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ledger Group Name</label>
                    </td>
                    <td>
                        <input type="text" name="ledger_name" id="ledger_name" onkeyup="emptValid(this.id,'errledger_name')" onblur="emptValid(this.id,'errledger_name')"  value="<?php echo $urow['ledger_name']; ?>" class="medium" />
                        <small style="display:block;" id="errledger_name"></small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="lupdate" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
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
</div>

<script type="text/javascript">
        
    $("#myForm").submit(function(){
        
        var group_id        = $("#group_id").val();
        var ledger_name     = $("#ledger_name").val();
        
        if ($.trim(group_id) == "") {
            $("#group_id").attr("style","border:2px solid red !important");
            $("#errgroup_id").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errgroup_id").html("").css("color","");
        }

        if ($.trim(ledger_name) == "") {
            $("#ledger_name").attr("style","border:2px solid red !important");
            $("#errledger_name").html("Field must not be empty.").css("color","red");
            return false;

        }else{
             $("#errledger_name").html("").css("color","");
        }
        
    });
</script>

<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();
        });
</script>
<?php include "inc/admin_footer.php"; ?>
