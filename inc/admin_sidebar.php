<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
                <li><a class="menuitem">User Setup</a>
                    <ul class="submenu">
                        <li><a href="user.php">Users List</a> </li>
                    </ul>
                </li>
                <?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1 || $role_id == 2) {
                ?>
                <li><a class="menuitem">Initial Setup</a>
                    <ul class="submenu">
                        <li><a href="country.php">Add City</a> </li>
                        <li><a href="businesstype.php">Business Type</a> </li>
                        <li><a href="company_type.php">Company Type</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1) {
                ?>
                <li><a class="menuitem">Company Setting</a>
                    <ul class="submenu">
                        <li><a href="companyUpdate.php">Comparny Info</a></li>
                        <li><a href="changeImage.php">Change logo</a></li>
                        <li><a href="addbranch.php">Add Branch</a> </li>
                        
                    </ul>
                </li>

                <?php } ?>

                <?php
                        $role_id = Session::get("role_id");
                        if ($role_id == 1 || $role_id == 2) {
                ?>

                <li><a class="menuitem">Ledger Setup</a>
                    <ul class="submenu">
                        <li><a href="group_type.php">Add Group</a> </li>
                        <li><a href="ledger.php">ledger group</a> </li>
                        <li><a href="ledger_sub.php">ledger sub group</a> </li>
                        <li><a href="ledger_sub_head_posting.php">ledger posting</a> </li>
                    </ul>
                </li>
                <?php 
                    }
                ?>
                <?php
                    $role_id = Session::get("role_id");
                    if ($role_id == 1) {
                ?>
				<li><a class="menuitem">Budget Option</a>
                    <ul class="submenu">
                        <li><a href="addbudget.php">Budgets</a> </li>
                    </ul>
                </li>
                <?php
                    }
                 ?>
                <li><a class="menuitem">Voucher</a>
                    <ul class="submenu">
                <?php
                    $role_id = Session::get("role_id");
                    if ($role_id == 1 || $role_id == 2) {
                ?>
                        <li><a href="voucher_type.php">Voucher Type</a></li>
                <?php } ?>
					    <li><a href="voucher.php">Add Voucher</a> </li>
						<li><a href="voucherList.php">Voucher List</a> </li>
                    </ul>
                </li>
				<li><a class="menuitem">Reports</a>
                    <ul class="submenu">
                       <!--  <li><a href="balance.php">Add Balance</a> </li> -->
                        <li><a href="fiscal.php">Date-wise Report</a> </li>
                        <li><a href="accountwisebalance.php">Account-wise BL</a> </li>
                        <li><a href="trialbalance.php">Trial balance</a> </li>
                        <li><a href="sales_payment_report.php">Earn-spend report</a> </li>
                        <li><a href="balanceSheet.php">Balance Sheet</a> </li>
					</ul>
				</li>
				<li><a class="menuitem">Logs</a>
                    <ul class="submenu">
				<li><a href="logInfo.php">Login Info</a></li>
					</ul>
				</li>
            </ul>
        </div>
    </div>
</div>