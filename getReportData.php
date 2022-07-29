<?php
    include_once("lib/Database.php");
    include_once("lib/Session.php");
    include_once("lib/amountinword.php");
    Session::init();
    if (Session::get("session") == false) {
        header("location:login.php");
    }
    $db = new Database();
    $aword  = new amountword();

    if (isset($_GET['action']) && $_GET['action'] == "logout") {
        date_default_timezone_set("Asia/Dhaka");
        $log_time = date("h:i:s A");
        $insert_Id = Session::get("insert_Id");
        $sql = "UPDATE log_table SET Logout_time = '$log_time' WHERE Log_id = '$insert_Id'";
        $db->update($sql);
        Session::destroy();
        header("location:login.php");
    }
?>

<?php 

    //------------------For accountwise balance start----

            if (isset($_REQUEST['posting_head_id'])) {

             $posting_head_id = $_REQUEST['posting_head_id'];
        ?>
        <?php

                $osql = "SELECT * FROM ledger_posting_head WHERE ledger_posting_head_id = '$posting_head_id'";

                $oresult = $db->select($osql);
                if ($oresult) {
                $orow = $oresult->fetch_assoc();
                $orow['posting_head_name'];
            }

 $sql = "SELECT
  voucher.*,
 ledger_posting_head.posting_head_name,
 ledger_sub_group.ledger_sub_group_name

    FROM voucher INNER JOIN ledger_posting_head
    ON voucher.phosting_head_id = ledger_posting_head.ledger_posting_head_id
    INNER JOIN ledger_sub_group
    ON voucher.sub_goup_id = ledger_sub_group.ledger_sub_group_id

 WHERE phosting_head_id = '$posting_head_id' AND voucher_status = 0";

                $result = $db->select($sql);
                if ($result) {
        ?>


  <table class="myTable">
    <thead>
        <tr>
            <th colspan="6"><?php if(isset($orow['posting_head_name'])){
                echo $orow['posting_head_name'];
            }?> Account</th>
        </tr>
        <tr>
            <th colspan="3">Dr.</th>
            <th colspan="3">Cr.</th>
        </tr>
        <tr>
            <th>Date</th>
            <th>Particulars</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Particulars</th>
            <th>Amount</th>
        </tr>
        <tr>
    </thead>
    <tbody>


            <?php 

       

                    $debit_amount   = 0;
                    $Credit_amount  = 0;

                    while($row = $result->fetch_assoc()){
        ?>

        

        <tr>
            <?php 

                if ($row['debit_amount'] == "") {
            ?>
                <td><span style="font-weight: 400;"></span></td>
                <td><span style="font-weight: 400;"></span></td>
                <td><span style="font-weight: 400;"></span></td>
                <td><span style="font-weight: 400;"><?php echo $row['voucher_date']; ?></span></td>
                <td><?php echo "By ".$row['ledger_sub_group_name']; ?></td>
                <td><span style="font-weight: 400;"><?php

                 echo number_format($row['Credit_amount']);
                  $Credit_amount += $row['Credit_amount'];
            ?></span></td>
                

            <?php 
                }else{
            ?>

                
                <td><span style="font-weight: 400;"><?php echo $row['voucher_date']; ?></span></td>
                <td><?php echo "To ".$row['ledger_sub_group_name']; ?></td>
                <td><span style="font-weight: 400;"><?php

                 echo number_format($row['debit_amount']);
                 $debit_amount += $row['debit_amount'];

             ?></span></td>
             <td><span style="font-weight: 400;"></span></td>
                <td><span style="font-weight: 400;"></span></td>
                <td><span style="font-weight: 400;"></span></td>

            <?php 
                }
            ?>
        </tr>




        <?php
                    }

        ?>


        
                <tr>
                    <?php 

                        if ($Credit_amount > $debit_amount) {
                            $upper = $Credit_amount;
                        }else{
                            $upper = $debit_amount;
                        }

                    ?>
                    <td></td>
                    <td></td>
                    <td><b><?php echo number_format($upper); ?></b></td>
                    <td></td>
                    <td></td>
                    <td><b><?php echo number_format($upper); ?></b></td>
                </tr>
                <tr>
                    <?php 

                        $ctotal =  $Credit_amount - $debit_amount;

                        if ($ctotal > 0) {

                    ?>
                    <td><span style="font-weight: 400;"></span></td>
                    <td><span style="font-weight: 400;">To Balance b/d</span></td>
                    <td><b><?php echo number_format($ctotal) ?></b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                <?php }else { ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><span style="font-weight: 400;"></span></td>
                    <td><span style="font-weight: 400;">By Balance c/d</span></td>
                    <td><b><?php
                    echo number_format(abs($ctotal));
                ?></b></td>
                <?php }?>
                </tr>
            </tbody>
        </table>
    
        <div style="height:30px; text-align: center;">
    <button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);">Print</button>
    </div>
         <?php   
                }else{
                    echo "<h4 style='text-align:center;color:red;'>Record not found!<h4>";
                }
    }

  //------------------For accountwise balance End----

?>


 
 <?php 

     //------------------For range start----
        
    if (isset($_REQUEST['date1']) && isset($_REQUEST['date1'])) {

   if ($_REQUEST['date1'] <= $_REQUEST['date2']) {

                    $date1 = $_REQUEST['date1'];
                    $date2 = $_REQUEST['date2'];

                  $sql = "SELECT
                   voucher.*,
                    voucher_type.*
                    FROM voucher INNER JOIN voucher_type
                   ON voucher.voucher_type = voucher_type.voucher_type_id WHERE voucher_date BETWEEN '$date1' AND '$date2' AND voucher_status = 0";

                $result = $db->select($sql);
                if ($result) {
        ?>


        <table class="myTable">
            <tr>
                <th>SL</th>
                <th>Date</th>
                <th>Type</th>
                <th>Voucher No</th>
                <th>Debit Balance</th>
                <th>Credit Balance</th>
                
            </tr>

        <?php 

                   $i = 1;

                    $debit_amount = 0;
                    $Credit_amount = 0;

                    while($row = $result->fetch_assoc()){
        ?>

            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['voucher_date']; ?></td>
                <td><?php echo $row['voucher_type_name']; ?></td>
                <td><?php echo $row['voucher_no']; ?></td>
                <td align="right"><?php

                    $debit_amount += (int) $row['debit_amount'];

                 echo $row['debit_amount']; 

             ?></td>
                <td align="right"><?php
                    $Credit_amount += (int) $row['Credit_amount'];
                     echo $row['Credit_amount'];

                 ?></td>
                
            </tr>

        <?php
                        
            }
        ?>
        <tr>
            <th colspan="4" align="right">Current Total: </th>
            <th align="right"><?php echo number_format(round($debit_amount,2));?></th>
            <th align="right"><?php echo number_format(round($Credit_amount,2));?></th>
        </tr>
        <tr>
            <th colspan="4" align="right">Closing Balance: </th>
            <th colspan="2" align="right">

                <?php echo number_format(round(abs($Credit_amount-$debit_amount)));?>
                    
            </th>
            
        </tr>
            

        </table>
    <div style="height:30px; text-align: center;">
    <button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);">Print</button>
    </div>
    <?php }else{
            echo "<h4 style='text-align:center;color:red;'>Record not found!<h4>";

        //------------------For range end----

    }}} ?>










<?php 

    //------------------------For voucher type-------------------

?>




    <?php


    if (isset($_REQUEST['select_type'])) {

    ?>

    <option value="">Select sub type</option>

    <?php

        $select_type = $_REQUEST['select_type'];

        if ($select_type == "in") {

             $sql = "SELECT * FROM voucher_type WHERE voucher_type_nature = '$select_type'";

            $result = $db->select($sql);

    ?>
            <option value="in_all">All</option>
    <?php 
        while($row = $result->fetch_assoc()){
    ?>

        <option value="<?php echo $row['voucher_type_id']; ?>"><?php echo $row['voucher_type_name']; ?></option>

<?php

 }}else if($select_type == "out"){

     $sql = "SELECT * FROM voucher_type WHERE voucher_type_nature = '$select_type'";

            $result = $db->select($sql);
?>
            <option value="out_all">All</option>
<?php
            while($row = $result->fetch_assoc()){

?>
     <option value="<?php echo $row['voucher_type_id']; ?>"><?php echo $row['voucher_type_name']; ?></option>

<?php

    }}
}


?>


<?php 

    //-----------------For voucher type calculation-------------------

?>

<?php

if (isset($_REQUEST['select_type_test']) && $_REQUEST['select_type_test'] == "in") {

if (isset($_REQUEST['voucher_type_id']) && !empty($_REQUEST['voucher_type_id'])) {

     $voucher_type_id = $_REQUEST['voucher_type_id'];

    if ($voucher_type_id == "in_all") {

        $uniqsql = "SELECT DISTINCT voucher_type_id FROM voucher_type INNER JOIN voucher
        ON voucher_type.voucher_type_id = voucher.voucher_type WHERE voucher_type.voucher_type_nature = 'in'";

        $uniqresult = $db->select($uniqsql);
        if ($uniqresult) {

    ?>

    <table class="myTable">
                <tr>
                    <th>SL</th>
                    <th>Particulars</th>
                    <th>Type</th>
                    <th>Voucher No</th>
                    <th>Amount</th>
                </tr>

    <?php

        $i = 1;
        $creditamount = 0;

        while($uniqrow = $uniqresult->fetch_assoc()){
           $voucher_type_id = $uniqrow['voucher_type_id'];


           $allsql = "SELECT
            voucher.*,
            voucher_type.*,
            ledger_posting_head.*
            FROM voucher INNER JOIN voucher_type
           ON voucher.voucher_type = voucher_type.voucher_type_id
           INNER JOIN ledger_posting_head
            ON voucher.phosting_head_id = ledger_posting_head.ledger_posting_head_id WHERE voucher_type = '$voucher_type_id' AND voucher_status = 0";

        $allresult = $db->select($allsql);
        if ($allresult) {
            while($allRow = $allresult->fetch_assoc()){

    ?>

                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $allRow['posting_head_name']; ?></td>
                    <td><?php echo $allRow['voucher_type_name']; ?></td>
                    <td><?php echo $allRow['voucher_no']; ?></td>
                    <td><?php $creditamount += (int) $allRow['Credit_amount'];
                    echo $allRow['Credit_amount'];?>
                    </td>
                </tr>
    
<?php

        }

        }
    }

?>
 <tr>
                <th  align="right" colspan="4">Total</th>
                <th><?php echo number_format(round($creditamount,2));?></th>
            </tr>
    </table>

        <div style="height:30px; text-align: center;">
        <button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);">Print</button>
        </div>
<?php
        }else{
            echo "<h4 style='text-align:center;color:red;'>Record not found!<h4>";
        }
    }else{

        $uniqsql = "SELECT DISTINCT voucher_type_id FROM voucher_type INNER JOIN voucher
        ON voucher_type.voucher_type_id = voucher.voucher_type WHERE voucher_type.voucher_type_id = '$voucher_type_id'";

        $uniqresult = $db->select($uniqsql);
        if ($uniqresult) {
?>

<table class="myTable">
                <tr>
                    <th>SL</th>
                    <th>Particulars</th>
                    <th>Type</th>
                    <th>Voucher No</th>
                    <th>Amount</th>
                </tr>

    <?php

        $i = 1;
        $creditamount = 0;

        while($uniqrow = $uniqresult->fetch_assoc()){
           $voucher_type_id = $uniqrow['voucher_type_id'];


           $allsql = "SELECT
            voucher.*,
            voucher_type.*,
            ledger_posting_head.*
            FROM voucher INNER JOIN voucher_type
           ON voucher.voucher_type = voucher_type.voucher_type_id
           INNER JOIN ledger_posting_head
            ON voucher.phosting_head_id = ledger_posting_head.ledger_posting_head_id WHERE voucher_type = '$voucher_type_id' AND voucher_status = 0";

        $allresult = $db->select($allsql);
        if ($allresult) {
            while($allRow = $allresult->fetch_assoc()){

    ?>

                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $allRow['posting_head_name']; ?></td>
                    <td><?php echo $allRow['voucher_type_name']; ?></td>
                    <td><?php echo $allRow['voucher_no']; ?></td>
                    <td><?php $creditamount += (int) $allRow['Credit_amount'];
                    echo $allRow['Credit_amount'];?>
                    </td>
                </tr>
    
<?php

        }

        }
    }

?>
 <tr>
                <th  align="right" colspan="4">Total</th>
                <th><?php echo number_format(round($creditamount,2));?></th>
            </tr>
    </table>

        <div style="height:30px; text-align: center;">
        <button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);">Print</button>
        </div>





<?php
    }else{
        echo "<h4 style='text-align:center;color:red;'>Record not found!<h4>";
    }
    }
}
}

?>




<?php

//-------------Out start--------------

if (isset($_REQUEST['select_type_test']) && $_REQUEST['select_type_test'] == "out") {

if (isset($_REQUEST['voucher_type_id']) && !empty($_REQUEST['voucher_type_id'])) {

     $voucher_type_id = $_REQUEST['voucher_type_id'];

    if ($voucher_type_id == "out_all") {

        $uniqsql = "SELECT DISTINCT voucher_type_id FROM voucher_type INNER JOIN voucher
        ON voucher_type.voucher_type_id = voucher.voucher_type WHERE voucher_type.voucher_type_nature = 'out'";

        $uniqresult = $db->select($uniqsql);
        if ($uniqresult) {

    ?>

    <table class="myTable">
                <tr>
                    <th>SL</th>
                    <th>Particulars</th>
                    <th>Type</th>
                    <th>Voucher No</th>
                    <th>Amount</th>
                </tr>

    <?php

        $i = 1;
        $debitamount = 0;

        while($uniqrow = $uniqresult->fetch_assoc()){
           $voucher_type_id = $uniqrow['voucher_type_id'];


           $allsql = "SELECT
            voucher.*,
            voucher_type.*,
            ledger_posting_head.*
            FROM voucher INNER JOIN voucher_type
           ON voucher.voucher_type = voucher_type.voucher_type_id
           INNER JOIN ledger_posting_head
            ON voucher.phosting_head_id = ledger_posting_head.ledger_posting_head_id WHERE voucher_type = '$voucher_type_id' AND voucher_status = 0";

        $allresult = $db->select($allsql);
        if ($allresult) {
            while($allRow = $allresult->fetch_assoc()){

    ?>

                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $allRow['posting_head_name']; ?></td>
                    <td><?php echo $allRow['voucher_type_name']; ?></td>
                    <td><?php echo $allRow['voucher_no']; ?></td>
                    <td><?php $debitamount += (int) $allRow['debit_amount'];
                    echo $allRow['debit_amount'];?>
                    </td>
                </tr>
    
<?php
        }

        }

        }

?>
 <tr>
                <th  align="right" colspan="4">Total</th>
                <th><?php echo number_format(round($debitamount,2));?></th>
            </tr>
    </table>

        <div style="height:30px; text-align: center;">
        <button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);">Print</button>
        </div>
<?php
    
    }else{
        echo "<h4 style='text-align:center;color:red;'>Record not found!<h4>";
    }
    
}else{

         $uniqsql = "SELECT DISTINCT voucher_type_id FROM voucher_type INNER JOIN voucher
        ON voucher_type.voucher_type_id = voucher.voucher_type WHERE voucher_type.voucher_type_id = '$voucher_type_id'";

        $uniqresult = $db->select($uniqsql);

        if ($uniqresult) {
?>

<table class="myTable">
                <tr>
                    <th>SL</th>
                    <th>Particulars</th>
                    <th>Type</th>
                    <th>Voucher No</th>
                    <th>Amount</th>
                </tr>

    <?php

        $i = 1;
        $debitamount = 0;

        while($uniqrow = $uniqresult->fetch_assoc()){
           $voucher_type_id = $uniqrow['voucher_type_id'];


           $allsql = "SELECT
            voucher.*,
            voucher_type.*,
            ledger_posting_head.*
            FROM voucher INNER JOIN voucher_type
           ON voucher.voucher_type = voucher_type.voucher_type_id
           INNER JOIN ledger_posting_head
            ON voucher.phosting_head_id = ledger_posting_head.ledger_posting_head_id WHERE voucher_type = '$voucher_type_id' AND voucher_status = 0";

        $allresult = $db->select($allsql);
        if ($allresult) {
            while($allRow = $allresult->fetch_assoc()){

    ?>

                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $allRow['posting_head_name']; ?></td>
                    <td><?php echo $allRow['voucher_type_name']; ?></td>
                    <td><?php echo $allRow['voucher_no']; ?></td>
                    <td><?php $debitamount += (int) $allRow['debit_amount'];
                    echo $allRow['debit_amount'];?>
                    </td>
                </tr>
    
<?php

        }

        }
    }

?>
 <tr>
                <th  align="right" colspan="4">Total</th>
                <th><?php
                echo number_format(round($debitamount,2));
            ?></th>
            </tr>
    </table>

        <div style="height:30px; text-align: center;">
        <button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);">Print</button>
        </div>





<?php

    }else{
        echo "<h4 style='text-align:center;color:red;'>Record not found!<h4>";
    }
    }


}


}

?>

