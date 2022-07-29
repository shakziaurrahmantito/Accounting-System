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
        <h2>Update Company Type</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['update'])) {
                if(empty($_POST['company_type'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else{
                    
                    $update = $_GET['update'];
                    $company_type = $_POST['company_type'];

        $sql = "UPDATE company_type SET company_type = '$company_type' WHERE type_id = '$update'";

                    $result = $db->update($sql);
                    if ($result) {
                        echo "<script>window.location='company_type.php';</script>";
                    }else{
                       echo "<script>window.location='company_type.php';</script>";
                    }
                }
            }
        ?>

        <?php 
            if (isset($_GET['update'])) {
               $update = $_GET['update'];
               $sql = "SELECT * FROM company_type WHERE type_id = '$update'";
               $result = $db->select($sql);
               if ($result) {

               $row = $result->fetch_assoc();
        ?>
         <form action="" method="post" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>Company Type</label>
                    </td>
                    <td>
                        <input type="text" name="company_type" id="company_type" onkeyup="emptValid(this.id,'errcompany_type')" onblur="emptValid(this.id,'errcompany_type')" value="<?php echo $row['company_type']; ?>" class="medium" />
                    <small style="display:block;" id="errcompany_type"></small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update" Value="update" />
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
        
        var company_type   = $("#company_type").val();

        if ($.trim(company_type) == "") {
            $("#company_type").attr("style","border:2px solid red !important");
            $("#errcompany_type").html("Field must not be empty.").css("color","red");
            return false;

        }else{
             $("#errcompany_type").html("").css("color","");
        }

    });

</script>

<?php include "inc/admin_footer.php"; ?>
