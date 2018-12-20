<div class="row">
    <div class="col-lg-6" style="padding-right: 1px;">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"><b>Category Registration</b></h3>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addProduct" action="<?=site_url('su/add_product_category')?>">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Name <span style="color:red;">*</span></label>
                        <div class="col-lg-6">
                            <input type="text" placeholder="Product Category" name="product_category" class="form-control">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label">Branch</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="product_branch_id">
                                <option value="0">Select Branch</option>
                                <?php foreach ($branches as $key) {?>
                                    <option value="<?=$key['branch_id'];?>"><?=$key['branch_name'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-2">
                            <button class="btn btn-white" type="reset">Cancel</button>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="padding-left: 1px;">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"><b>Category Details</b></h3>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $j=0;foreach ($products as $key) {?>
                            <tr>
                                <td><?=$j+1;?></td>
                                <td><?=$key['product_category']?></td>
                            </tr>
                            <?php $j++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
