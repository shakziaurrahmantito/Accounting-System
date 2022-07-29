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
        <h2>Add Voucher Type</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['submit'])) {

                if (!empty($_POST['voucher_type_name'])) {
                   $voucher_type_name           = $voucher_type_name   = $db->link->real_escape_string(trim($_POST['voucher_type_name']));
                    $sql                = "SELECT * FROM voucher_type WHERE voucher_type_name = '$voucher_type_name'";
                    $Checkvoucher_type_name     = $db->select($sql);
                }

                if(empty($_POST['voucher_type_name']) || empty($_POST['voucher_type_nature'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($Checkvoucher_type_name){
                     echo "<p style='color:red;text-align:center;'>Voucher type name already exist.</p>";
                }else{

    $voucher_type_name   = $db->link->real_escape_string(trim($_POST['voucher_type_name']));
    $voucher_type_nature = $db->link->real_escape_string(trim($_POST['voucher_type_nature']));


                    $result = $db->insert("INSERT INTO voucher_type(voucher_type_name, voucher_type_nature) VALUES('$voucher_type_name','$voucher_type_nature')");
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
						<label>Select Voucher Nature</label>
                    </td>
                    <td>
                        <select name="voucher_type_nature" id="voucher_type_nature" onchange="emptValid(this.id,'errvoucher_type_nature','select')">
                           <option value="">Select</option>
                           <option value="in">IN</option>
                           <option value="out">OUT</option>
                        </select>
                        <small style="display:block;" id="errvoucher_type_nature"></small>
                    </td>
                </tr>
                <tr>
                    <td>
					    <label>Voucher Type Name</label>
                    </td>
                    <td>
                        <input type="text" name="voucher_type_name" placeholder="Enter voucher type..." class="medium" id="voucher_type_name" onkeyup="emptValid(this.id,'errvoucher_type_name')" onblur="emptValid(this.id,'errvoucher_type_name')"/>
                        <small style="display:block;" id="errvoucher_type_name"></small>
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
                    <th>Voucher Type Name</th>
                    <th>Voucher Type Nature</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $sql = "SELECT * FROM voucher_type";
                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['voucher_type_name']; ?></td>
                    <td><?php
                        if ($row['voucher_type_nature'] == "in") {
                            echo "IN";
                        }else{
                            echo "OUT";
                        }
                     ?></td>
                    <td>
                        <a href="voucher_type_update.php?update=<?php echo $row['voucher_type_id']; ?>">Edit</a>
                    <?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1) {
                    ?> || 
                        <a onclick="return confirm('Are you sure delete?')" href="delete.php?action=voucher_type&id=<?php echo $row['voucher_type_id']; ?>">Delete</a>
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
        
		var voucher_type_name = $("#voucher_type_name").val();
        var voucher_type_nature   = $("#voucher_type_nature").val();

        if ($.trim(voucher_type_nature) == "") {
             $("#voucher_type_nature").attr("style","border:2px solid red !important");
            $("#errvoucher_type_nature").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errvoucher_type_nature").html("").css("color","");
        }




        if ($.trim(voucher_type_name) == "") {
            $("#voucher_type_name").attr("style","border:2px solid red !important");
            $("#errvoucher_type_name").html("Field must not be empty.").css("color","red");
            return false;

        }else if($.trim(voucher_type_name) !== ""){

           var check = "";

            $.ajax({
                async : false,
                url : "getExistData.php",
                data : {voucher_type_name:voucher_type_name},
                method : "post",
                dataType : "html",
                success : function(data){
                    if ($.trim(data) == "1") {
                        check = 1;
                    }
                }
            });

            if (check == "1") {
                $("#voucher_type_name").attr("style","border:2px solid red !important");
                $("#errvoucher_type_name").html("Data already exist.").css("color","red");
                return false;
            }else{
                $("#voucher_type_name").attr("style","border:");
                $("#errvoucher_type_name").html("").css("color","red");
            }



        }else{
             $("#errvoucher_type_name").html("").css("color","");
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
