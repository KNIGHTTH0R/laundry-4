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


            <?php if($dash == 'employee') {?>
                $('#employee').addClass('active');
                document.title = "8x Laundry | Employee Details"
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

            $('#editEmployee').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;
                var employee_details = id.split('-');   

                $('.employee_id_edit').val(employee_details[0]);
                $('.employee_name_first_edit').val(employee_details[1]);
                $('.employee_name_middle_edit').val(employee_details[2]);
                $('.employee_name_last_edit').val(employee_details[3]);
                $('.employee_mobile_edit').val(employee_details[4]);
            });

            $('#restEmployeePassword').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;
                $('.employee_id_pass').val(id);
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
            $("#addEmployee").validate({
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
                buttons: [  ],
                "language": {
                    "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                }
            });
        });
        
    </script>
  
</body>
</html>