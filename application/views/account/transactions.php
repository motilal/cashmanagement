<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $AccountData->name; ?>'s Ledger
                <div class="pull-right" style="font-size: 15px;">Total: <span class="text-green"><?php echo $AccountWallet->debit; ?> Dr</span> ~ <span class="text-red"><?php echo $AccountWallet->credit; ?> Cr</span></div>
            </h1>            
            <div class="add-btn">
                <a class="btn btn-danger" href="<?php echo site_url("payments/manage?redirect=$AccountData->id"); ?>"><i class="fa fa-plus"></i> Add Payment</a>
            </div>            
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo $AccountData->name; ?>  <a href="tel:<?php echo $AccountData->phone; ?>">(<?php echo $AccountData->phone; ?>)</a>
                    <a href="<?php echo site_url("accounts/transactions/{$AccountData->id}?download=report"); ?>"><i class="fa fa-download pull-right"></i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <?php echo form_open('payments/actions', array("id" => "table-form", "method" => "post")); ?>  
                        <input type="hidden" name="redirect" value="<?php echo $encodeUrl = base64_encode(current_url()); ?>">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-grid" width="100%">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Date</th> 
                                    <th width="50%">Note</th>
                                    <th>Dr</th> 
                                    <th>Cr</th> 
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows() > 0) { ?>
                                    <?php foreach ($result->result() as $key => $row): ?>
                                        <tr class="<?php echo ($key % 2 == 0) ? "even" : "odd"; ?> gradeX">
                                            <td><?php echo $AccountData->name; ?></td>
                                            <td><?php echo date('d-M-Y', strtotime($row->created)); ?></td>  
                                            <td><?php echo $row->note; ?></td> 
                                            <td class="greenbg" align="right"><?php echo $row->type == 'Dr' ? $row->amount : ''; ?></td> 
                                            <td class="redbg" align="right"><?php echo $row->type == 'Cr' ? $row->amount : ''; ?></td>   
                                            <td align="right"><?php
                                                echo abs($row->cummulative_balance);
                                                echo $row->cummulative_balance >= 0 ? ' Dr' : ' Cr';
                                                ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?> 
                            </tbody> 
                        </table> 

                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.table-responsive --> 
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
        $('#dataTables-grid').DataTable({
            responsive: true,
            order: [],
            "columnDefs": [
                {"orderable": false, "targets": []}
            ],
            "language": {
                "paginate": {
                    "previous": "Prev"
                }
            },
            "iDisplayLength": <?php echo PAGINATION_LIMIT; ?>,
            "fnDrawCallback": function (oSettings) {
                //$('#dataTables-grid_info').html($('.multi-action').html());
                //$('.multi-action').empty();
            }
        });

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