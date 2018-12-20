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
    <script src="<?= base_url();?>assets/js/plugins/fullcalendar/moment.min.js"></script>
    <!-- Date range picker -->
    <script src="<?= base_url();?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>
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


            <?php if($dash == 'walkin') {?>
                $('#walk-in').addClass('active');
                document.title = "8x Laundry | Walk In Details"
            <?php } ?>

            $(".select2_demo_3").select2({
                placeholder: "Please Select User",
                allowClear: true
            });

            $(".select2_demo_2").select2({
                placeholder: "-- Please Select Addon Service --",
                allowClear: true
            });

            var rowCnt = 0;
            $('#add_new_product_request').click(function () {
                rowCnt++;
                var old = $('#product_stock').html();
                $('#product_table').append('<tr id="product_stock"><td id="sr_no" style="padding-left: 1%;padding-top: 8px;width:1%;">'+(rowCnt+1)+'</td><td id="product_category">'+
                                        '<select class="form-control category" name="request_product_category[]">'+
                                            '<option value="">-- Choose Product Category --</option>'+
                                            '<?php foreach ($product_category as $key) {?>'+
                                                '<option value="<?=$key['product_category']?>"><?=$key['product_category']?></option>'+
                                            '<?php } ?>'+
                                        '</select>'+
                                    '</td>'+
                                    '<td id="product_item">'+
                                        '<select class="form-control item" name="request_product_item[]">'+
                                            '<option value="">-- Please Select Item --</option>'+
                                        '</select>'+
                                    '</td>'+
                                    '<td id="product_quantity">'+
                                        '<input type="text" class="form-control quantity" name="request_product_quantity[]">'+
                                    '</td>'+
                                    '<td id="product_price_quantity">'+
                                         '<input type="text" class="form-control price_per_QTY" name="product_price_quantity[]" readonly>'+
                                    '</td>'+
                                    '<td id="product_addon_service">'+
                                        '<select class="select2_demo_2 form-control addon_service" name="request_product_addon_service['+rowCnt+'][]" multiple="multiple" style="width:100%;">'+
                                            '<option value="">-- Please Select Addon Service --</option>'+
                                        '</select>'+
                                    '</td>'+
                                    '<td id="product_total_amount">'+
                                        '<input type="text" class="form-control total_amount" name="request_product_total_amount[]">'+
                                    '</td>'+
                                '</tr>');
                $(".select2_demo_2").select2({
                    placeholder: "-- Please Select Addon Service --",
                    allowClear: true
                });

                $(".category").each(function () { 
                    $(this).rules("add", {
                        required: true
                    });
                }); 
                $(".item").each(function () { 
                    $(this).rules("add", {
                        required: true,
                        min:1
                    });
                }); 
                $(".quantity").each(function () { 
                    $(this).rules("add", {
                        required: true,
                        number:true
                    });
                });
                $(".total_amount").each(function () { 
                    $(this).rules("add", {
                        required: true
                    });
                });
            });

            $(document).on('change','.category',function(){
                var category = $(this).val();
                // alert(category);
                var a = $(this).parent().siblings('#product_item').find('.item');
                $(this).parent().siblings('#product_total_amount').find('.total_amount').val('');
                $(this).parent().siblings('#product_quantity').find('.quantity').val('');
                var b = $(this).parent().siblings('#product_addon_service').find('.addon_service');
                a.empty();
                // b.prop("selected", false);
                $.post('<?=site_url('WalkIn/fetch_item_details')?>',{category:category},function(data){
                    // console.log(data);
                    var data1 = JSON.parse(data);
                    a.append('<option value="">-- Please Select Item --</option>');
                    $.each(data1,function(k,v){
                        a.append('<option value="'+v.product_id+'">'+v.product_item+'</option>')
                    })
                })
            });

            $(document).on('change','.item',function(){
                var item = $(this).val();
                // alert(item);
                var b = $(this).parent().siblings('#product_price_quantity').find('.price_per_QTY');
                var c = $(this).parent().siblings('#product_addon_service').find('.addon_service');
                b.empty();
                c.empty();
                $(this).parent().siblings('#product_total_amount').find('.total_amount').val('');
                $(this).parent().siblings('#product_quantity').find('.quantity').val('');
               
                $.post('<?=site_url('WalkIn/fetch_item_price')?>',{item:item},function(data){
                    // console.log(data);
                    var data2 = JSON.parse(data);
                    $.each(data2,function(k,v){
                        b.val(''+v.product_rate+'/'+v.product_qty_type+'');
                    })
                });
                c.append('<option value="">-- Please Select Addon Service --</option>');
                $.post('<?=site_url('WalkIn/fetch_item_services')?>',{item:item},function(data1){
                    // console.log(data1);
                    var data3 = JSON.parse(data1);
                    $.each(data3,function(k,v){
                        c.append('<option value="'+v.addon_id+'">'+v.addon_name+'</option>');
                    })
                    
                });
            });

            $(document).on('change','.quantity',function(){
                var qty_data = $(this).val();
                var addon1 = $(this).parent().siblings('#product_addon_service').find('.addon_service').val();
                var data = $(this).parent().siblings('#product_price_quantity').find('.price_per_QTY').val().split('/');
                var price = data[0];
                var d = $(this).parent().siblings('#product_total_amount').find('.total_amount');
                d.val('');
                if(addon1 == null){
                    var total_amount = (parseFloat(qty_data) * parseFloat(price)).toFixed(2);
                    d.val(''+total_amount+' /-');
                }
                else{
                    var addon = addon1.toString();
                    $.post('<?=site_url('WalkIn/fetch_addon_rate')?>',{'addon':addon},function(data){
                        var data1 = JSON.parse(data);
                        var addon_rate = data1[0].addon_rate;
                        if(qty_data == ''){
                            var total_amount = (parseFloat(price) + parseFloat(addon_rate)).toFixed(2);
                        }else if(addon_rate == ''){
                            var total_amount = (parseFloat(qty_data) * parseFloat(price)).toFixed(2);;
                        }else{
                          var total_amount = (parseFloat(qty_data) * (parseFloat(price) + parseFloat(addon_rate))).toFixed(2);
                        }
                        d.val(''+total_amount+' /-');
                    });
                }
            });

            $(document).on('change','.addon_service',function(){
                
                var addon1 = $(this).val();
                var qty_data = $(this).parent().siblings('#product_quantity').find('.quantity').val();
                var amt_data = $(this).parent().siblings('#product_price_quantity').find('.price_per_QTY').val().split('/');
                var price = amt_data[0];
                var d = $(this).parent().siblings('#product_total_amount').find('.total_amount');
                d.empty();
                if(addon1 == null){
                    var total_amount = (parseFloat(qty_data) * parseFloat(price)).toFixed(2);
                    d.val(''+total_amount+' /-');
                }
                else{
                    var addon = addon1.toString();
                    $.post('<?=site_url('WalkIn/fetch_addon_rate')?>',{'addon':addon},function(data){
                        var data1 = JSON.parse(data);
                        var addon_rate = data1[0].addon_rate;
                        if(qty_data == ''){
                            var total_amount = (parseFloat(price) + parseFloat(addon_rate)).toFixed(2);
                        }else if(addon_rate == ''){
                            var total_amount = (parseFloat(qty_data) * parseFloat(price)).toFixed(2);
                        }else{
                          var total_amount = (parseFloat(qty_data) * (parseFloat(price) + parseFloat(addon_rate))).toFixed(2);
                        }
                        d.val(''+total_amount+' /-');
                    });
                }
            });

            $("#addWalkin_details").validate({
                rules: {
                    user_first_name: {
                        pattern: /^[a-zA-Z\s]*$/
                    },
                    user_last_name: {
                        pattern: /^[a-zA-Z\s]*$/
                    },
                    employee_last_name: {
                        required: true,
                        pattern: /^[a-zA-Z\s]*$/
                    },
                    employee_address:{
                        required:true
                    },
                    user_mobile_no: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    user_address_pincode: {
                        digits: true,
                        minlength: 6,
                        maxlength: 6
                    }
                },
                messages: {
                    user_first_name: {
                        pattern:"Please enter only alphabets"
                    },
                    user_last_name: {
                        pattern:"Please enter only alphabets"
                    },
                    user_mobile_no: {
                        required: "Please enter User mobile number",
                        digits: "Please enter 10 digit mobile number",
                        minlength: "Please enter 10 digit mobile number",
                        maxlength: "Please enter 10 digit mobile number"
                    },
                    user_address_pincode: {
                        digits: "Please enter 6 digit pincode",
                        minlength: "Please enter 6 digit pincode",
                        maxlength: "Please enter 6 digit pincode"
                    }
                }
            }); 
            $("#walkin_request_reg").validate({
                rules: {
                    user_details: {
                        required:true,
                        min:1
                    },
                    request_product_category:{
                        required: true
                    },
                    request_product_item:{
                        required: true,
                        min:1
                    },
                    request_product_quantity:{
                        required: true,
                        digits:true
                    },
                    request_product_total_amount:{
                        required: true
                    }
                },
                messages: {
                    user_details: {
                        required:"Please select walkin user.",
                        min:"Please select walkin user."
                    }
                }
            });

            $(".category").each(function () { 
                $(this).rules("add", {
                    required: true
                });
            }); 
            $(".item").each(function () { 
                $(this).rules("add", {
                    required: true,
                    min:1
                });
            }); 
            $(".quantity").each(function () { 
                $(this).rules("add", {
                    required: true,
                    number:true
                });
            });
            $(".total_amount").each(function () { 
                $(this).rules("add", {
                    required: true
                });
            });

            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [  ],
                "language": {
                    "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                }
            });
        });
        
    </script>
  
</body>
</html>