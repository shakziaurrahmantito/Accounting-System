<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<style type="text/css">
 
.profile{
font-family: 'Nunito', sans-serif;
text-align: center;
max-width: 400px;
height: 400px;
box-shadow: 0 0 10px rgba(0,0,0,0.2);
padding: 20;



}
.profile_image{
width:150px;
height:150px;
object-fit: cover;
border-radius:50%;
margin: 0 auto 20px auto;
display: block;

}
.profile_name{
font-size: 1.2rem;
font-weight: bold;
}
.profile_tittle{
margin-bottom: 20px;
}
.profile__details{
 display:flex;
 align-items: center;
justify-content: ceneter;
font-size: 0.9em;

}

.copyblock {
    border: none;
    ine-height: 32px;
    margin-left: 100px;
    margin-top: 20px;
    padding-left: 20px;
    width: 600px;
}
.mybtn{
    width: 50%;
    height: 50px;
    font-size: 18px;
    color: rgb(233, 244, 251);
    font-weight: 700;
    cursor: pointer;
    border-width: 1px;
    border-style: solid;
    border-color: initial;
    border-image: initial;
    background: rgb(38, 145, 217);
    border-radius: 25px;
    outline: none;
}
</style>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User Profile</h2>
       <div class="block copyblock" style="margin: 0 auto;">
        <div class="profile">
            <?php 
                    $users_id = Session::get("users_id");
                    $sql = "SELECT * FROM users WHERE users_id = '$users_id'";
                    $result = $db->select($sql);
                    $row = $result->fetch_assoc();
             ?>

        <img style="padding-top:10px;" src="<?php echo $row['user_image']; ?>" alt="" class="profile_image">

         <div class="profile_name">Name: <?php echo $row['full_name']; ?></div> 
         <div class="profile_title">Username: <?php echo $row['users_name']; ?></div>
         <div class="profile_details">Email: <?php echo $row['email']; ?></div>
         <div class="profile_details">Phone: <?php echo $row['phone']; ?></div>
         <a href="userprofileupdate.php"><input type="submit" value="change" class="mybtn"></a>
        </div>
        </div>
    </div>
</div>

        
<?php include "inc/admin_footer.php"; ?>
