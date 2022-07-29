<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<style type="text/css">
    .myTable{
		border-collapse:collapse;
		border-spacing:0; 
        text-align: center;
        width: 80%;
        margin: 0 auto;
    }
    .myTable td{
        border: 1px solid;
        padding: 5px;
    }

    .myTable th{
        border: 1px solid;
        padding: 5px;
    }

    @media print{
		html, body {
		visibility: hidden;
		height:100vh; 
		margin: 0 !important; 
		padding: 0 !important;
		overflow: hidden;
		}

		.myTable{
		visibility: visible;
		position: absolute;
		border-collapse:collapse;
		border-spacing:0;
		left: 0;
		top: 0;
		width: 100%;
		margin: 0 auto;
		}
	
		@page{
		size: auto;
		}
    }
</style>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Balance Sheet</h2>
       <div class="block copyblock">

         <form action="" method="post">
            <table class="form" cellpadding="0" cellspacing="0">
                <tr>
                    <td></td>
                    <td>
                        <input style="margin: 0 auto;width: 100%;" type="submit" name="submit" Value="Balance Sheet" />
                    </td>
                </tr>
            </table>
            </form>
        </div>

        <br>
        <hr>
        <br>


        <?php 

if (isset($_POST['submit'])) {

    $sql = "SELECT DISTINCT group_id FROM voucher ORDER BY group_id ASC";
    $result =  $db->select($sql);


    if ($result) {

?>
    <table class="myTable">
            <tr>
                <th colspan="6">
                    <h3 style="background: #f6f1f1;padding: 5px;text-align: center;">Balance Sheet</h3>
                    <?php echo "<p>".date("d-F-Y")."<p>"; ?>
                </th>
            </tr>
<?php
        while($row      = $result->fetch_assoc()){
            $group_id   = $row['group_id'];

    $groupsql = "SELECT 
    voucher.*,
    group_type.*,
    ledger_group.*
    FROM voucher INNER JOIN group_type
    ON voucher.group_id = group_type.group_type_id
    INNER JOIN ledger_group
    ON voucher.ledger_id = ledger_group.ledger_id 
    WHERE voucher.group_id = '$group_id' ORDER BY voucher.ledger_id ASC";

    $groupresult    =  $db->select($groupsql);
    $gropuRow       = $groupresult->fetch_assoc();
?>
    
    <tr>
        <th align="left" style="padding-left: 30px"><?php echo $gropuRow['group_type_name']; ?></th>
        <th></th>
    </tr>

<?php

    $ledgersql = "SELECT DISTINCT ledger_id FROM voucher WHERE group_id ='$group_id' ORDER BY ledger_id ASC";
    $ledgerresult =  $db->select($ledgersql);

    $totalCount = 0;

     while($ledgerrow   = $ledgerresult->fetch_assoc()){
            $ledger_id   = $ledgerrow['ledger_id'];

            $ledgerNamesql = "SELECT * FROM ledger_group WHERE ledger_id = '$ledger_id'";

            $ledgerResult =  $db->select($ledgerNamesql);
            $ledgerRow = $ledgerResult->fetch_assoc();

            $calSql = "SELECT * FROM voucher WHERE ledger_id = '$ledger_id'";

            $calResult =  $db->select($calSql);
            $debit_amount = 0;
            $Credit_amount = 0;

            if ($calResult) {
                while($calRow = $calResult->fetch_assoc()){
                    $debit_amount   += (int) $calRow['debit_amount'];
                    $Credit_amount  += (int) $calRow['Credit_amount'];
                }
            }

        ?>

        <tr>
            <td align="left" style="padding-left:50px;"><?php  echo $ledgerRow['ledger_name']; ?></td>
            <td align="left" style="padding-left:50px;"><?php
                $totalCount += $debit_amount+$Credit_amount;
                echo number_format($debit_amount+$Credit_amount);
              ?></td>
        </tr>

        <?php


            }
         ?>

        <tr>
           <th align="left" style="border-bottom: 2px solid;border-top: 2px solid;padding-left:50px;">Total <?php echo $gropuRow['group_type_name']; ?></th>
           <th align="left" style="border-bottom: 2px solid;border-top: 2px solid;padding-left:50px;"><?php echo number_format($totalCount); ?></th>
        </tr>

    <?php
        }

    ?>
    </table>
    <div style="height:30px; text-align: center;">
    <button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);">Print</button>
    </div>
    <?php

    }

    


}


         ?>

       

<?php

/*while($row = $result->fetch_assoc()){

        $getpostId = $row['phosting_head_id'];

        $trisql = "SELECT 
        voucher.*,
        ledger_posting_head.posting_head_name
        FROM voucher INNER JOIN ledger_posting_head 
        ON voucher.phosting_head_id = ledger_posting_head.ledger_posting_head_id WHERE phosting_head_id = '$getpostId'";


        $trialresult =  $db->select($trisql);
        $trialrow = $trialresult->fetch_assoc();


        $tsql = "SELECT 
        voucher.*,
        ledger_posting_head.posting_head_name
        FROM voucher INNER JOIN ledger_posting_head 
        ON voucher.phosting_head_id = ledger_posting_head.ledger_posting_head_id WHERE phosting_head_id = '$getpostId'";

            $tresult =  $db->select($tsql);

            $debit_amount = 0;
            $Credit_amount = 0;

            while($trow = $tresult->fetch_assoc()){

                if ($trow['debit_amount']) {
                    $debit_amount += $trow['debit_amount'];
                }else{
                    $Credit_amount += $trow['Credit_amount'];
                }
                

            }*/

?>

    </tbody>
    </table>
	
      
    </div>
</div>

        
<?php include "inc/admin_footer.php"; ?>
