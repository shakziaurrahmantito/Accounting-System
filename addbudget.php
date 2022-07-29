<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <style type="text/css">
        select,input[type='text'],input[type='date'],input[type='month']{
            width: 250px;
        }
    </style>
    <div class="box round first grid">
        <h2>Add Budget</h2>
       <div class="block copyblock">

        <?php 

            if (isset($_POST['submit'])) {

                if (empty($_POST['Branch_id']) || empty($_POST['Group_id']) || empty($_POST['Sub_group_id']) || empty($_POST['Posting_head_id']) ||empty($_POST['Budget_type']) || empty($_POST['Amount'])|| empty($_POST['User_id']) || empty($_POST['Createion_date'])) {

                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";

                }else{

                    $Branch_id          = $_POST['Branch_id'];
                    $Group_id		    = $_POST['Group_id'];
                    $Sub_group_id       = $_POST['Sub_group_id'];
                    $Posting_head_id    = $_POST['Posting_head_id'];
                    $Budget_type        = $_POST['Budget_type'];
                    $Month              = $_POST['Month'];
                    $Amount             = $_POST['Amount'];
                    $User_id            = $_POST['User_id'];
                    $Createion_date     = $_POST['Createion_date'];

                    $sql = "INSERT INTO budget(
                        Branch_id,
                        Group_id,
                        Sub_group_id,
                        Posting_head_id,
                        Budget_type,
                        Month,
                        Amount,
                        User_id,
                        Createion_date) 
                        VALUES('$Branch_id',
                            '$Group_id',
                            '$Sub_group_id',
                            '$Posting_head_id',
                            '$Budget_type',
                            '$Month',
                            '$Amount',
                            '$User_id',
                            '$Createion_date')";

                            $result = $db->insert($sql);
                            if ($result > 0) {
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
        ?>
                    <option value="<?php echo $row['Branch_id']; ?>"><?php echo $row['Address']; ?></option>
        <?php 
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
                        <select name="Group_id" id="Group_id"  onchange="emptValid(this.id,'errGroup_id','select')">
                           <option value="">Select Group</option>
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
                        <option value="Year">Year</option>
                        <option value="Months">Months</option>
                    </select>
                    <small style="display:block;" id="errBudget_type"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Month</label>
                    </td>
                    <td>
                      <input type="month" name="Month" id="Month" onkeyup="emptValid(this.id,'errMonth')" onblur="emptValid(this.id,'errMonth')">

                      <small style="display:block;" id="errMonth"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Amount</label>
                    </td>
                    <td>
                      <input type="number" name="Amount" id="Amount" onkeyup="emptValid(this.id,'errAmount')" onblur="emptValid(this.id,'errAmount')">

                       <small style="display:block;" id="errAmount"></small>
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
                      <input type="date" name="Createion_date" id="Createion_date" onkeyup="emptValid(this.id,'errCreateion_date')" onblur="emptValid(this.id,'errCreateion_date')">

                      <small style="display:block;" id="errCreateion_date"></small>
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
                    <th>SL</th>
                    <th>Branch</th>
                    <th>Sub Group</th>
                    <th>Budget Type</th>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>User</th>
                    <th>Creation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = " SELECT 
                    budget.*,
                    branch.Address,
                    ledger_sub_group.ledger_sub_group_name,
                    users.users_name FROM
                    budget INNER JOIN  branch
                    ON budget.Branch_id = branch.Branch_id
                    
                    INNER JOIN ledger_sub_group 
                    ON budget.Sub_group_id = ledger_sub_group.ledger_sub_group_id
                    INNER JOIN users 
                    ON budget.User_id = users.users_id";

                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr class="odd gradeX">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['Address']; ?></td>
                    <td><?php echo $row['ledger_sub_group_name']; ?></td>
                    <td><?php echo $row['Budget_type']; ?></td>
                    <td><?php echo $row['Month']; ?></td>
                    <td><?php echo $row['Amount']; ?></td>
                    <td><?php echo $row['users_name']; ?></td>
                    <td><?php echo $row['Createion_date']; ?></td>
                    <td>
                        <a href="addbudget_update.php?update=<?php echo $row['Budget_id'];?>">Edit</a>
                        ||
                        <a onclick="return confirm('Are you sure delete?')" href="delete.php?action=budget&id=<?php echo $row['Budget_id']; ?>">Delete</a>  
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
 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();
        });
</script>    
<?php include "inc/admin_footer.php"; ?>
