<div class="row">
    <div class="col-sm-12" id="complaint_list_div">
        <div class="ibox-title">
            <div class="row">
                <div class="col-sm-6">
                    <span class="btn" style="font-size: 20px;"><b> Complaint Details</b></span>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>User</th>
                            <th>Complaint</th>
                            <th>Complaint Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $j=0;foreach ($complaint_list as $key) {?>
                            <tr class="view_complaint" title="<?=$key['complaint_id']?>">
                                <td><?=$j+1;?></td>
                                <td class="feed-element" style="">
                                    <!-- <img alt="image" class="img-circle" src="<?=$key['user_profile_image']?>"> -->
                                    <?=$key['user_first_name']?>  <?=$key['user_last_name']?>
                                    <br>
                                    <small class="text-muted" style=""><?=$key['user_mobile_no']?></small>
                                </td>
                                <td><?=$key['complaint_text']?></td>
                                <td><?=$key['complaint_text_date']?></td>
                                <?php if ($key['complaint_reply'] == null) { ?>
                                    <td>Pending</td>
                                <?php }else{ ?>
                                    <td>Replied</td>
                                <?php } ?>
                            </tr>
                            <?php $j++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4 hidden" id="complaint_show_div">
            <!-- <div class="social-feed-separated">
                <div class="social-avatar">
                    <img alt="user" src="img/a8.jpg">
                </div>
                <div class="social-feed-box">
                    <div class="social-avatar">
                        <a href="#">Andrew Williams</a>
                        <small class="text-muted">12.06.2014</small>
                    </div>
                    <div class="social-body">
                        <p>text</p>
                    </div>
                    <div class="social-footer">
                        <div class="social-comment">
                            <a href="#" class="pull-left">
                                <img alt="image" src="img/a3.jpg">
                            </a>
                            <div class="media-body">
                                It uses a dictionary of over 200 Latin words.
                                <br>
                                <small class="text-muted">12.06.2014</small>
                            </div>
                        </div>
                        <div class="social-comment">
                            <a href="#" class="pull-left">
                                <img alt="image" src="img/a4.jpg">
                            </a>
                            <div class="media-body">
                                <textarea class="form-control" placeholder="Write comment..."></textarea>
                                <div class="btn-group">
                                    <button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>


        </div>    
    </div>
