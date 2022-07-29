<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<style type="text/css">
    .myTable{

    }
    .myTable td{
        text-align: center;
    }
</style>

<?php
    $role_id = Session::get("role_id");
    if ($role_id == 3) {
        echo "<script>location='index.php';</script>";
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Business Type</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['update'])) {
                if(empty($_POST['Business_type'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else{
                    $update = $_GET['update'];
                    $Business_type = $_POST['Business_type'];

                    $sql = "UPDATE business_type SET Business_type = '$Business_type' WHERE Business_type_id = '$update'";
                    $result = $db->update($sql);
                    if ($result) {
                        echo "<script>window.location='businesstype.php';</script>";
                    }else{
                       echo "<script>window.location='businesstype.php';</script>";
                    }
                }
            }
        ?>

        <?php 
            if (isset($_GET['update'])) {
               $update = $_GET['update'];
               $sql = "SELECT * FROM business_type WHERE Business_type_id = '$update'";
               $result = $db->select($sql);
               if ($result) {

               $row = $result->fetch_assoc();
        ?>
         <form action="" method="post" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>Business Type</label>
                    </td>
                    <td>
                        <input type="text" name="Business_type" id="Business_type" onkeyup="emptValid(this.id,'errBusiness_type')" onblur="emptValid(this.id,'errBusiness_type')" value="<?php echo $row['Business_type']; ?>" class="medium" />
                    <small style="display:block;" id="errBusiness_type"></small>
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
        
        var Business_type   = $("#Business_type").val();

        if ($.trim(Business_type) == "") {
            $("#Business_type").attr("style","border:2px solid red !important");
            $("#errBusiness_type").html("Field must not be empty.").css("color","red");
            return false;

        }else{
             $("#errBusiness_type").html("").css("color","");
        }

    });



    </script>
<?php include "inc/admin_footer.php"; ?>
