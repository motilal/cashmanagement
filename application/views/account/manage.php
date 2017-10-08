<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Account</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Account
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php echo form_open(null, array("id" => "manage-account-form", "method" => "post")); ?>
                        <div class="col-lg-6">
                            <div class="form-group required <?php echo form_error('name') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="name">Account Name</label>
                                <?php echo form_input("name", set_value("name", isset($data->name) ? $data->name : ""), "id='name' class='form-control'"); ?>
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>

                        <div class="clonephone">
                            <div class="clear"></div>
                            <div class="col-lg-6">
                                <div class="form-group required <?php echo form_error('phone') != "" ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="phone">Contact No.</label>
                                    <div class="input-group"> 
                                        <?php echo form_input("phone", set_value("phone", isset($data->phone) ? $data->phone : ""), "id='phone' class='form-control' placeholder='89XXXXXXXX'"); ?>
                                        <span class="input-group-btn">
                                            <button class="btn btn-success add-more-contact" type="button"><i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <?php echo form_error('phone'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="secondry_contact">
                            <?php
                            if (isset($data->secondary_contacts) && $data->secondary_contacts != "" && count($secondary_phone) == 0) {
                                $edit_sec = explode(',', $data->secondary_contacts);
                                $secondary_phone = $edit_sec;
                            }
                            ?>
                            <?php if (isset($secondary_phone) && $secondary_phone != ""): ?>
                                <?php foreach ($secondary_phone as $k => $sec): ?>
                                    <div class="clonephone">
                                        <div class="clear"></div>
                                        <div class="col-lg-6">
                                            <div class="form-group <?php echo form_error('phone') != "" ? 'has-error' : ''; ?>">
                                                <label class="control-label" for="secondary_<?php echo $k; ?>">Secondary Contact</label>
                                                <div class="input-group"> 
                                                    <?php echo form_input("secondary[$k]", set_value("secondary[$k]", $sec), "id='secondary_$k' class='form-control' placeholder='89XXXXXXXX'"); ?>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-danger remove-contact" type="button"><i class="fa fa-minus"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <?php echo form_error("secondary[$k]"); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>

                        <div class="clear"></div>

                        <div class="col-lg-6">
                            <div class="form-group <?php echo form_error('email') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="email">Email</label>
                                <?php echo form_input("email", set_value("email", isset($data->email) ? $data->email : ""), "id='name' class='form-control' placeholder='example@example.com'"); ?>
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>

                        <div class="clear"></div>
                        <div class="col-lg-6">
                            <div class="form-group <?php echo form_error('address') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="address">Address</label>
                                <?php echo form_textarea("address", set_value("address", isset($data->address) ? $data->address : ""), "id='address' class='form-control' style='height:100px;'"); ?>
                                <?php echo form_error('address'); ?>
                            </div>
                        </div>


                        <div class="clear"></div>
                        <div class="col-lg-6">
                            <div class="form-group <?php echo form_error('description') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="description">Description</label>
                                <?php echo form_textarea("description", set_value("description", isset($data->description) ? $data->description : ""), "id='description' class='form-control' style='height:100px;'"); ?>
                                <?php echo form_error('description'); ?>
                            </div>

                            <?php echo form_hidden('id', set_value('id', isset($data->id) ? $data->id : "")); ?>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("accounts"); ?>'">Cancel</button>
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
        var _key = parseInt($('.clonephone').length) - 1;
        $('.add-more-contact').on('click', function () {
            var clone = $(this).closest('.clonephone').clone();
            clone.find('.add-more-contact').addClass('remove-contact').removeClass('add-more-contact');
            clone.find('.fa-plus').addClass('fa-minus').removeClass('fa-plus');
            clone.find('.btn-success').addClass('btn-danger').removeClass('btn-success');
            clone.find('#phone').attr('id','secondary_'+_key);
            clone.find('.control-label').attr('for','secondary_'+_key);
            clone.find('label.control-label').text('Secondary Contact');
            clone.find('[name="phone"]').attr('name', 'secondary['+_key+']').val('');
            clone.appendTo('.secondry_contact');
            _key++;
        });

        $(document).on('click', '.remove-contact', function () {
            $(this).closest('.clonephone').remove();
        });
    });
</script>