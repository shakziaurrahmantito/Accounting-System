<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<?php
    $role_id = Session::get("role_id");
    if ($role_id == 3 || $role_id == 2) {
        echo "<script>location='index.php';</script>";
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Company Logo Change</h2>
       <div class="block copyblock">
        <?php
            if (isset($imageChange)) {
                echo $imageChange;
            }
        ?>
         <form action="" method="post" onsubmit="emptValid(image.id,'errimage')" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    <td>
                       <input type="file" name="image" value="" id="image" onblur="emptValid(this.id,'errimage')">
					   <small style="display:block;" id="errimage"></small>
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
        </div>
    </div>
</div>

        
<?php include "inc/admin_footer.php"; ?>
