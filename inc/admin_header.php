<?php
    include_once("lib/Database.php");
    include_once("lib/Session.php");
    include_once("lib/amountinword.php");
    Session::init();
    if (Session::get("session") == false) {
        header("location:login.php");
    }
    $db     = new Database();
    $aword  = new amountword();

    if (isset($_GET['action']) && $_GET['action'] == "logout") {
        date_default_timezone_set("Asia/Dhaka");
        $log_time = date("h:i:s A");
        $insert_Id = Session::get("insert_Id");
        $sql = "UPDATE log_table SET Logout_time = '$log_time' WHERE Log_id = '$insert_Id'";
        $db->update($sql);
        Session::destroy();
        header("location:login.php");
    }
?>

<?php

    if (isset($_POST['update'])) {

        $permission = array("jpg","png");

        if(empty($_POST['type_id']) || empty($_POST['Business_type_id']) || empty($_POST['Company_name']) || empty($_POST['Address']) || empty($_POST['Phone']) || empty($_POST['Company_registration_no']) || empty($_POST['Vat'])) {
            $updateMsg = "<p style='color:red;text-align:center;'>* Field must not be empty.</p>";
        }else{
                
            $Company_type_id    = $_POST['type_id'];
            $Business_type_id   = $_POST['Business_type_id'];
            $Country_name       = $_POST['Country_name'];
            $Company_name       = $_POST['Company_name'];
            $Address            = $_POST['Address'];
            $Phone              = $_POST['Phone'];
            $Company_registration_no = $_POST['Company_registration_no'];
            $Tin                = $_POST['Tin'];
            $Trade_license      = $_POST['Trade_license'];
            $Vat                = $_POST['Vat'];

    $sql = "UPDATE company SET 
            Company_type_id     = '$Company_type_id',
            Business_type_id    = '$Business_type_id',
            Country_name        = '$Country_name',
            Company_name        = '$Company_name',
            Address             = '$Address',
            Phone               = '$Phone',
            Company_registration_no = '$Company_registration_no',
            Tin = '$Tin',
            Trade_license = '$Trade_license',
            Vat = '$Vat' WHERE Company_id = 1";


            $result = $db->update($sql);
            if ($result) {
               $updateMsg = "<p style='color:green;text-align:center;'>Data update successfully.</p>";
            }else{
                $updateMsg = "<p style='color:red;text-align:center;'>No change anytings.</p>";
            }
        }
    }
?>

<?php

if (isset($_POST['update'])) {

    $permission = array("jpg","png");

    if (empty($_FILES['image']['name']) || $_FILES['image']['size'] > 1048576) {

        $imageChange = "<p style='color:red;text-align:center;'>Please chose any image and max size 3 mb.</p>";

    }else if(!in_array(strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION)), $permission)){

        $imageChange = "<p style='color:red;text-align:center;'>You can only upload jpg, png.</p>";

    }else{
            
        $Company_logo  = $_FILES['image']['name'];
        $tmp_name   = $_FILES['image']['tmp_name'];
        $extension  = pathinfo($Company_logo,PATHINFO_EXTENSION);
        $uId        = uniqid();
        $path       = "uploads/".$uId.".".strtolower($extension);
        
        $sql = "UPDATE company SET Company_logo = '$path' WHERE Company_id = 1";

        $Csql    = "SELECT * FROM company WHERE Company_id = 1";
        $Cresult = $db->select($Csql);
        $Crow    = $Cresult->fetch_assoc();
        $Cimage  = $Crow['Company_logo'];
        unlink($Cimage);

        $result = $db->update($sql);
        move_uploaded_file($tmp_name, $path);
        if ($result) {
           $imageChange = "<p style='color:green;text-align:center;'>Data update successfully.</p>";
        }else{
            $imageChange = "<p style='color:red;text-align:center;'>No change anytings.</p>";
        }

        }
    }

 
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php echo ucwords(Session::get("users_name")); ?> || <?php
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

    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->

    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
     <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>

    <style type="text/css">
        input[type='password']{
            height: 20px !important;
            width: 300px !important;
            border-radius: 4px;
            border: 1px solid #e3c3c3 !important;
            padding: 5px;
        }

        input[type='month']{
            height: 20px !important;
            width: 300px !important;
            border-radius: 4px;
            border: 1px solid #e3c3c3 !important;
            padding: 5px;
        }

        input[type='number']{
            height: 20px !important;
            width: 300px !important;
            border-radius: 4px;
            border: 1px solid #e3c3c3 !important;
            padding: 5px;
        }
    </style>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <?php
                    $sql = "SELECT * FROM company WHERE Company_id = 1";
                    $result = $db->select($sql);
                    if ($result) {
                    $icon = $result->fetch_assoc();
                ?>
                <div class="floatleft logo">
                    <img src="<?php echo $icon['Company_logo']; ?>" alt="Logo" />
                </div>
                <div class="floatleft middle">

                    <h1><?php echo $icon['Company_name']; ?></h1>
                    <p><?php echo $icon['Address']; ?></p>
                </div>
                <?php  } ?>



                <?php

                    if (isset($_POST['update_img'])) {

                        if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['phone'])) {
                            $user_update = "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                        }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                            $user_update = "<p style='color:red;text-align:center;'>Email address invalid.</p>";

                        }else if(!empty($_FILES['image']['name'])){

                                $permission = array("jpg","png");

                                if ($_FILES['image']['size'] > 1048576) {
                                    $user_update = "<p style='color:red;text-align:center;'>Please chose any image and max size 3 mb.</p>";
                                }else if(!in_array(strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION)), $permission)){
                                    $user_update = "<p style='color:red;text-align:center;'>You can only upload jpg, png.</p>";
                                }else{

                                    $users_id = Session::get("users_id");
                                    $sql = "SELECT * FROM users WHERE users_id = '$users_id'";
                                    $result = $db->select($sql);
                                    $row = $result->fetch_assoc();
                                    unlink($row['user_image']);

                                    $img_name   = $_FILES['image']['name'];
                                    $tmp_name   = $_FILES['image']['tmp_name'];
                                    $extension  = pathinfo($img_name,PATHINFO_EXTENSION);
                                    $uId        = md5(uniqid());
                                    $path       = "uploads/".$uId.".".strtolower($extension);
                                    $users_name = $_POST['full_name'];
                                    $email      = $_POST['email'];
                                    $phone      = $_POST['phone'];
                                    $sql        = "UPDATE users SET full_name = '$users_name',email = '$email',phone = '$phone', user_image = '$path' WHERE users_id = '$users_id'";
                                    $result = $db->update($sql);
                                    move_uploaded_file($tmp_name,$path);
                                    if ($result) {
                                        $user_update = "<p style='color:green;text-align:center;'>Data update successfully.</p>";
                                    }else{
                                        $user_update = "<p style='color:red;text-align:center;'>Data not updated.</p>";
                                    }
                                }



                        }else{

                                    $users_id = Session::get("users_id");
                                    $users_name = $_POST['full_name'];
                                    $email      = $_POST['email'];
                                    $phone      = $_POST['phone'];
                                    $sql        = "UPDATE users SET full_name = '$users_name',email = '$email',phone = '$phone' WHERE users_id = '$users_id'";
                                    $result = $db->update($sql);
                                        if ($result) {
                                            $user_update = "<p style='color:green;text-align:center;'>Data update successfully.</p>";
                                        }else{
                                            $user_update = "<p style='color:red;text-align:center;'>Data not updated.</p>";
                                        }
                                    }
                            }       
                ?>



                <div class="floatright">
                    <div class="floatleft">
                        <img style="border-radius: 15px; height:30px;width: 30px;"  src="<?php

                    $users_id = Session::get("users_id");
                    $user_sql = "SELECT * FROM users WHERE users_id  = '$users_id'";
                    $user_result = $db->select($user_sql);
                    if ($user_result) {
                    $user_img = $user_result->fetch_assoc();
                        echo $user_img['user_image'];
                    }
                ?>" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Welcome! <?php echo Session::get("full_name"); ?></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="userprofile.php"><span>User Profile</span></a></li>
                <li class="ic-form-style"><a href="changepassword.php"><span>Change Password</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>