<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Branch</h2>
       <div class="block copyblock">
<?php

if (isset($_POST['submit'])) {
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

$sql = "
INSERT INTO branch(
    Company_id,
    Country_id,
    City_id,
    Address,
    Phone,
    Company_registration_no,
    Tin,
    Vat,
    Trade_license,
    Company_logo)

VALUES(
    '$Company_id',
    '$Country_name',
    '$City',
    '$Address',
    '$Phone',
    '$Company_registration_no',
    '$Tin',
    '$Vat',
    '$Trade_license',
    '$Company_logo'
)";

        $results = $db->insert($sql);
        if ($results) {
           echo "<p style='color:green;text-align:center;'>Data insert successfully.</p>";
        }else{
            echo "<p style='color:red;text-align:center;'>Data not inserted.</p>";
        }

    }
}
        ?>
         <form action="" method="post" id="myForm" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Company</label>
                    </td>
                    <td>
                       <select name="Company_id" id="Company_id" onchange="emptValid(this.id,'errCompany_id','select')">

                           <option value="">Select company</option>
            <?php
                $sql_ci = "SELECT * FROM company ORDER BY Company_id DESC";
                $myResult = $db->select($sql_ci);
                while($myrow = $myResult->fetch_assoc()){
            ?>
                 <option value="<?php echo $myrow['Company_id']; ?>"><?php echo $myrow['Company_name']; ?></option>
            <?php 
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
                       <option value="">Select City</option>
            <?php
                $sql = "SELECT * FROM countrycity ORDER BY city_name ASC";
                $Result = $db->select($sql);
                while($row = $Result->fetch_assoc()){
            ?>
                 <option value="<?php echo $row['c_id']; ?>"><?php echo $row['city_name']; ?></option>
            <?php 
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
                       <textarea name="Address" rows="3" cols="39" id="Address" onkeyup="emptValid(this.id,'errAddress')" onblur="emptValid(this.id,'errAddress')"></textarea>
					   <small style="display:block;" id="errAddress"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                       <input type="text" maxlength="11" name="Phone" id="Phone" onkeyup="emptValid(this.id,'errPhone')" onblur="emptValid(this.id,'errPhone')">
					   <small style="display:block;" id="errPhone"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Company registration</label>
                    </td>
                    <td>
                       <input type="text" name="Company_registration_no" id="Company_registration_no" onkeyup="emptValid(this.id,'errCompany_registration_no')" onblur="emptValid(this.id,'errCompany_registration_no')">
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
                       <input type="text" name="Tin">
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
                       <input type="text" name="Vat"  id="Vat" onkeyup="emptValid(this.id,'errVat')" onblur="emptValid(this.id,'errVat')">
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
                       <input type="text" name="Trade_license">
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
        <br>

    <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>SL No.</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Trade License</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT 
                    branch.*,
                     countrycity.city_name FROM 
                    branch INNER JOIN  countrycity 
                    ON branch.City_id = countrycity.c_id ORDER BY city_name ASC";

                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr class="odd gradeX">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['city_name']; ?></td>
                    <td><?php echo $row['Address']; ?></td>
                    <td><?php echo $row['Phone']; ?></td>
                    <td><?php echo $row['Trade_license']; ?></td>
                    <td>
                        <a href="addbranch_update.php?update=<?php echo $row['Branch_id']; ?>">Edit</a>
                        ||
                        <a onclick="return confirm('Are you sure delete?')" href="delete.php?action=branch&id=<?php echo $row['Branch_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php
                    }}
                 ?>

            </tbody>
        </table>
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
 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();
        });
</script>  
<?php include "inc/admin_footer.php"; ?>
