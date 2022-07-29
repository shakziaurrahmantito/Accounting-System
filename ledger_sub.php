<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Ledger Sub Group</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['submit'])) {

                if (!empty($_POST['ledger_sub_group_name'])) {
                   $ledger_sub_group_name       = trim($_POST['ledger_sub_group_name']);
                    $sql            = "SELECT * FROM ledger_sub_group WHERE ledger_sub_group_name = '$ledger_sub_group_name'";
                    $Checkledger_sub_group_name  = $db->select($sql);
                }

                if(empty($_POST['ledger_sub_group_parent_id']) || empty($_POST['ledger_sub_group_name'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($Checkledger_sub_group_name){
                     echo "<p style='color:red;text-align:center;'>Ledger sub group already exist.</p>";
                }else{

                    $ledger_sub_group_parent_id = $_POST['ledger_sub_group_parent_id'];
                    $ledger_sub_group_name = trim($_POST['ledger_sub_group_name']);

                    $sql = "INSERT INTO  ledger_sub_group(ledger_sub_group_name,ledger_sub_group_parent_id) VALUES('$ledger_sub_group_name','$ledger_sub_group_parent_id')";
                    
                    $result = $db->insert($sql);
                    if ($result) {
                       echo "<p style='color:green;text-align:center;'>Data insert successfully.</p>";
                    }else{
                        echo "<p style='color:red;text-align:center;'>Data not inserted.</p>";
                    }
                }
            }
        ?>
         <form action="" method="post" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>Ledger Parent Type</label>
                    </td>
                    <td>
                        <select name="ledger_sub_group_parent_id" id="ledger_sub_group_parent_id" onchange="emptValid(this.id,'errledger_sub_group_parent_id','select')">
                           <option value="">Select group Type</option>
        <?php
                $sql = "SELECT * FROM ledger_group ORDER BY ledger_name ASC";
                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
        ?>
                    <option value="<?php echo $row['ledger_id']; ?>"><?php echo $row['ledger_name']; ?></option>
        <?php 
                }
            }
        ?>         </select>
         <small style="display:block;" id="errledger_sub_group_parent_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ledger Sub Group Name</label>
                    </td>
                    <td>
                        <input type="text" name="ledger_sub_group_name" id="ledger_sub_group_name" placeholder="Enter ledger sub group name" class="medium" onkeyup="emptValid(this.id,'errledger_sub_group_name')" onblur="emptValid(this.id,'errledger_sub_group_name')" >
                        <small style="display:block;" id="errledger_sub_group_name"></small>
                    </td>
                </tr>
                <tr>				
				
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="20%">SL</th>        
                    <th width="30%">Group Name</th>
                    <th width="30%">Sub Group Name</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $sql = "SELECT  
                    ledger_sub_group.*,
                     ledger_group.ledger_name FROM
                    ledger_sub_group INNER JOIN ledger_group
                    ON ledger_sub_group.ledger_sub_group_parent_id = ledger_group.ledger_id ORDER BY ledger_sub_group.	ledger_sub_group_name ASC";
                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['ledger_name']; ?></td>
					<td><?php echo $row['ledger_sub_group_name']; ?></td>
                    <td>
                        <a href="ledger_sub_update.php?update=<?php echo $row['ledger_sub_group_id']; ?>">Edit</a>
                    <?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1) {
                    ?> || 
                        <a onclick="return confirm('Are you sure to delete?')" href="delete.php?action=ledger_sub_group&id=<?php echo $row['ledger_sub_group_id']; ?>">Delete</a>
                    </td>
                    <?php
                       }
                    ?>
                </tr>
            <?php } } ?>

            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">

//----------Submit Option Validiton---------

    $("#myForm").submit(function(){
        
        var ledger_sub_group_parent_id  = $("#ledger_sub_group_parent_id").val();
        var ledger_sub_group_name       = $("#ledger_sub_group_name").val();

        if ($.trim(ledger_sub_group_parent_id) == "") {
             $("#ledger_sub_group_parent_id").attr("style","border:2px solid red !important");
            $("#errledger_sub_group_parent_id").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errledger_sub_group_parent_id").html("").css("color","");
        }

        if ($.trim(ledger_sub_group_name) == "") {
            $("#ledger_sub_group_name").attr("style","border:2px solid red !important");
            $("#errledger_sub_group_name").html("Field must not be empty.").css("color","red");
            return false;

        }else if($.trim(ledger_sub_group_name) !== ""){

           var check = "";

            $.ajax({
                async : false,
                url : "getExistData.php",
                data : {ledger_sub_group_name:ledger_sub_group_name},
                method : "post",
                dataType : "html",
                success : function(data){
                    if ($.trim(data) == "1") {
                        check = 1;
                    }
                }
            });

            if (check == "1") {
                $("#ledger_sub_group_name").attr("style","border:2px solid red !important");
                $("#errledger_sub_group_name").html("Data already exist.").css("color","red");
                return false;
            }else{
                $("#ledger_sub_group_name").attr("style","border:");
                $("#errledger_sub_group_namee").html("").css("color","red");
            }
        }else{
             $("#errledger_sub_group_name").html("").css("color","");
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
