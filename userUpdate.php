<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<?php
    echo Session::get('msg');
    Session::set('msg',null);
?>

<?php
    $role_id = Session::get("role_id");
    if ($role_id == 3 || $role_id == 2) {
        echo "<script>location='index.php';</script>";
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User Update</h2>
        <?php 
            if (Session::get("role_id") == 1) {
        ?>
       <div class="block copyblock">

            <?php

                if (isset($_POST['update'])) {


                    if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['role'])) {
                        echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                    }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        echo "<p style='color:red;text-align:center;'>Email address invalid.</p>";
                    }else{
                            $update     = $_GET['update'];
                            $full_name  = $_POST['fullname'];
                            $email      = $_POST['email'];
                            $phone      = $_POST['phone'];
                            $role_id    = $_POST['role'];

                            $sql = "UPDATE users SET full_name = '$full_name', email = '$email', phone= '$phone', role_id = '$role_id' WHERE users_id = '$update'";
                            $result = $db->update($sql);

                            if ($result) {
                               echo "<script>window.location='user.php';</script>";
                            }else{
                                    echo "<script>window.location='user.php';</script>";
                            }
                        }
                        
                    }
                }
             ?>

        <?php

        if (isset($_GET['update'])) {
            $update = $_GET['update'];
            $sql = "SELECT * FROM users WHERE users_id = '$update'";
            $result = $db->select($sql);
            if ($result) {
            $row = $result->fetch_assoc();


        ?>
         <form action="" method="post" id="myForm" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="fullname" id="fullname" onkeyup="emptValid(this.id,'errfullname')" onblur="emptValid(this.id,'errfullname')"  value="<?php echo $row['full_name']; ?>" class="medium" />
                 <small style="display:block;" id="errfullname"></small>
                 </td>

                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="email" id="email" onkeyup="emptValid(this.id, 'erremail','email')" onblur="emptValid(this.id, 'erremail','email')"  value="<?php echo $row['email']; ?>" class="medium" />
                         <small style="display:block;" id="erremail"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                        <input type="text" maxlength="11" name="phone" id="phone"  onkeyup="emptValid(this.id,'errphone')" onblur="emptValid(this.id,'errphone')" value="<?php echo $row['phone']; ?>" class="medium" />
                        <small style="display:block;" id="errphone"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Role</label>
                    </td>
                    <td>
                        <select name="role" id="role" onchange="emptValid(this.id,'errrole','select')">
                            <option value="">Select</option>
                        <?php if ($row['role_id'] == "1") { ?>
                            <option selected value="1">Super Admin</option>
                            <option value="2">Admin</option>
                            <option value="3">User</option>
                        <?php }else if($row['role_id'] == "2"){ ?>
                            <option value="1">Super Admin</option>
                            <option selected value="2">Admin</option>
                            <option value="3">User</option>
                        <?php }else if($row['role_id'] == "3"){ ?>
                            <option value="1">Super Admin</option>
                            <option value="2">Admin</option>
                            <option selected value="3">User</option>
                        <?php } ?>
                            
                            
                        </select>
                        <small style="display:block;" id="errrole"></small>
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
        
        var fullname = $("#fullname").val();
        var email    = $("#email").val();
        var phone    = $("#phone").val();
        var role = $("#role").val();
        var valid = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
       
        if ($.trim(fullname) == "") {
             $("#fullname").attr("style","border:2px solid red !important");
            $("#errfullname").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#errfullname").html("").css("color","");
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

        
        if ($.trim(role) == "") {
             $("#role").attr("style","border:2px solid red !important");
            $("#errrole").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#errrole").html("").css("color","");
        }


       

    });



    </script>



<?php include "inc/admin_footer.php"; ?>
