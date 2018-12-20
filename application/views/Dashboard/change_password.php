<!DOCTYPE html>
<html>
<head>  
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/img/8x.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8x Laundry | Change Password</title>
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">

    <link href="<?=base_url();?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    

    <style>
    @media (min-width: 1200px) {
        #log {
            margin-top: -455px;  
        }
    }

    @media (min-width: 980px) and (max-width: 1199px)  {
    #log {
            margin-top: -480px;  
        }
    }
    @media (min-width: 768px) and (max-width: 979px) {
         #log {
            margin-top: -450px;  
        }
    }
   @media  (max-width: 767px) {
        #log {
            margin-top: -435px;  
        }
    } 
 #log {
    height: 100%;
    width: 100%;
    font-family: Helvetica;
    color: #fff;
    background: rgba(0,0,0,0.53);
    padding: 30px 0px;
    border: 1px solid #000;
    margin-top: 0%;
}
#log h2 {
    text-align: center;
    margin: 30px 0;
    font-size: 30px;
}
#log input {
    display: block;
    width: 100%;
    margin: 20px auto;
    padding: 15px;
    /*background: rgba(0,0,0,0.2);*/
    background: rgba(255,255,255,0.99);
    color: #000;
    border: 0;
}

 </style>
</head>
<?php 
$path = base_url('assets')."/img/clothes_in_water.jpg";
$path1 = base_url('assets')."/img/8x_logo.png";

 ?>
<body class="gray-bg" style="background: url('<?php echo $path;?>');background-size: cover;" >
    <div style=" padding-top: 10%;">
        <center>
        <div class="middle-box text-center loginscreen animated fadeInDown" id="log" style="border-radius: 20px;border: 1px solid #000;width: 21%;margin-top: 0%;box-shadow: 3px 2px;float:left;margin-left:10%;">
            <img src="<?php echo $path1; ?>" style="padding-bottom: 20px;height:10%;width:50%;">
            <form method="post" id="passUpdate" action="<?=site_url('Authentication/update_password')?>" style="padding: 5%;">
                <div class="form-group hidden">
                    <input type="text" class="form-control" placeholder="New Password" name="employee_profile_id" value="<?=$employee_details['employee_id']?>" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="New Password" name="user_password" id="password" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm New Password" name="confirm_password" required="">
                </div>
                <button type="submit" class="btn btn-info block m-b" style="background: #67C6F1;margin: 20px auto;padding: 10px;width: 50%;">Update</button>
            </form>
        </div>
    </div>
    <div style="background-color: rgba(255,255,255,0.8);border:none; backgorund:none repeat scroll 0 0 #cde7a6 !important;padding:10px 20px;right:0;left:0;bottom:0;position: fixed;opacity: 0.7;z-index: -1;">
        <div class="row">
            <div class="col-sm-4">
                 <div class="pull-left">
                    <b>Designed & Developed By
                    <a href="http://www.autoqed.com" target="_blank"> <img src="<?=base_url()?>assets/img/autoqed_logo.png" style="height:22px;"> <span style="color:#ffffff;">AUTO</span><span style="color: #39b54a;">QED</span></a> 
                    | Copyright &copy; 2018-19
                </div>
            </div>
             <div class="pull-right">
                <i class="fa fa-phone-square" aria-hidden="true"></i><strong> +91 98507 29144</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong>info@autoqed.com </strong> 
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->

    <script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/sweetalert/sweetalert.min.js"></script> 
    <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>

    <script>
        $(document).ready(function(){

            $.validator.setDefaults({
                submitHandler: function (form) {
                    form.submit();
                }
            });

            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>

            swal({
                title: "<?=$flash['title']?>",
                text: "<?=$flash['text']?>",
                type: "<?=$flash['type']?>"
            });

            <?php } ?>

             $("#passUpdate").validate({
                rules: {
                    user_password: {
                        required: true
                    },
                    confirm_password:{
                        required:true,
                        equalTo:"#password"
                    }
                },
                messages: {
                    user_password: {
                        required: "Please enter the password."
                    },
                    confirm_password:{
                        required:"Please enter the confirm password.",
                        equalTo:"Please enter the same password."
                    }
                }
            });
        });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:23:03 GMT -->
</html>
