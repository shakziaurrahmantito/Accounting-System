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
    <title>Forgot || <?php
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
  font-size: 18px;
}
.center form{
  padding: 0 40px;
  box-sizing: border-box;
  padding: 25px 0;
}

table{
  margin: 0 auto;
}

input[type='text']{
    width: 250px;
    height: 28px;
    border: 1px solid;
    border-radius: 5px;
    padding: 5px;
}

input[type='submit']{
    width: 250px;
    border: 1px solid;
    border-radius: 6px;
    height: 30px;
    margin-top: 15px;
    margin-bottom: 20px;
}

     </style>
  </head>
  <body>
    <div class="center">
      <h1>Forgot Password</h1>
      <form method="post" id="got_form">
        <p id="errsmg" align="center"></p>
        <table align="center">
          <tr>
            <td style="padding: 12px 0;">Enter email</td>
          </tr>
          <tr>
            <td><input type="text" name="for_get_email" id="for_get_email" placeholder="Enter valid email address"></td>
          </tr>
          <tr>
            <td><input type="submit" value="Submit" name="got"></td>
          </tr>
        </table>
      </form>
    </div>
<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
<script type="text/javascript">

  $("#for_get_email").keyup(function(){
     var valid = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    var for_get_email = $("#for_get_email").val();
     if(!valid.test($.trim(for_get_email))){
             $("#for_get_email").attr("style","border:2px solid red !important");
             $("#errsmg").html("Email address invalid.").css("color","red");
             return false;
      }else{
           $("#errsmg").html("").css("color","");
      }

  });


  $("#got_form").submit(function(){

      var valid = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

        var for_get_email = $("#for_get_email").val();

       if(!valid.test($.trim(for_get_email))){
            return false;
        }else{

            $.ajax({
                    url : "forgotPasswordexist.php",
                    data : {for_get_email:for_get_email},
                    method : "post",
                    dataType : "html",
                    success : function(event){
                      if ($.trim(event) == 1) {
                        location = "otp.php";
                      }else{
                         $("#errsmg").html("Email address not found.").css("color","red");
                      }
                    }
            });

           return false;
      }

  });

</script>
  </body>
</html>