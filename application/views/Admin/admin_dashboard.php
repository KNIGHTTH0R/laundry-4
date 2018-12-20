<style type="text/css">
    .ibox-title {
        background-color: #EF7F1A;
        color: #ffffff;
    }
    .ibox-content {
        background-color: #019DE1;
        color: #ffffff;
    }
    .ibox-content:hover {
        background-color: #28497C;
    }
</style>
<div class="wrapper wrapper-content" style="padding: 1%;">
    <div class="row" id="cnt_row">
        <a href="<?=site_url('Admin/employees')?>">
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">New</span>
                        <h5>Employees</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <center><h1 class="no-margins"><?php echo $total_admin[0]['total_employee'] ?></h1>
                                <small>Admin</small></center>
                            </div>
                            <div class="col-sm-6" style="text-align: right;">
                                <center><h1 class="no-margins"><?php echo $total_deli[0]['total_employee'] ?></h1>
                                <small>Employee</small></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Customer</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <center><h1 class="no-margins"><?php echo $total_active_user ?></h1>
                            <small>Total Customer</small></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="<?=site_url('Complaint')?>">
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Complaints</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <center><h1 class="no-margins"><?php echo $total_request[0]['total_request'] ?></h1>
                            <small>Receive</small></center>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <center><h1 class="no-margins"><?php echo $total_resolve[0]['total_request'] ?></h1>
                            <small>Resolve</small></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </a>
        <a href="<?=site_url('Request')?>">
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">New</span>
                        <h5>Request</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <center><h1 class="no-margins"><?php echo $total_pending_request[0]['total_request'] ?></h1>
                                <small>Pending</small></center>
                            </div>
                            <div class="col-sm-6" style="text-align: right;">
                                <center><h1 class="no-margins"><?php echo $total_comp_request[0]['total_request'] ?></h1>
                                <small>Completed</small></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>SMS</h5>
                </div>
                <div class="ibox-content">
                    <center>
                    <h1 class="no-margins"><?php echo $total_SMS[0]['total_SMS'] ?></h1>
                    <!-- <div class="stat-percent font-bold text-danger"><i class="fa fa-level-down"></i></div> -->
                    <small>Total SMS</small></center>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Total Revenue</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $total_revenue[0]['total_amount'] ?></h1>
                    <!-- <div class="stat-percent font-bold text-info"><i class="fa fa-level-up"></i></div> -->
                    <small>Total Amount</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="background-color: #EF7F1A;">
                    <h5>Branch Wise Request</h5>
                </div>
                <div class="ibox-content" style="background-color: #ffffff;">
                    <div><canvas id="barChart1"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="background-color: #28497C;">
                    <h5>Last 7 Days Request Record's</h5>
                </div>
                <div class="ibox-content" style="background-color: #ffffff;">
                    <div>
                        <canvas id="barChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>