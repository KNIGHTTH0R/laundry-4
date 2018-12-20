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
 <!-- Google Lat-Long Picker -->
    <link href="<?=base_url()?>assets/css/plugins/lat_long_picker/jquery-gmaps-latlon-picker.css" rel="stylesheet">
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
        background: url('<?=base_url()?>assets/img/loader.gif') 50% 50% no-repeat rgb(249,249,249);
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
                <div class="navbar-header" style="padding-left: 2%;">
                      <img class="img-responsive" src="<?=base_url()?>assets/img/8x_logosmall.png">
                </div>
                <div class="navbar-collapse collapse" id="navbar" style="padding-top: 1%;">
                    <ul class="nav navbar-nav">
                        <li id="dashboard">
                           <a href="<?=site_url('Su');?>"><center><img src="<?=base_url()?>assets/img/dashboard.png" style="height:25px;"></center> Dashboard </a>
                        </li>
                        <li id="branch">
                           <a href="<?=site_url('Su/branches');?>"><center><img src="<?=base_url()?>assets/img/branches.png" style="height:25px;"></center> Branches </a>
                        </li>
                        <li id="employee">
                           <a href="<?=site_url('Su/employees');?>"><center><img src="<?=base_url()?>assets/img/employees.png" style="height:25px;"></center> Employees </a>
                        </li>
                        <li id="category">
                           <a href="<?=site_url('Su/Category');?>"><center><img src="<?=base_url()?>assets/img/products.png" style="height:25px;width:41px;"></center> Category </a>
                        </li>
                        <li id="product">
                           <a href="<?=site_url('Su/products');?>"><center><img src="<?=base_url()?>assets/img/products.png" style="height:25px;width:41px;"></center> Products </a>
                        </li>
                        <li id="add_on">
                           <a href="<?=site_url('Su/add_on_services');?>"><center><img src="<?=base_url()?>assets/img/products.png" style="height:25px;width:41px;"></center> Add-on Service </a>
                        </li>
                         <li class="dropdown" id="sms">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/sms.png" style="display: -webkit-box;font-size: initial;padding-left: 24px;"></i> SMS Details <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="<?=site_url('SMS')?>"><b>Customer SMS</b></a></li>
                                <li><a href="<?=site_url('SMS/sms_details')?>"><b>SMS Details</b></a></li>
                            </ul>
                        </li>
                        <!-- <li id="sms">
                           <a href="<?=site_url('SMS');?>"><center><img src="<?=base_url()?>assets/img/sms.png" style="height:25px;width:41px;"></center> SMS </a>
                        </li> -->
                        <!-- <li id="assign">
                           <a href="<?=site_url('Su/branch_product_assign_details');?>"><center><img src="<?=base_url()?>assets/img/reports.png" style="height:25px;"></center> Assign </a>
                        </li> -->
                    </ul>
                    <ul class="nav navbar-top-links navbar-right" style="padding-top:1%; padding-right: 1%;"> 
                        <a href="<?=site_url('Authentication/logout')?>" class="btn btn-xs btn-danger pull-right"><i class="fa fa-power-off fa-2x"></i></a>
                    </ul>
                </div>
            </nav>
        </div>