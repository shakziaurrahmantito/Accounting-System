<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Business Type</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['submit'])) {
                if (!empty($_POST['Business_type'])) {
                   $Business_type       = trim($_POST['Business_type']);
                    $sql            = "SELECT * FROM business_type WHERE Business_type = '$Business_type'";
                    $CheckBusiness_type  = $db->select($sql);
                }
                if(empty($_POST['Business_type'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($CheckBusiness_type){
                     echo "<p style='color:red;text-align:center;'>Business type already exist.</p>";
                }else{

                    $Business_type = trim($_POST['Business_type']);
                    $sql = "INSERT INTO business_type(Business_type) VALUES('$Business_type')";

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
                        <label>Business Type</label>
                    </td>
                    <td>
                        <input type="text" name="Business_type" id="Business_type" onkeyup="emptValid(this.id,'errBusiness_type')" onblur="emptValid(this.id,'errBusiness_type')" placeholder="Enter group..." class="medium" />

                         <small style="display:block;" id="errBusiness_type"></small>
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
    <hr>

        <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="20%">SL</th>        
                    <th width="50">Business Type</th>
                    <th width="30%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $sql = "SELECT * FROM Business_type ORDER BY Business_type DESC";
                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['Business_type']; ?></td>
                    <td>
                        <a href="Business_type_update.php?update=<?php echo $row['Business_type_id']; ?>">Edit</a>
                    <?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1) {
                    ?> || 
                        <a onclick="return confirm('Are you sure to delete?')" 
                           href="delete.php?action=Business_type&id=<?php echo $row['Business_type_id']; ?>">Delete</a>
                    <?php } ?>
                    </td>
                </tr>
            <?php } } ?>

            </tbody>
        </table>



    </div>
</div>

<script type="text/javascript">
        
    $("#myForm").submit(function(){
        
        var Business_type   = $("#Business_type").val();

        if ($.trim(Business_type) == "") {
            $("#Business_type").attr("style","border:2px solid red !important");
            $("#errBusiness_type").html("Field must not be empty.").css("color","red");
            return false;

        }else if($.trim(Business_type) !== ""){

           var check = "";

            $.ajax({
                async : false,
                url : "getExistData.php",
                data : {Business_type:Business_type},
                method : "post",
                dataType : "html",
                success : function(data){
                    if ($.trim(data) == "1") {
                        check = 1;
                    }
                }
            });

            if (check == "1") {
                $("#Business_type").attr("style","border:2px solid red !important");
                $("#errBusiness_type").html("Data already exist.").css("color","red");
                return false;
            }else{
                $("#Business_type").attr("style","border:");
                $("#errBusiness_type").html("").css("color","red");
            }

        }else{
             $("#errBusiness_type").html("").css("color","");
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
