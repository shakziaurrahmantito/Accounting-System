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
        <h2>Update Voucher Type</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['update'])) {

                if (!empty($_POST['voucher_type_name'])) {
                   $voucher_type_name           = $voucher_type_name   = $db->link->real_escape_string(trim($_POST['voucher_type_name']));
                    $sql                = "SELECT * FROM voucher_type WHERE voucher_type_name = '$voucher_type_name'";
                    $Checkvoucher_type_name     = $db->select($sql);
                }

                if(empty($_POST['voucher_type_name']) || empty($_POST['voucher_type_nature'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else{

                $update = $_GET['update'];

    $voucher_type_name   = $db->link->real_escape_string(trim($_POST['voucher_type_name']));
    $voucher_type_nature = $db->link->real_escape_string(trim($_POST['voucher_type_nature']));

                    
                    $result = $db->update("UPDATE voucher_type SET voucher_type_name = '$voucher_type_name', voucher_type_nature = '$voucher_type_nature' WHERE voucher_type_id ='$update'");
                    if ($result) {
                        echo "<script>window.location='voucher_type.php';</script>";
                    }else{
                        echo "<script>window.location='voucher_type.php';</script>";
                    }
                }
            }
        ?>

        <?php 

            if (isset($_GET['update'])) {
                $update = $_GET['update'];

                $usql = "SELECT * FROM voucher_type WHERE voucher_type_id = '$update'";
                $uresult = $db->select($usql);
                if ($uresult) {
                    $urow = $uresult->fetch_assoc();
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
                        <?php if ($urow['voucher_type_nature'] == 'in') { ?>
                            <option selected value="in">IN</option>
                           <option value="out">OUT</option>
                        <?php } ?>

                        <?php if ($urow['voucher_type_nature'] == 'out') { ?>
                            <option value="in">IN</option>
                           <option selected value="out">OUT</option>
                        <?php } ?>

                        </select>
                        <small style="display:block;" id="errvoucher_type_nature"></small>
                    </td>
                </tr>
                <tr>
                    <td>
					    <label>Voucher Type Name</label>
                    </td>
                    <td>
                        <input type="text" name="voucher_type_name" value="<?php echo $urow['voucher_type_name']; ?>" class="medium" id="voucher_type_name" onkeyup="emptValid(this.id,'errvoucher_type_name')" onblur="emptValid(this.id,'errvoucher_type_name')"/>
                        <small style="display:block;" id="errvoucher_type_name"></small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update" Value="Update" />
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
