<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<style type="text/css">
    .myTable{

    }
    .myTable td{
        text-align: center;
    }
</style>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Group</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['submit'])) {

                if (!empty($_POST['group_type_name'])) {
                   $groupName           = trim($_POST['group_type_name']);
                    $sql                = "SELECT * FROM group_type WHERE group_type_name = '$groupName'";
                    $CheckGroupName     = $db->select($sql);
                }

                if(empty($_POST['group_type_name']) || empty($_POST['debit_credit'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($CheckGroupName){
                     echo "<p style='color:red;text-align:center;'>Group name already exists.</p>";
                }else{
                    $group_type_name = $_POST['group_type_name'];
                    $debit_credit = $_POST['debit_credit'];
                    $result = $db->insert("INSERT INTO group_type(group_type_name, debit_credit) VALUES('$group_type_name','$debit_credit')");
                    if ($result) {
                       echo "<p style='color:green;text-align:center;'>Data insert successfully.</p>";
                    }else{
                        echo "<p style='color:red;text-align:center;'>Data not inserted.</p>";
                    }
                }
            }
        ?>
         <form action="" method="post" id="myForm" autocomplete="off">
            <table class="form">
                <tr>
                    <td>
						<label>Select Type</label>
                    </td>
                    <td>
                        <select name="debit_credit" id="debitCredit" onchange="emptValid(this.id,'errdebitCredit','select')">
                           <option value="">Select</option>
                           <option value="dr">Debit</option>
                           <option value="cr">Credit</option>
                        </select>
                        <small style="display:block;" id="errdebitCredit"></small>
                    </td>
                </tr>
                <tr>
                    <td>
					    <label>Group Type Name</label>
                    </td>
                    <td>
                        <input type="text" name="group_type_name" placeholder="Enter group..." class="medium" id="groupType" onkeyup="emptValid(this.id,'errgroupType')" onblur="emptValid(this.id,'errgroupType')"/>
                        
                        <small style="display:block;" id="errgroupType"></small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <br>
        <hr>
        <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>SL No.</th>        
                    <th>Group Name</th>
                    <th>Debit/Credit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $sql = "SELECT * FROM group_type";
                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['group_type_name']; ?></td>
                    <td><?php
                        if ($row['debit_credit'] == "dr") {
                            echo "Debit";
                        }else{
                            echo "Credit";
                        }
                     ?></td>
                    <td>
                        <a href="group_type_update.php?update=<?php echo $row['group_type_id']; ?>">Edit</a><?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1) {
                    ?> || 
                        <a onclick="return confirm('Are you sure delete?')" href="delete.php?action=group_type&id=<?php echo $row['group_type_id']; ?>">Delete</a>
                    <?php
                        }
                    ?>
                    </td>
                </tr>
            <?php } } ?>

            </tbody>
        </table>
        
    </div>
</div>

    <script type="text/javascript">
        
    $("#myForm").submit(function(){
        
		var debitCredit = $("#debitCredit").val();
        var groupType   = $("#groupType").val();

        if ($.trim(debitCredit) == "") {
             $("#debitCredit").attr("style","border:2px solid red !important");
            $("#errdebitCredit").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errDebitCredit").html("").css("color","");
        }


        if ($.trim(groupType) == "") {
            $("#groupType").attr("style","border:2px solid red !important");
            $("#errgroupType").html("Field must not be empty.").css("color","red");
            return false;

        }else if($.trim(groupType) !== ""){

           var check = "";

            $.ajax({
                async : false,
                url : "getExistData.php",
                data : {groupType:groupType},
                method : "post",
                dataType : "html",
                success : function(data){
                    if ($.trim(data) == "1") {
                        check = 1;
                    }
                }
            });

            if (check == "1") {
                $("#groupType").attr("style","border:2px solid red !important");
                $("#errgroupType").html("Data already exist.").css("color","red");
                return false;
            }else{
                $("#groupType").attr("style","border:");
                $("#errgroupType").html("").css("color","red");
            }



        }else{
             $("#errgroupType").html("").css("color","");
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
