<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<div class="grid_10">
    <style type="text/css">
        select,input[type='text'],input[type='date'],input[type='month']{
            width: 250px;
        }
    </style>
    <div class="box round first grid">
        <h2>Add Balance</h2>
       <div class="block copyblock">

        <?php

            if(isset($_POST['save'])) {
                if (empty($_POST['Op_date']) || empty($_POST['Date_time'])) {
                     echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else{
                    $Voucher_no       = $_POST['Voucher_no'];
                    $ledger_id        = $_POST['ledger_id'];
                    $Sub_group_id     = $_POST['Sub_group_id'];
                    $Posting_head_id  = $_POST['Posting_head_id'];
                    $Op_date       = $_POST['Op_date'];
                    $Debit_credit              = $_POST['Debit_credit'];
                    $Amount        = $_POST['Amount'];
                    $bl_type       = $_POST['bl_type'];
                    $Date_time     = $_POST['Date_time'];

                    $sql = "INSERT INTO opening_balance(
                        Voucher_no,
                        ledger_id,
                        Sub_group_id,
                        Posting_head_id,
                        Op_date,
                        Debit_credit,
                        Amount,
                        bl_type,
                        Date_time) 
                        VALUES('$Voucher_no',
                            '$ledger_id',
                            '$Sub_group_id',
                            '$Posting_head_id',
                            '$Op_date',
                             '$Debit_credit',
                            '$Amount',
                            '$bl_type',
                            '$Date_time')";

                            $result = $db->insert($sql);

                            $sql = "UPDATE voucher SET voucher_status ='0' WHERE voucher_no = '$Voucher_no'";
                            $userResult = $db->update($sql);

                            if ($result > 0 && $userResult) {
                               echo "<p style='color:green;text-align:center;'>Transaction transfer successful.</p>";
                            }else{
                                 echo "<p style='color:red;text-align:center;'>Transaction transfer fail.</p>";
                            }
                    }
               
            }






            $complete = false;
            if (isset($_POST['submit'])) {
                
                $Voucher_no = $_POST['Voucher_no'];
                $sql = "SELECT * FROM voucher WHERE voucher_no = '$Voucher_no'";
                $result = $db->select($sql);

                if ($result) {
                $row = $result->fetch_assoc();
                $status = $row['voucher_status'];

                if (empty($_POST['Voucher_no'])) {
                    echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($result == false){
                      echo "<p style='color:red;text-align:center;'>Voucher is not exist.</p>";
                }else if($status == 0){
                      echo "<p style='color:red;text-align:center;'>Voucher number is used.</p>";
                }else{
                    $complete = true;
                }
                }
            }  

        ?>

        <form method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Voucher No</label>
                    </td>
                    <td><input type="text" name="Voucher_no"></td>
                </tr>
                <tr>
                    <td>
                        <label></label>
                    </td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </tr>
            </table>
        </form>

        <?php 

            if ($complete == true) {

                $sql = "SELECT * FROM voucher WHERE voucher_no = '$Voucher_no'";
                $result = $db->select($sql);
                if ($result) {
                $row = $result->fetch_assoc();
        ?>

    <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Voucher No</label>
                    </td>
                    <td><input type="text" readonly name="Voucher_no" value="<?php
                     echo $row['voucher_no'];
                    ?>"></td>
                </tr>
                <tr>
                    <td>
                        <label>Ledger Type</label>
                    </td>
                    <td>
                    <select name="ledger_id">
                        <option value="<?php echo $row['ledger_id']; ?>"><?php
                         $ledger_id = $row['ledger_id'];

            $gsql = "SELECT * FROM ledger_group WHERE ledger_id = '$ledger_id'";

                         $gResult = $db->select($gsql);
                         if ($gResult) {
                            $grow = $gResult->fetch_assoc();
                             echo $grow['ledger_name'];
                         }
                         

                     ?></option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Sub Group</label>
                    </td>
                    <td>
                    <select name="Sub_group_id">
                        <option value="<?php echo $row['sub_goup_id']; ?>"><?php
                
                         $sub_goup_id = $row['sub_goup_id'];

                        $sgsql = "SELECT * FROM ledger_sub_group WHERE ledger_sub_group_id = '$sub_goup_id'";

                         $sgResult = $db->select($sgsql);
                         if ($sgResult) {
                            $sgrow = $sgResult->fetch_assoc();
                             echo $sgrow['ledger_sub_group_name'];
                         }
                         

                     ?></option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Posting Head</label>
                    </td>
                    <td>
                    <select name="Posting_head_id">
                        <option value="<?php echo $row['phosting_head_id']; ?>"><?php
                
                         $phosting_head_id = $row['phosting_head_id'];

                        $psql = "SELECT * FROM ledger_posting_head WHERE ledger_posting_head_id = '$phosting_head_id'";

                         $pResult = $db->select($psql);
                         if ($pResult) {
                            $prow = $pResult->fetch_assoc();
                             echo $prow['posting_head_name'];
                         }
                         

                     ?></option>
                    </select>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Op Date</label>
                    </td>
                    <td>
                      <input type="date" name="Op_date">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Debit/Credit</label>
                    </td>
                    <td>
                        <select name="Debit_credit">
                            <option value="<?php

                       if($row['debit_amount'] == true){
                        echo "dr";
                       }else{
                        echo "cr";
                       }

                   ?>"><?php

                       if($row['debit_amount'] == true){
                        echo "Debit";
                       }else{
                        echo "Credit";
                       }

                   ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Amount</label>
                    </td>
                    <td>
                      <input type="text" readonly name="Amount" value="<?php

                       if($row['debit_amount'] == true){
                        echo $row['debit_amount'];
                       }else{
                        echo $row['Credit_amount'];
                       }

                   ?>">
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Balance Type</label>
                    </td>
                    <td>
                    <select name="bl_type">
                       <option value="bank">Bank</option>
                       <option value="cash">Cash</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Date Time</label>
                    </td>
                    <td>
                      <input type="datetime-local" name="Date_time">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="save" Value="Confirm" />
                    </td>
                </tr>
            </table>
            </form>





        <?php
                       
                }
            }   
        ?>

        </div>
    </div>
</div>
        
<?php include "inc/admin_footer.php"; ?>
