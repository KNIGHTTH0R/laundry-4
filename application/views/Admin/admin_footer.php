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
     <!-- ChartJS -->
    <script src="<?=base_url();?>assets/js/plugins/chartJs/Chart.min.js"></script>

     <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <script>

        
    </script>
    <script>
        $(document).ready(function(){

            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });

            <?php } ?>
            <?php if($active == 'dashboard') {?>
                $('#dashboard').addClass('active');
                document.title = "8x Laundry | Dashboard"
            <?php } ?>
            <?php if($active == 'employee') {?>
                $('#employee').addClass('active');
                document.title = "8x Laundry | Employee"
            <?php } ?>
            <?php if($active == 'product') {?>
                $('#product').addClass('active');
                document.title = "8x Laundry | Product"
            <?php } ?>

            $('#editEmployee').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;
                var employee_details = id.split('-');   

                $('.employee_id_edit').val(employee_details[0]);
                $('.employee_name_first_edit').val(employee_details[1]);
                $('.employee_name_middle_edit').val(employee_details[2]);
                $('.employee_name_last_edit').val(employee_details[3]);
                $('.employee_mobile_edit').val(employee_details[4]);
            });

            $(document).on('click','.close_add_b',function(){
                $('#add_branch').removeClass();
                $('#add_branch').addClass('row hidden');
                $('#details_add').removeClass();
                $('#details_add').addClass('col-sm-6');
            });

            $(document).on('click','#add_branch_b',function(){
                $('#add_branch').removeClass();
                $('#add_branch').addClass('row');
                $('#details_add').removeClass();
                $('#details_add').addClass('col-sm-6 hidden');
            });

            $(document).on('click','#grid',function(){
                $('#branch_grid').removeClass();
                $('#branch_grid').addClass('row');
                $('#branch_table').removeClass();
                $('#branch_table').addClass('table-responsive hidden');
                $('#list').removeClass();
                $('#list').addClass('btn'); 
                $('#grid').removeClass();
                $('#grid').addClass('btn hidden');
            });

            $(document).on('click','#list',function(){
                $('#branch_grid').removeClass();
                $('#branch_grid').addClass('row hidden');
                $('#branch_table').removeClass();
                $('#branch_table').addClass('table-responsive');
                $('#list').removeClass();
                $('#list').addClass('btn hidden');
                $('#grid').removeClass();
                $('#grid').addClass('btn');
            });
// -----------------------------------product footer----------------------------------------
             $(document).on('click','.close_add_b_update',function(){
                $('#product_category').empty();
                $('#product_id').empty();
                $('#product_item').empty();
                $('#product_rate').empty();
                $('#product_qty_type').empty();
                $('#icon_div').empty();

                $('#add_branch').removeClass();
                $('#add_branch').addClass('row hidden');
                $('#details_add').removeClass();
                $('#details_add').addClass('col-sm-6');
            });
            
            $(document).on('click','.fetch_item_acc_pro',function(){
                $('#add_branch').removeClass('hidden');
                var product_cat = this.title;
                $('#item_rec_details').empty();
                // $('#service_rec_details').empty();
                $('.item_select1').hide();
                // alert(product_cat);
                $.post('<?=site_url('Admin/fetch_item_acc_product')?>',{prod_cat:product_cat},function(data){
                    console.log(data);
                    $.each(data,function(k,v){

                        $('#item_rec_details').append('<tr><td>'+v.product_category+'</td><td class="fetch_service_acc_item">'+v.product_item+'</td>'+
                            '<td>'+v.product_rate+'</td>'+
                            '<td class="item_select">'+
                                '<div class="row"><div class="col-sm-4">'+
                                '<div class="switch">'+
                                    '<div class="onoffswitch">'+
                                    (v.product_expiry_date == "9999-12-31" ? '<input type="checkbox" checked class="onoffswitch-checkbox product_item_name" id="example1'+v.product_id+'" title="'+v.product_id+'">' : '<input type="checkbox" class="onoffswitch-checkbox product_item_name" id="example1'+v.product_id+'" title="'+v.product_id+'">' )+ 
                                        '<label class="onoffswitch-label" for="example1'+v.product_id+'">'+
                                            '<span class="onoffswitch-inner"></span>'+
                                            '<span class="onoffswitch-switch"></span>'+
                                        '</label>'+
                                    '</div>'+
                                '</div></div>'+
                                '<div class="col-sm-6"><button class="btn btn-primary btn-xs" data-toggle="modal" id ="'+v.product_id+'-'+v.product_category+'-'+v.product_item+'-'+v.product_rate+'" data-target="#editPrice"><i class="fa fa-pencil" title="Edit Price"></i></button>'+
                                '</div></div>'+
                            '</td></tr>')

                    });
                },'JSON')
            });
            $(document).on('click','.product_item_name',function(){
                var id = this.title;
                if(!$(this).is(':checked')){
                    $.post('<?=site_url('Admin/product_expire')?>',{id:id},function(data){
                    },'JSON')
                    // alert("off");
                }else{
                    $.post('<?=site_url('Admin/product_effective')?>',{id:id},function(data){
                    },'JSON')
                    // alert("on");
                }
            });

            $(document).on('click','.fetch_service_acc_item',function(){
                var product_item = $(this).text();
                $('#service_rec_details').empty();
                $.post('<?=site_url('Admin/fetch_service_acc_item')?>',{product_item:product_item},function(data){
                    console.log(data);
                    $.each(data,function(k,v){
                        $('#service_rec_details').append('<tr><td>'+v.product_item+'</td><td>'+v.addon_name+'</td>'+
                            '<td>'+v.addon_rate+'</td>'+
                            '<td class="service_select">'+
                            '<div class="row"><div class="col-sm-4">'+
                            '<div class="switch">'+
                                '<div class="onoffswitch">'+
                                (v.addon_expiry_date == "9999-12-31" ? '<input type="checkbox" checked class="onoffswitch-checkbox product_service_name" id="example1'+v.addon_id+'" title="'+v.addon_id+'">' : '<input type="checkbox" class="onoffswitch-checkbox product_service_name" id="example1'+v.addon_id+'" title="'+v.addon_id+'">' )+ 
                                    '<label class="onoffswitch-label" for="example1'+v.addon_id+'">'+
                                        '<span class="onoffswitch-inner"></span>'+
                                        '<span class="onoffswitch-switch"></span>'+
                                    '</label>'+
                                '</div>'+
                            '</div></div>'+
                            '<div class="col-sm-6"><button class="btn btn-primary btn-xs" data-toggle="modal" id ="'+v.addon_id+'-'+v.product_item+'-'+v.addon_name+'-'+v.addon_rate+'" data-target="#editAddOnPrice"><i class="fa fa-pencil" title="Edit Price"></i></button>'+
                                '</div></div>'+
                        '</td></tr>')
                    });
                },'JSON')
                
            });

            $('#editPrice').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;
                var product_details = id.split('-');   

                $('.product_id_edit').val(product_details[0]);
                $('.product_category_edit').val(product_details[1]);
                $('.product_item_edit').val(product_details[2]);
                $('.product_rate_edit').val(product_details[3]);
            });

            $('#editAddOnPrice').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;
                var addon_details = id.split('-');   

                $('.addon_id_edit').val(addon_details[0]);
                $('.addon_category_edit').val(addon_details[1]);
                $('.addon_item_edit').val(addon_details[2]);
                $('.addon_rate_edit').val(addon_details[3]);
            });

            $(document).on('click','.product_service_name',function(){
                var id = this.title;
                if(!$(this).is(':checked')){
                    $.post('<?=site_url('Admin/product_addon_expire')?>',{id:id},function(data){
                    },'JSON')
                    // alert("off");
                }else{
                    $.post('<?=site_url('Admin/product_addon_effective')?>',{id:id},function(data){
                    },'JSON')
                    // alert("on");
                }
            });

            $("#addProduct").validate({
                rules: {
                    product_category: {
                        required: true
                    },
                    employee_last_name: {
                        required: true,
                        pattern: /^[a-zA-Z\s]*$/
                    },
                    employee_address:{
                        required:true
                    },
                    product_branch_id:{
                        required:true,
                        min:1
                    }, 
                    employee_account_type:{
                        required:true,
                        min:1
                    },
                    employee_mobile_no: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    }
                },
                messages: {
                    product_category: {
                        required: "Please enter Product name."
                    },
                    employee_last_name: {
                        required: "Please enter Employee Last name.",
                        pattern:"Please enter only alphabets"
                    },
                    product_branch_id:{
                        required:"Please select Branch",
                        min:"Please select Branch"
                    },
                    employee_account_type:{
                        required:"Please select Employee type",
                        min:"Please select Employee type"
                    },
                    employee_mobile_no: {
                        required: "Please enter Employee mobile number",
                        digits: "Please enter 10 digit mobile number",
                        minlength: "Please enter 10 digit mobile number",
                        maxlength: "Please enter 10 digit mobile number"
                    }
                }
            });


            $("#addEmployee").validate({
                rules: {
                    employee_first_name: {
                        required: true,
                        pattern: /^[a-zA-Z\s]*$/
                    },
                    employee_last_name: {
                        required: true,
                        pattern: /^[a-zA-Z\s]*$/
                    },
                    employee_address:{
                        required:true
                    },
                    employee_branch_id:{
                        required:true,
                        min:1
                    }, 
                    employee_mobile_no: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    }
                },
                messages: {
                    employee_first_name: {
                        required: "Please enter Employee First name.",
                        pattern:"Please enter only alphabets"
                    },
                    employee_last_name: {
                        required: "Please enter Employee Last name.",
                        pattern:"Please enter only alphabets"
                    },
                    employee_branch_id:{
                        required:"Please select Branch",
                        min:"Please select Branch"
                    },
                    employee_mobile_no: {
                        required: "Please enter Employee mobile number",
                        digits: "Please enter 10 digit mobile number",
                        minlength: "Please enter 10 digit mobile number",
                        maxlength: "Please enter 10 digit mobile number"
                    }
                }
            }); 

            $("#update_rateDetails").validate({
                rules: {
                    product_rate: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    product_rate: {
                        required: "Please enter product Rate"
                    }
                }
            });

            $("#update_addOnrateDetails").validate({
                rules: {
                    addon_rate: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    addon_rate: {
                        required: "Please enter Service Rate"
                    }
                }
            });

            $("#update_employeeDetails").validate({
                rules: {
                    employee_first_name: {
                        required: true,
                        pattern: /^[a-zA-Z\s]*$/
                    },
                    employee_middle_name: {
                        pattern: /^[a-zA-Z\s]*$/
                    },
                    employee_last_name: {
                        required: true,
                        pattern: /^[a-zA-Z\s]*$/
                    },
                    employee_address:{
                        required:true
                    },
                    employee_branch_id:{
                        required:true,
                        min:1
                    }, 
                    employee_account_type:{
                        required:true,
                        min:1
                    },
                    employee_mobile_no: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    }
                },
                messages: {
                    employee_first_name: {
                        required: "Please enter Employee First name.",
                        pattern:"Please enter only alphabets"
                    },
                    employee_last_name: {
                        required: "Please enter Employee Last name.",
                        pattern:"Please enter only alphabets"
                    },
                    employee_branch_id:{
                        required:"Please select Branch",
                        min:"Please select Branch"
                    },
                    employee_account_type:{
                        required:"Please select Employee type",
                        min:"Please select Employee type"
                    },
                    employee_mobile_no: {
                        required: "Please enter Employee mobile number",
                        digits: "Please enter 10 digit mobile number",
                        minlength: "Please enter 10 digit mobile number",
                        maxlength: "Please enter 10 digit mobile number"
                    }
                }
            }); 



            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [  ]

            });
        });

    </script>
  
</body>
</html>