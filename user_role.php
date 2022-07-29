<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add User Role</h2>
       <div class="block copyblock"> 
         <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Role Name</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter username..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Permission</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Permission..." class="medium" />
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
    </div>
</div>

        
<?php include "inc/admin_footer.php"; ?>
