<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<?php
    $role_id = Session::get("role_id");
    if ($role_id == 3) {
        echo "<script>location='index.php';</script>";
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Branch</h2>
       <div class="block copyblock">
<?php

if (isset($_POST['submit'])) {
	$update = $_GET['update'];
    if(empty($_POST['Company_id']) || empty($_POST['City_name']) || empty($_POST['Address']) ||empty($_POST['Phone']) || empty($_POST['Company_registration_no']) || empty($_POST['Vat'])) {
        echo "<p style='color:red;text-align:center;'>* Field must not be empty.</p>";
    }else{
        $Company_id		    = $_POST['Company_id'];
        $Country_name       = $_POST['Country_name'];
        $City  		        = $_POST['City_name'];
        $Address            = $_POST['Address'];
        $Phone              = $_POST['Phone'];
        $Company_registration_no = $_POST['Company_registration_no'];
        $Tin                = $_POST['Tin'];
        $Trade_license      = $_POST['Trade_license'];
        $Vat                = $_POST['Vat'];
        $getLogo    = "SELECT Company_logo from company WHERE Company_id = 1 LIMIT 1";
        $result     = $db->select($getLogo);
        $row        = $result->fetch_assoc();
        $Company_logo = $row['Company_logo'];

$sql = "UPDATE branch SET 
		Company_id = '$Company_id',
		Country_id = '$Country_name',
		City_id = '$City',
		Address = '$Address',
		Phone = '$Phone',
		Company_registration_no = '$Company_registration_no',
		Tin = '$Tin',
		Vat = '$Vat',
		Trade_license = '$Trade_license',
		Company_logo= '$Company_logo'
		WHERE Branch_id = '$update'";

        $results = $db->update($sql);
		if ($result) {
            echo "<script>window.location='addbranch.php';</script>";
        }else{
            echo "<script>window.location='addbranch.php';</script>";
        }

    }
}
        ?>
		<?php 
            if (isset($_GET['update'])) {
               $update = $_GET['update'];
               $sql = "SELECT branch.*,
                    company.Company_id,
					countrycity.country_name,
					countrycity.c_id FROM
                    branch INNER JOIN company
                    ON branch.Company_id = company.Company_id
					
					INNER JOIN countrycity
					ON branch.Country_id = countrycity.country_name AND branch.City_id = countrycity.c_id
					WHERE branch.Branch_id  = '$update'";
               $uresult = $db->select($sql);
               if ($uresult) {
               $urow = $uresult->fetch_assoc();
        ?>
         <form action="" method="post" enctype="multipart/form-data" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>Company</label>
                    </td>
                    <td>
                       <select name="Company_id" id="Company_id" onchange="emptValid(this.id,'errCompany_id','select')">

                           <option value="">Select company</option>
            <?php
                $sql = "SELECT * FROM company ORDER BY Company_name ASC";
                $Result = $db->select($sql);
				 if ($Result) {
                while($row = $Result->fetch_assoc()){
        					if ($row['Company_id'] == $urow['Company_id']) {
        ?>
				<option selected value="<?php echo $row['Company_id']; ?>"><?php echo $row['Company_name']; ?></option>
		<?php
						}else{
        ?>
			<option value="<?php echo $row['Company_id']; ?>"><?php echo $row['Company_name']; ?></option>
        <?php 
						}
					}
				}
        ?>       
						</select>
						<small style="display:block;" id="errCompany_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Country</label>
                    </td>
                    <td>
                       <select name="Country_name">
                           <option value="Bangladesh">Bangladesh</option>

                       </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>City</label>
                    </td>
                    <td>
                <select name="City_name" id="City_name" onchange="emptValid(this.id,'errCity_name','select')">
                       <option value ="">Select City</option>
            <?php
                $sql = "SELECT * FROM countrycity ORDER BY city_name ASC";
                $Result = $db->select($sql);
				 if ($Result) {
                while($row = $Result->fetch_assoc()){
              					if ($row['c_id'] == $urow['City_id']) {
        ?>
				<option selected value="<?php echo $row['c_id']; ?>"><?php echo $row['city_name']; ?></option>
		<?php
						}else{
        ?>
			<option value="<?php echo $row['c_id']; ?>"><?php echo $row['city_name']; ?></option>
        <?php 
						}
					}
				 }
        ?> 
                </select>
				<small style="display:block;" id="errCity_name"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                       <textarea name="Address" id="Address" onkeyup="emptValid(this.id,'errAddress')" onblur="emptValid(this.id,'errAddress')" rows="3" cols="39"><?php echo $urow['Address']; ?></textarea>
					   <small style="display:block;" id="errAddress"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                       <input type="text" name="Phone" id="Phone" onkeyup="emptValid(this.id,'errPhone')" onblur="emptValid(this.id,'errPhone')" maxlength="11" value="<?php echo $urow['Phone']; ?>">
					   <small style="display:block;" id="errPhone"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Company registration</label>
                    </td>
                    <td>
                       <input type="text" name="Company_registration_no" id="Company_registration_no" onkeyup="emptValid(this.id,'errCompany_registration_no')" onblur="emptValid(this.id,'errCompany_registration_no')" value="<?php echo $urow['Company_registration_no']; ?>">
					   <small style="display:block;" id="errCompany_registration_no"></small>
                    </td>
                </tr>

                <!-- <tr>
                    <td>
                        <label>Registration doc</label>
                    </td>
                    <td>
                       <input type="file" name="">
                    </td>
                </tr> -->
                <tr>
                    <td>
                        <label>Tin</label>
                    </td>
                    <td>
                       <input type="text" name="Tin" value="<?php echo $urow['Tin']; ?>">
                    </td>
                </tr>
                <!-- <tr>
                    <td>
                        <label>Tin doc</label>
                    </td>
                    <td>
                       <input type="file" name="">
                    </td>
                </tr> -->
                <tr>
                    <td>
                        <label>Vat</label>
                    </td>
                    <td>
                       <input type="text" name="Vat" id="Vat" onkeyup="emptValid(this.id,'errVat')" onblur="emptValid(this.id,'errVat')" value="<?php echo $urow['Vat']; ?>">
					   <small style="display:block;" id="errVat"></small>
                    </td>
                </tr>
                <!-- <tr>
                    <td>
                        <label>Vat doc</label>
                    </td>
                    <td>
                       <input type="file" name="">
                    </td>
                </tr> -->
                <tr>
                    <td>
                        <label>Trade License</label>
                    </td>
                    <td>
                       <input type="text" name="Trade_license" value="<?php echo $urow['Trade_license']; ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
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

//----------Submit Option Validiton---------

    $("#myForm").submit(function(){
        
        var Company_id               = $("#Company_id").val();
        var City_name                = $("#City_name").val();
        var Address                  = $("#Address").val();
        var Phone                    = $("#Phone").val();
        var Company_registration_no  = $("#Company_registration_no").val();
        var Vat                      = $("#Vat").val();
      

        

        if ($.trim(Company_id) == "") {
             $("#Company_id").attr("style","border:2px solid red !important");
            $("#errCompany_id").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errCompany_id").html("").css("color","");
        }

        if ($.trim(City_name) == "") {
            $("#City_name").attr("style","border:2px solid red !important");
            $("#errCity_name").html("Please select any option.").css("color","red");
            return false;

        }
         else{
             
                $("#errCity_name").html("").css("color","red");
            }

            if ($.trim(Address) == "") {
            $("#Address").attr("style","border:2px solid red !important");
            $("#errAddress").html("Field must not be empty.").css("color","red");
            return false;

        }
         else{
             
                $("#errAddress").html("").css("color","red");
            }


            if ($.trim(Phone) == "") {
            $("#Phone").attr("style","border:2px solid red !important");
            $("#errPhone").html("Field must not be empty.").css("color","red");
            return false;

        }
         else{
             
                $("#errPhone").html("").css("color","red");
            }


            if ($.trim(Company_registration_no) == "") {
            $("#Company_registration_no").attr("style","border:2px solid red !important");
            $("#errCompany_registration_no").html("Field must not be empty.").css("color","red");
            return false;

        }
         else{
             
                $("#errCompany_registration_no").html("").css("color","red");
            }


            if ($.trim(Vat) == "") {
            $("#Vat").attr("style","border:2px solid red !important");
            $("#errVat").html("Field must not be empty.").css("color","red");
            return false;

        }
         else{
             
                $("#errVat").html("").css("color","red");
            }


         
    });


</script>

<?php include "inc/admin_footer.php"; ?>
