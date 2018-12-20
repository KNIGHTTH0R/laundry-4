<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/img/8x_logo.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>8xLaundry</title>

    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/plugins/cropper/cropper.min.css" rel="stylesheet">
     <link href="<?=base_url()?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="<?=base_url();?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<!-- c3 Charts -->
    <link href="<?=base_url();?>assets/css/plugins/c3/c3.min.css" rel="stylesheet">
</head>
<style type="text/css">
.top-navigation .nav > li > a {
    padding: 11px 20px;
}
/*.white-bg {
    background-color: #e7eaec;
}*/
.loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('<?=base_url()?>assets/img/loading-page.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
    }
    .top-navigation .nav > li > a {
        text-align: center;
    }
</style>

<body  class="top-navigation">
    <div class="loader"></div>
<div id="wrapper">
  <div id="page-wrapper" class="gray-bg" style="min-height: 650px;">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top" role="navigation" style="border-bottom: 1px solid red;">
                <div class="navbar-header">
                      <img class="img-responsive" src="<?=base_url()?>assets/img/logo123.png" style="height:54px;">
                  </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav">
                        <li id="dashboard">
                           <a href="<?=site_url('Su');?>"><center><img src="<?=base_url()?>assets/img/dashboard.png" style="height:25px;"></center> Dashboard </a>
                        </li>
                        <li id="live">
                           <a href="<?=site_url('Su/branches');?>"><center><img src="<?=base_url()?>assets/img/branches.png" style="height:25px;"></center> Branches </a>
                        </li>
                        <li id="assign">
                           <a href="<?=site_url('Su/employees');?>"><center><img src="<?=base_url()?>assets/img/employees.png" style="height:25px;"></center> Employees </a>
                        </li>
                        <li id="vehicle">
                           <a href="<?=site_url('Su/products');?>"><center><img src="<?=base_url()?>assets/img/products.png" style="height:25px;width:41px;"></center> Products </a>
                        </li>
                        <li id="details">
                           <a href="<?=site_url('Su/vehicle_details');?>"><center><img src="<?=base_url()?>assets/img/reports.png" style="height:25px;"></center> Report </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-top-links navbar-right" style="margin:2% 3% 0 0;"> 
                        <a href="<?=site_url('Authentication/logout')?>" class="btn btn-xs btn-danger pull-right"><i class="fa fa-power-off"></i> Logout</a>
                    </ul>
                </div>
            </nav>
        </div>