<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <h3 class="new_device"  style="font-size: 20px;"><b>Daily Book Details</b></h3>
                        </div>
                        <div class="col-sm-9">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="StudentReport">
                                <div class="form-group">
                                    <label class="control-label col-sm-1">From</label> 
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control datepicker date-range-filter" name="" style="border-radius:3px;" id="day_book_from" value="<?php echo date('Y-m-d')?>" readonly>
                                    </div>
                                    <label class="control-label col-sm-1">To</label> 
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control datepicker date-range-filter" name="" style="border-radius:3px;" id="day_book_to" value="<?php echo date('Y-m-d')?>" readonly>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>User Name</th>
                                <th>Employee</th>
                                <th>Mobile No.</th>
                                <th class="hidden">Payment Date</th>
                                <th>Payment Date</th>
                                <th>Payment Time</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Payment Amount</th>
                                <th>Discount</th>
                                <th>Admin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $j=0;foreach ($day_book as $key) {?>
                            <tr id="all_request_details">
                                <td><?=$j+1;?></td>
                                <td><?=$key['name']?></td>
                                <td><?=$key['emp_name']?></td>
                                <td><?=$key['user_mobile_no']?></td>
                                <td  class="hidden"><?=$key['date_payment']?></td>
                                <td><?=$key['payment_date']?></td>
                                <td><?=$key['payment_time']?></td>
                                <td><?=$key['payment_method']?></td>
                                <td><?=$key['payment_status']?></td>
                                <td><?=$key['payment_amount']?></td>
                                <td><?=$key['payment_discount']?></td>
                                <td><?=$key['admin_name']?></td>
                                <td>
                                    <?php if($key['payment_admin_id'] == 0){ ?>
                                       <button class="btn btn-danger btn-xs" data-toggle="modal" id ='<?=$key['payment_id']; ?>' data-target="#updateAdmin"><i class="fa fa-user" title="Update Admin"></i></button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $j++;} ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="hidden"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="text-align:right">Total:</th>
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
        <div id="updateAdmin" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Payment Admin Details</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="form-horizontal" id="update_paymentDetails" action="<?=site_url('Payment/update_payment_admin')?>" enctype="multipart/form-data">
                            <div class="form-group hidden">
                                <label class="col-sm-3 control-label">Payment ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control payment_id_edit" name="payment_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Admin Name</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="payment_admin_id">
                                        <option value ="0"> Select Admin</option>
                                        <?php foreach ($employee_details as $key) {?>
                                            <option value="<?=$key['employee_id']?>"><?=$key['employee_last_name']?> <?=$key['employee_first_name']?> <?=$key['employee_middle_name']?></option>
                                        <?php } ?>
                                    </select>
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
    </div>
</div>
