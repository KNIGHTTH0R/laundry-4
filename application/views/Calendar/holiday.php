<!-- Page Content -->
        	<div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 text-center">
                                    <div class="ibox-content">
                                        <!-- <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#calendar"><i class="fa fa-th-large"></i> Grid View</a></li>
                                            <li class=""><a data-toggle="tab" href="#list_view"><i class="fa fa-list"></i> List View</a></li>
                                        </ul> -->
                                        <!-- <div class="tab-content"> -->
        					                <div id="calendar" class="tab-pane col-centered active">
                                            </div>
                                            
                                        <!-- </div> -->
    			                    </div>
    				            </div>
                                <div class="col-lg-6 col-sm-6 text-center">
                                    <div class="ibox-content">
                                        <div id="list_view" class="tab-pane">
                                            <form method="post" class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-sm-offset-2 col-sm-3 control-label">Select Year</label>   
                                                    <div class="col-sm-3">
                                                        <select class="form-control" name="" id="select_year">
                                                            <option value="" disabled selected>Select year</option>
                                                            <?php for ($i=0; $i < count($year); $i++) { ?> 
                                                                <option value="<?=$year[$i]?>"><?=$year[$i]?></option>
                                                            <?php } ?>  
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover dataTables-example table-condensed" >
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;">ID</th>
                                                            <th style="text-align: center;">Title</th>
                                                            <th style="text-align: center;">Date</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="list">
                                                    <?php $i = 1;
                                                        foreach ($holiday as $key) { 
                                                    ?>
                                                    <tr>
                                                        <td><?=$i;?></td>
                                                        <td><?=$key['holiday_name']?></td>
                                                        <td><?=substr($key['holiday_start_date'], 0, 10)?></td>
                                                        <td style="padding-top: 1px;padding-bottom: 1px;">
                                                            <a class="btn btn-danger btn-xs confirm_delete" href="<?=site_url('Calendar/delete_event/'.$key['holiday_id'])?>"><i class="fa fa-trash-o delete" title="Delete"></i> </a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; } ?>
                                                    </tbody>
                                                </table>
                                            </div>  
                                        </div>
                                    </div>    
                                </div>
    						</div>
            
                    		<!-- Modal -->
                    		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    		    <div class="modal-dialog" role="document">
                        			<div class="modal-content">                                
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                                        </div>
                                        <div class="modal-body">
                            			    <form class="form-horizontal" method="POST" action="<?=site_url('Calendar/addEvent')?>" id="addEvent">
                            				    <div class="form-group">
                                					<label for="title" class="col-sm-2 control-label">Title</label>
                                					<div class="col-sm-10">
                                					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                					</div>
                            				    </div>
                            				    <div class="form-group hidden">
                                					<label for="start" class="col-sm-2 control-label">Start date</label>
                                					<div class="col-sm-10">
                                					  <input type="text" name="start" class="form-control" id="start" readonly>
                                					</div>
                            				    </div>
                            				    <div class="form-group hidden">
                                					<label for="end" class="col-sm-2 control-label">End date</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" name="end" class="form-control" id="end" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">                  
                                                    <div class="col-sm-offset-3 col-sm-5">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                            			    </form>
                            			</div>
                        		    </div>
                                </div>
                    		</div>
                    		
                    		<!-- Modal -->
                    		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">	
                    		  <div class="modal-dialog" role="document">
                    			<div class="modal-content">
                    			<form class="form-horizontal" method="POST" action="<?=site_url('Calendar/cal_edit')?>" id="cal_edit">
                    			  <div class="modal-header">
                    				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    				<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                    			  </div>
                    			  <div class="modal-body">
                    				
                    				  <div class="form-group">
                    					<label for="title" class="col-sm-2 control-label">Title</label>
                    					<div class="col-sm-10">
                    					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    					</div>
                    				  </div>
                    				    <div class="form-group"> 
                    						<div class="col-sm-offset-2 col-sm-10">
                    							<label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
                    						</div>
                    					</div>
                    				  
                    				  <input type="hidden"  name="id" class="form-control" id="id">
                    				
                    			  </div>
                    			  <div class="modal-footer">
                    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    				<button type="submit" class="btn btn-primary">Save changes</button>
                    			  </div>
                    			</form>
                    			</div>
                    		  </div>
                    		</div>

    					    <!-- </div> -->
     					</div>
                    </div>
                </div>
        	</div>
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
        </div>
    </div>
    <!-- </div> -->
    <!-- /.container -->
    <script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/plugins/fullcalendar/moment.min.js"></script>
    <script src="<?=base_url();?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>

	 <!-- Mainly scripts 
    <script src="<?=base_url();?>assets/js/jquery-ui-1.10.4.min.js"></script>-->
    <script src="<?= base_url();?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/js/inspinia.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>

    <script src="<?=base_url()?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
	
	<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			// defaultDate: 'date()',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 	?>
				{
					id: '<?php echo $event['holiday_id']; ?>',
					title: '<?php echo $event['holiday_name']; ?>',
					start: '<?php echo $event['holiday_start_date']; ?>',
					end: '<?php echo $event['holiday_end_date']; ?>',
					color: '#000',
				},
			<?php endforeach; ?>
			]
		});

		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: "<?=site_url('Calendar/select_cal_edit')?>",
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep){
			 	console.log(rep);
					if(rep == 'true'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
		
	    <?php if($active == 'holiday'){ ?>
            $('#holiday').addClass('active');
        <?php } ?>
        <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
            swal({
                title: "<?=$flash['title']?>",
                text: "<?=$flash['text']?>",
                type: "<?=$flash['type']?>"
            });
        <?php } ?>


        $(document).on('change','#select_year',function(){

            var select_year  = $('#select_year').val();
            $('#list').empty();
            var id = 1;

            $.post('<?=site_url('Calendar/year_wise_list')?>',{select_year:select_year}, function(data){
                    console.log(data);
                    $.each(data, function(k,v){
                        var date = v.holiday_start_date.split('');
                        $('#list').append('<tr>'+
                                                '<td>'+id++ +'</td>'+
                                                '<td>'+v.holiday_name+'</td>'+
                                                '<td>'+date[0]+date[1]+date[2]+date[3]+date[4]+date[5]+date[6]+date[7]+date[8]+date[9]+'</td>'+
                                                '<td style="padding-top: 1px;padding-bottom: 1px;">'+
                                                    '<a class="btn btn-danger btn-xs confirm_delete delete_event" title="'+v.holiday_id+'"><i class="fa fa-trash-o delete" title="Delete"></i></a>'+
                                                '</td>'+
                                            '</tr>');

                    });
                    
                    $('.confirm_delete').click(function() {
                        if (confirm("Are You Sure? Do You Want To Delete It?"))
                            return ture;
                        else
                            return false;
                    });
            },'json');


        });

            $(document).on('click','.delete_event',function(){

                var event_id = this.title;
                $.post('<?=site_url('Calendar/event_delete')?>',{event_id:event_id}, function(){
                },'json');
                
                window.location.href = "<?=site_url('Calendar/index')?>";
            });

        $('.confirm_delete').click(function() {
            if (confirm("Are You Sure? Do You Want To Delete It?"))
                return ture;
            else
                return false;
        });

        $("#addEvent").validate({
            rules: {
                title: {
                    required: true,
                    pattern: /^[a-zA-Z0-9-,]+(\s{0,1}[a-zA-Z0-9-, ])*$/,
                    maxlength : 100
                },
             },
            messages: {
             }
        });
        $("#cal_edit").validate({
            rules: {
                title: {
                    required: true,
                    pattern: /^[a-zA-Z0-9-,]+(\s{0,1}[a-zA-Z0-9-, ])*$/,
                    maxlength : 100
                },
             },
            messages: {
             }
        });

	});

</script>

</body>

</html>
