<style type="text/css">

     .table > thead > tr > th{

        vertical-align: middle;

        text-align: center;

    }

    .table > tbody > tr > td{

        padding: 0px;

        width: 15%;

    }

</style>

<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <div class="row">

                    <div class="col-sm-6">

                        <h3 class="new_device"><b>Walk IN Request</b></h3>

                    </div>

                    <div class="col-sm-6">

                        <button type="button" class="btn btn-xs btn-success btn-outline pull-right" data-toggle="modal" data-target="#addWalkin"><i class="fa fa-plus"></i></button>

                    </div>

                </div>

            </div>

            <div class="ibox-content">

                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="walkin_request_reg" action="<?=site_url('WalkIn/add_walkin_request')?>">

                    <div class="form-group">

                        <div class="col-sm-7 col-sm-offset-2">

                            <select class=" select2_demo_3 form-control" name="user_details" id="user_details">

                                <option>Please Select User</option>

                                <?php foreach ($user as $key) {?>

                                    <option value="<?=$key['user_id']?>"><?=$key['user_first_name']?> <?=$key['user_last_name']?></option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="ibox-title">

                        <div class="row">

                            <div class="col-sm-6">

                                <h3 class="new_device"><b>Product Request</b></h3>

                            </div>

                            <div class="col-sm-6">

                                <span class="btn btn-xs btn-primary btn-outline pull-right" id="add_new_product_request"><i class="fa fa-plus"></i></span>

                            </div>

                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>Sr No.</th>

                                    <th>Category</th>

                                    <th>Item</th>

                                    <th>Qauntity</th>

                                    <th>Price/QTY</th>

                                    <th>AddOn Services</th>

                                    <th>Total</th>

                                </tr>

                            </thead>

                            <tbody id="product_table">

                                <tr id="product_stock">

                                    <td id="sr_no" style="padding-left: 1%;padding-top: 8px;width:1%;">

                                        1

                                    </td>

                                    <td id="product_category">

                                        <select class="form-control category" name="request_product_category[]">

                                            <option value="">-- Choose Product Category --</option>

                                            <?php foreach ($product_category as $key) {?>

                                                <option value="<?=$key['product_category']?>"><?=$key['product_category']?></option>

                                            <?php } ?>

                                        </select>

                                    </td>

                                    <td id="product_item">

                                        <select class="form-control item" name="request_product_item[]">

                                            <option value="">-- Please Select Item --</option>

                                        </select>

                                    </td>

                                    <td id="product_quantity">

                                        <input type="text" class="form-control quantity" name="request_product_quantity[]">

                                    </td>

                                    <td id="product_price_quantity">

                                         <input type="text" class="form-control price_per_QTY" name="product_price_quantity[]" readonly>

                                    </td>

                                    <td id="product_addon_service" style="width: 25%;">

                                        <select class="select2_demo_2 form-control addon_service" name="request_product_addon_service[0][]" multiple="multiple" style="width:100%;">

                                            <option value="">-- Please Select Addon Service --</option>

                                        </select>

                                    </td>

                                    <td id="product_total_amount">

                                        <input type="text" class="form-control total_amount" name="request_product_total_amount[]">

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">

                        <div class="col-sm-5 col-sm-offset-5">

                            <button class="btn btn-white" type="reset">Cancel</button>

                            <button class="btn btn-primary" type="submit">Submit</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div id="addWalkin" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 50%;">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">New Walk IN Details</h4>

            </div>

            <div class="modal-body">

                <form method="post" class="form-horizontal" id="addWalkin_details" action="<?=site_url('WalkIn/add_walkin_details')?>" enctype="multipart/form-data">

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="user_first_name" placeholder="User First Name">

                        </div>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="user_last_name" placeholder="User Last Name">

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label"> Mobile No. <span style="color:red;">*</span></label>

                        <div class="col-sm-4">

                            <input type="text" class="form-control" name="user_mobile_no"> 

                        </div>

                        <label class="col-sm-2 control-label"> Area </label>

                        <div class="col-sm-4">

                            <input type="text" class="form-control" name="user_address_area"> 

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label"> House No.</label>

                        <div class="col-sm-4">

                            <input type="text" class="form-control" name="user_address_house_no"> 

                        </div>

                        <label class="col-sm-2 control-label"> City</label>

                        <div class="col-sm-4">

                            <input type="text" class="form-control" name="user_address_city" value="Pune"> 

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label"> State</label>

                        <div class="col-sm-4">

                            <input type="text" class="form-control" name="user_address_state" value="Maharashtra"> 

                        </div>

                        <label class="col-sm-2 control-label"> Pin Code</label>

                        <div class="col-sm-4">

                            <input type="text" class="form-control" name="user_address_pincode"> 

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label"> Latitude </label>

                        <div class="col-sm-4">

                            <input type="text" class="form-control" name="user_latitude" value="<?php echo $lat?>"> 

                        </div>

                        <label class="col-sm-2 control-label"> Longitude</label>

                        <div class="col-sm-4">

                            <input type="text" class="form-control" name="user_longitude" value="<?php echo $long?>"> 

                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">

                        <div class="col-lg-6" style="text-align:right;">

                            <button class="btn btn-primary" type="submit">Submit</button>

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