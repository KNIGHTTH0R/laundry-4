<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/img/8x_logo.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8x Laundry | Login</title>
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
    background: rgba(0,0,0,0.7);
    padding: 0px 0px;
    border: 0px solid #000;
    margin-top: 0%;
    padding-top:20px;
}
#log h2 {
    text-align: center;
    margin: 10px 0;
    font-size: 23px;
    font-family:Raleway;
    margin-top:30px;
}
#log input {
    display: block;
    width: 300px;
    margin: 20px auto;
    padding: 15px;
    /*background: rgba(0,0,0,0.2);*/
    background: rgba(255,255,255,0.99);
    color: #000;
    border: 0;
}

.loginfooter{
    background-color:black;
    padding-top:10px;
     padding-bottom:10px;
     margin-top:35px;
     
}

 </style>
</head>
<?php 
$path = base_url('assets')."/img/clean-cloth-clothing-41165.jpg";

 ?>
<body class="gray-bg" style="background: url('<?php echo $path;?>');background-size: cover;" >
    <div style=" padding-top: 7%;">
        <center>
        <div class="middle-box text-center loginscreen animated fadeInDown" id="log">
            <div>
                 <img src="<?=base_url()?>assets/img/8x_logo.png" style="width:90px; height:90px;"> 
            </div>
           
         <h2 style="color: #fff;"><b>Welcome To <span style="color: #42B8EC;font-size:32px;">8xLaundry</span></b></h2>
            <form method="post" action="<?=site_url('Authentication/login')?>">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="user_username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="user_password" narequired="">
                </div>
                <button type="submit" class="btn btn-info block m-b" style="background: transparent;margin: 20px auto;padding: 6px;    width: 160px;"><span style="font-size:18px">Admin Login</span></button>
               
                
            </form>
            
               <div class="loginfooter">
                 <span style="font-size:15px;color:white;padding-left:20px;float:left;">Customers can download <br> Application from here </span> <a href="https://play.google.com/store/apps/details?id=com.syntechsolutions.laundryapp" target="_blank"><img src="<?=base_url()?>assets/img/button_google.png" style="width:158px; height:54px; align:right;"> </a>
            </div>
           
            <!-- <a href="<?=site_url('Welcome/login_forgot_password')?>"><small><u>Forgot password?</u></small></a> -->
            <!-- <h4 class="m-t"><small style="color:#fff;"><b><br>Designed & Developed By <a href="http://www.syntech.co.in" target="_blank" style="color: #f59e00;"><u>Syntech Solution </u></a>&copy; 2017-18 </b></small></p> -->
        </div>
      
    </div>
    <!-- <div style="background-color: rgba(255,255,255,0.8);border:none; backgorund:none repeat scroll 0 0 #cde7a6 !important;padding:10px 20px;right:0;left:0;bottom:0;position: fixed;">
        <div class="row">
            <div class="col-sm-4">
                <div class="pull-left">
                    <a href="http://www.syntech.co.in" target="_blank"> <img src="<?=base_url()?>assets/img/syntech1.png" style="height:22px;"></a>  
                </div>
            </div>
            <div class="pull-right" style="color: #000;">
                <i class="fa fa-phone-square" aria-hidden="true"></i><strong> 020-24269021 / 7030578612</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong>contactus@syntech.co.in </strong> 
            </div>
        </div>
    </div> -->

    <!-- Mainly scripts -->

    <script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/sweetalert/sweetalert.min.js"></script> 

    <script>
        $(document).ready(function(){

            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>

            swal({
                title: "<?=$flash['title']?>",
                text: "<?=$flash['text']?>",
                type: "<?=$flash['type']?>"
            });

        <?php } ?>
    });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:23:03 GMT -->
</html>
