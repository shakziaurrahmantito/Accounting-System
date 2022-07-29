<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Country & City</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['submit'])) {

                 if (!empty($_POST['city_name'])) {
                   $city_name       = trim($_POST['city_name']);
                    $sql            = "SELECT * FROM countrycity WHERE city_name = '$city_name'";
                    $Checkcity_name  = $db->select($sql);
                }

                if(empty($_POST['city_name'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($Checkcity_name){
                     echo "<p style='color:red;text-align:center;'>City name already exist.</p>";
                }else{

                    $city_name      = trim($_POST['city_name']);
                    $country_name   = $_POST['country_name'];
                    $sql = "INSERT INTO countrycity(city_name, country_name) VALUES('$city_name','$country_name')";

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
                        <label>City Name</label>
                    </td>
                    <td>
                        <input type="text" name="city_name" id="city_name" onkeyup="emptValid(this.id,'errcity_name')" onblur="emptValid(this.id,'errcity_name')" placeholder="Enter group..." class="medium" />

                         <small style="display:block;" id="errcity_name"></small>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Select Country</label>
                    </td>
                    <td>
                        <select name="country_name">
                            <option value="Bangladesh">Bangladesh</option>
                        </select>
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
                    <th>SL No.</th>        
                    <th>City</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $sql = "SELECT * FROM  countrycity";
                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['city_name']; ?></td>
                    <td><?php  echo $row['country_name'];?></td>
                    <td>
                        <a href="country_city_update.php?update=<?php echo $row['c_id'];?>"> Edit</a>
                    <?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1) {
                    ?>|| 
                        <a onclick="return confirm('Are you sure delete?')" href="delete.php?action=countrycity&id=<?php echo $row['c_id']; ?>">Delete</a>
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

    $('#city_name').autocomplete({
        source:'getAutocompletData.php',
        minLength:1,
        delay:500,
        autoFocus : true
    })
        
    $("#myForm").submit(function(){
        
        var city_name   = $("#city_name").val();

        if ($.trim(city_name) == "") {
            $("#city_name").attr("style","border:2px solid red !important");
            $("#errcity_name").html("Field must not be empty.").css("color","red");
            return false;

        }else if($.trim(city_name) !== ""){

           var check = "";

            $.ajax({
                async : false,
                url : "getExistData.php",
                data : {city_name:city_name},
                method : "post",
                dataType : "html",
                success : function(data){
                    if ($.trim(data) == "1") {
                        check = 1;
                    }
                }
            });

            if (check == "1") {
                $("#city_name").attr("style","border:2px solid red !important");
                $("#errcity_name").html("Data already exist.").css("color","red");
                return false;
            }else{
                $("#city_name").attr("style","border:");
                $("#errcity_name").html("").css("color","red");
            }



        }else{
             $("#errgroupType").html("").css("color","");
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
