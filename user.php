<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<?php
    echo Session::get('msg');
    Session::set('msg',null);
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Users</h2>
        <?php 
            if (Session::get("role_id") == 1) {
        ?>
       <div class="block copyblock">

            <?php

                if (isset($_POST['submit'])) {

                    $users_name = $_POST['username'];
                    $sql = "SELECT * FROM users WHERE users_name = '$users_name'";
                    $usernameResult = $db->select($sql);


                    if (empty($_POST['username']) || empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['phone']) ||empty($_POST['password']) || empty($_POST['role'])) {
                        echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                    }else if(preg_match("/[^a-z0-9_]/", $_POST['username'])){
                        echo "<p style='color:red;text-align:center;'>Username invalid.</p>";
                    }else if($usernameResult){
                        echo "<p style='color:red;text-align:center;'>Username already exists.</p>";
                    }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        echo "<p style='color:red;text-align:center;'>Email address invalid.</p>";
                    }else{
                        $permission = array("jpg","png");
                        if (empty($_FILES['image']['name']) || $_FILES['image']['size'] > 1048576) {
                            echo "<p style='color:red;text-align:center;'>Please chose any image and max size 3 mb.</p>";
                        }else if(!in_array(strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION)), $permission)){
                            echo "<p style='color:red;text-align:center;'>You can only upload jpg, png.</p>";
                        }else{

                            $img_name   = $_FILES['image']['name'];
                            $tmp_name   = $_FILES['image']['tmp_name'];
                            $extension  = pathinfo($img_name,PATHINFO_EXTENSION);
                            $uId        = uniqid();
                            $path       = "uploads/".$uId.".".strtolower($extension);
                            $users_name = $_POST['username'];
                            $full_name  = $_POST['fullname'];
                            $email      = $_POST['email'];
                            $phone      = $_POST['phone'];
                            $password   = md5($_POST['password']);
                            $role_id    = $_POST['role'];
                            $sql = "INSERT INTO users(users_name,full_name,email,phone,password,role_id,user_image) VALUES('$users_name','$full_name','$email','$phone','$password','$role_id','$path')";
                            $result = $db->insert($sql);
                            move_uploaded_file($tmp_name,$path);
                            if ($result > 0) {
                               echo "<p style='color:green;text-align:center;'>Data insert successfully.</p>";
                            }else{
                                 echo "<p style='color:red;text-align:center;'>Data not inserted.</p>";
                            }
                        }
                        
                    }
                }
             ?>
         <form action="" method="post" id="myForm" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="fullname" id="fullname" onkeyup="emptValid(this.id,'errfullname')" onblur="emptValid(this.id,'errfullname')"placeholder="Enter name..." class="medium" />

                        <small style="display:block;" id="errfullname"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" name="username" id="username" placeholder="Enter username..." onkeyup="emptValid(this.id, 'errusername','username')" onblur="emptValid(this.id, 'errusername','username')" class="medium" />

                        <small style="display:block;" id="errusername"></small>

                        <small style="display:block;" id="erusername"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="email" id="email"  placeholder="Enter email..." onkeyup="emptValid(this.id, 'erremail','email')" onblur="emptValid(this.id, 'erremail','email')" class="medium" />

                        <small style="display:block;" id="erremail"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                        <input type="text" name="phone" id="phone" maxlength="11" onkeyup="emptValid(this.id,'errphone')" onblur="emptValid(this.id,'errphone')" placeholder="Enter phone..." class="medium" />
                        <small style="display:block;" id="errphone"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="password" name="password" id="password" onkeyup="emptValid(this.id,'errpassword','password')" onblur="emptValid(this.id,'errpassword','password')" placeholder="Enter password..." class="medium" />
                         <small style="display:block;" id="errpassword"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Role</label>
                    </td>
                    <td>
                        <select name="role" id="role" onchange="emptValid(this.id,'errrole','select')">
                            <option value="">Select</option>
                            <option value="1">Supper Admin</option>
                            <option value="2">Admin</option>
                            <option value="3">User</option>
                        </select>
                        <small style="display:block;" id="errrole"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    <td>
                        <input type="file" name="image">
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
        <br>
        <hr>
     <?php } ?>

        <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>SL No.</th>        
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
            <?php 
                    if (Session::get("role_id") == 1) {
            ?>
                    <th>Status</th>
             <?php } ?>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $sql = "SELECT * FROM users ORDER BY users_id DESC";
                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['users_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                        <?php 
                            if (Session::get("role_id") == 1) {
                        ?>
                    <td>
                  
                  <a href="action.php?action=roleUpdate&id=<?php echo $row['users_id']; ?>">
                    <?php 
                            if ($row['status'] == 1) {
                                echo "Active";
                            }else{
                                echo "Inactive";
                            }
                     ?>
                         
                     </a>
                    </td>
                        <?php } ?>

                    <td>
                    <?php 
                         if (Session::get("role_id") == 1) {
                    ?>
                        <a href="userUpdate.php?update=<?php echo $row['users_id']; ?>">Edit</a> ||
                        <a onclick="return confirm('Are you sure to delete?')" href="delete.php?action=users&id=<?php echo $row['users_id']; ?>">Delete</a> ||
                     <?php } ?>
                        <a href="profile_view.php?view=<?php echo $row['users_id']; ?>">View</a>
                    </td>
                </tr>
                 <?php } } ?>

            </tbody>
        </table>
    </div>
</div>

 <script type="text/javascript">


    $("#username").keyup(function(){
        var get_username = $("#username").val();
        var check = "";
            $.ajax({
                    async : false,
                    url : "getExistData.php",
                    data : {get_username:get_username},
                    method : "post",
                    dataType : "html",
                    success : function(data){
                    if ($.trim(data) == "1") {
                        check = 1;
                    }
                }
            });

        if (check == 1) {
            $("#username").attr("style","border:2px solid red !important");
            $("#erusername").html("Data already exist.").css("color","red");
        }else{
            $("#username").attr("style","border:");
            $("#erusername").html("").css("color","");
        }
    });



    $("#myForm").submit(function(){
        
        var fullname = $("#fullname").val();
        var username = $("#username").val();
        var email    = $("#email").val();
        var phone    = $("#phone").val();
        var password = $("#password").val();
        var role = $("#role").val();
        var valid = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        var user = /[^a-z0-9]/;


        if ($.trim(fullname) == "") {
             $("#fullname").attr("style","border:2px solid red !important");
            $("#errfullname").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#errfullname").html("").css("color","");
        }

        if ($.trim(username) == "") {
             $("#username").attr("style","border:2px solid red !important");
            $("#errusername").html("Field must not be empty.").css("color","red");
            return false;
        }else if(user.test($.trim(username))){
                    $("#username").attr("style","border:2px solid red !important");
                    $("#errusername").html("Username is invalid.").css("color","red");
            return false;
        }else{
             $("#errusername").html("").css("color","");
        }

        var get_username = $("#username").val();
        var check = "";
            $.ajax({
                    async : false,
                    url : "getExistData.php",
                    data : {get_username:get_username},
                    method : "post",
                    dataType : "html",
                    success : function(data){
                    if ($.trim(data) == "1") {
                        check = 1;
                    }
                }
            });

            if (check == 1) {
                $("#username").attr("style","border:2px solid red !important");
                $("#erusername").html("Data already exist.").css("color","red");
                return false;
            }else{
                $("#username").attr("style","border:");
                $("#erusername").html("").css("color","");
            }

        if ($.trim(email) == "") {
             $("#email").attr("style","border:2px solid red !important");
            $("#erremail").html("Field must not be empty.").css("color","red");
            return false;
        }else if(!valid.test($.trim(email))){
             $("#email").attr("style","border:2px solid red !important");
             $("#erremail").html("Email address invalid.").css("color","red");
             return false;
        }else{
             $("#erremail").html("").css("color","");
        }

        if ($.trim(phone) == "") {
             $("#phone").attr("style","border:2px solid red !important");
            $("#errphone").html("Field must not be empty.").css("color","red");
            return false;
        }else if($.trim(phone).length < 11){
            $("#phone").attr("style","border:2px solid red !important");
            $("#errphone").html("Phone number must be 11 digit.").css("color","red");
            return false;
        }else{
             $("#errphone").html("").css("color","");
        }

        if ($.trim(password) == "") {
             $("#password").attr("style","border:2px solid red !important");
            $("#errpassword").html("Field must not be empty.").css("color","red");
            return false;
        }else if($.trim(password).length < 6){
            $("#password").attr("style","border:2px solid red !important");
            $("#errpassword").html("Password too short.").css("color","red");
            return false;
        }else{
             $("#errpassword").html("").css("color","");
        }

        if ($.trim(role) == "") {
             $("#role").attr("style","border:2px solid red !important");
            $("#errrole").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#errrole").html("").css("color","");
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
