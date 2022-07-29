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
        <h2>Update Ledger Posting</h2>
       <div class="block copyblock">
        <?php

            if (isset($_POST['update'])) {

                $update = $_GET['update'];

                if(empty($_POST['ledger_group_id']) || empty($_POST['ledger_sub_group_id']) || empty($_POST['posting_head_name']) || empty($_POST['posting_head_date'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else{

        $ledger_group_id        = $_POST['ledger_group_id'];
        $ledger_sub_group_id    = $_POST['ledger_sub_group_id'];
        $posting_head_name      = $_POST['posting_head_name'];
        $posting_head_date      = $_POST['posting_head_date'];


        $sql = "UPDATE ledger_posting_head SET 
            ledger_sub_group_id = '$ledger_sub_group_id',
            ledger_group_id = '$ledger_group_id',
            posting_head_name = '$posting_head_name',
            posting_head_date = '$posting_head_date' WHERE ledger_posting_head_id = '$update'";
                    
                    $result = $db->update($sql);
                     if ($result) {
                        echo "<script>window.location='ledger_sub_head_posting.php';</script>";
                    }else{
                       echo "<script>window.location='ledger_sub_head_posting.php';</script>";
                    }
                }
            }
        ?>


        <?php

            if (isset($_GET['update'])) {

                    $update = $_GET['update'];

                    $sql = "SELECT 
                    ledger_posting_head.*,
                    ledger_sub_group.ledger_sub_group_name,
                    ledger_sub_group.ledger_sub_group_parent_id,
                    ledger_group.ledger_name FROM
                    ledger_posting_head INNER JOIN ledger_sub_group
                    ON ledger_posting_head.ledger_sub_group_id = ledger_sub_group.ledger_sub_group_id 
                    INNER JOIN ledger_group
                    ON ledger_posting_head.ledger_group_id = ledger_group.ledger_id WHERE ledger_posting_head_id = '$update'";
                    
                    $uResult = $db->select($sql);
                    if ($uResult) {
                    $urow = $uResult->fetch_assoc();

        ?>


         <form action="" method="post" id="myForm">
            <table class="form">
                <tr>
                    <td>
                        <label>Ledger Parent Type</label>
                    </td>
                    <td>
                        <select name="ledger_group_id" id="ledger_group_id"  onchange="emptValid(this.id,'errledger_group_id','select')">
                           <option value="">Select group Type</option>
        <?php
                $sql = "SELECT * FROM ledger_group ORDER BY ledger_name ASC";
                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
                    if ($row['ledger_id'] == $urow['ledger_group_id']) {
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
        ?></select>
            <small style="display:block;" id="errledger_group_id"></small>
                    </td>
                </tr>


                <tr>
                    <td>
                        <label>Ledger Sub Type</label>
                    </td>
                    <td>
                        <select name="ledger_sub_group_id" id="ledger_sub_group_id" onchange="emptValid(this.id,'errledger_sub_group_id','select')">
                           <option value="">Select group Type</option>
        <?php
                $ledger_sub_group_id = $urow['ledger_sub_group_id'];
                $sql = "SELECT * FROM ledger_sub_group WHERE ledger_sub_group_id = '$ledger_sub_group_id' ORDER BY ledger_sub_group_name ASC";

                $result = $db->select($sql);
                if ($result) {
                while($row = $result->fetch_assoc()){
                    if ($row['ledger_sub_group_id'] == $urow['ledger_sub_group_id']) {
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
        ?></select>
          <small style="display:block;" id="errledger_sub_group_id"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Posting Headname</label>
                    </td>
                    <td>
                        <input type="text" name="posting_head_name" placeholder="Enter ledger sub group name"  id="posting_head_name" onkeyup="emptValid(this.id,'errposting_head_name')" onblur="emptValid(this.id,'errposting_head_name')" value="<?php echo $urow['posting_head_name']; ?>" class="medium" />
                        <small style="display:block;" id="errposting_head_name"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Date</label>
                    </td>
                    <td>
                        <input type="date" name="posting_head_date" id="posting_head_date" onkeyup="emptValid(this.id,'errposting_head_date')" onblur="emptValid(this.id,'errposting_head_date')" placeholder="Enter ledger sub group name" value="<?php echo $urow['posting_head_date']; ?>" class="medium" />
                        <small style="display:block;" id="errposting_head_date"></small>
                    </td>
                </tr>
                <tr>				
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update" Value="Update" />
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
