<?php
    include_once("lib/Database.php");
    include_once("lib/Session.php");
    Session::init();
    if (Session::get("session") == true) {
      header("location:index.php");
    }
    $db = new Database();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login || <?php
                    $sql = "SELECT * FROM company WHERE Company_id = 1";
                    $result = $db->select($sql);
                    if ($result) {
                        $icon = $result->fetch_assoc();
                        echo $icon['Company_name'];
                    }
                ?></title>
    <link rel="shortcut icon" href="<?php
                    $sql = "SELECT * FROM company WHERE Company_id = 1";
                    $result = $db->select($sql);
                    if ($result) {
                        $icon = $result->fetch_assoc();
                        echo $icon['Company_logo'];
                    }
                ?>" type="image/x-icon">
     <style type="text/css">
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body{
  margin: 0;
  padding: 0;
  background: linear-gradient(120deg,#2980b9, #8e44ad);
  height: 100vh;
  overflow: hidden;
}
.center{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 400px;
  background: white;
  border-radius: 10px;
  box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
}
.center h1{
  text-align: center;
  padding: 20px 0;
  border-bottom: 1px solid silver;
}
.center form{
  padding: 0 40px;
  box-sizing: border-box;
}
form .txt_field{
  position: relative;
  border-bottom: 2px solid #adadad;
  margin: 40px 0;
}
.txt_field input{
  width: 100%;
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
}
.txt_field label{
  position: absolute;
  padding-bottom:5px;
  color: #adadad;
  transform: translateY(-50%);
  font-size: 16px;
  pointer-events: none;
  transition: .5s;
}
.txt_field span::before{
  content: '';
  position: absolute;
  top: 40px;
  left: 0;
  width: 0%;
  height: 2px;
  background: #2691d9;
  transition: .5s;
}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
  top: -5px;
  color: #2691d9;
}
.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{
  width: 100%;
}
.pass{
  margin: -5px 0 20px 5px;
  color: #a6a6a6;
  cursor: pointer;
}
.pass:hover{
  text-decoration: underline;
}
input[type="submit"]{
  width: 100%;
  height: 50px;
  border: 1px solid;
  background: #2691d9;
  border-radius: 25px;
  font-size: 18px;
  color: #e9f4fb;
  font-weight: 700;
  cursor: pointer;
  outline: none;
}
input[type="submit"]:hover{
  border-color: #2691d9;
  transition: .5s;
}
.signup_link{
  margin: 30px 0;
  text-align: center;
  font-size: 16px;
  color: #666666;
}
.signup_link a{
  color: #2691d9;
  text-decoration: none;
}
.signup_link a:hover{
  text-decoration: underline;
}

     </style>
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
<?php
      if (isset($_POST['login'])) {

        if (!empty($_POST['users_name'])) {
          $users_name = $_POST['users_name'];
          $sql      = "SELECT * FROM users WHERE users_name = '$users_name'";
          $result   = $db->select($sql);
          if ($result) {
            $row      = $result->fetch_assoc();
            $status   = $row['status'];
          }
        }

        if (empty($_POST['users_name']) || empty( $_POST['password'])) {
          echo "<p style='color:red;text-align: center;margin: 10px 0;'>Field must not be empty.</p>";
        }else if(isset($status) && $status == 0){
          echo "<p style='color:red;text-align: center;margin: 10px 0;'>Your account is inactive.</p>";
        }else{
          $users_name = $_POST['users_name'];
          $password   = md5($_POST['password']);
          $sql = "SELECT * FROM users WHERE users_name = '$users_name' AND password = '$password'";
          $result = $db->select($sql);
          if ($result) {
            $row = $result->fetch_assoc();
            Session::set("session",true);
            Session::set("users_name",$row['users_name']);
            Session::set("full_name",$row['full_name']);
            Session::set("phone",$row['phone']);
            Session::set("email",$row['email']);
            Session::set("role_id",$row['role_id']);
            Session::set("users_id",$row['users_id']);
            Session::set("user_image",$row['user_image']);
            $ip = $_SERVER["REMOTE_ADDR"];
            $user_id = $row['users_id'];
            $sql = "INSERT INTO log_table(User_id,User_ip) VALUES('$user_id','$ip')";
            $insertId = $db->insert($sql);
            Session::set("insert_Id",$insertId);
            header("location:index.php");
          }else{
            echo "<p style='color:red;text-align:center;margin: 10px 0;'>Username & password not match!</p>";
          }
        }
      }
    ?>
      <form method="post" name="myForm" id="myForm" onsubmit="return validateForm()">
        <div class="txt_field">
          <input type="text" name="users_name" id="users_name" onkeyup="emptValid(this.id,'errusers_name', 'username')" onblur="emptValid(this.id,'errusers_name', 'username')">
          <small style="display:block;"  id="errusers_name"></small>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" id="password" onkeyup="emptValid(this.id,'errpassword')" onblur="emptValid(this.id,'errpassword')">
          <small style="display:block;"  id="errpassword"></small>
          <label>Password</label>
        </div>
        <div class="pass"><a style="text-decoration: none;" href="forgot.php">Forgot Password?</a></div>
        <input type="submit" value="Login" name="login">
        <div class="signup_link">
         
        </div>
      </form>
    </div>
	
<script src="js/jquery-1.6.4.min.js"></script>
<script type="text/javascript">
function validateForm() {
  var user = $("#users_name").val();
  var password = $("#password").val();
  if (user == "") {
	$("#errusers_name").html("Field must not be empty.").css({
      "color":"red",
      "position":"relative",
      "top":"22px"
    });
    return false;
  }else{
	 $("#errusers_name").html("").css({
        "color":"",
        "position":"",
        "top":""
      });
  }  
  
if (password == "") {
	$("#errpassword").html("Field must not be empty.").css({
    "color":"red",
    "position":"relative",
    "top":"22px"
  });
    return false;
  }else{
  	$("#errpassword").html("").css({
      "color":"",
      "position":"",
      "top":""
    });
  }

}


function emptValid(id, show, type = null){
	var user = /[^a-z0-9]/;
	var getValue = $("#"+id).val();
	
	if (type == "username") {
		if (getValue == "") {
			$("#"+show).html("Field must not be empty.").css({
        "color":"red",
        "position":"relative",
        "top":"22px"
      });
		}else if(user.test(getValue)){
			$("#"+show).html("Username is invalid.").css({
        "color":"red",
        "position":"relative",
        "top":"22px"
      });
		}else{
			 $("#"+show).html("").css({
        "color":"",
        "position":"",
        "top":""
      });
		}
	}
	
	if (type == null) {
	if (getValue == "") {
	 $("#"+show).html("Field must not be empty.").css({
      "color":"red",
      "position":"relative",
      "top":"22px"
    });
	}else{
		 $("#"+show).html("").css({
        "color":"",
        "position":"",
        "top":""
      });
		}
	}
}


</script>
  </body>
</html>
