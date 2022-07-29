<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Compay Type</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['submit'])) {

                if (!empty($_POST['company_type'])) {
                   $company_type       = trim($_POST['company_type']);
                    $sql            = "SELECT * FROM company_type WHERE company_type = '$company_type'";
                    $CheckCompanyType     = $db->select($sql);
                }

                if(empty($_POST['company_type'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($CheckCompanyType){
                    echo "<p style='color:red;text-align:center;'>Company type already exists.</p>";
                }else{

                    $company_type = trim($_POST['company_type']);
                    $sql = "INSERT INTO company_type(company_type) VALUES('$company_type')";

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
                        <label>Company Type</label>
                    </td>
                    <td>
                        <input type="text" name="company_type" id="company_type" onkeyup="emptValid(this.id,'errcompany_type')" onblur="emptValid(this.id,'errcompany_type')" placeholder="Enter group..." class="medium" />

                         <small style="display:block;" id="errcompany_type"></small>
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
                    <th width="50">Company Type</th>
                    <th width="30%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $sql = "SELECT * FROM company_type ORDER BY company_type ASC";
                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['company_type']; ?></td>
                    <td>
                        <a href="company_type_update.php?update=<?php echo $row['type_id']; ?>">Edit</a>
                    <?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1) {
                    ?>
                         ||
                        <a onclick="return confirm('Are you sure to delete?')" href="delete.php?action=company_type&id=<?php echo $row['type_id']; ?>">Delete</a>
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
        
        var company_type   = $("#company_type").val();

        if ($.trim(company_type) == "") {
            $("#company_type").attr("style","border:2px solid red !important");
            $("#errcompany_type").html("Field must not be empty.").css("color","red");
            return false;

        }else if($.trim(company_type) !== ""){

           var check = "";

            $.ajax({
                async : false,
                url : "getExistData.php",
                data : {company_type:company_type},
                method : "post",
                dataType : "html",
                success : function(data){
                    if ($.trim(data) == "1") {
                        check = 1;
                    }
                }
            });

            if (check == "1") {
                $("#company_type").attr("style","border:2px solid red !important");
                $("#errcompany_type").html("Data already exist.").css("color","red");
                return false;
            }else{
                $("#company_type").attr("style","border:");
                $("#errcompany_type").html("").css("color","red");
            }

        }else{
             $("#errcompany_type").html("").css("color","");
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
