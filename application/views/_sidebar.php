<?php
$segment_cntr = $this->uri->segment(1);
$segment_fun = $this->uri->segment(2);

$accountIndex = ($segment_cntr == 'accounts' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$accountAdd = ($segment_cntr == 'accounts' && $segment_fun == 'manage') ? 'active' : '';

$paymentIndex = ($segment_cntr == 'payments' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$paymentAdd = ($segment_cntr == 'payments' && $segment_fun == 'manage') ? 'active' : '';

$settingIndex = ($segment_cntr == 'settings' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$settingProfile = ($segment_cntr == 'settings' && $segment_fun == 'profile') ? 'active' : '';
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <a href="<?php echo site_url('dashboard'); ?>" class="<?php echo $segment_cntr == 'dashboard' ? 'active' : ''; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>  

            <li class="<?php echo $segment_cntr == 'accounts' ? 'active' : ''; ?>">
                <a href="#"><i class="glyphicon glyphicon-user"></i> Accounts<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php echo $segment_cntr == 'accounts' ? 'in' : ''; ?>">
                    <li>
                        <a href="<?php echo site_url('accounts/index'); ?>" class="<?php echo $accountIndex; ?>">Account List</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('accounts/manage'); ?>" class="<?php echo $accountAdd; ?>">Add Account</a>
                    </li> 
                </ul> 
            </li>
            
            <li class="<?php echo $segment_cntr == 'payments' ? 'active' : ''; ?>">
                <a href="#"><i class="fa fa-money"></i> Transactions<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php echo $segment_cntr == 'payment' ? 'in' : ''; ?>">
                    <li>
                        <a href="<?php echo site_url('payments/index'); ?>" class="<?php echo $paymentIndex; ?>">Transaction List</a>
                    </li>                     
                </ul> 
            </li>
 

            <li class="<?php echo $segment_cntr == 'settings' ? 'active' : ''; ?>">
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Site Setting<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php echo $segment_cntr == 'settings' ? 'in' : ''; ?>">
                    <li>
                        <a href="<?php echo site_url('settings/profile'); ?>" class="<?php echo $settingProfile ?>">Profile Setup</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('settings/index'); ?>" class="<?php echo $settingIndex ?>">Settings</a>
                    </li> 
                </ul>
                <!-- /.nav-second-level -->
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>