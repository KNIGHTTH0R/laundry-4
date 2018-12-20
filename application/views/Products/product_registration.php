
<div class="row hidden" id="add_branch">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="new_device"><b>Product Registration</b></h3>
                    </div>
                    <div class="col-sm-6">
                     <a class="btn btn-xs btn-danger btn-outline pull-right close_add_b" >Close</a>
                 </div>
             </div>
         </div>
         <div class="ibox-content">
            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addProductCategory" action="<?=site_url('su/add_product')?>">
                <div class="form-group">
                    <label class="col-lg-2 control-label">Name <span style="color:red;">*</span></label>
                    <div class="col-lg-3">
                        <select name="product_category" class="form-control">
                            <!-- <option value="0"> Select Product Category</option> -->
                            <?php foreach ($products_category as $key) {?>
                                <option value="<?=$key['product_category'];?>"><?=$key['product_category'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Item <span style="color:red;">*</span></label>
                    <div class="col-lg-3">
                        <input type="text" placeholder="Product Item" name="product_item" class="form-control">
                    </div>
                    <label class="col-lg-2 control-label">Item Rate</label>
                    <div class="col-lg-3">
                        <input type="text" placeholder="Product Item Rate" name="product_rate" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Qty Type<span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                        <select class="form-control" name="product_qty_type">
                            <option value="0">Select Qty Type</option>
                            <option value="1">Per KG</option>
                            <option value="2">Per Nos</option>
                        </select>
                    </div>                  
                    <label class="col-lg-2 control-label">Product icon <span style="color:red;">*</span></label>
                    <div class="col-lg-3">
                        <input type="text" placeholder="Product Icon" id="product_icon_path" name="product_icon" class="form-control" readonly>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Choose Icon</button>
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
            <span class="btn hidden" id="grid" style="font-size: 20px;"><img src="<?=base_url()?>assets/img/grid.png" style="height:20px;"><b>  &nbsp Product Details</b></span>
            <span class="btn" id="list" style="font-size: 20px;"><img src="<?=base_url()?>assets/img/list.png" style="height:20px;"><b>  &nbsp Product Details</b></span>
        </div>
        <div class="col-sm-6">
            <a class="btn btn-xs btn-success btn-outline pull-right" id="add_branch_b" >Add Product</a>
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
                    <tr>
                        <td><?=$j+1;?></td>
                        <!-- <td><?=$key['branch_id']?></td> -->
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
            <?php } else{ $j=0; $cate= '';
                foreach ($products as $key) {
                    if($cate == ""){?> 
                        <div class="row">
                    <?php }elseif($cate != ''.$key['product_category'].''){ ?>
                        </div>
                        <hr style="border-color: #000000;margin-top:0px;">
                        <div class="row">
                    <?php } ?>
                    <div class="col-sm-2">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <div class="product-imitation" style="padding: 0px 0px;background-color: #ffffff;">
                            <center><img src="<?=$key['product_icon']?>" class=" img-responsive" style="width: 100px;height: 100px;"></center>
                        </div>
                        <div class="product-desc" style="padding: 14px;background-color:#f8f8f9;">
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
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog" style="width: 100%;height: 10%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding-left: 3%;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-size: large;">Choose Product Image</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    <?php foreach ($map as $key) {?>
                        <div class="col-sm-2" style="border: 1px solid #000000;"> 
                            <input type="radio" name="imagedetails" id="radio_option" value="<?php echo base_url($dir)."".$key;?>" data-dismiss="modal">   
                            <center><img src="<?php echo base_url($dir)."/".$key;?>" width="100px" alt="">
                            <figcaption style="font-size: 15px;font-weight: bold;padding-top: 5%;"><?php $data = explode('.',$key);echo $data[0];?></figcaption></center>
                        </div>
                    <?php } ?>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

      </div>
    </div>
</div>
