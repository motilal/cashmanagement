<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $total_account; ?></div>
                            <div>Total Accounts!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('accounts/index'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo (int) $AccWallet->debit; ?></div>
                            <div>Total Debit(<i class="fa fa-inr"></i>)</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('payments/index'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo (int) $AccWallet->credit; ?></div>
                            <div>Total Credit(<i class="fa fa-inr"></i>)</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('payments/index'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-piggy-bank fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo (int) $AccWallet->balance; ?><sup><?php echo $AccWallet->type; ?></sup></div>
                            <div>Total Balance(<i class="fa fa-inr"></i>)</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('payments/index'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Account Manager
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="dataTables-grid" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dataTables-grid_info">
                        <thead>
                            <tr role="row" class="order-heading">
                                <th width="30%">Account</th>
                                <th class="greenbg text-right">Total Debit</th> 
                                <th class="redbg text-right">Total Credit</th> 
                                <th class="text-right">Total Balance</th> 
                            </tr>
                        </thead> 
                        <tbody> 
                            <?php if (isset($AccCreditDebit) && $AccCreditDebit->num_rows() > 0) { ?>
                                <?php foreach ($AccCreditDebit->result() as $key => $row): ?>
                                    <tr class="<?php echo ($key % 2 == 0) ? "even" : "odd"; ?> gradeX">
                                        <td><a href="<?php echo site_url("accounts/transactions/$row->account_id"); ?>" class="color-inherit"><?php echo $row->username; ?></a></td> 
                                        <td class="greenbg" align="right"><?php echo $row->total_debits; ?></td> 
                                        <td class="redbg" align="right"><?php echo $row->total_credits; ?></td>
                                        <td align="right" class="<?php echo $row->balance > 0 ? 'text-green' : 'text-red'; ?>"><?php echo abs($row->balance); ?> <?php echo $row->balance > 0 ? 'Dr' : 'Cr'; ?></td>                                         
                                    </tr>
                                <?php endforeach; ?>
                            <?php }else { ?>
                                <tr class="odd">
                                    <td valign="top" colspan="6" class="dataTables_empty">
                                        No records found
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody> 
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>

        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Recent Transactions
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <?php if ($recentTrans->num_rows() > 0) { ?>
                            <?php foreach ($recentTrans->result() as $row) { ?>
                                <a href="<?php echo site_url("accounts/transactions/$row->account_id"); ?>" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> <?php echo $row->username ?>
                                    <span class="pull-right  <?php echo $row->type == 'Cr' ? 'text-red' : 'text-green'; ?> small"><em><?php echo $row->amount . ' ' . $row->type; ?></em>
                                    </span>
                                    <br>
                                    <small><em><?php echo $row->note; ?></em></small>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <!-- /.list-group -->
                    <a href="<?php echo site_url('payments'); ?>" class="btn btn-default btn-block">View All Transactions</a>
                </div>
                <!-- /.panel-body -->
            </div>

        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
