<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New Transaction</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Transaction
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php echo form_open_multipart(null, array("id" => "manage-payment-form", "method" => "post")); ?>
                        <?php
                        $options = array('' => 'Select Account');
                        if ($accounts_list->num_rows() > 0):
                            foreach ($accounts_list->result() as $key => $value) :
                                $options[$value->id] = $value->name;
                            endforeach;
                        endif;
                        ?> 
                        <?php
                        if (isset($data->account_id)) {
                            $account_id = $data->account_id;
                        } else if ($this->input->get('redirect')) {
                            $account_id = $this->input->get('redirect');
                        } else {
                            $account_id = '';
                        }
                        ?>
                        <div class="col-lg-6">
                            <div class="form-group required <?php echo form_error('account') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="account_list">Account Name</label>
                                <?php echo form_dropdown('account', $options, set_value('account', $account_id), 'class="form-control" id="account_list"'); ?>
                                <?php echo form_error('account'); ?>
                            </div>
                        </div>


                        <div class="clear"></div>
                        <div class="col-lg-6">
                            <div class="form-group required <?php echo form_error('amount') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="amount">Amount</label>
                                <?php echo form_input("amount", set_value("amount", isset($data->amount) ? $data->amount : ""), "id='amount' class='form-control'"); ?>
                                <?php echo form_error('amount'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="redirect" value="<?php echo set_value('redirect', $this->input->get('redirect')); ?>">

                        <div class="clear"></div>
                        <div class="col-lg-6">
                            <div class="form-group <?php echo form_error('note') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="note">Note</label>
                                <?php echo form_textarea("note", set_value("note", isset($data->note) ? $data->note : ""), "id='note' class='form-control' style='height:100px;'"); ?>
                                <?php echo form_error('note'); ?>
                            </div>
                            
                            <div class="form-group <?php echo form_error('file') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="file">Document</label> <em class="text-red">(gif,jpg,png,docx,txt,xls,xlsx,pdf) file only</em>
                                <?php echo form_upload("file", set_value("file", isset($data->file) ? $data->file : ""), "id='file' class='form-control1'"); ?>
                                <?php echo form_error('file'); ?>
                            </div>
                            

                            <?php echo form_hidden('id', set_value('id', isset($data->id) ? $data->id : "")); ?>
                            <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("accounts"); ?>'">Cancel</button>
                            <div class="pull-right">
                                <?php if (!isset($data->id)): ?>                                    
                                    <button type="submit" class="btn btn-success" name="debit" value="1">Debit</button>
                                    <button type="submit" class="btn btn-danger" name="credit" value="1">Credit</button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-<?php echo (isset($data->type) && $data->type == 'Cr') ? 'danger' : 'success'; ?>" name="update" value="1">Update</button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div> 
<script>
    $(document).ready(function () {
        $('#account_list').select2({
            selectOnClose: true
        });
    });
</script>