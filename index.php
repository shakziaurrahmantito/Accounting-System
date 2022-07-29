<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>

<style type="text/css">
    .main{
        display: flex;
    }
    .main div {
        margin: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 10px;
        min-height: 120px;
        background: #f8f4f4;
        min-width: 210px;
        text-align: center;
        box-shadow: inset -1px -2px 0px 0px;
        border: 1px solid #a79797;
    }

    .main div i {
        font-size: 36px;
        color: #196cad;
    }

    .main div h3{
        font-size: 18px;
        text-align: center;
        margin-top: 20px;
    }

    .main div h4{
        font-size: 15px;
        text-align: center;
    }
</style>

    <?php

        $sqls = "SELECT * FROM opening_balance WHERE Debit_credit = 'cr'";
        $crresult = $db->select($sqls);
        if ($crresult) {
            $crTotal = 0;
            while($row = $crresult->fetch_assoc()){
                $crTotal += $row['Amount'];
            }
        }

    ?>

    <?php

        $sql = "SELECT * FROM opening_balance WHERE Debit_credit = 'dr'";
        $result = $db->select($sql);
        if ($result) {
            $drTotal = 0;
            while($row = $result->fetch_assoc()){
                $drTotal += $row['Amount'];
            }
          
        }

    ?>

 <div class="grid_10">
    <div class="box round first grid">
            <h2> Dashbord</h2>
                <div class="main">

                    <div>
                            <i class="fas fa-dollar-sign"></i>
                            <h3>Balance</h3>
                            <h4>TK: 



<?php 



    $sql = "SELECT DISTINCT group_id FROM voucher ORDER BY group_id ASC";
    $result =  $db->select($sql);


    if ($result) {

    $array = array();

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
    $ledgersql = "SELECT DISTINCT ledger_id FROM voucher WHERE group_id ='$group_id' ORDER BY ledger_id ASC";
    $ledgerresult =  $db->select($ledgersql);

    $totalArray = array();
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


                $totalCount += $debit_amount+$Credit_amount;
                //array_push($totalArray, $totalCount);
  

            }

            $array[] = $totalCount;


        }

        $i = 1;

        $allAssets  = $array[0];
        $all_toal   = 0;

        while($i < count($array)){
            $all_toal += $array[$i];
             $i++;
        }

        echo $all_toal-$allAssets;
    }



         ?>






                            </h4>
                    </div>
                    <div>
                        <i class="fab fa-btc"></i>
                       <h3>Credit</h3>
                       <h4>TK: <?php 
                                if (isset($crTotal)) {
                                    echo number_format($crTotal);
                                }else{
                                    echo "N/A";
                                }
                        ?></h4>
                    </div>
                    <div>
                        <i class="fab fa-bitcoin"></i>
                       <h3>Debit</h3>
                       <h4>TK: <?php 
                                if (isset($drTotal)) {
                                    echo number_format($drTotal);
                                }else{
                                    echo "N/A";
                                }
                        ?></h4>
                    </div>
                    <div>
                       <i class="fas fa-user"></i>
                       <h3>Active Users</h3>
                       <h4><?php

            $sql = "SELECT * FROM log_table";
            $result = $db->select($sql);
            if ($result) {
                $count = 0;
                while( $row = $result->fetch_assoc()){
                    if ($row['Logout_time'] == null) {
                       $count += 1;
                    }
                }
                echo $count;
              
            }else{
                echo "N/A";
            }
                   ?></h4>
                    </div>

                </div><div class="main">

                    <div>
                       <i class="fas fa-balance-scale"></i>
                       <h3>Total Budget</h3>
                       <h4><?php

                            $sql = "SELECT sum(Amount) as 'totalVoucher' FROM budget";
                            $result = $db->select($sql);
                            if ($result) {
                                $row = $result->fetch_assoc();
                                echo number_format($row['totalVoucher']);
                            }else{
                                echo "N/A";
                            }
                   ?></h4>
                    </div>
                    <div>
                        <i class="fas fa-file-alt"></i>
                       <h3>Total Voucher</h3>
                       <h4><?php

                            $sql = "SELECT count(sl_no) as 'totalVoucher' FROM  voucher";
                            $result = $db->select($sql);
                            if ($result) {
                                $row = $result->fetch_assoc();
                                echo number_format($row['totalVoucher']);
                            }else{
                                echo "N/A";
                            }
                   ?></h4>
                    </div>
                    <div>
                       <i class="fas fa-sitemap"></i>
                       <h3>Total Branch</h3>
                       <h4><?php

                            $sql = "SELECT count(Branch_id) as 'totalBrnach' FROM  branch";
                            $result = $db->select($sql);
                            if ($result) {
                                $row = $result->fetch_assoc();
                                echo number_format($row['totalBrnach']);
                            }else{
                                echo "N/A";
                            }
                   ?></h4>
                    </div>
                    <div>
                        <i class="fas fa-users"></i>
                       <h3>Total User</h3>
                       <h4><?php
                        $sql = "SELECT count(users_id) as 'total' FROM users";
                        $result = $db->select($sql);
                        if ($result) {
                            $row = $result->fetch_assoc();
                            echo number_format($row['total']);
                        }else{
                            echo "N/A";
                        }
                   ?></h4>
                    </div>

                </div>

                <style type="text/css">

                    
                    td{
                        border: 1px solid;
                        padding: 5px;
                    }

                </style>
    </div>
</div>

<?php include "inc/admin_footer.php"; ?>