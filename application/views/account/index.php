<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">All Accounts</h1>
            <div class="add-btn"><a class="btn btn-danger" href="<?php echo site_url("accounts/manage"); ?>"><i class="fa fa-plus"></i> Add Account</a></div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Accounts
                    <a href="<?php echo site_url('accounts/index?download=report'); ?>"><i class="fa fa-download pull-right"></i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <?php echo form_open('accounts/actions', array("id" => "table-form", "method" => "post")); ?>  
                        <table class="table table-striped table-bordered table-hover" id="dataTables-grid" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <td>Total Amount</td>
                                    <th>Created</th>
                                    <th>Tran.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows() > 0) { ?>
                                    <?php foreach ($result->result() as $key => $row): ?>
                                        <tr class="<?php echo ($key % 2 == 0) ? "even" : "odd"; ?> gradeX">
                                            <td><?php echo $row->name; ?></td>
                                            <td>
                                                <?php echo $row->phone; ?><?php echo $row->secondary_contacts != "" ? ',' . $row->secondary_contacts : ""; ?></div>
                                            </td>
                                            <td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a></td>
                                            <td><?php echo $row->address; ?></td>
                                            <?php $AccountWallet = $this->transaction->getAccountWallet($row->id); ?>
                                            <td><?php echo $AccountWallet->balance . ' ' . $AccountWallet->type; ?></td>
                                            <td><?php echo date('d-M-Y', strtotime($row->created)); ?></td>
                                            <td align="center"><a href="<?php echo site_url('accounts/transactions/' . $row->id); ?>" title="Payments"> <span class="fa fa-money"></span> </a></td>
                                            <td class="center action-link" align="center">
                                                <a href="<?php echo site_url('accounts/manage/' . $row->id); ?>" title="Edit"> <span class="fa fa-edit"></span> </a>
                                                <a href="<?php echo site_url('accounts/delete/' . $row->id); ?>" title="Delete" class="delete-row"> <span class="fa fa-times"></span> </a>
                                            </td>
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
            order: [[0, 'asc']],
            "columnDefs": [
                {"orderable": false, "targets": [6, 7]}
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
            var href = $(this).attr('href');
            confirm(function (e, btn) {
                e.preventDefault();
                window.location = href;
            });
            E.preventDefault();
        });
    });
</script>