<style type="text/css">
    .popover{
        z-index: 2200;
    }
    .canvasjs-chart-credit{
        display: none;
    }
    .canvasjs-chart-toolbar{
        display: none;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addSMS" action="<?=site_url('SMS/send_user_sms')?>">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <div class="col-sm-6" style="padding-left:  0px;">
                                <h3 style="font-size: 20px;"><b>User SMS</b></h3>
                            </div>
                            <div class="col-sm-6" style="padding-right:  0px; text-align: right;">
                                <span id="characters"><span>
                            </div>
                            </br>
                                 <textarea placeholder="Write the Message for Customer.. " name="user_sms" class="form-control" rows="4" maxlength="160" required></textarea>
                            </br>
                            <div class="col-sm-12 col-sm-offset-2">
                                <button class="btn btn-white" type="reset">Cancel</button>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div><br>
                            <div class="col-lg-12" style="padding: 0px;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Branch Wise SMS Details </h5>
                                        <h5 class="pull-right">Pending : <?php echo $pending[0]['cnt'] ?></h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div>
                                            <div id="chartContainer" style="height: 250px; width: 100%;"></div>
                                            <!-- <canvas id="doughnutChart" height="140"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h3 style="font-size: 20px;"><b>Select User</b></h3>
                            <div class="table-responsive">
                                <table class="table table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Mobile No.</th>
                                        <th>Area</th>
                                        <th>Select</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user as $key) {?>
                                            <tr>
                                                <td><?=$key['user_id']?></td>
                                                <td><?=$key['username']?></td>
                                                <td><?=$key['user_mobile_no']?></td>
                                                <td><?=$key['user_address_area']?></td>
                                                <td><input type="checkbox" name="user_id[]" value="<?=$key['user_id']?>"></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>