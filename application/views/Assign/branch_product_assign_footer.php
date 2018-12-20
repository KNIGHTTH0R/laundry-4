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

            <?php if($dash == 'assign') {?>
                $('#assign').addClass('active');
                document.title = "8x Laundry | Branch Product Assign Details"
            <?php } else if($dash == 'category') {?>
                $('#category').addClass('active');
                document.title = "8x Laundry | Category Details"
            <?php } else if($dash == 'add_on_services') {?>
                $('#add_on').addClass('active');
                document.title = "8x Laundry | Add On Service Details"
            <?php } ?>

            $('.product_select').hide();
            $(document).on('click','.product_ass_details_edit',function(){
                $('.product_select').toggle();
            });

            $(document).on('click','.item_ass_details_edit',function(){
                $('.item_select').toggle();
            });

            $(document).on('click','.service_ass_details_edit',function(){
                $('.service_select').toggle();
            })

            prod_cat = [];
            $(document).on('click','.product_category_name',function(){
                var prod_cat =[];
                $(".product_category_name:checked").each(function(){
                    prod_cat.push($(this).val());
                });
                // alert(prod_cat);
            });

            $(document).on('click','.fetch_item_acc_pro',function(){
                var product_cat =$(this).text();
                $('#item_rec_details').empty();
                $('.item_select1').hide();
                // alert(product_cat);
                $.post('<?=site_url('Su/fetch_item_acc_product')?>',{prod_cat:product_cat},function(data){
                    console.log(data);
                    $.each(data,function(k,v){
                        $('#item_rec_details').append('<tr><td>'+v.product_category+'</td><td class="fetch_service_acc_item">'+v.product_item+'</td><td class="item_select"><input type="checkbox" value="'+v.product_id+'" name="product_item[]" class="product_item_name"></td></tr>')
                    });
                },'JSON')
                // alert(prod_cat);
            });

            $(document).on('click','.product_item_name',function(){
                var prod_item = $(this).val();
                 $.post('<?=site_url('Su/fetch_final_item_acc_product')?>',{prod_item:prod_item},function(data){
                    console.log(data);
                    $.each(data,function(k,v){
                        $('#final_rec_details').append('<tr><td>'+v.product_category+'</td><td>'+v.product_item+'</td><td></td><td class="item_select"><input type="checkbox" value="'+v.product_id+'" name="product_final_item[]" class="product_final_recc" checked></td></tr>')
                    });
                },'JSON')
            });

            $(document).on('click','.fetch_service_acc_item',function(){
                var product_item = $(this).text();
                $('#service_rec_details').empty();
                $.post('<?=site_url('Su/fetch_service_acc_item')?>',{product_item:product_item},function(data){
                    console.log(data);
                    $.each(data,function(k,v){
                        $('#service_rec_details').append('<tr><td>'+v.product_item+'</td><td>'+v.addon_name+'</td><td class="service_select"><input type="checkbox" value="'+v.addon_id+'" name="product_service[]" class="product_service_name"></td></tr>')
                    });
                },'JSON')
                // alert(prod_cat);
            });

            $(document).on('click','.product_service_name',function(){
                var prod_service = $(this).val();
                alert(prod_service);
                 $.post('<?=site_url('Su/fetch_final_service_acc_product')?>',{prod_service:prod_service},function(data){
                    console.log(data);
                    $.each(data,function(k,v){
                        $('#final_rec_details').append('<tr><td>'+v.product_category+'</td><td>'+v.product_item+'</td><td>'+v.addon_name+'</td><td class="service_select"><input type="checkbox" value="'+v.addon_id+'" name="product_final_service[]" class="product_final_recc" checked></td></tr>')
                    });
                },'JSON')
            });

            $("#assignBranch").validate({
                rules: {
                    product_category: {
                        required: true
                    },
                    product_item: {
                        required: true
                    },
                    product_service:{
                        required:true
                    },
                    product_branch_id:{
                        required:true,
                        min:1
                    }
                },
                messages: {
                    product_branch_id:{
                        required:"Please select Branch",
                        min:"Please select Branch"
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