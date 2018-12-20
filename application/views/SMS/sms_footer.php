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
    <!-- ChartJS-->
    <script src="<?= base_url();?>assets/js/plugins/chartJs/Chart.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script src="<?=base_url();?>assets/js/plugins/lat_long_picker/jquery-gmaps-latlon-picker.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCOb6MStK2RKEOdmVnXjAv8FbrnC81xRdc"></script>

     <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <script>
        $('textarea').keyup(updateCount);
        $('textarea').keydown(updateCount);

        function updateCount() {
            var cs = 160-$(this).val().length;
            $('#characters').text(cs+' Char Left');
            }
        
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


            <?php if($sms == 'sms') {?>
                $('#sms').addClass('active');
                document.title = "8x Laundry | SMS Details"
            <?php } ?>

            $('.clockpicker').clockpicker();

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
                        min:1
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

            $('.dataTables-example').DataTable({
                pageLength: 15,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [  ],
                "language": {
                    "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                }
            });

            var table = $('.dataTables-example_sms').DataTable({
                pageLength: 10,
                responsive: true,
                ordering:false,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [  ],
                "language": {
                    "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                }
            });

             $('#serach_sms_type').on( 'keyup', function () {
                table
                    .columns([2])
                    .search( this.value )
                    .draw();
            } );
            $('#serach_user').on( 'keyup', function () {
                table
                    .columns([8])
                    .search( this.value )
                    .draw();
            } );

            $('#serach_branch').on( 'keyup', function () {
                table
                    .columns([9])
                    .search( this.value )
                    .draw();
            } );

            window.onload = function () {

                var chart = new CanvasJS.Chart("chartContainer", {
                    exportEnabled: true,
                    animationEnabled: true,
                    legend:{
                        cursor: "pointer",
                        itemclick: explodePie
                    },
                    data: [{
                        type: "pie",
                        showInLegend: true,
                        toolTipContent: "{name}: <strong>{y}</strong>",
                        indexLabel: "{name} - {y}",
                        dataPoints: [
                        <?php foreach ($pie_chart_data as $key) {?>
                            { y: <?=$key['cnt']?>, name: "<?=$key['branch_name']?>"},
                        <?php }?>
                        ]
                    }]
                });
                chart.render();
            }

            function explodePie (e) {
                if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                    e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
                } else {
                    e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
                }
                e.chart.render();

            }

            // var doughnutData = {
            //     labels: [
            //         <?php foreach ($pie_chart_data as $key) { ?>
            //             "<?php  echo $key['branch_name']?>",
            //         <?php } ?>
            //      ],
            //     datasets: [{
            //         data: [
            //         <?php foreach ($pie_chart_data as $key1) { ?>
            //             <?php  echo $key1['cnt']?>,  
            //         <?php } ?>   
            //         ],
            //         backgroundColor: ["#a3e1d4","#dedede","#b5b8cf","#bf145a"]
            //     }]
            //     tooltip: {
            //         visible: true,
            //         template: "${ category } - ${ value }%"
            //     }
            // } ;


            // var doughnutOptions = {
            //     responsive: true
            // };


            // var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            // new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});



        });
    </script>
  
</body>
</html>