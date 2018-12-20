<style type="text/css">
    .popover{
        z-index: 2200;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 style="font-size: 20px;"><b>SMS Details</b></h3>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table table-striped table-bordered table-hover dataTables-example_sms">
                        <thead>
                            <th>Sr No</th>
                            <th>Date & time</th>
                            <th>SMS Type</th>
                            <th>Mobile No.</th>
                            <th>Message ID</th>
                            <th>Status</th>
                            <th>Total MSG</th>
                            <th>Message</th>
                            <th>User</th>
                            <th>Branch</th>
                        </thead>
                        <tbody>
                            <?php foreach ($sms as $key) {?>
                                <tr>
                                    <td><?=$key['sent_sms_id']?></td>
                                    <td><?=$key['sent_sms_datetime']?></td>
                                    <td><?=$key['sms_type']?></td>
                                    <td><?=$key['sent_sms_mobile_number']?></td>
                                    <td><?=$key['sent_sms_MsgID']?></td>
                                    <td><?=$key['sent_sms_status']?></td>
                                    <td><?=$key['sent_sms_count']?></td>
                                    <td><?=$key['sent_sms_MSG']?></td>
                                    <td><?=$key['username']?></td>
                                    <td><?=$key['branch_name']?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot style="height: 35px;">
                            <th></th>
                            <th></th>
                            <th style="padding: 0px;"><input type="text" name="" id="serach_sms_type" style="border:none;height:35px;width:100%;"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="padding: 0px;"><input type="text" name="" id="serach_user" style="border:none;height:35px;width:100%;"></th>
                            <th style="padding: 0px;"><input type="text" name="" id="serach_branch" style="border:none;height:35px;width:100%;"></th>
                        </tfoot>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</div>