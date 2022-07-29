<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<?php
    $role_id = Session::get("role_id");
    if ($role_id == 3) {
        echo "<script>location='index.php';</script>";
    }
?>
<style type="text/css">
    .myTable{

    }
    .myTable td{
        text-align: center;
    }
</style>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Group</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['update'])) {
                if(empty($_POST['group_type_name']) || empty($_POST['debit_credit'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else{
                    $update = $_GET['update'];
                    $group_type_name = $_POST['group_type_name'];
                    $debit_credit = $_POST['debit_credit'];

                    $sql = "UPDATE group_type SET group_type_name = '$group_type_name', debit_credit = '$debit_credit' WHERE group_type_id = '$update'";
                    $result = $db->update($sql);
                    if ($result) {
                        echo "<script>window.location='group_type.php';</script>";
                    }else{
                       echo "<script>window.location='group_type.php';</script>";
                    }
                }
            }
        ?>

        <?php 
            if (isset($_GET['update'])) {
               $update = $_GET['update'];
               $sql = "SELECT * FROM group_type WHERE group_type_id = '$update'";
               $result = $db->select($sql);
               if ($result) {

               $row = $result->fetch_assoc();
        ?>
         <form action="" method="post" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>Select Type</label>
                    </td>
                    <td>
                        <select name="debit_credit" id="debitCredit" onchange="emptValid(this.id,'errdebitCredit','select')">
                           <option value="">Select</option>
                           <option <?php if ($row['debit_credit'] == "dr") {
                                   echo "selected";
                                }?> value="dr">Debit</option>
                           <option <?php if ($row['debit_credit'] == "cr") {
                                   echo "selected";
                                }?> value="cr">Credit</option>
                        </select>
                        <small style="display:block;" id="errdebitCredit"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Group Type Name</label>
                    </td>
                    <td>
                        <input type="text" name="group_type_name" id="groupType" onkeyup="emptValid(this.id,'errgroupType')" onblur="emptValid(this.id,'errgroupType')"    value="<?php echo $row['group_type_name']; ?>" class="medium" />
                        <small style="display:block;" id="errgroupType"></small>
                    
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

        }else{
             $("#errgroupType").html("").css("color","");
        }

    });



    </script>
<?php include "inc/admin_footer.php"; ?>
