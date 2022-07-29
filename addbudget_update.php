<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <style type="text/css">
        select,input[type='text'],input[type='date'],input[type='month']{
            width: 250px;
        }
    </style>
    <div class="box round first grid">
        <h2>Budget Update</h2>
       <div class="block copyblock">

        <?php 

            if (isset($_POST['submit'])) {
				$update = $_GET['update'];

                if (empty($_POST['Branch_id']) || empty($_POST['Group_id']) || empty($_POST['Sub_group_id']) || empty($_POST['Posting_head_id']) ||empty($_POST['Budget_type']) || empty($_POST['Amount'])|| empty($_POST['User_id']) || empty($_POST['Createion_date'])) {

                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";

                }else{

                    $Branch_id          = $_POST['Branch_id'];
                    $Group_id           = $_POST['Group_id'];
                    $Sub_group_id       = $_POST['Sub_group_id'];
                    $Posting_head_id    = $_POST['Posting_head_id'];
                    $Budget_type        = $_POST['Budget_type'];
                    $Month              = $_POST['Month'];
                    $Amount             = $_POST['Amount'];
                    $User_id            = $_POST['User_id'];
                    $Createion_date     = $_POST['Createion_date'];

                    $sql = "UPDATE budget SET
                        Branch_id = '$Branch_id',
                        Group_id = '$Group_id',
                        Sub_group_id = '$Sub_group_id',
                        Posting_head_id = '$Posting_head_id',
                        Budget_type = '$Budget_type',
                        Month = '$Month',
                        Amount = '$Amount',
                        User_id = '$User_id',
                        Createion_date = '$Createion_date'
                        WHERE Budget_id = $update";

                            $result = $db->update($sql);
                             if ($result) {
									echo "<script>window.location='addbudget.php';</script>";
								}else{
									echo "<script>window.location='addbudget.php';</script>";
								}

                }
            }

        ?>
			<?php
			if (isset($_GET['update'])) {
            $update = $_GET['update'];
				
				$sql = " SELECT 
				budget.*,
				branch.Branch_id,
				ledger_group.ledger_id,
				ledger_sub_group.ledger_sub_group_id,
				ledger_posting_head.ledger_posting_head_id FROM
				
				budget INNER JOIN  branch
				ON budget.Branch_id = branch.Branch_id
				
				INNER JOIN ledger_group 
				ON budget.Group_id = ledger_group.ledger_id				
				
				INNER JOIN ledger_sub_group 
				ON budget.Sub_group_id = ledger_sub_group.ledger_sub_group_id
				
				INNER JOIN ledger_posting_head 
				ON budget.Posting_head_id = ledger_posting_head.ledger_posting_head_id
				WHERE budget.Budget_id = '$update'";

				$uresult = $db->select($sql);
				if ($uresult) {
				$urow = $uresult->fetch_assoc()
            ?>


         <form action="" method="post" id="myForm" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Branch Address</label>
                    </td>
                    <td>
                    <select name="Branch_id" id="Branch_id" onchange="emptValid(this.id,'errBranch_id','select')">
                        <option value="">Select Branch</option>
			<?php
                $sql = "SELECT * FROM branch ORDER BY Address ASC";
                $result = $db->select($sql);
				if ($result) {
					while($row = $result->fetch_assoc()){
						if ($row['Branch_id'] == $urow['Branch_id']) {
			?>
					<option selected value="<?php echo $row['Branch_id']; ?>"><?php echo $row['Address']; ?></option>
			<?php
							}else{
			?>
				<option value="<?php echo $row['Branch_id']; ?>"><?php echo $row['Address']; ?></option>
			<?php 
							}
						}
					}
			?>       
                    </select>
                    <small style="display:block;" id="errBranch_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Group</label>
                    </td>
                    <td>
                    <select name="Group_id" id="Group_id" onchange="emptValid(this.id,'errGroup_id','select')">
                        <option value="">Select Group</option>
        <?php
                $sql = $sql = "SELECT * FROM ledger_group ORDER BY ledger_name ASC";
                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
       			if ($row['ledger_id'] == $urow['Group_id']) {
			?>
					<option selected value="<?php echo $row['ledger_id']; ?>"><?php echo $row['ledger_name']; ?></option>
			<?php
							}else{
			?>
				<option value="<?php echo $row['ledger_id']; ?>"><?php echo $row['ledger_name']; ?></option>
			<?php 
							}
						}
					}
			?> 

                    </select>
                    <small style="display:block;" id="errGroup_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Sub Group</label>
                    </td>
                    <td>
                    <select name="Sub_group_id" id="Sub_group_id" onchange="emptValid(this.id,'errSub_group_id','select')">
                        <option value="">Select Sub Group</option>
            <?php
                $sql = "SELECT * FROM ledger_sub_group ORDER BY ledger_sub_group_name ASC";               
                $result = $db->select($sql);
                if ($result) {
                    while($row = $result->fetch_assoc()){
       			if ($row['ledger_sub_group_id'] == $urow['Sub_group_id']) {
			?>
					<option selected value="<?php echo $row['ledger_sub_group_id']; ?>"><?php echo $row['ledger_sub_group_name']; ?></option>
			<?php
							}else{
			?>
				<option value="<?php echo $row['ledger_sub_group_id']; ?>"><?php echo $row['ledger_sub_group_name']; ?></option>
			<?php 
							}
						}
					}
			?> 
                    </select>
                    <small style="display:block;" id="errSub_group_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Posting Head</label>
                    </td>
                    <td>
                    <select name="Posting_head_id" id="Posting_head_id" onchange="emptValid(this.id,'errPosting_head_id','select')">
                        <option value="">Select Posting Head</option>
        <?php
                $sql = "SELECT * FROM ledger_posting_head ORDER BY posting_head_name ASC";
                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
     			if ($row['ledger_posting_head_id'] == $urow['Posting_head_id']) {
			?>
					<option selected value="<?php echo $row['ledger_posting_head_id']; ?>"><?php echo $row['posting_head_name']; ?></option>
			<?php
							}else{
			?>
				<option value="<?php echo $row['ledger_posting_head_id']; ?>"><?php echo $row['posting_head_name']; ?></option>
			<?php 
							}
						}
					}
			?>        ?>
                    </select>
                    <small style="display:block;" id="errPosting_head_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Budget Type</label>
                    </td>
                    <td>
                    <select name="Budget_type" id="Budget_type" onchange="emptValid(this.id,'errBudget_type','select')">
                        <option value="">Select Budget Type</option>
						<option <?php if ($urow['Budget_type'] == "Year") {
                                   echo "selected";
                                }?> value="Year">Year</option>
                        <option <?php if ($urow['Budget_type'] == "Months") {
                                   echo "selected";
                                }?> value="Months">Months</option>
                    </select>
                     <small style="display:block;" id="errBudget_type"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Month</label>
                    </td>
                    <td>
                      <input type="month" name="Month" id="Month" value="<?php echo $urow['Month']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Amount</label>
                    </td>
                    <td>
                      <input type="number" name="Amount" id="Amount" value="<?php echo $urow['Amount']; ?>">
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>User Id</label>
                    </td>
                    <td>
                    <select name="User_id">
            <?php
                $sql = "SELECT * FROM users ORDER BY users_id ASC";               
                $result = $db->select($sql);
                if ($result) {
                    while($row = $result->fetch_assoc()){
                        $user_id = Session::get('users_id');
                        if ($row['users_id'] == $user_id) {
            ?>
                        <option value="<?php echo $row['users_id']; ?>"><?php echo $row['users_name']; ?></option>
            <?php   
                        }
                    }
                }
            ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Creation Date</label>
                    </td>
                    <td>
                      <input type="date" name="Createion_date" id="Createion_date" value="<?php echo $urow['Createion_date']; ?>">
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
        
        var Branch_id		= $("#Branch_id").val();
        var Group_id		= $("#Group_id").val();
        var Sub_group_id	= $("#Sub_group_id").val();
        var Posting_head_id	= $("#Posting_head_id").val();
        var Budget_type		= $("#Budget_type").val();
        var Month			= $("#Month").val();
        var Amount			= $("#Amount").val();
        var Createion_date	= $("#Createion_date").val();

        if ($.trim(Branch_id) == "") {
             $("#Branch_id").attr("style","border:2px solid red !important");
            $("#errBranch_id").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errBranch_id").html("").css("color","");
        }


        if ($.trim(Group_id) == "") {
             $("#Group_id").attr("style","border:2px solid red !important");
            $("#errGroup_id").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errGroup_id").html("").css("color","");
        } 
		
		
		if ($.trim(Sub_group_id) == "") {
             $("#Sub_group_id").attr("style","border:2px solid red !important");
            $("#errSub_group_id").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errSub_group_id").html("").css("color","");
        }
		
		
		if ($.trim(Posting_head_id) == "") {
             $("#Posting_head_id").attr("style","border:2px solid red !important");
            $("#errPosting_head_id").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errPosting_head_id").html("").css("color","");
        }

       
		
		
		if ($.trim(Budget_type) == "") {
             $("#Budget_type").attr("style","border:2px solid red !important");
            $("#errBudget_type").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errBudget_type").html("").css("color","");
        }
		
		 
		if ($.trim(Month) == "") {
             $("#Month").attr("style","border:2px solid red !important");
            $("#errMonth").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#errMonth").html("").css("color","");
        }
		
		
		if ($.trim(Amount) == "") {
             $("#Amount").attr("style","border:2px solid red !important");
            $("#errAmount").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#errAmount").html("").css("color","");
        }


        if ($.trim(Createion_date) == "") {
             $("#Createion_date").attr("style","border:2px solid red !important");
            $("#errCreateion_date").html("Field must not be empty.").css("color","red");
            return false;
        }else{
             $("#errCreateion_date").html("").css("color","");
        }


    });



//----------Select Option Validiton---------

    $("#Group_id").change(function(){
        var Group_id = $(this).val();
        $.ajax({
            url : "getSelectData.php",
            method : "post",
            data : {Group_id:Group_id},
            dataType : "html",
            success : function(data){
               $("#Sub_group_id").html(data);
            }
        });

    });
	
	    $("#Sub_group_id").change(function(){
        var Sub_group_id = $(this).val();
        $.ajax({
            url : "getSelectData.php",
            method : "post",
            data : {Sub_group_id:Sub_group_id},
            dataType : "html",
            success : function(data){
               $("#Posting_head_id").html(data);
            }
        });

    });


</script>
   
<?php include "inc/admin_footer.php"; ?>
