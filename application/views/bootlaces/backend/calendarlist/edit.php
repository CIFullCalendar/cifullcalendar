
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a><i class="fa fa-calendar" ></i> <?php echo $events->title  ?> </a> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">   
									<button class="btn btn-danger btn-sm" data-title="Delete" data-toggle="modal" data-target="#del_<?php echo $events->id  ?>" data-placement="top" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button> 
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="calendarlist"> 
								<div class="panel-title">
									 <?php if(!empty($message)) : ?> 
									 <div class="alert-message alert-message-info">
										<h4> </h4>
										<p> <?php echo $message ?> </p>
									</div>
									<?php endif ?> 
                                </div>							
                                <div class="panel-body">
									<div class="row">
										<div class="col-md-12 col-lg-12">  
										
											<?php echo form_open_multipart('admin/calendarlist/edit/'.$events->eid, array('class' => 'form-horizontal', 'id' => 'list'.$events->eid)); ?>   
													 
												<ul class="nav nav-tabs">
													<li class="active"><a href="#panel1_<?php echo $events->id  ?>" data-toggle="tab"><i class="fa fa-info-circle"></i> <?php echo lang('calendar_modal_tabtitle'); ?></a></li>
													<li><a href="#panel2_<?php echo $events->id  ?>" data-toggle="tab"><i class="fa fa-paint-brush"></i> <?php echo lang('calendar_modal_tabtitle2'); ?></a></li>
													<li><a href="#panel3_<?php echo $events->id  ?>" id="show" data-toggle="tab"><i class="fa fa-location-arrow"></i> <?php echo lang('calendar_modal_tabtitle4'); ?></a></li>
													<li><a href="#panel4" data-toggle="tab"><i class="fa fa-file"></i> <?php echo lang('calendar_modal_tabtitle5'); ?></a></li>
												</ul>
												<div class="tab-content">
													<div id="panel1_<?php echo $events->id  ?>" class="tab-pane active"> 
																					
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
																	<?php echo form_error('ic_event_title') ?>	
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4 col-xs-4" for="inputDescr"><?php echo lang('calendar_modal_description'); ?></label>
																<div class="col-md-7 col-xs-7">	
																	<textarea class="form-control" name="ic_event_desc" id="ic_event_desc" placeholder="Event Description" ><?php echo $events->description ?></textarea>
																	<?php echo form_error('ic_event_desc') ?>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4 col-xs-4" for="inputBegin"><?php echo lang('calendar_modal_eventbegin'); ?></label>
																<div class="col-md-7 col-xs-7">	 
																	<div class="input-group date3" id="updatedtp1"> 
																		<input class="form-control" type="text" name="ic_event_starttime" id="ic_event_starttime" value="<?php echo set_value('start',$events->start) ?>" placeholder="<?php echo lang('calendar_modal_eventbegin'); ?>" />
																		<span class="input-group-addon">
																			<span class="glyphicon glyphicon-calendar"></span>
																		</span>
																	</div> 
																	<?php echo form_error('ic_event_starttime') ?>
																</div>
															<script type="text/javascript">
																$(function () {
																	$('#updatedtp1').datetimepicker({
																		timeZone: "<?php echo $timezone ?>", 
																		format: "YYYY-MM-DD HH:mm:ss",
																		toolbarPlacement: 'top',							
																		widgetPositioning: {horizontal: 'auto', vertical: 'top'}
																	});  
																});
															</script>	
															</div>								
															<div class="form-group">
																<label class="control-label col-md-4 col-xs-4" for="inputEnd"><?php echo lang('calendar_modal_eventend'); ?></label>
																<div class="col-md-7 col-xs-7">	 
																	<div class="input-group date4" id="updatedtp2"> 
																		<input class="form-control" type="text" name="ic_event_endtime" id="ic_event_endtime" value="<?php echo set_value('end',$events->end) ?>"  placeholder="<?php echo lang('calendar_modal_eventend'); ?>" />
																		<span class="input-group-addon">
																			<span class="glyphicon glyphicon-calendar"></span>
																		</span>
																	</div> 
																	<?php echo form_error('ic_event_endtime') ?>
																</div>
															<script type="text/javascript">
																$(function () {
																	$('#updatedtp2').datetimepicker({
																		timeZone: "<?php echo $timezone ?>", 
																		format: "YYYY-MM-DD HH:mm:ss",
																		toolbarPlacement: 'top',							
																		widgetPositioning: {horizontal: 'auto', vertical: 'top'}
																	});  
																});
															</script>	
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
																<label class="control-label col-md-4 col-xs-4" for="inputURL"><?php echo lang('calendar_modal_eventurl'); ?></label>
																<div class="col-md-7 col-xs-7">	
																	<input class="form-control" type="text" name="ic_event_urllink" id="ic_event_urllink" value="<?php echo $events->url ?>" placeholder="http://" />
																</div>
															</div>

															<div class="form-group">	
																<label class="control-label col-md-4 col-xs-4" for="inputShareit"><?php echo lang('calendar_modal_eventshare'); ?></label>
																<div class="col-md-7 col-xs-7">	
																	<select class="form-control" name="ic_event_shareit" id="ic_event_shareit">	 
																	   <?php $selected = null; $selected2 = null; if ($events->gid == 0) {$selected = 'selected';}else if ($events->gid == -1) {$selected2 = 'selected';} ?>
																	   <option id="ic_event_ahareit" value="0" <?php echo $selected;?>><?php echo lang('calendar_modal_eventprivate'); ?></option>
																	  <option id="ic_event_ahareit" value="-1" <?php echo $selected2;?>><?php echo lang('calendar_modal_eventpublic'); ?></option>	  
																	<?php foreach ($groups as $group):?> 
																	  <?php $selected3 = null; if ($group['id'] == $events->gid) {$selected3 = 'selected';} ?>
																	  <option id="ic_event_ahareit" value="<?php echo $group['id'];?>" <?php echo $selected3;?>><?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></option> 
																	<?php endforeach ?> 	  
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
													</div>
													<div id="panel2_<?php echo $events->id  ?>" class="tab-pane">
													 

														<?php foreach ($allcategories as $events2): ?>	
															<?php if(($events->category) == ($events2['category_id'])):  ?>  
																<div class="form-group">
																	<label class="control-label col-md-4 col-xs-4" for="inputCategory"><?php echo lang('calendar_modal_eventcategory'); ?></label>
																	<div class="col-md-7 col-xs-7">	 													
																		<b class="form-control" ><?php echo $events2['category_name']; ?></b>
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
													<div id="panel3_<?php echo $events->id  ?>" class="tab-pane">    
														<input class="form-control" type="text" name="ic_event_location" id="markers_address" value="<?php echo $events->location ?>" >
														
														<div id="gmapsCanvas2<?php echo $events->id  ?>" class="map" style="background-color:transparent;" ></div>  											
														<script type="text/javascript"> 
														
															gmaps_update(<?php echo $events->latitude  ?>, <?php echo $events->longitude  ?>, 'gmapsCanvas2<?php echo $events->id  ?>', 'markers_address');

														</script>										
											
														<div class="form-group"> 
															<label class="control-label col-md-2 col-lg-1" for="inputLat"><?php echo lang('lat'); ?></label>
															<div class="col-md-5 col-lg-5">	  
																<span class="form-control" id="show_lat"><?php echo $events->latitude ?></span>
															</div> 		
															<label class="control-label col-md-2 col-lg-1" for="inputLng"><?php echo lang('lng'); ?></label>
															<div class="col-md-5 col-lg-5">	  
																 <span class="form-control" id="show_lng"><?php echo $events->longitude ?></span>
															</div> 
														</div>
																
														<input type="hidden" name="markers_ulat" id="markers_lat" value="<?php echo $events->latitude ?>" > 
														<input type="hidden" name="markers_ulng" id="markers_lng" value="<?php echo $events->longitude ?>" >	
													</div>
													<div id="panel4" class="tab-pane">     
														<div class="form-group"> 
															<label class="control-label col-md-2 col-xs-2" for="inputFile"><?php echo lang('calendar_modal_attachment'); ?></label>	
															<div class='col-xs-9 col-md-9'>
																<input class="form-control" type="file" name="userfile1" id="userfile1" />
																<a href="<?php echo base_url('assets/attachments').'/'.$events->filename  ?>" title="<?php echo $events->filename  ?>" target="_blank" ><b><?php echo $events->filename  ?></b></a>							
															</div>				
														</div>	 
													</div>								
												</div> 

												<div class="btn-group">
													<input type="submit" name="submitEdit" id="submitEdit" class="btn btn-primary" value="<?php echo lang('save'); ?>" >
												</div>								
												<div class="btn-group">
													<a href="<?php echo site_url('admin/calendarlist');?>" class="btn btn-default" > <?php echo lang('cancel'); ?></a>
												</div>	  
												<div class="btn-group pull-right">
													<b><?php echo lang('pubdate'); ?>:</b>
													<time datetime="<?php echo $events->pubDate; ?>"><?php echo $pubDate; ?></time> 
												</div>

											<?php echo form_close(); ?> 
											
										</div>
										<!-- /.col-md-12 .col-lg-12 -->				
									</div>
									<!-- /.row -->
                                </div>
                            </div>
                        </div>
						<!-- /.col-md-12 -->
                    </div>
					<!-- /.row -->
                </div>
				<!-- /.page-content -->
		</div> 
		<!-- /.page-content-wrapper --> 
	</div>
	<!-- /.page-container --> 	
 
	
	<div class="modal fade" id="del_<?php echo $events->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_delete_calendar'); ?></h4>
				</div>
				 
				<?php echo form_open('admin/calendarlist/del/'.$events->id, array('id' => 'form_del'.$events->id, 'name' => 'form_del'.$events->id )); ?> 
				
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
					
				<?php echo form_close(); ?>  
			</div>
			<!-- /.modal-content --> 
		</div>
	  <!-- /.modal-dialog --> 
	</div>		