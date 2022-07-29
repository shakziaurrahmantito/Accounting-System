<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User Profile</h2>
       <div class="block copyblock">

        <?php
            if (isset($user_update)) {
                echo $user_update;
            }
        ?>

        <?php
            $users_id = Session::get("users_id");
            $sql = "SELECT * FROM users WHERE users_id = '$users_id'";
            $result = $db->select($sql);
            if ($result) {
                $row = $result->fetch_assoc();
        ?>
        <form action="" method="post" id="myForm" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>FULL Name</label>
                    </td>
                    <td>
                        <input type="text" name="full_name" id="full_name" onkeyup="emptValid(this.id,'errfull_name')" 
                        onblur="emptValid(this.id,'errfull_name')" value="<?php echo $row['full_name']; ?>" class="medium" />
                        <small style="display:block;" id="errfull_name"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="email" id="email" onkeyup="emptValid(this.id, 'erremail','email')" 
                        onblur="emptValid(this.id, 'erremail','email')" value="<?php echo $row['email']; ?>" class="medium" />
                        <small style="display:block;" id="erremail"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                        <input type="text" name="phone" maxlength="11" id="phone" onkeyup="emptValid(this.id,'errphone')" 
                        onblur="emptValid(this.id,'errphone')" value="<?php echo $row['phone']; ?>"  class="medium" />
                        <small style="display:block;" id="errphone"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" id="image" onkeyup="emptValid(this.id,'errimage')" 
                        onblur="emptValid(this.id,'errimage')"  class="medium" />
                        <small style="display:block;" id="errimage"></small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update_img" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
        
    $("#myForm").submit(function(){
        
        var full_name = $("#full_name").val();
        var email    = $("#email").val();
        var phone    = $("#phone").val();
        var image = $("#image").val();
        var valid = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
       
        
      

        if ($.trim(full_name) == "") {
             $("#full_name").attr("style","border:2px solid red !important");
            $("#errfull_name").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#errfull_name").html("").css("color","");
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

        
        if ($.trim(image) == "") {
             $("#image").attr("style","border:2px solid red !important");
            $("#errimage").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#errimage").html("").css("color","");
        }


       

    });



    </script>
        
<?php include "inc/admin_footer.php"; ?>
