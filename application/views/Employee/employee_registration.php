<div class="row hidden" id="add_branch">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"><b>Employee Registration</b></h3>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-xs btn-danger btn-outline pull-right close_add_b" >Close</a>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addEmployee" action="<?=site_url('su/add_employee')?>">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Name <span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Employee Firstname" name="employee_first_name" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" placeholder="Employee Middlename" name="employee_middle_name" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" placeholder="Employee Lastname" name="employee_last_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Branch <span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                            <select class="form-control m-b" name="employee_branch_id">
                                <option value="0">Select Branch</option>
                                <?php foreach ($branches as $key) {?>
                                    <option value="<?=$key['branch_id'];?>"><?=$key['branch_name'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-lg-2 control-label">Mobile No. <span style="color:red;">*</span></label>
                        <div class="col-lg-3">
                            <input type="text" placeholder="Employee mobile Number" name="employee_mobile_no" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Picture</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control" name="profile_image" style="border:none;">
                        </div>
                        <label class="col-lg-2 control-label hidden">Type <span style="color:red;">*</span></label>
                        <div class="col-sm-3 hidden">
                            <select class="form-control m-b" name="employee_account_type">
                                <option value="2">Admin</option>
                            </select>
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
            <span class="btn hidden" id="grid" style="font-size: 20px;"><img src="<?=base_url()?>assets/img/grid.png" style="height:20px;"><b>  &nbsp Employee Details</b></span>
            <span class="btn" id="list" style="font-size: 20px;"><img src="<?=base_url()?>assets/img/list.png" style="height:20px;"><b>  &nbsp Employee Details</b></span>
        </div>
        <div class="col-sm-6">
         <a class="btn btn-xs btn-success btn-outline pull-right" id="add_branch_b" >Add Employee</a>

     </div>
 </div>
</div>
<div class="ibox-content">
    <div class="table-responsive hidden" id="branch_table">
        <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Branch</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $j=0;
                foreach ($employees as $key) {?>
                    <tr>
                        <td><?=$j+1;?></td>
                        <td><?=$key['branch_name']?></td>
                        <td>
                            <?php if($key['employee_account_type']==2){?>
                                Admin
                            <?php }if($key['employee_account_type']==3){?>
                                Employee
                            <?php } ?>    

                        </td>
                        <td><?=$key['employee_first_name']?> <?=$key['employee_middle_name']?> <?=$key['employee_last_name']?></td>
                        <td><?=$key['employee_mobile_no']?></td>
                        <td>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" id ="<?=$key['employee_id'].'-'.$key['employee_first_name'].'-'.$key['employee_middle_name'].'-'.$key['employee_last_name'].'-'.$key['employee_mobile_no']?>" data-target="#editEmployee"><i class="fa fa-pencil" title="Edit Employee"></i></button>&nbsp &nbsp
                            <button class="btn btn-success btn-xs" data-toggle="modal" id ='<?=$key['employee_id']; ?>' data-target="#restEmployeePassword"><i class="fa fa-refresh" title="Reset Password"></i></button>
                        </td>
                    </tr>
                    <?php $j++;} ?>
                </tbody>
            </table>
        </div>
        <!-- =================================== -->
        <div class="row" id="branch_grid">
            <?php if(empty($employees)){ ?>
                <center>
                    <img src='<?=base_url();?>assets/img/No-record-found.png'> 
                </center>                
            <?php } else{ $j=0; foreach ($employees as $key) {?>        
                 <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <div class="product-imitation" style="padding: 10% 0px;">
                                <center><img src="<?=$key['employee_profile_image']?>" class=" img-responsive" style="width: 150px;height: 88px;"></center>
                            </div>
                            <div class="product-desc">
                                <span class="product-price">
                                        <?php if($key['employee_account_type']==2){?>
                                            Admin
                                        <?php }if($key['employee_account_type']==3){?>
                                            Employee
                                        <?php } ?>  
                                </span>
                                <!-- <small class="text-muted">Category</small> -->
                                <span class="product-name" style="color: #1ab394;"><i class="fa fa-user"></i> <b><strong><?=$key['employee_last_name']?> <?=$key['employee_first_name']?> <?=$key['employee_middle_name']?></strong></b></span>
                                <p>&nbsp &nbsp <i class="fa fa-map-marker"></i> <?=$key['branch_name']?></p>
                                <div class="small m-t-xs">
                                   <p>&nbsp &nbsp <i class="fa fa-mobile fa-lg"></i> &nbsp <strong><?=$key['employee_mobile_no']?></strong></p>
                                </div>
                                <!-- <div class="m-t text-righ">
                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php $j++; } } ?>

            </div>
        </div>
        <div id="editEmployee" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Employee Details</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="form-horizontal" id="update_employeeDetails" action="<?=site_url('Su/update_employee')?>" enctype="multipart/form-data">
                            <div class="form-group hidden">
                                <label class="col-sm-3 control-label">Employee ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control employee_id_edit" name="employee_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name <span style="color:red;">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control employee_name_first_edit" name="employee_first_name">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control employee_name_middle_edit" name="employee_middle_name">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control employee_name_last_edit" name="employee_last_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Mobile No. <span style="color:red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control employee_mobile_edit" name="employee_mobile_no"> 
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
        <div id="restEmployeePassword" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Branch Details</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="form-horizontal" action="<?=site_url('Su/reset_password')?>" enctype="multipart/form-data">
                           <div class="form-group hidden">
                                <label class="col-sm-3 control-label">Employee ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control employee_id_pass" name="employee_id">
                                </div>
                            </div>
                            <center><h3>Do you really want Update to Default Password?</h3></center>
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