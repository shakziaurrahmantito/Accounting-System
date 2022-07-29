<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Company</h2>
       <div class="block copyblock">
    <?php
        $role_id = Session::get("role_id");
        if ($role_id == 3 || $role_id == 2) {
            echo "<script>location='index.php';</script>";
        }
    ?>
        <?php
            if (isset($updateMsg)) {
                echo $updateMsg;
            }
        ?>
        <?php 

        $cusql = "SELECT 
        company.*,
        company_type.company_type,
        business_type.Business_type FROM 
        company INNER JOIN company_type
        ON company.Company_type_id = company_type.type_id
        INNER JOIN business_type
        ON company.Business_type_id = business_type.Business_type_id WHERE company.Company_id = 1";

        $curesult = $db->select($cusql);
        if ($curesult) {
            $curow = $curesult->fetch_assoc();
        

        ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">

                <tr>
                    <td>
                        <label>Company Type</label>
                    </td>
                    <td>
                       <select name="type_id" id="type_id" onchange="emptValid(this.id,'errtype_id','select')">
                        <option value="">Select company type</option>
            <?php
                $sql = "SELECT * FROM company_type ORDER BY company_type DESC";
                $result = $db->select($sql);
                while($row = $result->fetch_assoc()){
                if ($row['type_id'] == $curow['Company_type_id']) {
            ?>
                    <option selected value="<?php echo $row['type_id']; ?>"><?php echo $row['company_type']; ?></option>
            <?php 
                }else{

            ?>
                <option value="<?php echo $row['type_id']; ?>"><?php echo $row['company_type']; ?></option>
            <?php
                }
                }
            ?>
                       </select>
					   <small style="display:block;" id="errtype_id"></small>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Business Type</label>
                    </td>
                    <td>
                       <select name="Business_type_id" id="Business_type_id" onchange="emptValid(this.id,'errBusiness_type_id','select')">

                           <option value="">Business Type</option>
            <?php
                $sql = "SELECT * FROM business_type ORDER BY Business_type_id DESC";
                $myResult = $db->select($sql);
                while($myrow = $myResult->fetch_assoc()){

                if ($myrow['Business_type_id'] == $curow['Business_type_id']) {
            ?>

            <option selected value="<?php echo $myrow['Business_type_id']; ?>"><?php echo $myrow['Business_type']; ?></option> 

            <?php 
                    }else{
            ?>
                <option value="<?php echo $myrow['Business_type_id']; ?>"><?php echo $myrow['Business_type']; ?></option> 
            <?php
                    }
                }
            ?>
                       </select>
					   <small style="display:block;" id="errBusiness_type_id"></small>
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
                        <label>Company name</label>
                    </td>
                    <td>
                       <input type="text" name="Company_name" id="Company_name" onkeyup="emptValid(this.id,'errCompany_name')" onblur="emptValid(this.id,'errCompany_name')" value="<?php echo $curow['Company_name']; ?>">
					   <small style="display:block;" id="errCompany_name"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Company Address</label>
                    </td>
                    <td>
                       <textarea name="Address" id="Address" onkeyup="emptValid(this.id,'errAddress')" onblur="emptValid(this.id,'errAddress')" cols="39" rows="3"><?php echo $curow['Address']; ?></textarea>
					   <small style="display:block;" id="errAddress"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Company Phone</label>
                    </td>
                    <td>
                       <input type="text" name="Phone" id="Phone" onkeyup="emptValid(this.id,'errPhone')" onblur="emptValid(this.id,'errPhone')" maxlength="11" value="<?php echo $curow['Phone']; ?>">
					   <small style="display:block;" id="errPhone"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Company registration</label>
                    </td>
                    <td>
                       <input type="text" name="Company_registration_no" id="Company_registration_no" onkeyup="emptValid(this.id,'errCompany_registration_no')" onblur="emptValid(this.id,'errCompany_registration_no')" value="<?php echo $curow['Company_registration_no']; ?>">
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
                       <input type="text" name="Tin" value="<?php echo $curow['Tin']; ?>">
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
                       <input type="text" name="Vat" id="Vat" onkeyup="emptValid(this.id,'errVat')" onblur="emptValid(this.id,'errVat')"value="<?php echo $curow['Vat']; ?>">
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
                       <input type="text" name="Trade_license" value="<?php echo $curow['Trade_license']; ?>">
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
            } 

        ?>
        </div>
    </div>
</div>

        
<?php include "inc/admin_footer.php"; ?>
