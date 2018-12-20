    <div class="footer" style="background: #232020;color: #fff;">
        <div class="row">
            <div class="col-sm-4">
                <div class="pull-left">
                    <b>Designed & Developed By
                    <a href="http://www.autoqed.com" target="_blank"> <img src="<?=base_url()?>assets/img/autoqed_logo.png" style="height:22px;"> <span style="color:#ffffff;">AUTO</span><span style="color: #39b54a;">QED</span></a> 
                    | Copyright &copy; 2018-19
                </div>
            </div>
             <div class="pull-right">
                <i class="fa fa-phone-square" aria-hidden="true"></i><strong> +91 98507 29144</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong>info@autoqed.com </strong> 
            </div>
        </div>
    </div>  
    <!-- Mainly scripts -->
    <script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>assets/js/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/js/inspinia.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>
   
    <script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
     <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?= base_url();?>assets/js/plugins/fullcalendar/moment.min.js"></script>
    <!-- Date range picker -->
    <script src="<?= base_url();?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>
      <!-- Data picker -->
   <script src="<?= base_url();?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
     <!-- Clock picker -->
    <script src="<?= base_url();?>assets/js/plugins/clockpicker/clockpicker.js"></script>
     <!-- Select2 -->
    <script src="<?= base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>

    <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>
    <!-- Sweet alert -->
    <script src="<?= base_url();?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- d3 and c3 charts -->
    <script src="<?= base_url();?>assets/js/plugins/d3/d3.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/c3/c3.min.js"></script>

     <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <script>

        
    </script>
    <script>
        $(document).ready(function(){

            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });

            <?php } ?>
            <?php if($active == 'complaint') {?>
                $('#complaint').addClass('active');
                document.title = "8x Laundry | Complaint"
            <?php } ?>
           
           $(document).on('click','.view_complaint', function(){
                var complaint_id = this.title;
                $('#complaint_list_div').removeClass('col-sm-12');
                $('#complaint_list_div').addClass('col-sm-8');
                $('#complaint_show_div').removeClass('hidden');
                $('#complaint_show_div').addClass('col-sm-4');
                $('#complaint_show_div').empty();

                $.post('<?=site_url('Complaint/view_complaint')?>',{complaint_id:complaint_id},function(data){
                    console.log(data);
                        $('#complaint_show_div').append('<div class="social-feed-separated">'+
                                '<div class="social-avatar">'+
                                    '<img alt="user" src="'+data.complaint_list.user_profile_image+'">'+
                                '</div>'+
                                '<div class="social-feed-box">'+
                                    '<div class="social-avatar">'+
                                        '<a href="#">'+data.complaint_list.user_last_name+' '+data.complaint_list.user_first_name+'</a>'+
                                        '<small class="text-muted"> '+data.complaint_list.complaint_text_date+'</small>'+
                                    '</div>'+
                                    '<div class="social-body">'+
                                        '<p>'+data.complaint_list.complaint_text+'</p>'+
                                    '</div>'+
                                    '<div class="social-footer">'+
                                        (data.complaint_list.complaint_reply == null ? '<div class="social-comment">'+
                                            '<a href="#" class="pull-left">'+
                                                '<img alt="image" src="'+data.employee_profile_image+'">'+
                                            '</a>'+
                                            '<div class="media-body">'+
                                                '<input type="text" id="reply_id" class="hidden" value="'+data.complaint_list.complaint_id+'">'+
                                                '<textarea class="form-control" placeholder="Write comment..." id="reply_text"></textarea>'+
                                                '<br>'+
                                                '<div class="btn-group" style="float:right">'+
                                                    '<button class="btn btn-white btn-xs" id="reply_details_update"><i class="fa fa-comments"></i> Reply</button>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>' : '<div class="social-comment">'+
                                            '<a href="#" class="pull-left">'+
                                                '<img alt="image" src="'+data.employee_profile_image+'">'+
                                            '</a>'+
                                            '<div class="media-body" id="update_complaint_req_details">'+
                                                ''+data.complaint_list.complaint_reply+''+
                                                '<br>'+
                                                '<small class="text-muted">'+data.complaint_list.complaint_reply_date+'</small>'+
                                                '<span class="btn btn-white btn-xs pull-right" id="edit_reply_details_update_pencil"><i class="fa fa-pencil"></i></span>'+
                                            '</div>'+
                                            '<div class="media-body hidden" id="update_complaint_req">'+
                                                '<input type="text" id="edit_reply_id" class="hidden" value="'+data.complaint_list.complaint_id+'">'+
                                                '<textarea class="form-control" placeholder="Write comment..." id="edit_reply_text">'+data.complaint_list.complaint_reply+'</textarea>'+
                                                '<br>'+
                                                '<div class="btn-group" style="float:right">'+
                                                    '<button class="btn btn-white btn-xs" id="edit_reply_details_update"><i class="fa fa-comments"></i>Update Reply</button>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>')+
                                    '</div>'+
                                '</div>'+
                            '</div>');
                },'JSON')
           });

           $(document).on('click','#reply_details_update',function(){
                var co_id = $('#reply_id').val();
                var co_reply = $('textarea#reply_text').val();
                if(co_id != '' && co_reply != ''){
                    $.post('<?=site_url('Complaint/update_complaint_status')?>',{co_id:co_id,co_reply:co_reply},function(data){
                        console.log(data);                         
                        $('#reply_id').empty();
                        $('textarea#reply_text').empty();
                        <?php
                            $this->session->set_flashdata('active',1);
                            $this->session->set_flashdata('title',"Complaint Updated.");
                            $this->session->set_flashdata('text',"");
                            $this->session->set_flashdata('type',"success");
                        ?>
                        window.location.href = "<?php  echo site_url('Complaint'); ?>";
                    },'JSON');
                }
           });

           $(document).on('click','#edit_reply_details_update_pencil',function(){
                $('#update_complaint_req').removeClass();
                $('#update_complaint_req').addClass('media-body');
                $('#update_complaint_req_details').removeClass();
                $('#update_complaint_req_details').addClass('media-body hidden');
           });

           $(document).on('click','#edit_reply_details_update',function(){
                var co_id = $('#edit_reply_id').val();
                var co_reply = $('textarea#edit_reply_text').val();
                if(co_id != '' && co_reply != ''){
                    $.post('<?=site_url('Complaint/update_complaint_status')?>',{co_id:co_id,co_reply:co_reply},function(data){
                        console.log(data);                         
                        $('#edit_reply_id').empty();
                        $('textarea#edit_reply_text').empty();
                        window.location.href = "<?php  echo site_url('Complaint'); ?>";
                    },'JSON');
                }
           });

            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [  ]

            });


        });
    </script>
  
</body>
</html>