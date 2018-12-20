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
    <script src="<?= base_url();?>assets/js/jquery-ui.min.js"></script>
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

    <script src="<?=base_url();?>assets/js/plugins/lat_long_picker/jquery-gmaps-latlon-picker.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCOb6MStK2RKEOdmVnXjAv8FbrnC81xRdc"></script>

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


            <?php if($dash == 'branch') {?>
                $('#branch').addClass('active');
                document.title = "8x Laundry | Branch Details"
            <?php } ?>

            $('.clockpicker').clockpicker();

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

            $(document).on('change','#branch_home_delivery_charges',function(){
                var del = $(this).val();
                if(del == 1){
                    $('#delivery_charge_branch').removeClass();
                    $('#delivery_charge_branch').addClass('form-group');
                }else{
                    $('#delivery_charge_branch').removeClass();
                    $('#delivery_charge_branch').addClass('form-group hidden');
                }
            });
            $(document).on('change','.branch_home_delivery_charges_edit',function(){
                var del = $(this).val();
                if(del == 1){
                    $('#delivery_charge_branch1').removeClass();
                    $('#delivery_charge_branch1').addClass('form-group');
                }else{
                    $('#delivery_charge_branch1').removeClass();
                    $('#delivery_charge_branch1').addClass('form-group hidden');
                }
            });

            $('#editBranch').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;
                var branch_details = id.split('-*');   

                $('.branch_id_edit').val(branch_details[0]);
                $('.branch_name_edit').val(branch_details[1]);
                $('.branch_code_edit').val(branch_details[2]);
                $('.branch_add_edit').val(branch_details[3]);
                $('.branch_ver_edit').val(branch_details[4]);
                $('.branch_lat_edit').val(branch_details[5]);
                $('.branch_long_edit').val(branch_details[6]);
                $('.branch_contact_no_edit').val(branch_details[7]);
                $('.branch_opening_time_edit').val(branch_details[8]);
                $('.branch_closed_time_edit').val(branch_details[9]);
                $('.branch_break_start_time_edit').val(branch_details[10]);
                $('.branch_break_end_time_edit').val(branch_details[11]);
                // $('.branch_home_delivery_charges_edit select').val(branch_details[12]).change();
                $('.branch_home_delivery_charges_edit option[value='+branch_details[13]+']').attr('selected','selected');
            });
            $('#editBranchPaytm').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;
                $('.paytm_branch_id_edit').val(id);
            });

            $(document).on('click','#update_lat_long',function(){
                var lat = $('.gllpLatitude').val();
                var long = $('.gllpLongitude').val();
                $('#geofence_lat').val(lat);
                $('#geofence_long').val(long);
            });

            $("#addBranch").validate({
                rules: {
                    branch_name: {
                        required: true
                    },
                    branch_area: {
                        required: true
                    },
                    branch_contact_no:{
                        required:true,
                        digits:true,
                        minlength:10,
                        maxlength:11
                    },
                    branch_location_address:{
                        required:true
                    },
                    branch_ver_code:{
                        required:true,
                        digits:true,
                        minlength: 3,
                        maxlength: 6
                    },
                    branch_lat:{
                        required:true
                    },
                    branch_long:{
                        required:true
                    },
                    branch_opening_time:{
                        required:true
                    },
                    branch_closed_time:{
                        required:true
                    },
                    branch_home_delivery_charges:{
                        required:true,
                        min:1
                    },
                    branch_minimum_delivery:{
                        required:true,
                        digits:true
                    },
                    branch_paytm_code:{
                        required:true
                    }
                },
                messages: {
                    branch_name: {
                        required: "Please enter Branch name."
                    },
                    branch_area: {
                        required: "Please enter Branch Area."
                    },
                    branch_contact_no:{
                        required:"Please Enter branch Contact Number.",
                        digits:"Please enter Only Digits.",
                        minlength: "Please enter the minimum 10 digits.",
                        maxlength: "Please enter the maximum 11 digits."
                    },
                    branch_location_address:{
                        required:"Please enter Branch Address.",
                    },
                    branch_ver_code:{
                        required:"Please Enter employee verification Code.",
                        digits:"Please enter Only Digits.",
                        minlength: "Please enter the minimum 3 digits.",
                        maxlength: "Please enter the maximum 6 digits."
                    },
                    branch_lat:{
                        required:"Please enter the Branch Lattitutde."
                    },
                    branch_long:{
                        required:"Please enter the Branch Longitude."
                    },
                    branch_home_delivery_charges:{
                        min:"Please Select Delievry Charges."
                    },
                    branch_paytm_code:{
                        required:"Please select the Paytm QRCode."
                    }
                }
            });
            $("#update_branchDetails").validate({
                rules: {
                    branch_name: {
                        required: true
                    },
                    branch_area: {
                        required: true
                    },
                    branch_location_address:{
                        required:true
                    },
                    branch_contact_no:{
                        required:true,
                        digits:true,
                        minlength:10,
                        maxlength:11
                    },
                    branch_ver_code:{
                        required:true,
                        digits:true,
                        minlength: 3,
                        maxlength: 6
                    },
                    branch_lat:{
                        required:true
                    },
                    branch_long:{
                        required:true
                    },
                    branch_opening_time:{
                        required:true
                    },
                    branch_closed_time:{
                        required:true
                    },
                    branch_home_delivery_charges:{
                        required:true,
                        min:0
                    },
                    branch_minimum_delivery:{
                        required:true,
                        digits:true
                    },
                    branch_paytm_code:{
                        required:true
                    }
                },
                messages: {
                    branch_name: {
                        required: "Please enter Branch name."
                    },
                    branch_area: {
                        required: "Please enter Branch Area."
                    },
                    branch_location_address:{
                        required:"Please enter Branch Address.",
                    },
                    branch_contact_no:{
                        required:"Please Enter branch Contact Number.",
                        digits:"Please enter Only Digits.",
                        minlength: "Please enter the minimum 10 digits.",
                        maxlength: "Please enter the maximum 11 digits."
                    },
                    branch_ver_code:{
                        required:"Please Enter employee verification Code.",
                        digits:"Please enter Only Digits.",
                        minlength: "Please enter the minimum 3 digits.",
                        maxlength: "Please enter the maximum 6 digits."
                    },
                    branch_home_delivery_charges:{
                        min:"Please Select Delievry Charges."
                    },
                    branch_lat:{
                        required:"Please enter the Branch Lattitutde."
                    },
                    branch_long:{
                        required:"Please enter the Branch Longitude."
                    },
                    branch_paytm_code:{
                        required:"Please select the Paytm QRCode."
                    }
                }
            });
            $("#branchPaytm").validate({
                rules: {
                    branch_paytm_code:{
                        required:true
                    }
                },
                messages: {
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