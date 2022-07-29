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
        <h2>Trial Balance</h2>
       <div class="block copyblock">

         <form action="" method="post">
            <table class="form" cellpadding="0" cellspacing="0">
                <tr>
                    <td></td>
                    <td>
                        <input style="margin: 0 auto;width: 100%;" type="submit" name="submit" Value="Generate trial balance" />
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
   $sql = "SELECT DISTINCT phosting_head_id FROM voucher";
    $result =  $db->select($sql);
    if ($result) {
    $totalCr = 0;
    $totalDr = 0;

?>
    <table class="myTable">
    <thead>
        <tr>
            <th colspan="6"><h3 style="background: #f6f1f1;padding: 5px;text-align: center;">Trial Balance of <?php 
            if (isset($icon['Company_name'])) {
                echo $icon['Company_name'];
            }
        ?> on <?php echo date("d-M-Y");?></h3></th>
        </tr>
        <tr>
            <th>Particulars</th>
            <th>Amount(Debit)</th>
            <th>Amount(Credit)</th>
        </tr>
        <tr>
    </thead>
    <tbody>

<?php

while($row = $result->fetch_assoc()){

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
                

            }

?>
    
        <tr>
            <td><?php echo $trialrow['posting_head_name']; ?></td>
        <?php 

         $drcrResult = $Credit_amount-$debit_amount;

         if ($drcrResult > 0) {
        ?>
            <td><?php
            
            $totalDr += abs($drcrResult);
             echo number_format(abs($drcrResult)); 
         ?></td>
            <td>-</td>
        <?php }else{ ?>
            <td>-</td>
            <td><?php
            $totalCr += abs($drcrResult);
             echo number_format(abs($drcrResult));
            ?></td>
           
        <?php } ?>
        </tr>
     

<?php

}
?>
        <tr>
            <th>Total</th>
             <th><?php echo number_format($totalDr); ?></th>
             <th><?php echo number_format($totalCr); ?></th>
           
        </tr>
    </tbody>
    </table>
    
    <div style="height:30px; text-align: center;">
    <button onclick="window.print()" style="overflow: hidden;margin-right: 20px;margin-top: 20px; border-radius:20px 20px;padding: 8px;font-weight: bold;font-size: 20px;background: #204562;color: white;width: 100px; background-image: linear-gradient(135deg, #204562 40%, #2e5e79 60%);}">Print</button>
    </div>
    
<?php
    }
}

?>
      
    </div>
</div>

        
<?php include "inc/admin_footer.php"; ?>
