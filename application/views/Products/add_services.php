<div class="row">
    
    <div class="col-lg-6" style="padding-right: 1px;">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"><b>Add Services</b></h3>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addProduct" action="<?=site_url('su/add_on_services_reg')?>">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Name <span style="color:red;">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" placeholder="Add on Name" name="addon_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Category <span style="color:red;">*</span></label>
                        <div class="col-lg-8">
                            <select name="" class="form-control" id="product_cat_details">
                                <option value="" selected disabled> Select Category</option>
                                <?php foreach ($products_category as $key) {?>
                                    <option value="<?=$key['product_category'];?>"><?=$key['product_category'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Product <span style="color:red;">*</span></label>
                        <div class="col-lg-8">
                            <select name="addon_product_id" class="form-control" id="product_prod_details">
                                <option value="" selected disabled> Select Product</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">                 
                        <label class="col-lg-3 control-label">Rate <span style="color:red;">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" placeholder="Rate" name="addon_rate" class="form-control">
                        </div>
                    </div>
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
                        <h3 class="new_device"><b>Add On Services Details</b></h3>
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
                                <th>Product</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $j=0;foreach ($addon as $key) {?>
                            <tr>
                                <td><?=$j+1;?></td>
                                <td><?=$key['addon_name']?></td>
                                <td><?=$key['product_item']?></td>
                                <td><?=$key['addon_rate']?></td>
                            </tr>
                            <?php $j++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

