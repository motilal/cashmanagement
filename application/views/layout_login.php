<!DOCTYPE html>
<html lang="en"> 
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Motilal Soni">
        <title><?php echo isset($title) ? $title : ''; ?></title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('css/admin.css'); ?>" rel="stylesheet">
        <!-- Custom Fonts -->   
        <link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
        <!-- jQuery -->
        <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/admin.js'); ?>"></script>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php echo $content_for_layout; ?> 
                </div>
            </div>
        </div>
        
    </body>
</html>
