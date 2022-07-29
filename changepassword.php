<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block copyblock">
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

                $users_id = Session::get("users_id");
                $sql = "SELECT * FROM users WHERE users_id = '$users_id'";
                $result = $db->select($sql);
                $row = $result->fetch_assoc();

                if (empty($_POST['oldPass']) || empty($_POST['newPass']) || empty($_POST['conPass'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($row['password'] !== md5($_POST['oldPass'])) {
                    echo "<p style='color:red;text-align:center;'>Old password not match.</p>";
                }else if(strlen($_POST['newPass'])<6) {
                    echo "<p style='color:red;text-align:center;'>Password munimum length 6 character.</p>";
                }else if($_POST['newPass'] !== $_POST['conPass']){
                     echo "<p style='color:red;text-align:center;'>Confirm Password not match.</p>";
                }else{
                    $password = md5($_POST['newPass']);
                    $sql = "UPDATE users SET password = '$password' WHERE users_id = '$users_id'";
                    $result = $db->update($sql);
                    if ($result) {
                        echo "<p style='color:green;text-align:center;'>Password changed</p>";
                    }else{
                        echo "<p style='color:red;text-align:center;'>Password not change.</p>";
                    }
                }

            }
        ?>                
         <form action="" id="myForm" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" name="oldPass"id="oldPass" onkeyup="emptValid(this.id,'erroldPass')" 
                        onblur="emptValid(this.id,'erroldPass')" placeholder="Enter Old Password..."  name="title" class="medium" />
                        <small style="display:block;" id="erroldPass"></small>
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" name="newPass" id="newPass" onkeyup="emptValid(this.id,'errnewPass','password')" 
                        onblur="emptValid(this.id,'errnewPass','password')" placeholder="Enter New Password..." name="slogan" class="medium" />
                        <small style="display:block;" id="errnewPass"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Confirm Password</label>
                    </td>
                    <td>
                        <input type="password" name="conPass" id="conPass" onkeyup="emptValid(this.id,'errconPass','password')" 
                        onblur="emptValid(this.id,'errconPass','password')" placeholder="Enter Confirm Password..." name="slogan" class="medium" />
                        <small style="display:block;" id="errconPass"></small>
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
        
    $("#myForm").submit(function(){
        
        var oldPass    = $("#oldPass").val();
        var newPass    = $("#newPass").val();
        var conPass    = $("#conPass").val();
       
        
    
        if ($.trim(oldPass) == "") {
             $("#oldPass").attr("style","border:2px solid red !important");
            $("#erroldPass").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#erroldPass").html("").css("color","");
        }
        if ($.trim(newPass) == "") {
             $("#newPass").attr("style","border:2px solid red !important");
            $("#errnewPass").html("Field must not be empty.").css("color","red");
            return false;
        }else if($.trim(newPass).length < 6){
            $("#newPass").attr("style","border:2px solid red !important");
            $("#errnewPass").html("Password too short.").css("color","red");
            return false;
        }else{
             $("#errnewPass").html("").css("color","");
        }

        if ($.trim(conPass) == "") {
             $("#conPass").attr("style","border:2px solid red !important");
            $("#errconPass").html("Field must not be empty.").css("color","red");
            return false;
        }else if($.trim(conPass).length < 6){
            $("#conPass").attr("style","border:2px solid red !important");
            $("#errconPass").html("Password too short.").css("color","red");
            return false;
            
        }else if($.trim(newPass)!=$.trim(conPass)){
            $("#conPass").attr("style","border:2px solid red !important");
            $("#errconPass").html("Confirm Password not match.").css("color","red");
            return false;
        }else{
             $("#errconPass").html("").css("color","");
        }

       

    });



    </script>
<?php include "inc/admin_footer.php"; ?>
