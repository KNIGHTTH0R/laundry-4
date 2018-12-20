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
        $(document).ready(function(){
            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });

            <?php } ?>

            <?php if($dash == 'product') {?>
                $('#product').addClass('active');
                document.title = "8x Laundry | Product Details"
            <?php } else if($dash == 'category') {?>
                $('#category').addClass('active');
                document.title = "8x Laundry | Category Details"
            <?php } else if($dash == 'add_on_services') {?>
                $('#add_on').addClass('active');
                document.title = "8x Laundry | Add On Service Details"
            <?php } ?>

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

            $(document).on('click','#radio_option',function(){
                var path = $('form input[type=radio]:checked').val();
                // alert(path);
                $('#product_icon_path').val(path);
            });

            $(document).on('change','#product_cat_details',function(){
                $("#product_prod_details").empty();
                var cate = $(this).val();
                console.log(cate);
                $.post('<?=site_url('Su/fetch_product_details')?>',{cate:cate},function(data){
                    console.log(data);
                    $("#product_prod_details").append('<option value="" selected disabled> Select Product</option>');
                    $.each(data,function(k,v){
                        $("#product_prod_details").append('<option value="'+v.product_id+'">'+v.product_item+'</option>');
                    });
                },'JSON');
                // alert(cate);
            });

            $("#addProduct").validate({
                rules: {
                    product_category: {
                        required: true
                    },
                    addon_name:{
                        required:true
                    },
                    product_category:{
                        required:true
                    },
                    product_branch_id:{
                        required:true,
                        min:1
                    }, 
                    addon_product_id:{
                        required:true,
                        min:1
                    },
                    addon_rate:{
                        required: true,
                        digits: true,
                        maxlength:2
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
                    product_branch_id:{
                        required:"Please select Branch",
                        min:"Please select Branch"
                    },
                    addon_product_id:{
                        required:"Please select Product type",
                        min:"Please select Product type"
                    },
                    addon_rate:{
                        maxlength:"Rate Should be less than 100."
                    },
                    employee_mobile_no: {
                        required: "Please enter Employee mobile number",
                        digits: "Please enter 10 digit mobile number",
                        minlength: "Please enter 10 digit mobile number",
                        maxlength: "Please enter 10 digit mobile number"
                    }
                }
            });

            $("#addProductCategory").validate({
                rules: {
                    product_category: {
                        required: true
                    },
                    product_item:{
                        required:true
                    },
                    product_icon:{
                        required:true
                    },
                    product_qty_type:{
                        required:true,
                        min:1
                    },
                    product_rate:{
                        required: true,
                        digits: true,
                    }
                },
                messages: {
                    product_category: {
                        required: "Please select Product name."
                    },
                    product_qty_type:{
                        required:"Please select QTY Type.",
                        min:"Please select QTY Type."
                    },
                    addon_product_id:{
                        required:"Please select Product type",
                        min:"Please select Product type"
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
                buttons: [  ],
                "language": {
                    "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                }
            });

        });
    </script>
</body>
</html>