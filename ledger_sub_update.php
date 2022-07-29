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
        <h2>Update Ledger Sub Group</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['lsupdate'])) {
				
				 $update = $_GET['update'];

                if(empty($_POST['ledger_sub_group_parent_id']) || empty($_POST['ledger_sub_group_name'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else{

                    $ledger_sub_group_parent_id = $_POST['ledger_sub_group_parent_id'];
                    $ledger_sub_group_name = trim($_POST['ledger_sub_group_name']);
                    $sql = "UPDATE ledger_sub_group SET ledger_sub_group_name = '$ledger_sub_group_name', ledger_sub_group_parent_id = '$ledger_sub_group_parent_id' WHERE ledger_sub_group_id  = '$update'";
                    
                    $result = $db->update($sql);
                    if ($result) {
                        echo "<script>window.location='ledger_sub.php';</script>";
                    }else{
                       echo "<script>window.location='ledger_sub.php';</script>";
                    }
                
                }
            }
        ?>
		
		<?php 
            if (isset($_GET['update'])) {
               $update = $_GET['update'];
               $sql = "SELECT ledger_sub_group.*,
                    ledger_group.ledger_name FROM
                    ledger_sub_group INNER JOIN ledger_group
                    ON ledger_sub_group.ledger_sub_group_parent_id = ledger_group.ledger_id
					WHERE ledger_sub_group.ledger_sub_group_id  = '$update'";
               $uresult = $db->select($sql);
               if ($uresult) {
               $urow = $uresult->fetch_assoc();
        ?>
         <form action="" method="post" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>Ledger Parent Type</label>
                    </td>
                    <td>
                        <select name="ledger_sub_group_parent_id" id="ledger_sub_group_parent_id" onchange="emptValid(this.id,'errledger_sub_group_parent_id','select')">
                           <option value="">Select Parent Type</option>
       <?php
                $sql = "SELECT * FROM ledger_group ORDER BY ledger_name ASC";
                $result = $db->select($sql);
                if ($result) {
					while($row = $result->fetch_assoc()){
						if ($row['ledger_id'] == $urow['ledger_sub_group_parent_id']) {
        ?>
				<option selected value="<?php echo $row['ledger_id']; ?>"><?php echo $row['ledger_name']; ?></option>
		<?php
						}else{
        ?>
			<option value="<?php echo $row['ledger_id']; ?>"><?php echo $row['ledger_name']; ?></option>
        <?php 
						}
					}
				}
        ?></select>
        <small style="display:block;" id="errledger_sub_group_parent_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ledger Sub Group Name</label>
                    </td>
                    <td>
                        <input type="text" name="ledger_sub_group_name" id="ledger_sub_group_name" placeholder="Enter ledger sub group name" class="medium" onkeyup="emptValid(this.id,'errledger_sub_group_name')" onblur="emptValid(this.id,'errledger_sub_group_name')"   value="<?php echo $urow['ledger_sub_group_name']; ?>" class="medium" />
                        <small style="display:block;" id="errledger_sub_group_name"></small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="lsupdate" Value="Save" />
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

<script type="text/javascript">

//----------Submit Option Validiton---------

    $("#myForm").submit(function(){
        
        var ledger_sub_group_parent_id  = $("#ledger_sub_group_parent_id").val();
        var ledger_sub_group_name       = $("#ledger_sub_group_name").val();

        if ($.trim(ledger_sub_group_parent_id) == "") {
             $("#ledger_sub_group_parent_id").attr("style","border:2px solid red !important");
            $("#errledger_sub_group_parent_id").html("Please select any options.").css("color","red");
            return false;
        }else{
             $("#errledger_sub_group_parent_id").html("").css("color","");
        }

        if ($.trim(ledger_sub_group_name) == "") {
            $("#ledger_sub_group_name").attr("style","border:2px solid red !important");
            $("#errledger_sub_group_name").html("Field must not be empty.").css("color","red");
            return false;

        }else{
             $("#errledger_sub_group_name").html("").css("color","");
        }


    });


</script>
    
<?php include "inc/admin_footer.php"; ?>
