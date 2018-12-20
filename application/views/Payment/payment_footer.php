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

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#day_book_from').val();
                var max = $('#day_book_to').val();
                var createdAt = data[4] || 0; // Our date column in the table
                if ((min == "" || max == "") || (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))) {
                    return true;
                }
                return false;
            }
        );

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
                var user_data =this.title;
                $('#send_sms_for_pending_amount').attr('title',''+user_data+'');
                var update_data = user_data.split('-');
                var user_id = update_data[0];
                $.post('<?=site_url('Payment/user_payemnt_details')?>',{user_id:user_id},function(data){
                    console.log(data);
                    $('#all_user_payment_details').removeClass();
                    $('#all_user_payment_details').addClass('col-lg-6');
                    $('#user_payment_details').removeClass();
                    $('#user_payment_details').addClass('col-lg-6');
                    // $('#user_details').text(name);
                    $.each(data,function(k,v){
                        $('.user_payment').append('<tr><td>1</td><td>'+v.date+'</td><td>'+v.description+'</td><td>'+v.request_amount+'</td><td>'+v.payment_amount+'</td></tr>');
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

            var table = $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [  ],
                "language": {
                    "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                },
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api();
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        if(typeof i === 'string') {
                            let multiplier = /[\(\)]/g.test(i) ? -1 : 1;
                        
                            return (i.replace(/[\$,\(\)]/g, '') * multiplier)
                        }
                        return typeof i === 'number' ?
                            i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 9 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 9, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 9 ).footer() ).html(
                        'Rs. '+pageTotal +' ( Rs. '+ total +' total)'
                    );
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
                        digits:true
                    },
                    payment_discount:{
                        required:true,
                        digits:true
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