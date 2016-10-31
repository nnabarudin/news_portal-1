<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php isset($title) ?: $title = 'News Portal';echo 'News Portal | ' . $title; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="<?php echo base_url();?>plugins/select2/css/select2.min.css" rel="stylesheet">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/sweet-alert/sweetalert.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/font-awesome/css/font-awesome.min.css">

    <!--KendoUI for PDF-->
    <link href="<?php echo base_url();?>plugins/kendo-ui/styles/kendo.common.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>plugins/kendo-ui/styles/kendo.rtl.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>plugins/kendo-ui/styles/kendo.default.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>plugins/kendo-ui/styles/kendo.dataviz.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>plugins/kendo-ui/styles/kendo.dataviz.default.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>plugins/kendo-ui/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>plugins/kendo-ui/js/jszip.min.js"></script>
    <script src="<?php echo base_url();?>plugins/kendo-ui/js/kendo.all.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php include(VIEWPATH."navbar.php") ?>

