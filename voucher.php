<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Voucher</h2>
       <div class="block copyblock">
         <?php

    if (isset($_POST['submit'])) {
        
        if (empty($_POST['voucher_no']) || empty($_POST['ledger_id']) || empty($_POST['sub_goup_id']) || empty($_POST['phosting_head_id']) || empty($_POST['user_id']) || empty($_POST['branch_id']) || empty($_POST['company_id']) || empty($_POST['voucher_type']) || empty($_POST['prepared_by']) || (empty($_POST['debit_amount']) && empty($_POST['Credit_amount']))) {
            echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
      }else{
            $voucher_no = $_POST['voucher_no'];
            //$voucher_date = date("m-d-Y", time());
            $ledger_id = $_POST['ledger_id'];
            $sub_goup_id = $_POST['sub_goup_id'];
            $phosting_head_id = $_POST['phosting_head_id'];
            $debit_amount = $_POST['debit_amount'] ?? null;
            $Credit_amount = $_POST['Credit_amount'] ?? null;
            $user_id = $_POST['user_id'];
            $branch_id = $_POST['branch_id'];
            $company_id = $_POST['company_id'];
            $check_no = $_POST['check_no'];
            $check_date = $_POST['check_date'];
            $voucher_type = $_POST['voucher_type'];
            $prepared_by = $_POST['prepared_by'];

            $posting_head_next = $_POST['posting_head_next'];

            $sql = "SELECT * FROM ledger_group WHERE ledger_id = '$ledger_id'";
            $result = $db->select($sql);
            $row = $result->fetch_assoc();
            $group_id = $row['group_id'];


            /*$vtsql = "SELECT * FROM voucher_type WHERE voucher_type_id = '$voucher_type'";
            $vtresult = $db->select($vtsql);
            $vtrow = $vtresult->fetch_assoc();
            $voucher_nature = $vtrow['voucher_type_nature'];*/

            if ($debit_amount !== null) {

                $sql = "INSERT INTO voucher(voucher_no,
                    group_id,
                    ledger_id,
                    sub_goup_id,
                    phosting_head_id,
                    debit_amount,
                    user_id,
                    branch_id,
                    company_id,
                    check_no,
                    check_date,
                    voucher_type,
                    prepared_by 
               ) VaLUES(
                    '$voucher_no',
                    '$group_id',
                    '$ledger_id',
                    '$sub_goup_id',
                    '$phosting_head_id',
                    '$debit_amount',
                    '$user_id',
                    '$branch_id',
                    '$company_id',
                    '$check_no',
                    '$check_date',
                    '$voucher_type',
                    '$prepared_by'
               )";

               $result = $db->insert($sql);


               $sql = "INSERT INTO voucher(voucher_no,
                    group_id,
                    ledger_id,
                    sub_goup_id,
                    phosting_head_id,
                    Credit_amount,
                    user_id,
                    branch_id,
                    company_id,
                    check_no,
                    check_date,
                    voucher_type,
                    prepared_by 
               ) VaLUES(
                    '$voucher_no',
                    '$group_id',
                    '$ledger_id',
                    '$sub_goup_id',
                    '$posting_head_next',
                    '$debit_amount',
                    '$user_id',
                    '$branch_id',
                    '$company_id',
                    '$check_no',
                    '$check_date',
                    'in',
                    '$prepared_by'
               )";

               $result = $db->insert($sql);
                if ($result) {
                   echo "<p style='color:green;text-align:center;'>Data insert successfully.</p>";
                }else{
                     echo "<p style='color:red;text-align:center;'>Data not inserted.</p>";
                }


            }



            if ($Credit_amount !== null) {

                $sql = "INSERT INTO voucher(voucher_no,
                    group_id,
                    ledger_id,
                    sub_goup_id,
                    phosting_head_id,
                    Credit_amount,
                    user_id,
                    branch_id,
                    company_id,
                    check_no,
                    check_date,
                    voucher_type,
                    prepared_by 
               ) VaLUES(
                    '$voucher_no',
                    '$group_id',
                    '$ledger_id',
                    '$sub_goup_id',
                    '$phosting_head_id',
                    '$Credit_amount',
                    '$user_id',
                    '$branch_id',
                    '$company_id',
                    '$check_no',
                    '$check_date',
                    '$voucher_type',
                    '$prepared_by'
               )";

               $result = $db->insert($sql);


               $sql = "INSERT INTO voucher(voucher_no,
                    group_id,
                    ledger_id,
                    sub_goup_id,
                    phosting_head_id,
                    debit_amount,
                    user_id,
                    branch_id,
                    company_id,
                    check_no,
                    check_date,
                    voucher_type,
                    prepared_by 
               ) VaLUES(
                    '$voucher_no',
                    '$group_id',
                    '$ledger_id',
                    '$sub_goup_id',
                    '$posting_head_next',
                    '$Credit_amount',
                    '$user_id',
                    '$branch_id',
                    '$company_id',
                    '$check_no',
                    '$check_date',
                    'in',
                    '$prepared_by'
               )";

               $result = $db->insert($sql);
                if ($result) {
                   echo "<p style='color:green;text-align:center;'>Data insert successfully.</p>";
                }else{
                     echo "<p style='color:red;text-align:center;'>Data not inserted.</p>";
                }


            }

       
        }
    }

                
   ?>

        <form action="" method="post" name="myForm" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>Company</label>
                    </td>
                    <td>
                       <select name="company_id" id="company_id" onchange="emptValid(this.id,'errcompany_id','select')">
                           <option value="">Select Company</option>
        <?php
                $sql = "SELECT * FROM company ORDER BY Company_name ASC";
                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
        ?>
                    <option value="<?php echo $row['Company_id']; ?>"><?php echo $row['Company_name']; ?></option>
        <?php 
                }
            }
        ?>
                       </select>
                       <small style="display:block;" id="errcompany_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Branch</label>
                    </td>
                    <td>
                       <select name="branch_id" id="branch_id" onchange="emptValid(this.id,'errbranch_id','select')">
                           <option value="">Select Branch</option>
        <?php
                $sql = "SELECT * FROM branch ORDER BY Address ASC";
                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
        ?>
                    <option value="<?php echo $row['Branch_id']; ?>"><?php echo $row['Address']; ?></option>
        <?php 
                }
            }
        ?>
                       </select>
                       <small style="display:block;" id="errbranch_id"></small>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Ledger Type</label>
                    </td>
                    <td>
                       <select name="ledger_id" id="ledger_id" onchange="emptValid(this.id,'errledger_id','select')">
                           <option value="">Select Group Type</option>
        <?php
                $sql = "SELECT * FROM ledger_group ORDER BY ledger_name ASC";
                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
        ?>
                   <option value="<?php echo $row['ledger_id']; ?>"><?php echo $row['ledger_name']; ?></option>
        <?php 
                }
            }
        ?>
                       </select>
                       <small style="display:block;" id="errledger_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ledger Sub Group Type</label>
                    </td>
                    <td>
                       <select name="sub_goup_id" id="sub_goup_id" onchange="emptValid(this.id,'errsub_goup_id','select')">
                           <option value="">Select ledger group type</option>
                       </select>
                       <small style="display:block" id="errsub_goup_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Posting Head</label>
                    </td>
                    <td>
                       <select name="phosting_head_id" id="phosting_head_id" onchange="emptValid(this.id,'errphosting_head_id','select')">
                           <option value="">Select Posting Head</option>
                       </select>
                       <small style="display:block" id="errphosting_head_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Voucher Type</label>
                    </td>
                    <td>
                       <select name="voucher_type" id="voucher_type" onchange="emptValid(this.id,'errvoucher_type','select')">
                           <option value="">Select Voucher</option>

        <?php
                $sql = "SELECT * FROM voucher_type ORDER BY voucher_type_name ASC";
                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
        ?>
                    <option value="<?php echo $row['voucher_type_id']; ?>"><?php echo $row['voucher_type_name']; ?></option>
        <?php 
                }
            }

        ?> 

                       </select>
                       <small style="display:block;" id="errvoucher_type"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Voucher No</label>
                    </td>
                    <td>
                        <input type="text" name="voucher_no" id="voucher_no" readonly value="" required class="medium"/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Debit Amount</label>
                    </td>
                    <td>
                        <input type="number" name="debit_amount" id="debit_amount" class="medium" onkeyup="myEmpty()" onblur="myEmpty()" />
                        <small style="display:block;" id="errdebit_amount"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Credit Amount</label>
                    </td>
                    <td>
                        <input type="number" name="Credit_amount" id="Credit_amount" class="medium" onkeyup="myEmpty()" onblur="myEmpty()" />
                        <small style="display:block;" id="errCredit_amount"></small>
                    </td>
                </tr>


                <tr>
                    <td>
                        <label>Choose Head</label>
                    </td>
                    <td>
                       <select name="posting_head_next" id="posting_head_next" onchange="emptValid(this.id,'errposting_head_next','select')">
                           <option value="">Choose Head</option>

        <?php
                $sql = "SELECT * FROM ledger_posting_head ORDER BY posting_head_name ASC";
                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
        ?>
                    <option value="<?php echo $row['ledger_posting_head_id']; ?>"><?php echo $row['posting_head_name']; ?></option>
        <?php 
                }
            }

        ?>
                       </select>
                       <small style="display:block" id="errposting_head_next"></small>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>User</label>
                    </td>
                    <td>
                        <input type="text" name="user_id" readonly value="<?php
                            echo Session::get("full_name");
                    ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Checkno</label>
                    </td>
                    <td>
                       <input type="text" name="check_no" id="check_no">
                       <small style="display:block;" id="errcheck_no"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Check Date</label>
                    </td>
                    <td>
                       <input type="date" name="check_date" id="check_date">
                       <small style="display:block;" id="errcheck_date"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Prepare By</label>
                    </td>
                    <td>
                        <input type="text" name="prepared_by" readonly value="<?php
                            echo Session::get("users_name");
                    ?>" class="medium" />
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Submit" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<script type="application/javascript">

    document.getElementById("debit_amount").disabled = true;
    document.getElementById("Credit_amount").disabled = true;

    $("#ledger_id").change(function(){
        var ledger_id = $(this).val();
        $.ajax({
            url : "getSelectData.php",
            method : "post",
            data : {ledger_id:ledger_id},
            dataType : "html",
            success : function(data){
              $("#sub_goup_id").html(data);
            }
        });

        $("#phosting_head_id").html('<option value="">Select posting type</option>');

    });


    //---For active and deactive----

    $("#ledger_id").change(function(){
        var get_ledger_id = $(this).val();
        $.ajax({
            url : "getSelectData.php",
            method : "post",
            data : {get_ledger_id:get_ledger_id},
            dataType : "html",
            success : function(data){

    if ($.trim(data) == "cr") {

         document.getElementById("debit_amount").value = "";

        document.getElementById("debit_amount").disabled = true;
        document.getElementById("Credit_amount").disabled = false;


    }else{

         document.getElementById("Credit_amount").value = "";

        document.getElementById("debit_amount").disabled = false;
        document.getElementById("Credit_amount").disabled = true;

    }
            }
        });

    });


    function myEmpty(){

    var disdebit_amount = document.getElementById("debit_amount").disabled;
   var didCredit_amount = document.getElementById("Credit_amount").disabled;

        var debit_amount    = $("#debit_amount").val();
        var Credit_amount   = $("#Credit_amount").val();

        if (debit_amount == "" && didCredit_amount) {
            $("#errdebit_amount").html("Field must not be empty.").css("color","red");
        }else{
             $("#errdebit_amount").html("").css("color","");
        }

        if (Credit_amount == "" && disdebit_amount) {
            $("#errCredit_amount").html("Field must not be empty.").css("color","red");
        }else{
             $("#errCredit_amount").html("").css("color","");
        }

    }



    $("#debit_amount").keyup(function(){
        var voucher_type = $("#voucher_type").val();
        var debit_amount = $("#debit_amount").val();

         $.ajax({
            url : "getSelectData.php",
            method : "post",
            data : {voucher_type:voucher_type, debit_amount:debit_amount},
            dataType : "html",
            success : function(data){
                if ($.trim(data) == 1) {
                    $("#errdebit_amount").html("Insufficient balance").css("color","red");
                }else{
                    $("#errdebit_amount").html("").css("color","");
                }

            }
        });

    });




    $("#sub_goup_id").change(function(){

        var sub_goup_id = $(this).val();
        $.ajax({
            url : "getSelectData.php",
            method : "post",
            data : {sub_goup_id:sub_goup_id},
            dataType : "html",
            success : function(data){
              $("#phosting_head_id").html(data);
            }
        });

    });
    

$("#branch_id").change(function(){
    var year = new Date().getFullYear();
    var month = ("0" + (new Date().getMonth() + 1)).slice(-2);
    var branch_id = $("#branch_id").val();
    var getvoucher_no = "";
    
    $.ajax({
        url : "getSelectData.php",
        method : "post",
        data : {getvoucher_no:getvoucher_no, branch_id:branch_id},
        dataType : "html",
        success : function(data){
            var a = $.trim(data).substr(0, 7);
            var b = branch_id+year+month;
            if(a==b){
                $("#voucher_no").attr("value", "B"+data);
            }else{
                $("#voucher_no").attr("value", "B"+branch_id+year+month+"0000");    
            }
          
        }
    });
});




$("#myForm").submit(function(){

var company_id       = $("#company_id").val();
var branch_id        = $("#branch_id").val();
var ledger_id        = $("#ledger_id").val();
var sub_goup_id      = $("#sub_goup_id").val();
var phosting_head_id = $("#phosting_head_id").val();
var voucher_type     = $("#voucher_type").val();
var voucher_no       = $("#voucher_no").val();
var debit_amount     = $("#debit_amount").val();
var Credit_amount    = $("#Credit_amount").val();
var check_no         = $("#check_no").val();
var check_date       = $("#check_date").val();
    
    if($.trim(company_id) == ""){
        $("#company_id").attr("style","border:2px solid red !important");
        $("#errcompany_id").html("Please select any option.").css("color","red");
        return false;
    }else{
        $("#company_id").attr("style","border:");
        $("#errcompany_id").html("").css("color","red");
    }
        
    if($.trim(branch_id) == ""){
        $("#branch_id").attr("style","border:2px solid red !important");
        $("#errbranch_id").html("Please select any option.").css("color","red");
        return false;
    }else{
        $("#branch_id").attr("style","border:");
        $("#errbranch_id").html("").css("color","red");
    }
    
    if($.trim(ledger_id) == ""){
        $("#ledger_id").attr("style","border:2px solid red !important");
        $("#errledger_id").html("Please select any option.").css("color","red");
        return false;
    }else{
        $("#ledger_id").attr("style","border:");
        $("#errledger_id").html("").css("color","red");
    }
        
    if($.trim(sub_goup_id) == ""){
        $("#sub_goup_id").attr("style","border:2px solid red !important");
        $("#errsub_goup_id").html("Please select any option.").css("color","red");
        return false;
    }else{
        $("#sub_goup_id").attr("style","border:");
        $("#errsub_goup_id").html("").css("color","red");
    }   
    
    if($.trim(phosting_head_id) == ""){
        $("#phosting_head_id").attr("style","border:2px solid red !important");
        $("#errphosting_head_id").html("Please select any option.").css("color","red");
        return false;
    }else{
        $("#phosting_head_id").attr("style","border:");
        $("#errphosting_head_id").html("").css("color","red");
    }
        
    if($.trim(voucher_type) == ""){
        $("#voucher_type").attr("style","border:2px solid red !important");
        $("#errvoucher_type").html("Please select any option.").css("color","red");
        return false;
    }else{
        $("#voucher_type").attr("style","border:");
        $("#errvoucher_type").html("").css("color","red");
    }
    
    if($.trim(voucher_no) == ""){
        $("#voucher_no").attr("style","border:2px solid red !important");
        $("#errvoucher_no").html("Field must not be empty.").css("color","red");
        return false;
    }else{
        $("#voucher_no").attr("style","border:");
        $("#errvoucher_no").html("").css("color","red");
    }   
    
    if($.trim(debit_amount) == "" && $.trim(Credit_amount) == ""){

        $("#errCredit_amount").html("Please fill the active field").css("color","red");
        return false;       
    }else{
        $("#errCredit_amount").html("").css("color","red");
    }
        
    if($.trim(check_no) !== "" && $.trim(check_date) == ""){
        $("#check_date").attr("style","border:2px solid red !important");
        $("#errcheck_date").html("Please select check date").css("color","red");
        return false;       
    }else{
        $("#check_date").attr("style","border:");
        $("#errcheck_date").html("").css("color","red");
    }
    
});

/*var dis1 = document.getElementById("amnt1");
var dis2 = document.getElementById("amnt2");

if (dis1.value != "") {
    document.getElementById("amnt2").disabled = true;
}else{
    document.getElementById("amnt2").disabled = false;
}

if (dis2.value != "") {
    document.getElementById("amnt1").disabled = true;
}else{
    document.getElementById("amnt1").disabled = false;
}

dis1.onchange = function () {
   if (this.value != "" || this.value.length > 0) {
      document.getElementById("amnt2").disabled = true;
   }else{ onkeyup=document.getElementById("amnt2").disabled = false;}
}

dis2.onchange = function () {
   if (this.value != "" || this.value.length > 0) {
      document.getElementById("amnt1").disabled = true;
   }else{ onkeyup=document.getElementById("amnt1").disabled = false;}
}*/
</script>

<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();
        });
</script>  
        
<?php include "inc/admin_footer.php"; ?>
