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
        <h2>City Update</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['update'])) {
                if(empty($_POST['country_name']) || empty($_POST['city_name'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else{
                    $update = $_GET['update'];
                    $country_name = $_POST['country_name'];
                    $city_name = $_POST['city_name'];

                    $sql = "UPDATE countrycity SET country_name = '$country_name', city_name = '$city_name' WHERE c_id = '$update'";
                    $result = $db->update($sql);
                    if ($result) {
                        echo "<script>window.location='country.php';</script>";
                    }else{
                       echo "<script>window.location='country.php';</script>";
                    }
                }
            }
        ?>
		 <?php 
            if (isset($_GET['update'])) {
               $update = $_GET['update'];
               $sql = "SELECT * FROM countrycity WHERE c_id='$update'";
               $result = $db->select($sql);
               if ($result) {

               $row = $result->fetch_assoc();
        ?>

        
         <form action="" method="post" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>City name</label>
                    </td>
                    <td>
                        <input type="text" name="city_name" id="city_name" onkeyup="emptValid(this.id,'errcity_name')" onblur="emptValid(this.id,'errcity_name')" value="<?php echo $row['city_name']; ?>" class="medium" />
                     <small style="display:block;" id="errcity_name"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Select Country</label>
                    </td>
                    <td>
                        <select name="country_name">
                           <option value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option>
                           
                        </select>
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
        
        var city_name   = $("#city_name").val();

        if ($.trim(city_name) == "") {
            $("#city_name").attr("style","border:2px solid red !important");
            $("#errcity_name").html("Field must not be empty.").css("color","red");
            return false;

        }else{
             $("#errgroupType").html("").css("color","");
        }

    });

</script>
<?php include "inc/admin_footer.php"; ?>
