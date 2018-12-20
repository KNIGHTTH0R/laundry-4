<div class="row">
    <div class="col-lg-12" id="all_user_payment_details">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"  style="font-size: 20px;"><b>Payment Details</b></h3>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-xs btn-success btn-outline pull-right" data-toggle="modal" data-target="#addWalkinPayment"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example_all" >
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <!-- <th>Status</th> -->
                                <th>Pick Up</th>
                                <th>Approval</th>
                                <th>Under Process</th>
                                <th>Work Done</th>
                                <th>Delivered</th>
                                <th>Cancelled</th>
                                <th>Total Quantity</th>
                                <th>Total Amount</th>
                                <th>Total Received</th>
                                <th>Discount</th>
                                <th>Pending Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $j=0;foreach ($user_payment as $key) {?>
                            <tr class="user_payemnt_details" title="<?=$key['user_id']?>-<?=$key['pending_amount']?>">
                                <td><?=$j+1;?></td>
                                <td><?=$key['name']?></td>
                                <td><?=$key['user_mobile_no']?></td>
                                <!-- <td><?=$key['user_status']?></td> -->
                                <td><?=$key['type_1_cnt']?></td>
                                <td><?=$key['type_2_cnt']?></td>
                                <td><?=$key['type_3_cnt']?></td>
                                <td><?=$key['type_4_cnt']?></td>
                                <td><?=$key['type_5_cnt']?></td>
                                <td><?=$key['type_6_cnt']?></td>
                                <td><?=$key['total_qty']?></td>
                                <td><?=$key['total_amount']?></td>
                                <td><?=$key['total_received']?></td>
                                <td><?=$key['payment_discount']?></td>
                                <td><?=$key['pending_amount']?></td>
                            </tr>
                            <?php $j++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 hidden" id="user_payment_details">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="" style="font-size: 20px;"><b>User Payment Details</b></h3>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <span class="btn btn-primary" id="send_sms_for_pending_amount"><i class="fa fa-envelope"></i></span>
                        <span class="btn btn-primary" id="close_user_payment"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>
            <div class="ibox-content" style="padding-top: 0px;">
                <table class="table" id="user_details_inawards">
                    
                </table>
                <div class="table-responsive"  style="height:390px;"">
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                            <!-- <tr>
                                <th colspan="5">User Name : <span id="user_details"></span></th>
                            </tr> -->
                            <tr>
                                <th>Sr No</th>
                                <th>Date</th>
                                <th>Descripation</th>
                                <th>Request Amount</th>
                                <th>Payment AMount</th>
                            </tr>
                        </thead>
                        <tbody class="user_payment">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="addWalkinPayment" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 40%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New User Payment Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-horizontal" id="addWalkin_payment_details" action="<?=site_url('Payment/add_walkin_payment_details')?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">User <span style="color:red;">*</span></label>
                            <div class="col-sm-7">
                                <select class="form-control" name="payment_user_id" id="user_details">
                                    <option>Please Select User</option>
                                    <?php foreach ($user as $key) {?>
                                        <option value="<?=$key['user_id']?>"><?=$key['user_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"> Pay. Method <span style="color:red;">*</span></label>
                            <div class="col-sm-7">
                                <select class="form-control" name="payment_method">
                                    <option> Select Payment Mathod</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Paytm</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"> Amount <span style="color:red;">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="payment_amount"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"> Discount <span style="color:red;">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="payment_discount" value="000"> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-lg-6" style="text-align:right;">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="footer" style="background: #232020;color: #fff;">
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
    <!-- <script src="<?= base_url();?>assets/js/jquery-ui.min.js"></script> -->
    <script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/js/inspinia.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>
   
    <script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
     <!-- Date range use moment.js same as full calendar plugin -->
    <!-- <script src="<?= base_url();?>assets/js/plugins/fullcalendar/moment.min.js"></script> -->
    <!-- Date range picker -->
    <script src="<?= base_url();?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
      <!-- Data picker -->
   <script src="<?= base_url();?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
     <!-- Clock picker -->
    <script src="<?= base_url();?>assets/js/plugins/clockpicker/clockpicker.js"></script>
     <!-- Select2 -->
    <script src="<?= base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>

    <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>
    <!-- Sweet alert -->
    <script src="<?= base_url();?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- d3 and c3 charts -->
    <script src="<?= base_url();?>assets/js/plugins/d3/d3.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/c3/c3.min.js"></script>

     <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <script>

        
    </script>
    <script>

        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        $(document).ready(function(){

            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });

            <?php } ?>

            $(".select2_demo_3").select2({
                placeholder: "Please Select User",
                allowClear: true
            });
            
            <?php if($payment == 'payment') {?>
                $('#payment').addClass('active');
                document.title = "8x Laundry | Payment Details"
            <?php } ?>

            var today = new Date();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,
                endDate: "today",
                maxDate: today
            });
            
            $(document).on('click','.user_payemnt_details',function(){
                $('.user_payment').empty();
                $('#user_details_inawards').empty();
                var user_data =this.title;
                var i = 0;
                $('#send_sms_for_pending_amount').attr('title',''+user_data+'');
                var update_data = user_data.split('-');
                var user_id = update_data[0];
                 $.post('<?=site_url('Payment/user_info_details')?>',{user_id:user_id},function(data){
                    console.log(data);
                    // $('#user_details').text(name);
                    $.each(data,function(k,v){
                        $('#user_details_inawards').append('<tr style="border-top: none;">'+
                                '<th colspan="9" style="border-top: none;padding-left: 7%;">'+v.username+'</th>'+
                                '<th colspan="2" style="border-top: none;">'+v.user_mobile_no+'</th>'+
                            '</tr>'+
                            '<tr>'+
                                '<td colspan="2"><center>Total Amount</center></td>'+
                                '<td></td>'+
                                '<td colspan="2"><center>Paid. Amount</center></td>'+
                                '<td></td>'+
                                '<td colspan="2"><center>Discount</center></td>'+
                                '<td></td>'+
                                '<td colspan="2"><center>Balance</center></td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td colspan="2"><center><b>Rs. '+v.req+' /-</b></center></td>'+
                                '<td><center>(-)</center></td>'+
                                '<td colspan="2"><center><b>Rs. '+v.pay+' /-</b></center></td>'+
                                '<td><center>(-)</center></td>'+
                                '<td colspan="2"><center><b>Rs. '+v.dis+' /-</b></center></td>'+
                                '<td><center>(=)</center></td>'+
                                '<td colspan="2"><center><b>Rs. '+v.balance+' /-</b></center></td>'+
                            '</tr>');
                    });
                },'JSON');
                $.post('<?=site_url('Payment/user_payemnt_details')?>',{user_id:user_id},function(data){
                    console.log(data);
                    $('#all_user_payment_details').removeClass();
                    $('#all_user_payment_details').addClass('col-lg-6');
                    $('#user_payment_details').removeClass();
                    $('#user_payment_details').addClass('col-lg-6');
                    // $('#user_details').text(name);
                    $.each(data,function(k,v){
                        $('.user_payment').append('<tr><td>'+(i = i+1)+'</td><td>'+v.date+'</td><td>'+v.description+'</td><td>'+v.request_amount+'</td><td>'+v.payment_amount+'</td></tr>');
                    });
                },'JSON');

               
            });

            $(document).on('click','#send_sms_for_pending_amount',function(){
                var user_data =this.title;
                var update_data = user_data.split('-');
                var user_id = update_data[0];
                var amount = update_data[1]
                $.post('<?=site_url('Payment/send_pending_amount_sms')?>',{user_id:user_id,amount:amount},function(data){
                    console.log(data);
                },'JSON');

            })

            $('#updateAdmin').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;
                $('.payment_id_edit').val(id);
            });

            $(document).on('click','#close_user_payment',function(){
                $('.user_payment').empty();
                $('#all_user_payment_details').removeClass();
                $('#all_user_payment_details').addClass('col-lg-12');
                $('#user_payment_details').removeClass();
                $('#user_payment_details').addClass('col-lg-6 hidden');
            });

            $('.dataTables-example_all').DataTable({
                "pageLength": 10,
                "responsive": true,
                "searching": true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [  ],
                "language": {
                    "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                }
            });

            // Re-draw the table when the a date range filter changes
            $('.date-range-filter').change(function() {
              table.draw();
            });

            $("#update_paymentDetails").validate({
                rules: {
                    payment_admin_id: {
                        required:true,
                        min:1
                    }
                },
                messages: {
                    payment_admin_id: {
                        required: "Please Select Payment Admin.",
                        min:"Please Select Payment Admin."
                    }
                }
            });   

            $("#addWalkin_payment_details").validate({
                rules: {
                    payment_user_id: {
                        required:true,
                        min:1
                    },
                    payment_method:{
                        required:true,
                        min:1
                    },
                    payment_amount:{
                        required:true,
                        number:true
                    },
                    payment_discount:{
                        required:true,
                        number:true
                    }
                },
                messages: {
                    payment_user_id: {
                        required: "Please Select Payment User.",
                        min:"Please Select Payment User."
                    },
                    payment_method:{
                        required:"Please Select Method Method.",
                        min:"Please Select Method Method.",
                    },
                    payment_amount:{
                        required:"Please enter Payment amount.",
                        digits:"Please enter only digits."
                    },
                    payment_discount:{
                        required:"Please enter Payment discount.",
                        digits:"Please enter only digits."
                    }
                }
            });   

        });
    </script>
  
</body>
</html>