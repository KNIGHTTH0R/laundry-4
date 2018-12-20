<style type="text/css">
    .popover{
        z-index: 2200;
    }
</style>
<div class="row hidden" id="add_branch">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"  style="font-size: 20px;"><b>Branch Registration</b></h3>
                    </div>
                    <div class="col-sm-6">
                     <a class="btn btn-xs btn-danger btn-outline pull-right close_add_b" >Close</a>
                 </div>
             </div>
         </div>
         <div class="ibox-content">
            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addBranch" action="<?=site_url('su/add_branch')?>">
                <div class="form-group">
                    <label class="col-lg-2 control-label">Name <span style="color:red;">*</span></label>
                    <div class="col-lg-3">
                        <input type="text" placeholder="Branch Name" name="branch_name" class="form-control">
                    </div>
                    <label class="col-sm-2 control-label">Area<span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="branch_area" placeholder="Branch Area">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Contact No.<span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="branch_contact_no" placeholder="Branch Contact Number">
                    </div>
                    <label class="col-lg-2 control-label"> Home Delivery Charges  <span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <select class="form-control" name="branch_home_delivery_charges" id="branch_home_delivery_charges" placeholder="Home Delivery Charges">
                            <option disabled>Branch Home Delivery Charges</option>
							<option value="0">Home Delivery Not Available</option>
                            <option value="2">Free Delivery</option>
                            <option value="1">Charges as per Branch</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-lg-2 control-label">Address<span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="branch_location_address" placeholder="Branch Location Address">
                    </div>                    
                    <label class="col-lg-2 control-label">verification Code <span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="branch_ver_code" placeholder="Branch Verification Code">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Latitude <span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="branch_lat" placeholder="Branch Latitude" id="geofence_lat">
                    </div>
                    <label class="col-lg-2 control-label">Longitude <span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="branch_long" placeholder="Branch Longitude" id="geofence_long">
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal"><img src="<?=base_url()?>assets/img/map_picker.png"></button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Opening Time <span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="branch_opening_time" placeholder="Branch Opening Time" readonly="">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                    </div>
                    <label class="col-lg-2 control-label">Closed Time <span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="branch_closed_time" placeholder="Branch Closed Time" readonly="">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Break Start Time</label>
                    <div class="col-sm-3">
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="branch_break_start_time" placeholder="Branch Break Start Time" readonly="">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>                        
                    </div>
                    <label class="col-lg-2 control-label">Break Closed Time</label>
                    <div class="col-sm-3">
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="branch_break_end_time" placeholder="Branch Break Close Time" readonly="">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Paytm QRCode <span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <input type="file" class="form-control" name="branch_paytm_code" placeholder="Branch Paytm Code" style="border:none;">
                    </div>
                    <label class="col-lg-2 control-label">Logo</label>
                    <div class="col-sm-3">
                        <input type="file" class="form-control" name="branch_logo" accept="image/gif,image/png,image/jpeg" style="border:none;">
                    </div>
                </div>
                <div class="form-group hidden" id="delivery_charge_branch">
                    <label class="col-lg-2 control-label">Minimum Order Amount<span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="branch_minimum_delivery" placeholder="Minimum Order Amount">
                    </div>
                </div>  
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-5">
                        <button class="btn btn-white close_add_b" type="reset">Cancel</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="ibox-title">
    <div class="row">
        <div class="col-sm-6">
            <span class="btn hidden" id="grid" style="font-size: 20px;"><img src="<?=base_url()?>assets/img/grid.png" style="height:20px;"><b>  &nbsp Branch Details</b></span>
            <span class="btn" id="list" style="font-size: 20px;"><img src="<?=base_url()?>assets/img/list.png" style="height:20px;"><b>  &nbsp Branch Details</b></span>
        </div>
        <div class="col-sm-6" id="details_add">
            <a class="btn btn-xs btn-success btn-outline pull-right" id="add_branch_b" >Add Branch</a>

        </div>
    </div>
</div>
<div class="ibox-content">
    <div class="table-responsive hidden" id="branch_table">
        <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Branch Name</th>
                    <th>Branch Area</th>
                    <th>Contact No.</th>
                    <th>Branch Location Address</th>
                    <th>Branch Verification Code</th>
                    <th>Branch Opening Time</th>
                    <th>Branch Closed Time</th>
                    <th>Branch Break Time</th>
					<th>Branch Home Delivery Status</th>
					<th>Branch Minimum Order Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $j=0;
                foreach ($branches as $key) {?>
                    <tr>
                        <td><?=$j+1;?></td>
                        <!-- <td><?=$key['branch_id']?></td> -->
                        <td><?=$key['branch_name']?></td>
                        <td><?=$key['branch_area']?></td>
                        <td><?=$key['branch_contact_no']?></td>
                        <td><?=$key['branch_location_address']?></td>
                        <td><?=$key['branch_verification_code']?></td>
                        <td><?=$key['branch_opening_time']?></td>
                        <td><?=$key['branch_closed_time']?></td>
                        <td><?=$key['branch_break_start_time']?> - <?=$key['branch_break_end_time']?></td>
						
						<?php if ($key['branch_home_delivery_charges'] == '0' ) { ?>
                            <td>Home Delivery Not Available</td>
                        <?php }else if ($key['branch_home_delivery_charges'] == '1' ){ ?>
                            <td>Charges as per Branch</td>
.						<?php }else if ($key['branch_home_delivery_charges'] == '2' ){ ?>
                            <td>Free Home Delivery</td>
                        <?php } ?>
						<td><?=$key['branch_minimum_delivery']?></td>
                        <td>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" id ="<?=$key['branch_id'].'-*'.$key['branch_name'].'-*'.$key['branch_area'].'-*'.$key['branch_location_address'].'-*'.$key['branch_verification_code'].'-*'.$key['branch_latitude'].'-*'.$key['branch_longitude'].'-*'.$key['branch_contact_no'].'-*'.$key['branch_opening_time'].'-*'.$key['branch_closed_time'].'-*'.$key['branch_break_start_time'].'-*'.$key['branch_break_end_time'].'-*'.$key['branch_home_delivery_charges'].'-*'.$key['branch_minimum_delivery']?>" data-target="#editBranch"><i class="fa fa-pencil" title="Edit Branch"></i></button>&nbsp &nbsp
                            <button class="btn btn-primary btn-xs" data-toggle="modal" id ="<?=$key['branch_id']?>" data-target="#editBranchPaytm"><i class="fa fa-paypal" title="Edit Paytm"></i></button>&nbsp &nbsp
                        </td>
                    </tr>
                    <?php $j++;} ?>
                </tbody>
            </table>
        </div>
        <!-- =================================== -->
        <div class="row" id="branch_grid">
            <?php if(empty($branches)){ ?>
                <center>
                    <img src='<?=base_url();?>assets/img/No-record-found.png'> 
                </center>                
            <?php } else{ $j=0; foreach ($branches as $key) {?>        
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <div class="product-imitation" style="padding: 10% 0px;">
                                <?php if ($key['branch_logo'] == 'https://8xlaundry.com/assets/img/branches.png' || $key['branch_logo'] == '') { ?>
                                    <center><img src="<?=base_url()?>assets/img/branches.png" class=" img-responsive" ></center>
                                <?php }else{ ?>
                                    <center><img src="<?=$key['branch_logo']?>" class=" img-responsive" ></center>
                                <?php } ?>
                            </div>
                            <div class="product-desc" style="padding-bottom: 0;padding-top: 5px;">
                                <span class="product-price">
                                 <?=$key['branch_area']?>
								 </span>
								 <div class="row">
									<div class="col-sm-9">
										<span class="product-name" style="color:#ff6b01;font-weight: bold;"><?=$key['branch_name']?></span>
										<div class="small m-t-xs">
											<i class="fa fa-map-marker" style="color:#ff6b01;"></i> <?=$key['branch_location_address']?>
										</div>
										<div class="small m-t-xs" style="padding-top: 10px;">
											<?php if ($key['branch_home_delivery_charges'] == '0' ) { ?>
												<i class="fa fa-truck" style="color:#ff6b01;" ></i>  Home Delivery Not Available
											<?php }else if ($key['branch_home_delivery_charges'] == '1' ){ ?>
												<i class="fa fa-truck" style="color:#ff6b01;"></i>  Delivery Charges as per branch on order below (Rs.<?=$key['branch_minimum_delivery']?>)
											<?php }else if ($key['branch_home_delivery_charges'] == '2' ){ ?>
												<i class="fa fa-truck" style="color:#ff6b01;"></i>  Free Home Delivery
											<?php } ?>
										</div>
									</div>
									<div class="col-sm-3" style="padding: 0px;">
										<div class="small m-t-xs">
											<img src="<?=$key['branch_PAYTM_QR_code']?>" class="img-responsive" style="width: 150px;">
										</div>
									</div>
								</div>

                                <!-- <div class="m-t text-righ">
                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php $j++; } }?>
            </div>
        </div>
        <div id="editBranch" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Branch Details</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="form-horizontal" id="update_branchDetails" action="<?=site_url('Su/Update_branch')?>" enctype="multipart/form-data">
                            <div class="form-group hidden">
                                <label class="col-sm-3 control-label">Branch ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control branch_id_edit" name="branch_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name <span style="color:red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control branch_name_edit" name="branch_name" readonly="">
                                </div>
                                <label class="col-sm-2 control-label">Area <span style="color:red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control branch_code_edit" name="branch_area"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Contact No.<span style="color:red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control branch_contact_no_edit" name="branch_contact_no" placeholder="Branch Contact Number">
                                </div>
                                <label class="col-lg-2 control-label"> Home Delivery Charges  <span style="color:red;">*</span></label>
                                <div class="col-sm-4">
                                    <select class="form-control branch_home_delivery_charges_edit" name="branch_home_delivery_charges" placeholder="Branch Home Delivery Charges">
                                        <option disabled>Branch Home Delivery Charges</option>
                                        <option value="0">Home Delivery Not Available</option>
										<option value="1">Charges as per Branch</option>
										<option value="2">Free Delivery</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address <span style="color:red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control branch_add_edit" name="branch_location_address">
                                </div>
                                <label class="col-sm-2 control-label">Verification Code <span style="color:red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control branch_ver_edit" name="branch_ver_code"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Lattitude <span style="color:red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control branch_lat_edit" name="branch_lat">
                                </div>
                                <label class="col-sm-2 control-label">Longitude <span style="color:red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control branch_long_edit" name="branch_long">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-2 control-label">Opening Time <span style="color:red;">*</span></label>
                            <div class="col-sm-4">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control branch_opening_time_edit" name="branch_opening_time" readonly="">
                                    <span class="input-group-addon">
                                        <span class="fa fa-clock-o"></span>
                                    </span>
                                </div>
                            </div>
                            <label class="col-lg-2 control-label">Closed Time <span style="color:red;">*</span></label>
                            <div class="col-sm-4">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control branch_closed_time_edit" name="branch_closed_time" readonly="">
                                    <span class="input-group-addon">
                                        <span class="fa fa-clock-o"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Break Start Time</label>
                            <div class="col-sm-4">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control branch_break_start_time_edit" name="branch_break_start_time" readonly="">
                                    <span class="input-group-addon">
                                        <span class="fa fa-clock-o"></span>
                                    </span>
                                </div>                        
                            </div>
                            <label class="col-lg-2 control-label">Break Closed Time</label>
                            <div class="col-sm-4">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control branch_break_end_time_edit" name="branch_break_end_time"  readonly="">
                                    <span class="input-group-addon">
                                        <span class="fa fa-clock-o"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group hidden" id="delivery_charge_branch1">
                            <label class="col-lg-2 control-label">Minimum Order Amount<span style="color:red;">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="branch_minimum_delivery" placeholder="Minimum Order Amount">
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
        <div id="editBranchPaytm" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Branch Paytm QR Code</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="form-horizontal" id="branchPaytm" action="<?=site_url('Su/Update_Paytm_QR')?>" enctype="multipart/form-data">
                            <div class="form-group hidden">
                                <label class="col-sm-3 control-label">Branch ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control paytm_branch_id_edit" name="branch_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Paytm QRCode <span style="color:red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="branch_paytm_code" placeholder="Branch Paytm Code" style="border:none;">
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
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Map Lat-Long Picker</b></h4>
                    </div>
                    <div class="modal-body">
                        <fieldset class="gllpLatlonPicker">
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="text" class="form-control gllpSearchField">
                            </div>
                            <div class="col-sm-2">
                                <input type="button" class="btn btn-info gllpSearchButton" value="search">
                            </div>
                        </div>
                        <br><br>
                        <div class="gllpMap"></div><br><center>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="col-sm-10">   
                                        <div class="form-group">
                                            <label class="control-label" style="padding-bottom:2%">Lattitude</label>
                                            <input type="text" name="" class="form-control gllpLatitude" value="22.38661818384341">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-10">   
                                        <div class="form-group">
                                            <label class="control-label" style="padding-bottom:2%">Longitude</label>
                                            <input type="text" name="" class="form-control gllpLongitude" value="79.52245681526063">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="gllpZoom hidden" value="3"/>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="update_lat_long" data-dismiss="modal">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>