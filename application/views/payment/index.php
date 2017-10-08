<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">All Transactions</h1>
            <div class="add-btn"><a class="btn btn-danger" href="<?php echo site_url("payments/manage"); ?>"><i class="fa fa-plus"></i> Add Payment</a></div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Transactions
                    <a href="<?php echo site_url('payments/index?download=report'); ?>"><i class="fa fa-download pull-right"></i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body"> 
                    <div class="dataTable_wrapper">
                        <div id="dataTables-grid_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_length" id="dataTables-grid_length">
                                        <label>Show  
                                            <select name="dataTables-grid_length" id="perpage_list" aria-controls="dataTables-grid" class="form-control input-sm">
                                                <option value="10"  <?php echo $perpage == "10" ? "selected" : ""; ?>>10</option>
                                                <option value="25"  <?php echo $perpage == "25" ? "selected" : ""; ?>>25</option>
                                                <option value="50"  <?php echo $perpage == "50" ? "selected" : ""; ?>>50</option>
                                                <option value="100" <?php echo $perpage == "100" ? "selected" : ""; ?>>100</option>
                                            </select> entries
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <?php echo form_open('payments/index', array("id" => "search-form", "method" => "get")); ?>
                                    <div id="dataTables-grid_filter" class="dataTables_filter">
                                        <label>Search:</label> 
                                        <div class="form-group input-group">
                                            <input type="text"  name="keyword" class="form-control" value="<?php echo $this->input->get('keyword'); ?>">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                        <input type="hidden" name="perpage" value="<?php echo $perpage; ?>">
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>

                            </div>  
                            <?php echo form_open('payments/actions', array("id" => "table-form", "method" => "post")); ?>
                            <div class="row">
                                <div class="col-sm-12 table-responsive"> 
                                    <table id="dataTables-grid" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dataTables-grid_info">
                                        <thead>
                                            <tr role="row" class="order-heading">
                                                <th><?php echo sorting_url('name', 'User'); ?></th>
                                                <th><?php echo sorting_url('created', 'Date'); ?></th> 
                                                <th width="40%"><?php echo sorting_url('note', 'Note'); ?></th>
                                                <th class="greenbg"><?php echo sorting_url('amount', 'Dr.'); ?></th> 
                                                <th class="redbg"><?php echo sorting_url('amount', 'Cr.'); ?></th>        
                                                <th><?php echo sorting_url('cummulative_balance', 'Balance'); ?></th>     
                                                <th>File</th>
                                            </tr>
                                        </thead> 
                                        <tbody> 
                                            <?php if ($result->num_rows() > 0) { ?>
                                                <?php foreach ($result->result() as $key => $row): ?>
                                                    <tr class="<?php echo ($key % 2 == 0) ? "even" : "odd"; ?> gradeX">
                                                        <td><?php echo $row->username; ?></td> 
                                                        <td><?php echo date('d-M-Y H:i', strtotime($row->created)); ?></td>  
                                                        <td><?php echo $row->note; ?></td> 
                                                        <td class="greenbg" align="right"><?php echo $row->type == 'Dr' ? $row->amount : ''; ?></td> 
                                                        <td class="redbg" align="right"><?php echo $row->type == 'Cr' ? $row->amount : ''; ?></td>
                                                        <td align="right"><?php
                                                            echo abs($row->cummulative_balance);
                                                            echo $row->cummulative_balance >= 0 ? ' Dr' : ' Cr';
                                                            ?>
                                                        </td>
                                                        <td align="center"><?php echo $row->file != "" ? '<a href="' . site_url("payments/download_file/{$row->file}") . '"><i class="fa fa-file"></i></a>' : ''; ?></td>
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
                            </div>
                            <input type="hidden" name="redirect" value="<?php echo base64_encode($this->input->server('QUERY_STRING')); ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-grid_paginate">
                                        <?php echo $pagination; ?> 
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>  
                        </div> 

                    </div>  
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row --> 
</div> 

<!-- /#page-wrapper -->
<script>
    $(document).ready(function () {

        var delRestrict = false;
        $("#table-form").submit(function () {
            if ($("[name='ids[]']:checked").length == 0) {
                alert('Please select atleast one checkbox.');
                return false;
            }
            if ($("#list-action").val() == "delete" && !delRestrict) {
                confirm(function (e, btn) {
                    e.preventDefault();
                    delRestrict = true;
                    $("#table-form").submit();
                }, function (e, btn) {
                    e.preventDefault();
                    $("#table-form").find("input[type=checkbox]").prop('checked', false);
                });
                return delRestrict;
            }
        });

        $('#perpage_list').on('change', function () {
            var val = $(this).val();
            if (val > 0) {
                window.location = "<?php echo site_url('payments/index?perpage='); ?>" + val;
            }
        });

        $(document).on('click', 'a.delete-row', function (E) {
            $("#table-form").find('input[type=checkbox]').removeAttr('checked');
            $(this).parent("td")
                    .parent("tr")
                    .find("td > input[type=checkbox]")
                    .prop('checked', 'checked');
            $('#list-action').val('delete');
            $(this).closest('form').submit();
            E.preventDefault();
        });

    });

</script>