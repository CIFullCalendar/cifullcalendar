 
	<div id="page-wrapper"> 
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $events->title  ?></h1>
			</div>
			<!-- /.col-lg-12 -->		
		
		<div class="col-md-12 col-lg-12">

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-red">
						<div class="panel-heading">
							<i class="fa fa-calendar" ></i> <?php echo lang('calendar') ?>
                            <div class="pull-right">
								<div class="btn-group">
									<button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#del_<?php echo $events->id  ?>" data-placement="top" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button>
								</div>	
                            </div>							
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body"> 
							 
							<form class="form-horizontal" name="form" id="form" method="post" action="<?php echo site_url('admin/calendarlist/edit') . '/';?><?php echo $events->id  ?>" >	
								 
							<ul class="nav nav-tabs">
								<li class="active"><a href="#panel1_<?php echo $events->id  ?>" data-toggle="tab"><i class="fa fa-info-circle"></i> <?php echo lang('calendar_modal_tabtitle'); ?></a></li>
								<li><a href="#panel2_<?php echo $events->id  ?>" data-toggle="tab"><i class="fa fa-paint-brush"></i> <?php echo lang('calendar_modal_tabtitle2'); ?></a></li>
								<li><a href="#panel3_<?php echo $events->id  ?>" id="show" data-toggle="tab"><i class="fa fa-location-arrow"></i> <?php echo lang('calendar_modal_tabtitle3'); ?></a></li>
								<li><a href="#panel4" data-toggle="tab"><i class="fa fa-file"></i> <?php echo lang('calendar_modal_tabtitle4'); ?></a></li>
							</ul>
							<div class="tab-content">
								<div id="panel1_<?php echo $events->id  ?>" class="tab-pane active">
								<fieldset> 
																
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputEvent"><?php echo lang('username'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<b class="form-control" ><?php echo $events->username  ?></b>
											</div>
										</div>							
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputEvent"><?php echo lang('calendar_modal_eventname'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<input class="form-control" type="text" name="ic_event_title" id="ic_event_title" value="<?php echo $events->title  ?>" placeholder="Event Title" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputDescr"><?php echo lang('calendar_modal_description'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<textarea class="form-control" name="ic_event_desc" id="ic_event_desc" placeholder="Event Description" ><?php echo $events->description ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputBegin"><?php echo lang('calendar_modal_eventbegin'); ?></label>
											<div class="col-md-7 col-xs-7">	 
												<div class="input-group date3" id="updatedtp1<?php echo $events->id  ?>"> 
													<input class="form-control" type="text" name="ic_event_starttime" id="ic_event_starttime" value="<?php echo $events->start ?>" placeholder="<?php echo lang('calendar_modal_eventbegin'); ?>" />
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
													</span>
												</div> 													
											</div>
										<script type="text/javascript">
											$(function () {
												$('#updatedtp1<?php echo $events->id  ?>').datetimepicker({
													format: "YYYY-MM-DD HH:mm:ss"
												});  
											});
										</script>	
										</div>								
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputEnd"><?php echo lang('calendar_modal_eventend'); ?></label>
											<div class="col-md-7 col-xs-7">	 
												<div class="input-group date4" id="updatedtp2<?php echo $events->id  ?>"> 
													<input class="form-control" type="text" name="ic_event_endtime" id="ic_event_endtime" value="<?php echo $events->end ?>"  placeholder="<?php echo lang('calendar_modal_eventend'); ?>" />
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
													</span>
												</div> 		 
											</div>
										<script type="text/javascript">
											$(function () {
												$('#updatedtp2<?php echo $events->id  ?>').datetimepicker({
													format: "YYYY-MM-DD HH:mm:ss"
												});  
											});
										</script>	
										</div>		
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputURL"><?php echo lang('calendar_modal_eventurl'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<input class="form-control" type="text" name="ic_event_urllink" id="ic_event_urllink" value="<?php echo $events->url ?>" placeholder="http://" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputAllDay"><?php echo lang('calendar_modal_eventallday'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<?php if(($events->allDay) == 'true'):  ?>													
													<input type="radio" name="ic_event_allday" id="ic_event_allday" value="true" checked><?php echo lang('yes'); ?>
													<input type="radio" name="ic_event_allday" id="ic_event_allday" value="false"><?php echo lang('no'); ?>
												<?php else: ?> 
													<input type="radio" name="ic_event_allday" id="ic_event_allday" value="true" ><?php echo lang('yes'); ?>
													<input type="radio" name="ic_event_allday" id="ic_event_allday" value="false" checked><?php echo lang('no'); ?>	
												<?php endif ?>	 
											</div>												
										</div>	
										<div class="form-group">	
											<label class="control-label col-md-4 col-xs-4" for="inputShareit"><?php echo lang('calendar_modal_eventshare'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<select class="form-control" name="ic_event_shareit" id="ic_event_shareit">													
													<?php if(($events->auth) == 1):  ?>
													  <option id="ic_event_ahareit" value="1" selected><?php echo lang('calendar_modal_eventprivate'); ?></option>
													  <option id="ic_event_ahareit" value="0"><?php echo lang('calendar_modal_eventpublic'); ?></option>	
													<?php else: ?>
													  <option id="ic_event_ahareit" value="1" ><?php echo lang('calendar_modal_eventprivate'); ?></option>
													  <option id="ic_event_ahareit" value="0" selected><?php echo lang('calendar_modal_eventpublic'); ?></option>	
													<?php endif ?>	  
												</select> 	
											</div>					
										</div>
										<?php if(($events->recurdays) >= 1):  ?>
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputEvent"><?php echo lang('calendar_modal_eventrecurring'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<?php if(($events->recurdays) == 365):  ?>	
												 <b class="form-control" ><?php echo lang('calendar_modal_eventyearly'); ?></b>
												<?php elseif(($events->recurdays) == 30): ?> 
												 <b class="form-control" ><?php echo lang('calendar_modal_eventmonthly'); ?></b>
												<?php elseif(($events->recurdays) == 14): ?> 
												 <b class="form-control" ><?php echo lang('calendar_modal_event2weeks'); ?></b>
												<?php elseif(($events->recurdays) == 7): ?> 
												 <b class="form-control" ><?php echo lang('calendar_modal_eventweekly'); ?></b>
												<?php elseif(($events->recurdays) == 1): ?> 
												 <b class="form-control" ><?php echo lang('calendar_modal_eventdaily'); ?></b>
												<?php else: ?>
												 
												<?php endif ?>	
											</div>
										</div>	
										<?php endif ?>
									</fieldset>								
								</div>
								<div id="panel2_<?php echo $events->id  ?>" class="tab-pane">
								<div id="content_wrapper"> 

									<?php foreach ($allcategories as $events2): ?>	
										<?php if(($events->category) == ($events2->category_id)):  ?>  
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputCategory"><?php echo lang('calendar_modal_eventcategory'); ?></label>
												<div class="col-md-7 col-xs-7">	 													
													<b class="form-control" ><?php echo $events2->category_name ?></b>
												</div> 
											</div>	
										<?php endif ?>
									<?php endforeach ?> 
									
									<!-- Option select-->
									<div class="form-group">
										<label class="control-label col-md-4 col-xs-4" for="inputRendering"><?php echo lang('calendar_modal_eventrendering'); ?></label>
										<div class="col-md-7 col-xs-7">	
											<select class="form-control" name="ic_event_rendering" id="ic_event_rendering" >
												<?php if(($events->rendering)  == "" ):  ?> 
													<option id="ic_event_renderingF" value="" selected><?php echo lang('calendar_modal_eventfgrender'); ?></option>
													<option id="ic_event_renderingB" value="background" ><?php echo lang('calendar_modal_eventbgrender'); ?></option>
												<?php else: ?>
													<option id="ic_event_renderingF" value="" ><?php echo lang('calendar_modal_eventfgrender'); ?></option>
													<option id="ic_event_renderingB" value="background" selected><?php echo lang('calendar_modal_eventbgrender'); ?></option>
												<?php endif ?>			 						
											</select>
										</div>											
									</div> 
									<!-- Color select-->
									<div class="form-group">	
										<label class="control-label col-md-4 col-xs-4" for="inputBgColor"><?php echo lang('calendar_modal_colorbackground'); ?></label>	
										<div class='col-xs-7 col-md-7'>
											<input type="text" name="ic_event_bgcolor" id="ic_event_bgcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="<?php echo $events->backgroundColor ?>" value="<?php echo $events->backgroundColor ?>"> 
										</div>
									</div>
									<!-- Color select-->
									<div class="form-group">	
										<label class="control-label col-md-4 col-xs-4" for="inputTxtColor"><?php echo lang('calendar_modal_colortext'); ?></label>	
										<div class='col-xs-7 col-md-7'>
											<input type="text" name="ic_event_bordercolor" id="ic_event_bordercolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="<?php echo $events->borderColor ?>" value="<?php echo $events->borderColor ?>" />
										</div>
									</div> 													
									<!-- Color select-->
									<div class="form-group">	
										<label class="control-label col-md-4 col-xs-4" for="inputBrdColor"><?php echo lang('calendar_modal_colorborder'); ?></label>	
										<div class='col-xs-7 col-md-7'>
											<input type="text" name="ic_event_textcolor" id="ic_event_textcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="<?php echo $events->textColor ?>" value="<?php echo $events->textColor ?>" />
										</div>
									</div>	 
								</div>	 
								</div>
								<div id="panel3_<?php echo $events->id  ?>" class="tab-pane">    
									<input class="form-control" type="text" name="ic_event_location" id="markers_address" value="<?php echo $events->location ?>" >
									<div id="gmapsCanvas2<?php echo $events->id  ?>" class="map" style="background-color:transparent;" ></div> 
									<div style="border-top: 1px #CCC dashed; margin-top: 5px; padding-top: 3px;"> Lat: <span id="show_lat"><?php echo $events->longitude  ?></span> | Lng: <span id="show_lng"><?php echo $events->latitude  ?></span></div>											
									<script type="text/javascript"> 
									
										gmaps_update(<?php echo $events->latitude  ?>, <?php echo $events->longitude  ?>, 'gmapsCanvas2<?php echo $events->id  ?>', 'markers_address');

									</script>										
									<input type="hidden" name="markers_ulat" id="markers_ulat" value="<?php echo $events->latitude ?>" > 
									<input type="hidden" name="markers_ulng" id="markers_ulng" value="<?php echo $events->longitude ?>" >	
								</div>
								<div id="panel4" class="tab-pane">     
									<div class="form-group"> 
										<label class="control-label col-md-3 col-xs-3" for="inputFile"><?php echo lang('calendar_modal_attachment'); ?></label>	
										<div class='col-xs-9 col-md-9'>
											<a href="<?php echo base_url('assets/attachments').'/'.$events->filename  ?>" class="form-control" title="<?php echo $events->filename  ?>" target="_blank" ><b><?php echo $events->filename  ?></b></a>							
										</div>				
									</div>	 
								</div>								
							</div> 

							<div class="btn-group">
								<input type="submit" name="submitEdit" id="submitEdit" class="btn btn-primary" value="<?php echo lang('save'); ?>" > </input> 
							</div>								
							<div class="btn-group">
								<a href="<?php echo site_url('admin/calendarlist');?>" class="btn btn-default" > <?php echo lang('cancel'); ?></a>
							</div>	  
							
						</form> 
					
						 
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
		
		</div>
		<!-- /.col-md-12 .col-lg-12 -->	  
		</div>
		<!-- /.row --> 
	
		
   </div>
    <!-- /#wrapper --> 
	
	<div class="modal fade" id="del_<?php echo $events->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_delete_calendar'); ?></h4>
				</div>
				
				<form name="form_<?php echo $events->id  ?>" id="form_<?php echo $events->id  ?>" method="post" action="<?php echo site_url('admin/calendarlist/del') . '/';?><?php echo $events->id  ?>" >	

					<div class="modal-body">
						<div class="alert alert-warning">
							<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('admin_modal_delete_calendar'); ?>  
							<b><?php echo $events->title  ?></b>? 
						</div>							
					</div>
					<div class="modal-footer ">
						<button type="submit" name="submitDelete" class="btn btn-danger" ><i class="fa fa-trash"></i> <?php echo lang('yes'); ?></button>
						<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no'); ?></button>
					</div>
				
				</form> 
			</div>
	<!-- /.modal-content --> 
		</div>
	  <!-- /.modal-dialog --> 
	</div>		