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

            $('.clockpicker').clockpicker({
                twelvehour: true,
                donetext: 'Done'
            });

            var today = new Date();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,
                startDate: "today",
                maxDate: today
            });

            <?php if($request == 'request') {?>
                $('#request').addClass('active');
                document.title = "8x Laundry | Request Details"
            <?php } ?>

            $('#editDeliverTime').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;  

                $('.request_id_edit').val(id);
            });

            $('#cancelRequest').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;  
                $('.request_id_delete').val(id);
            });
            
            // $(document).on('click','.pickup_request_details',function(){
            //     var request_id = this.title;
            //     $.post('<?=site_url('Request/cancel_request')?>',{request_id:request_id},function(data){
            //         console.log(data);
            //         window.location.href = "<?php  echo site_url('Request'); ?>";
            //     },'JSON');
            // });

            $(document).on('click','.approved_request_details',function(){
                var request_id = this.title;
                $.post('<?=site_url('Request/approved_request')?>',{request_id:request_id},function(data){
                    console.log(data);
                    window.location.href = "<?php  echo site_url('Request'); ?>";
                },'JSON');
            });

            $(document).on('click','.work_done_request_details',function(){
                var request_id = this.title;
                $.post('<?=site_url('Request/work_done_request')?>',{request_id:request_id},function(data){
                    console.log(data);
                    window.location.href = "<?php  echo site_url('Request'); ?>";
                },'JSON');
            });

            $(document).on('click','.under_process_request_details',function(){
                var request_id = this.title;
                $.post('<?=site_url('Request/under_process_request')?>',{request_id:request_id},function(data){
                    console.log(data);
                    window.location.href = "<?php  echo site_url('Request'); ?>";
                },'JSON');
            });

            $(document).on('click','.inward_request_details',function(){
                $('.inward_details').empty();
                $('#request_detials').removeClass();
                $('#request_detials').addClass('col-sm-6');
                $('#request_imward_detials').removeClass();
                $('#request_imward_detials').addClass('col-sm-6');

                var request_id = this.title;
                $.post('<?=site_url('Request/inward_request_details')?>',{request_id:request_id},function(data){
                    console.log(data);
                    $.each(data,function(k,v){
                        $('.inward_details').append('<tr><td>'+v.product_category+'</td><td>'+v.product_item+'</td><td>'+v.inward_product_rate+'</td><td>'+v.inward_product_quantity+'</td><td>'+v.inward_total_amount+'</td><td>'+v.inward_status+'</td></tr>');
                    });
                },'JSON');
            });

            $(document).on('click','.close_inward_details',function(){
                $('#request_detials').removeClass();
                $('#request_detials').addClass('col-sm-12');
                $('#request_imward_detials').removeClass();
                $('#request_imward_detials').addClass('hidden');
            });

            var table = $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                ordering:false,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [  ],
                "language": {
                    "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                }
            });
            $('.search_request_id').on( 'keyup', function () {
                table
                    .columns([3])
                    .search( this.value )
                    .draw();
            } );
            $('.search_user_id').on( 'keyup', function () {
                table
                    .columns([1])
                    .search( this.value )
                    .draw();
            } );

        });
    </script>
  
</body>
</html>