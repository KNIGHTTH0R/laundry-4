<div class="row hidden" id="add_branch">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"><b>Product Update</b></h3>
                    </div>
                    <div class="col-sm-6">
                     <a class="btn btn-xs btn-danger btn-outline pull-right close_add_b_update" >Close</a>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-6" id="product_item_details">
                        <div class="ibox-title" style="border:none;border-bottom: 2px solid #000000;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span><b>  Item Details</b></span>
                                </div>
                                <!-- <div class="col-sm-6" style="text-align:right;">
                                    <span class="btn btn-white item_ass_details_edit"><i class="fa fa-pencil"></i></span>
                                </div> -->
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 99% !important;">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Item</th>
                                        <th>Rate</th>
                                        <th class="item_select">Select</th>
                                    </tr>
                                </thead>
                                <tbody id="item_rec_details">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6" id="product_item_details">
                        <div class="ibox-title" style="border:none;border-bottom: 2px solid #000000;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span><b>  Service's Details</b></span>
                                </div>
                                <!-- <div class="col-sm-6" style="text-align:right;">
                                    <span class="btn btn-white service_ass_details_edit"><i class="fa fa-pencil"></i></span>
                                </div> -->
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 99% !important;">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Service</th>
                                        <th>Rate</th>
                                        <th class="service_select">Select</th>
                                    </tr>
                                </thead>
                                <tbody id="service_rec_details">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox-title">
    <div class="row">
        <div class="col-sm-6">
            <span class="btn hidden" id="grid" style="font-size: 20px;"><img src="<?=base_url()?>assets/img/grid.png" style="height:20px;"><b>   Product Details</b></span>
            <span class="btn" id="list" style="font-size: 20px;"><img src="<?=base_url()?>assets/img/list.png" style="height:20px;"><b>   Product Details</b></span>
        </div>
        <div class="col-sm-6">
            <!-- <a class="btn btn-xs btn-success btn-outline pull-right" id="add_branch_b" >Add Product</a> -->
        </div>
    </div>
</div>
<div class="ibox-content">
    <div class="table-responsive hidden" id="branch_table">
        <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Icon</th>
                    <th>Product Rate</th>
                    <th>Product Qnty Type</th>
                </tr>
            </thead>
            <tbody>
                <?php $j=0;
                foreach ($products as $key) {?>
                    <tr class="fetch_item_acc_pro" title="<?=$key['product_category']?>">
                        <td><?=$j+1;?></td>
                        <td><?=$key['product_item']?></td>
                        <td><?=$key['product_category']?></td>
                        <td class="project-people">
                            <img alt="image" class="img-circle" src="<?=$key['product_icon']?>">
                        </td>
                        <td><?=$key['product_rate']?></td>
                        <td><?=$key['product_qty_type']?></td>
                    </tr>
                    <?php $j++;} ?>
                </tbody>
            </table>
        </div>
        <!-- =================================== -->
        <div class="row" id="branch_grid">
            <?php if(empty($products)){ ?>
                <center>
                    <img src='<?=base_url();?>assets/img/No-record-found.png'> 
                </center>                
            <?php } else{ $j=0;$cate= '';
            foreach ($products as $key) {
                if($cate == ""){?> 
                        <div class="row">
                    <?php }elseif($cate != ''.$key['product_category'].''){ ?>
                        </div>
                        <hr style="border-color: #000000;margin-top:0px;">
                        <div class="row">
                    <?php } ?>       
                <div class="col-md-2">
                <div class="ibox">
                    <div class="ibox-content product-box fetch_item_acc_pro" title="<?=$key['product_category']?>">
                        <div class="product-imitation" style="padding: 0px 0px;">
                            <center><img src="<?=$key['product_icon']?>" class=" img-responsive" style="width: 150px;height: 88px;"></center>
                        </div>
                        <div class="product-desc" style="padding: 14px;">
                            <span class="product-price">
                                <?php if($key['product_qty_type']==1){?>
                                    Per KG
                                <?php }if($key['product_qty_type']==2){?>
                                    Per QTY
                                <?php } ?>
                            </span>
                            <!-- <small class="text-muted">Category</small> -->
                            <span class="product-name pull-left" style="color: #1ab394;"><i class="fa fa-cart-plus"></i> <b><strong><?=$key['product_item']?></strong></b></span>
                           <!--  <p  style="font-size: 10px;">&nbsp &nbsp<b><strong><?=$key['product_category']?></strong></b></p> -->
                            <?php $cate = ''.$key['product_category'].''; ?>
                            <p class="pull-right">&nbsp &nbsp <i class="fa fa-rupee"></i>  <strong><?=$key['product_rate']?> RS/-</strong></p><br><br>
                            <span class="pull-left"><i class="fa fa-tint"></i> <b><strong><?=$key['product_category']?></strong></b></span>
                         <div class="m-t text-righ">
                            <!-- <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $j++; } } ?>
    </div>
</div>
<div id="editPrice" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Product Rate Details</h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" id="update_rateDetails" action="<?=site_url('Admin/Update_branch_product_rate')?>" enctype="multipart/form-data">
                    <div class="form-group hidden">
                        <label class="col-sm-3 control-label">Branch ID</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control product_id_edit" name="product_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control product_category_edit" name="product_category" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Item</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control product_item_edit" name="product_item" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Rate <span style="color:red;">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control product_rate_edit" name="product_rate">
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
<div id="editAddOnPrice" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Add On Service Rate Details</h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" id="update_addOnrateDetails" action="<?=site_url('Admin/Update_branch_addon_service_rate')?>" enctype="multipart/form-data">
                    <div class="form-group hidden">
                        <label class="col-sm-3 control-label">Branch ID</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control addon_id_edit" name="addon_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control addon_category_edit" name="addon_category" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Item</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control addon_item_edit" name="addon_item" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Rate <span style="color:red;">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control addon_rate_edit" name="addon_rate">
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
