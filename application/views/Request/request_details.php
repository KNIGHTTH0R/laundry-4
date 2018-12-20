<style type="text/css">
    .popover{
        z-index: 2200;
    }
    table > tbody > tr >td {
        white-space: nowrap;
    }
</style>
<div class="row">
    <div class="col-lg-12" id="request_detials">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"  style="font-size: 20px;"><b>Request Details</b></h3>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#All_request"> All  (<?php echo $request_details[0]['total_request']?>) </a></li>
                        <li class=""><a data-toggle="tab" href="#pickup_request">Pick Up  (<?php echo $request_details[0]['pickup_request']?>) </a></li>
                        <li class=""><a data-toggle="tab" href="#approval_request">Approval  (<?php echo $request_details[0]['approval_request']?>) </a></li>
                        <li class=""><a data-toggle="tab" href="#underprocess_request">Under Process  (<?php echo $request_details[0]['under_process_request']?>) </a></li>
                        <li class=""><a data-toggle="tab" href="#workdone_request">Work Done (<?php echo $request_details[0]['work_done_request']?>) </a></li>
                        <li class=""><a data-toggle="tab" href="#delivery_request"> Delivery  (<?php echo $request_details[0]['delivery_request']?>) </a></li>
                        <li class=""><a data-toggle="tab" href="#cancel_request"> Cancel  (<?php echo $request_details[0]['cancel_request']?>) </a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="All_request" class="tab-pane active">
                            <div class="panel-body">
                               <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Request ID</th>
                                                <!-- <th>Branch</th> -->
                                                <th>Date</th>    
                                                <th>Time</th>                                            
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Time</th>
                                                <th>Delivery Charges</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j=0;foreach ($request as $key) {?>
                                            <tr id="all_request_details">
                                                <td><?=$j+1;?></td>
                                                <td><?=$key['request_user_id']?></td>
                                                <td><?=$key['username']?></td>
                                                <td class="all_request_id search"><?=$key['request_id']?></td>
                                                <!-- <td><?=$key['branch_name']?></td> -->
                                                <td><?=$key['request_date']?></td>
                                                <td><?=$key['request_start_time']?> - <?=$key['request_end_time']?></td>
                                                <td><?=$key['status']?></td>
                                                <td><?=$key['request_qty']?></td>
                                                <td><?=$key['request_amount']?></td>
                                                <td><?=$key['request_expected_delivery_date']?></td>
                                                <td><?=$key['request_delivery_start_time']?> - <?=$key['request_delivery_end_time']?></td>
                                                <td><?=$key['request_delivery_charges']?></td>
                                            </tr>
                                            <?php $j++;} ?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="height: 30px;">
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_user_id" placeholder="Search User ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_request_id" placeholder="Search Request ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="pickup_request" class="tab-pane">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Request ID</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <!-- <th>Delivery Date</th>
                                                <th>Delivery Time</th> -->
                                                <th>Delivery Charges</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j=0;foreach ($request as $key) {
                                                if ($key['request_status'] == '1') {
                                            ?>
                                            <tr>
                                                <td><?=$j+1;?></td>
                                                <td><?=$key['request_user_id']?></td>
                                                <td><?=$key['username']?></td>                                                
                                                <td><?=$key['request_id']?></td>
                                                <td><?=$key['request_date']?></td>
                                                <td><?=$key['request_start_time']?> - <?=$key['request_end_time']?></td>
                                                <td><?=$key['status']?></td>
                                                <td><?=$key['request_qty']?></td>
                                                <td><?=$key['request_amount']?></td>
                                                <!-- <td><?=$key['request_expected_delivery_date']?></td>
                                                <td><?=$key['request_delivery_start_time']?> - <?=$key['request_delivery_end_time']?></td> -->
                                                <td><?=$key['request_delivery_charges']?></td>
                                                <?php if($key['request_qty'] == 0 && $key['request_amount'] == 0) {?>
                                                    <td>
                                                        <button type="button" class="btn btn-xs btn-danger" id="<?=$key['request_id']?>" data-toggle="modal" data-target="#cancelRequest"><i class="fa fa-trash"></i></button>
                                                        <!-- <span class="btn btn-danger btn-xs pickup_request_details" title="<?=$key['request_id']?>"><i class="fa fa-trash" title="Cancel Request"></i></span> -->
                                                <?php }else{ ?>
                                                    <td>
                                                <?php } ?>
                                                <span class="btn btn-primary btn-xs inward_request_details" title="<?=$key['request_id']?>"><i class="fa fa-money" title="Process Request"></i></span></td>
                                            </tr>
                                            <?php $j++;} }?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="height: 30px;">
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_user_id" placeholder="Search User ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_request_id" placeholder="Search Request ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <!-- <th></th>
                                                <th></th> -->
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="approval_request" class="tab-pane">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Request ID</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <!-- <th>Delivery Date</th>
                                                <th>Delivery Time</th> -->
                                                <th>Delivery Charges</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j=0;foreach ($request as $key) {
                                                if ($key['request_status'] == '2') {
                                            ?>
                                            <tr>
                                                <td><?=$j+1;?></td>
                                                <td><?=$key['request_user_id']?></td>
                                                <td><?=$key['username']?></td>                                                
                                                <td><?=$key['request_id']?></td>
                                                <td><?=$key['request_date']?></td>
                                                <td><?=$key['request_start_time']?> - <?=$key['request_end_time']?></td>
                                                <td><?=$key['status']?></td>
                                                <td><?=$key['request_qty']?></td>
                                                <td><?=$key['request_amount']?></td>
                                                <!-- <td><?=$key['request_expected_delivery_date']?></td>
                                                <td><?=$key['request_delivery_start_time']?> - <?=$key['request_delivery_end_time']?></td> -->
                                                <td><?=$key['request_delivery_charges']?></td>
                                                <td><span class="btn btn-primary btn-xs approved_request_details" title="<?=$key['request_id']?>"><i class="fa fa-forward" title="Process Request"></i></span>&nbsp
                                                <span class="btn btn-primary btn-xs inward_request_details" title="<?=$key['request_id']?>"><i class="fa fa-money" title="Process Request"></i></span></td>
                                            </tr>
                                            <?php $j++;} }?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="height: 30px;">
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_user_id" placeholder="Search User ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_request_id" placeholder="Search Request ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                               <!--  <th></th>
                                                <th></th> -->
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="underprocess_request" class="tab-pane">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Request ID</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <!-- <th>Delivery Date</th>
                                                <th>Delivery Time</th> -->
                                                <th>Delivery Charges</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j=0;foreach ($request as $key) {
                                                if ($key['request_status'] == '3') {
                                            ?>
                                            <tr>
                                                <td><?=$j+1;?></td>
                                                <td><?=$key['request_user_id']?></td>
                                                <td><?=$key['username']?></td>                                                
                                                <td><?=$key['request_id']?></td>
                                                <td><?=$key['request_date']?></td>
                                                <td><?=$key['request_start_time']?> - <?=$key['request_end_time']?></td>
                                                <td><?=$key['status']?></td>
                                                <td><?=$key['request_qty']?></td>
                                                <td><?=$key['request_amount']?></td>
                                               <!--  <td><?=$key['request_expected_delivery_date']?></td>
                                                <td><?=$key['request_delivery_start_time']?> - <?=$key['request_delivery_end_time']?></td> -->
                                                <td><?=$key['request_delivery_charges']?></td>
                                                <td><span class="btn btn-primary btn-xs under_process_request_details" title="<?=$key['request_id']?>"><i class="fa fa-forward" title="Process Request"></i></span>&nbsp
                                                <span class="btn btn-primary btn-xs inward_request_details" title="<?=$key['request_id']?>"><i class="fa fa-money" title="Process Request"></i></span></td>
                                            </tr>
                                            <?php $j++;} }?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="height: 30px;">
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_user_id" placeholder="Search User ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_request_id" placeholder="Search Request ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                               <!--  <th></th>
                                                <th></th> -->
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="workdone_request" class="tab-pane">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Request ID</th>
                                                <!-- <th>Branch</th> -->
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Time</th>
                                                <th>Delivery Charges</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j=0;foreach ($request as $key) {
                                                if ($key['request_status'] == '4') {
                                            ?>
                                            <tr>
                                                <td><?=$j+1;?></td>
                                                <td><?=$key['request_user_id']?></td>
                                                <td><?=$key['username']?></td>                                                
                                                <td class=""><?=$key['request_id']?></td>
                                                <!-- <td><?=$key['branch_name']?></td> -->
                                                <td><?=$key['request_date']?></td>
                                                <td><?=$key['request_start_time']?> - <?=$key['request_end_time']?></td>
                                                <td><?=$key['status']?></td>
                                                <td><?=$key['request_qty']?></td>
                                                <td><?=$key['request_amount']?></td>
                                                <td><?=$key['request_expected_delivery_date']?></td>
                                                <td><?=$key['request_delivery_start_time']?> - <?=$key['request_delivery_end_time']?></td>
                                                <td><?=$key['request_delivery_charges']?></td>
                                                <td>
                                                    <?php if($key['request_expected_delivery_date'] != 'NA'){ ?>
                                                    <span class="btn btn-primary btn-xs work_done_request_details" title="<?=$key['request_id']?>"><i class="fa fa-forward" title="Process Request"></i></span>
                                                    <?php } ?>&nbsp
                                                <span class="btn btn-primary btn-xs inward_request_details" title="<?=$key['request_id']?>"><i class="fa fa-money" title="Process Request Inward"></i></span>&nbsp
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" id ="<?=$key['request_id']?>" data-target="#editDeliverTime"><i class="fa fa-pencil" title="Edit Delivery Date & Time"></i></button>
                                                </td>
                                            </tr>
                                            <?php $j++;} }?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="height: 30px;">
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_user_id" placeholder="Search User ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_request_id" placeholder="Search Request ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="delivery_request" class="tab-pane">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th class="">Request ID</th>
                                                <!-- <th>Branch</th> -->
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Time</th>
                                                <th>Delivery Charges</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j=0;foreach ($request as $key) {
                                                if ($key['request_status'] == '5') {
                                            ?>
                                            <tr>
                                                <td><?=$j+1;?></td>
                                                <td><?=$key['request_user_id']?></td>
                                                <td><?=$key['username']?></td>                                                
                                                <td class=""><?=$key['request_id']?></td>
                                                <!-- <td><?=$key['branch_name']?></td> -->
                                                <td><?=$key['request_date']?></td>
                                                <td><?=$key['request_start_time']?> - <?=$key['request_end_time']?></td>
                                                <td><?=$key['status']?></td>
                                                <td><?=$key['request_qty']?></td>
                                                <td><?=$key['request_amount']?></td>
                                                <td><?=$key['request_expected_delivery_date']?></td>
                                                <td><?=$key['request_delivery_start_time']?> - <?=$key['request_delivery_end_time']?></td>
                                                <td><?=$key['request_delivery_charges']?></td>
                                                <td> <span class="btn btn-primary btn-xs inward_request_details" title="<?=$key['request_id']?>"><i class="fa fa-money" title="Process Request"></i></span></td>
                                            </tr>
                                            <?php $j++;} }?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="height: 30px;">
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_user_id" placeholder="Search User ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_request_id" placeholder="Search Request ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="cancel_request" class="tab-pane">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th class="">Request ID</th>
                                                <!-- <th>Branch</th> -->
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Time</th>
                                                <th>Delivery Charges</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j=0;foreach ($request as $key) {
                                                if ($key['request_status'] == '6') {
                                            ?>
                                            <tr>
                                                <td><?=$j+1;?></td>
                                                <td><?=$key['request_user_id']?></td>
                                                <td><?=$key['username']?></td>                                                
                                                <td class=""><?=$key['request_id']?></td>
                                                <!-- <td><?=$key['branch_name']?></td> -->
                                                <td><?=$key['request_date']?></td>
                                                <td><?=$key['request_start_time']?> - <?=$key['request_end_time']?></td>
                                                <td><?=$key['status']?></td>
                                                <td><?=$key['request_qty']?></td>
                                                <td><?=$key['request_amount']?></td>
                                                <td><?=$key['request_expected_delivery_date']?></td>
                                                <td><?=$key['request_delivery_start_time']?> - <?=$key['request_delivery_end_time']?></td>
                                                <td><?=$key['request_delivery_charges']?></td>
                                            </tr>
                                            <?php $j++;} }?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="height: 30px;">
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_user_id" placeholder="Search User ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th style="padding: 0px;"><input type="text" name="" class="search_request_id" placeholder="Search Request ID" style="border:none;width: 100%;height: 30px;    padding-left: 5%;"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden" id="request_imward_detials">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"  style="font-size: 20px;"><b>Request Inward Details</b></h3>
                    </div>
                    <div class="col-sm-6">
                        <span class="btn btn-success btn-xs close_inward_details pull-right"><i class="fa fa-times" title="Close Inwards"></i></span>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Item</th>
                                <th>Rate</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="inward_details">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="editDeliverTime" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Delivery Date & Time Details</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="form-horizontal" id="update_deliveryDetails" action="<?=site_url('Request/Update_deliverDateTime')?>" enctype="multipart/form-data">
                            <div class="form-group hidden">
                                <label class="col-sm-3 control-label">Request ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control request_id_edit" name="request_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Date</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control datepicker" name="request_expected_delivery_date" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Start Time</label>
                                <div class="col-sm-3">
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input type="text" class="form-control" name="request_delivery_start_time" readonly="">
                                        <span class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </span>
                                    </div>
                                </div>
                                <label class="col-lg-2 control-label">End Time</label>
                                <div class="col-sm-3">
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input type="text" class="form-control" name="request_delivery_end_time" readonly="">
                                        <span class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-lg-6" style="text-align:right;">
                                    <button class="btn btn-primary" type="submit">Update</button>
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
    <div id="cancelRequest" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cancel Request Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-horizontal" action="<?=site_url('Request/cancel_request')?>" enctype="multipart/form-data">
                       <div class="form-group hidden">
                            <label class="col-sm-3 control-label">Request ID</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control request_id_delete" name="request_id">
                            </div>
                        </div>
                        <center><h3>Do you really want to Cancel Request?</h3></center>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-lg-6" style="text-align:right;">
                                <button class="btn btn-primary" type="submit">Yes</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
