<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Ledger Posting</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['submit'])) {

                 if (!empty($_POST['posting_head_name'])) {
                   $posting_head_name       = trim($_POST['posting_head_name']);
                    $sql            = "SELECT * FROM ledger_posting_head WHERE posting_head_name = '$posting_head_name'";
                    $Checkposting_head_name  = $db->select($sql);
                }

                if(empty($_POST['ledger_group_id']) || empty($_POST['ledger_sub_group_id']) || empty($_POST['posting_head_name']) || empty($_POST['posting_head_date'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($Checkposting_head_name){
                     echo "<p style='color:red;text-align:center;'>Posting head name already exists.</p>";
                }else{

        $ledger_sub_group_id    = $_POST['ledger_sub_group_id'];
        $ledger_group_id        = $_POST['ledger_group_id'];
        $posting_head_name      = $_POST['posting_head_name'];
        $posting_head_date      = $_POST['posting_head_date'];


        $sql = "INSERT INTO ledger_posting_head(ledger_sub_group_id,ledger_group_id,posting_head_name,posting_head_date) VALUES('$ledger_sub_group_id','$ledger_group_id','$posting_head_name','$posting_head_date')";
                    
                    $result = $db->insert($sql);
                    if ($result) {
                       echo "<p style='color:green;text-align:center;'>Data insert successfully.</p>";
                    }else{
                        echo "<p style='color:red;text-align:center;'>Data not inserted.</p>";
                    }
                }
            }
        ?>

         <form action="" method="post" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>Ledger Group</label>
                    </td>
                    <td>
                        <select name="ledger_group_id" id="ledger_group_id"  onchange="emptValid(this.id,'errledger_group_id','select')">
                           <option value="">Select group Type</option>
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

        ?>    </select>
         <small style="display:block;" id="errledger_group_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ledger Sub Group</label>
                    </td>
                    <td>
                        <select name="ledger_sub_group_id" id="ledger_sub_group_id" onchange="emptValid(this.id,'errledger_sub_group_id','select')">
                           <option value="">Select sub group Type</option>
                         </select>
                    <small style="display:block;" id="errledger_sub_group_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Posting Headname</label>
                    </td>
                    <td>
                        <input type="text" name="posting_head_name" placeholder="Enter ledger sub group name" class="medium" id="posting_head_name" onkeyup="emptValid(this.id,'errposting_head_name')" onblur="emptValid(this.id,'errposting_head_name')">
                        <small style="display:block;" id="errposting_head_name"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Date</label>
                    </td>
                    <td>
                        <input type="date" name="posting_head_date" id="posting_head_date" onkeyup="emptValid(this.id,'errposting_head_date')" onblur="emptValid(this.id,'errposting_head_date')" placeholder="Enter ledger sub group name" class="medium" />
                        <small style="display:block;" id="errposting_head_date"></small>
                    </td>
                </tr>
                <tr>				
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>

        <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>SL</th>        
                    <th>Group</th>
                    <th>Sub Group</th>
                    <th>Head Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 

        $sql = "SELECT 
        ledger_posting_head.*,
        ledger_sub_group.ledger_sub_group_name,
        ledger_group.ledger_name FROM

        ledger_posting_head INNER JOIN ledger_sub_group 
        ON ledger_posting_head.ledger_sub_group_id = ledger_sub_group.ledger_sub_group_id 
        INNER JOIN ledger_group 
        ON ledger_posting_head.ledger_group_id = ledger_group.ledger_id ORDER BY ledger_posting_head.posting_head_name ASC";

                    $result = $db->select($sql);
                    if ($result) {
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['ledger_name']; ?></td>
                    <td><?php echo $row['ledger_sub_group_name']; ?></td>
                    <td><?php echo $row['posting_head_name']; ?></td>
                    <td><?php echo $row['posting_head_date']; ?></td>
                    <td>
                        <a href="ledger_sub_head_posting_update.php?update=<?php echo $row['ledger_posting_head_id']; ?>">Edit</a>
                    <?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1) {
                    ?> || 
                        <a onclick="return confirm('Are you sure to delete?')" href="delete.php?action=ledger_posting_head&id=<?php echo $row['ledger_posting_head_id']; ?>">Delete</a>
                    <?php
                        }
                    ?>
                    </td>
                </tr>
            <?php } } ?>

            </tbody>
        </table>

    </div>
</div>
<script type="text/javascript">

//----------Submit Option Validiton---------

    $("#myForm").submit(function(){
        
        var ledger_group_id     = $("#ledger_group_id").val();
        var ledger_sub_group_id = $("#ledger_sub_group_id").val();
        var posting_head_name   = $("#posting_head_name").val();
        var posting_head_date   = $("#posting_head_date").val();

        if ($.trim(ledger_group_id) == "") {
             $("#ledger_group_id").attr("style","border:2px solid red !important");
            $("#errledger_group_id").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errledger_group_id").html("").css("color","");
        }


        if ($.trim(ledger_sub_group_id) == "") {
             $("#ledger_sub_group_id").attr("style","border:2px solid red !important");
            $("#errledger_sub_group_id").html("Please select any option.").css("color","red");
            return false;
        }else{
             $("#errledger_sub_group_id").html("").css("color","");
        }


        if ($.trim(posting_head_name) == "") {
            $("#posting_head_name").attr("style","border:2px solid red !important");
            $("#errposting_head_name").html("Field must not be empty.").css("color","red");
            return false;

        }else if($.trim(posting_head_name) !== ""){
           var check = "";
            $.ajax({
                async : false,
                url : "getExistData.php",
                data : {posting_head_name:posting_head_name},
                method : "post",
                dataType : "html",
                success : function(data){
                    if ($.trim(data) == "1") {
                        check = 1;
                    }
                }
            });

            if (check == "1") {
                $("#posting_head_name").attr("style","border:2px solid red !important");
                $("#errposting_head_name").html("Data already exist.").css("color","red");
                return false;
            }else{
                $("#posting_head_name").attr("style","border:");
                $("#errposting_head_name").html("").css("color","red");
            }
        }else{
             $("#errposting_head_name").html("").css("color","");
        }


        if ($.trim(posting_head_date) == "") {
             $("#posting_head_date").attr("style","border:2px solid red !important");
            $("#errposting_head_date").html("Please select any options.").css("color","red");
            return false;
        }else{
             $("#errposting_head_date").html("").css("color","");
        }


    });


//----------Select Option Validiton---------

    $("#ledger_group_id").change(function(){
        var ledger_group_id = $(this).val();
        $.ajax({
            url : "getSelectData.php",
            method : "post",
            data : {ledger_group_id:ledger_group_id},
            dataType : "html",
            success : function(data){
               $("#ledger_sub_group_id").html(data);
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
