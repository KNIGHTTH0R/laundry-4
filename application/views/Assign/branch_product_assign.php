<div class="ibox-title">

    <span class="btn" style="font-size: 20px;"><img src="<?=base_url()?>assets/img/list.png" style="height:20px;"><b>  &nbsp Branch Product Assign</b></span>

</div>

<div class="ibox-content">

    <div class="row">

        <form method="post" class="form-horizontal" id="assignBranch" enctype="multipart/form-data" action="<?=site_url('Su/add_branch_product')?>">

             <div class="form-group">

                <label class="col-lg-6 col-lg-offset-3 control-label" style="text-align: left; margin-bottom: 1%;">Branch<span style="color:red;">*</span></label>

                <div class="col-sm-6 col-lg-offset-3">

                    <select class="form-control" name="product_branch_id">

                        <option value="0">Select Branch</option>

                        <?php foreach ($branches as $key) {?>

                            <option value="<?=$key['branch_id']?>"><?=$key['branch_name']?></option>

                        <?php } ?>

                    </select>

                </div>

            </div>

            <div class="hr-line-dashed"></div>

            <div class="col-sm-3" id="product_cat_details">

                <div class="ibox-title" style="border:none;border-bottom: 2px solid #000000;">

                    <div class="row">

                        <div class="col-sm-6">

                            <span><b>  Product Details</b></span>

                        </div>

                        <!-- <div class="col-sm-6" style="text-align:right;">

                            <span class="btn btn-white product_ass_details_edit"><i class="fa fa-pencil"></i></span>

                        </div> -->

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>Sr No</th>

                                <th>Product Name</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $j=0;

                            foreach ($products_category as $key) {?>

                            <tr>

                                <td><?=$j+1;?></td>

                                <td class="fetch_item_acc_pro"><?=$key['product_category']?></td>

                            </tr>

                            <?php $j++;} ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="col-sm-3" id="product_item_details">

                <div class="ibox-title" style="border:none;border-bottom: 2px solid #000000;">

                    <div class="row">

                        <div class="col-sm-6">

                            <span><b>  Item Details</b></span>

                        </div>

                        <div class="col-sm-6" style="text-align:right;">

                            <span class="btn btn-white item_ass_details_edit"><i class="fa fa-pencil"></i></span>

                        </div>

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>Product</th>

                                <th>Item</th>

                                <th class="item_select">Select</th>

                            </tr>

                        </thead>

                        <tbody id="item_rec_details">

                            

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="col-sm-3" id="product_item_details">

                <div class="ibox-title" style="border:none;border-bottom: 2px solid #000000;">

                    <div class="row">

                        <div class="col-sm-6">

                            <span><b>  Service's Details</b></span>

                        </div>

                        <div class="col-sm-6" style="text-align:right;">

                            <span class="btn btn-white service_ass_details_edit"><i class="fa fa-pencil"></i></span>

                        </div>

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>Item</th>

                                <th>Service</th>

                                <th class="service_select">Select</th>

                            </tr>

                        </thead>

                        <tbody id="service_rec_details">

                            

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="col-sm-3" id="final_product_item_details">

                <div class="ibox-title" style="border:none;border-bottom: 2px solid #000000;">

                    <div class="row">

                        <div class="col-sm-6">

                            <span><b>  Final Product & Service Details</b></span>

                        </div>

                        <div class="col-sm-6" style="text-align:right;">

                            <span class="btn btn-white service_ass_details_edit"><i class="fa fa-pencil"></i></span>

                        </div>

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>Product</th>

                                <th>Item</th>

                                <th>Service</th>

                                <th class="final_select">Select</th>

                            </tr>

                        </thead>

                        <tbody id="final_rec_details">

                            

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">

                <div class="col-sm-12 col-sm-offset-8">

                    <button class="btn btn-white" type="reset">Cancel</button>

                    <button class="btn btn-primary enableOnInput" type="submit">Submit</button>

                </div>

            </div>

        </form>

    </div>

</div>

