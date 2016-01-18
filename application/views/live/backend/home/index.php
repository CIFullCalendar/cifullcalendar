	
	<div id="page-wrapper">   
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default"> 
							<div class="row">
								<div class="col-md-12 col-lg-12"> 
									<div class="pull-left">  
										<div class="btn-group ">
											<form id="CalendarSettingForm" method="post" action="<?php echo site_url('profile/user/fullcalendar');?>"  >
												<button id="CalendarSettings" class="btn btn-default btn-sm"><i class="fa fa-calendar"></i> </button> 
											</form>
										</div>
										<div class="btn-group ">
											<form id="loadform1" >
												<button id="#loadEvents" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </button> 
											</form>
										</div>  
										
									</div>
									<div class="pull-right"> 
										<div class="btn-group "> 
										 <select class="form-control btn-sm" id="cal_category">
											<option value="" ><?php echo lang('submenu_select_categories'); ?></option>
										 </select> 
										</div>	  
									</div>
								</div>
								<!-- /.col-md-12 .col-lg-12 -->				
							</div>
							<!-- /.row --> 					
                        <div class="panel-body">
					
							<div class="row">
								<div class="col-md-12 col-lg-12"> 
									<div id='loading' class="alert alert-info" style='display:none;'>
										<?php echo lang('calendar_loading_title'); ?> <br />
										<progress></progress>		
									</div> 					
									<div id='calendar' ></div>	 
									<div class="pull-left"><i class="fa fa-globe fa-fw"></i><?php echo $userinfo->cal_timezone; ?></div>
									<div class="pull-right"><div class="hero hero-moment"><i class="fa fa-clock-o fa-fw"></i><span id="digiclock"></span><span id="ampm"></span></div> </div>
								</div>
								<!-- /.col-md-12 .col-lg-12 -->				
							</div>
							<!-- /.row --> 	
						
                       </div>
					   <!-- /.panel-body --> 
						<div class="row">
							<div class="col-md-12 col-lg-12"> 
								<div class=" pull-left">		 
									<div class="btn-group "> 
										<form id="CalendarSettingForm" method="post" action="<?php echo site_url('profile/home/export_all');?>"  >
											<button id="CalendarSettings" class="btn btn-default btn-sm"><i class="fa fa-cloud-download"></i> <?php echo lang('calendar_export'); ?></button> 
										</form>
									</div>  
									<div class="btn-group ">
										<button class="btn btn-success btn-sm" data-title="upload" data-toggle="modal" data-target="#upload" data-placement="top" ><i class="fa fa-cloud-upload"></i> <?php echo lang('calendar_import'); ?></button>
									</div>  					 
								</div> 
								
								<div class=" pull-right">
									 <div class="btn-group "> 
										<select class="form-control btn-sm" id="cal_eventsources">
											<option ><?php echo lang('submenu_select_sources'); ?></option>
										</select> 
									</div>
								</div>  
							</div>
							<!-- /.col-md-12 .col-lg-12 -->				
						</div>
						<!-- /.row --> 
					</div> 
			
				</div>
				<!-- /.col-md-12, .col-lg-12 -->
            
			</div>
			<!-- /.row -->
	
    </div>
    <!-- /#wrapper -->
			
 			<div id="createEventModal" class='modal fade' tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h3 id="myModalLabel1"><i class="fa fa-calendar"></i> <?php echo lang('calendar_modal_create_title'); ?> </h3>
					    <div class="control-group"> 
							<div class="controls controls-row" id="when" style="margin-top:5px;">
							</div>						
						</div>
					</div>
					 <form class="form-horizontal" id="form1" method="post" enctype="multipart/form-data"  >	
						<div class="modal-body">	
													
								 <ul class="nav nav-tabs">
									<li class="active"><a href="#pane1" data-toggle="tab"><i class="fa fa-info-circle"></i> <?php echo lang('calendar_modal_tabtitle'); ?></a></li>
									<li><a href="#pane2" data-toggle="tab"><i class="fa fa-paint-brush"></i> <?php echo lang('calendar_modal_tabtitle2'); ?></a></li> 
								 	<li><a href="#pane3" id="show" data-toggle="tab"><i class="fa fa-refresh"></i> <?php echo lang('calendar_modal_tabtitle3'); ?></a></li>
									<li><a href="#pane4" id="show" data-toggle="tab"><i class="fa fa-location-arrow"></i> <?php echo lang('calendar_modal_tabtitle4'); ?></a></li>
									<li><a href="#pane5" data-toggle="tab"><i class="fa fa-file"></i> <?php echo lang('calendar_modal_tabtitle5'); ?></a></li>
								 
								 </ul>
								 <div class="tab-content">
									<div id="pane1" class="tab-pane active">								 
									
											<!-- Text input-->
											<div class="form-group"> 
												<label class="control-label col-md-4 col-xs-4" for="inputEvent"><?php echo lang('calendar_modal_eventname'); ?></label> 
												<div class="col-md-7 col-xs-7">
													<input class="form-control" type="text" name="ic_event_title" id="ic_event_title" placeholder="<?php echo lang('calendar_modal_eventname'); ?>" required/>
												</div>
											</div>										

											<!-- Textarea input-->
											<div class="form-group">		 
												<label class="control-label col-md-4 col-xs-4" for="inputDescr"><?php echo lang('calendar_modal_description'); ?></label>
												<div class="col-md-7 col-xs-7">
													<textarea class="form-control" name="ic_event_desc" id="ic_event_desc" placeholder="<?php echo lang('calendar_modal_description'); ?>" ></textarea>
												</div>
											</div>
									  
											<!-- Text input-->
											<div class="form-group">	
												<label class="control-label col-md-4 col-xs-4" for="inputBegin"><?php echo lang('calendar_modal_eventbegin'); ?></label>
												<div class="col-md-7 col-xs-7">
												    <div class="input-group date" id="createdtp1"> 
														<input class="form-control" type="text" name="ic_event_starttime" id="ic_event_starttime" placeholder="<?php echo lang('calendar_modal_eventbegin'); ?>" required/>
														<span class="input-group-addon">
															<span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div> 
												</div>
											</div>	
											
											<!-- Text input-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputEnd"><?php echo lang('calendar_modal_eventend'); ?></label>
												<div class="col-md-7 col-xs-7">
													<div class="input-group date" id="createdtp2"> 
														<input class="form-control" type="text" name="ic_event_endtime" id="ic_event_endtime" placeholder="<?php echo lang('calendar_modal_eventend'); ?>" required/>
														<span class="input-group-addon">
															<span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div> 	
												</div>
											</div>		
											
											<!-- radio input-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputAllDay"><?php echo lang('calendar_modal_eventallday'); ?></label>
												<div class="col-md-7 col-xs-7">												
													 <input type="radio" name="ic_event_allday" id="ic_event_alldayT" value="true" checked="checked"><?php echo lang('yes'); ?>
													 <input type="radio" name="ic_event_allday" id="ic_event_alldayF" value="false"><?php echo lang('no'); ?>
												</div>
											</div>
											
											<!-- Text input-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputURL"><?php echo lang('calendar_modal_eventurl'); ?></label>
												<div class="col-md-7 col-xs-7">
													<input class="form-control" type="text" name="ic_event_urllink" id="ic_event_urllink" value="" placeholder="http://" />
												</div>												
											</div>

											<!-- Option select-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputAllDay"><?php echo lang('calendar_modal_eventshare'); ?></label>
												<div class="col-md-7 col-xs-7">	
													<select class="form-control" name="ic_event_shareit" id="ic_event_shareit" >
													  <option id="ic_event_shareitT" value="1" selected><?php echo lang('calendar_modal_eventprivate'); ?></option>
													  <option id="ic_event_shareitF" value="0" ><?php echo lang('calendar_modal_eventpublic'); ?></option>													
													</select>
												</div>											
											</div>	
																					
									</div>
									<div id="pane2" class="tab-pane">
									
										<!-- Option select-->
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputCategory"><?php echo lang('calendar_modal_eventcategory'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<select class="form-control" id="marker_category" name="marker_category">													
												</select>
											</div> 
										</div>	
										<!-- Option select-->
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputRendering"><?php echo lang('calendar_modal_eventrendering'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<select class="form-control" name="ic_event_rendering" id="ic_event_rendering" >
												  <option id="ic_event_renderingF" value="" selected><?php echo lang('calendar_modal_eventfgrender'); ?></option>
												  <option id="ic_event_renderingB" value="background" ><?php echo lang('calendar_modal_eventbgrender'); ?></option> 
												</select>
											</div>											
										</div> 
										<!-- Option select-->
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputOverlap"><?php echo lang('calendar_modal_eventoverlap'); ?></label>
											<div class="col-md-7 col-xs-7">	
												<select class="form-control" name="ic_event_eventoverlap" id="ic_event_eventoverlap" >
												  <option id="ic_event_eventoverlapT" value="true" ><?php echo lang('yes'); ?></option>
												  <option id="ic_event_eventoverlapF" value="false" selected><?php echo lang('no'); ?></option> 
												</select>
											</div>											
										</div>										
										<!-- Color select-->
										<div class="form-group">	
											<label class="control-label col-md-4 col-xs-4" for="inputBgColor"><?php echo lang('calendar_modal_colorbackground'); ?></label>	
											<div class='col-xs-7 col-md-7'> 
												 <input type="text" name="ic_event_bgcolor" id="ic_event_bgcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#05b0dc" value="#05b0dc">
											</div>
										</div>
										<!-- Color select-->
										<div class="form-group">	
											<label class="control-label col-md-4 col-xs-4" for="inputTxtColor"><?php echo lang('calendar_modal_colortext'); ?></label>	
											<div class='col-xs-7 col-md-7'>
												<input type="text" name="ic_event_bordercolor" id="ic_event_bordercolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="#FFFFFF"> 
											</div>
										</div> 													
										<!-- Color select-->
										<div class="form-group">	
											<label class="control-label col-md-4 col-xs-4" for="inputBrdColor"><?php echo lang('calendar_modal_colorborder'); ?></label>	
											<div class='col-xs-7 col-md-7'>
												<input type="text" name="ic_event_textcolor" id="ic_event_textcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="#FFFFFF">
											</div>
										</div> 		 
												
									</div>
									<div id="pane3" class="tab-pane"> 
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputRecurring"><?php echo lang('calendar_modal_eventrecurring'); ?></label> 
											<div class="col-md-7 col-xs-7 ">	 
												<select class="form-control" name="ic_event_recurring" id="ic_event_recurring" size="7">
												  <option id="ic_event_recurringnone" value="0" selected><?php echo lang('calendar_modal_eventnonerecurring'); ?></option>
												  <option id="ic_event_recurringdaily" value="1" ><?php echo lang('calendar_modal_eventdaily'); ?></option>
												  <option id="ic_event_recurringweekly" value="7" ><?php echo lang('calendar_modal_eventweekly'); ?></option>				
												  <option id="ic_event_recurring2weeks" value="14" ><?php echo lang('calendar_modal_event2weeks'); ?></option>				
												  <option id="ic_event_recurringmonthly" value="30" ><?php echo lang('calendar_modal_eventmonthly'); ?></option>			
												  <option id="ic_event_recurringyearly" value="365" ><?php echo lang('calendar_modal_eventyearly'); ?></option>					
												</select>
											</div>
										</div> 
										<div class="form-group"> 
											<label class="control-label col-md-4 col-xs-4" for="inputEndRecurring"  style="padding: 6px 0px;"><?php echo lang('calendar_modal_eventendrecurring'); ?></label>
											<div class="col-md-7 col-xs-7 ">	
												<div class="input-group date4" id="createdtp3"> 
													<input class="form-control" type="text" name="ic_event_endrecurring" id="ic_event_endrecurring" value="" placeholder="<?php echo lang('calendar_modal_eventend'); ?>" />  
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
													</span>
												</div>  
											</div>	 									
										</div>	 
									</div>
									<div id="pane4" class="tab-pane">     
										<input class="form-control" type="text" name="ic_event_location" id="ic_event_clocation" > 
										<input type="radio" name="type" id="changetype-all" style="display:none;" checked="checked">
										<label for="changetype-all" style="display:none;"><?php echo lang('all'); ?></label>
										<input type="radio" name="type" id="changetype-establishment" style="display:none;">
										<label for="changetype-establishment" style="display:none;"><?php echo lang('business'); ?></label>
										<input type="radio" name="type" id="changetype-geocode" style="display:none;">
										<label for="changetype-geocode" style="display:none;"><?php echo lang('geocodes'); ?></label>  
										<div id="gmapsCanvas" class="map" style="background-color:transparent;" ></div> 
										<div style="border-top: 1px #CCC dashed; margin-top: 5px; padding-top: 3px;"> Lat: <span id="show_clat">none</span> | Lng: <span id="show_clng">none</span></div>		
										<input type="hidden" name="markers_clat" id="markers_clat"> 
										<input type="hidden" name="markers_clng" id="markers_clng" >	
									</div> 
									<div id="pane5" class="tab-pane">    
										<div class="form-group"> 
										  	<label class="control-label col-md-3 col-xs-3" for="inputFile"><?php echo lang('calendar_modal_attachment'); ?></label>	
										  	<div class='col-xs-9 col-md-9'>
											 <input class="form-control" type="file" name="userfile1" id="userfile1" />
											</div>  	
										<?php $msg ?>		
										</div>   									 	
									</div>						
								</div>
					
							</div>
							<div class="modal-footer"> 
								<div class="btn-group dropup ">
								 <button class="btn " data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> <?php echo lang('cancel'); ?></button> 
								</div>	
								<div class="btn-group dropup "> 
									<button type="submit" class="btn btn-primary" name="addButton" id="addButton" ><i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?></button>		
								</div> 
							</div>
						</form>
					</div>
				  </div>
				</div>		
				
				<div id="updateEventModal" class='modal fade' tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
							<h3 id="myModalLabel2"><i class="fa fa-calendar"></i> <span id="event_title"></span></h3>
							<div class="control-group"> 
								<div class="controls controls-row" role="alert" id="when"  >
								</div>	 
							</div>						
							
						</div>
						<form class="form-horizontal" id="form2" action="<?php site_url('profile/home/attach_file'); ?>" method="post" enctype="multipart/form-data" >
						<div class="modal-body">	 
					
								 <ul class="nav nav-tabs">
									<li class="active"><a href="#panel1" data-toggle="tab"><i class="fa fa-info-circle"></i> <?php echo lang('calendar_modal_tabtitle'); ?></a></li>
									<li><a href="#panel2" data-toggle="tab"><i class="fa fa-paint-brush"></i> <?php echo lang('calendar_modal_tabtitle2'); ?></a></li>
									<li><a href="#panel3" id="show" data-toggle="tab"><i class="fa fa-refresh"></i> <?php echo lang('calendar_modal_tabtitle3'); ?></a></li>
									<li><a href="#panel4" id="show" data-toggle="tab"><i class="fa fa-location-arrow"></i> <?php echo lang('calendar_modal_tabtitle4'); ?></a></li>
									<li><a href="#panel5" data-toggle="tab"><i class="fa fa-file"></i> <?php echo lang('calendar_modal_tabtitle5'); ?></a></li>
								 </ul>
								 <div class="tab-content">
									<div id="panel1" class="tab-pane active">
									<fieldset> 
							 
										<input type="hidden" name="apptID" id="apptID" > 
									
											<!-- text input-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputEvent"><?php echo lang('calendar_modal_eventname'); ?></label>
												<div class="col-md-7 col-xs-7">	
													<input class="form-control" type="text" name="ic_event_title" id="ic_event_title" placeholder="<?php echo lang('calendar_modal_eventname'); ?>" />
												</div>
											</div>
											
											<!-- textarea-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputDescr"><?php echo lang('calendar_modal_description'); ?></label>
												<div class="col-md-7 col-xs-7">	
													<textarea class="form-control" name="ic_event_desc" id="ic_event_desc" placeholder="<?php echo lang('calendar_modal_description'); ?>" > </textarea>
												</div>
											</div>
											
											<!-- text input-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputBegin"><?php echo lang('calendar_modal_eventbegin'); ?></label>
												<div class="col-md-7 col-xs-7">	 
													<div class="input-group date3" id="updatedtp1"> 
														<input class="form-control" type="text" name="ic_event_starttime" id="ic_event_starttime" placeholder="<?php echo lang('calendar_modal_eventbegin'); ?>" />
														<span class="input-group-addon">
															<span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div> 													
												</div>
											</div>		

											<!-- text input-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputEnd"><?php echo lang('calendar_modal_eventend'); ?></label>
												<div class="col-md-7 col-xs-7">	 
													<div class="input-group date4" id="updatedtp2"> 
														<input class="form-control" type="text" name="ic_event_endtime" id="ic_event_endtime" placeholder="<?php echo lang('calendar_modal_eventend'); ?>" />
														<span class="input-group-addon">
															<span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div> 		 
												</div>
											</div>		
											
											<!-- radio input-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputAllDay"><?php echo lang('calendar_modal_eventallday'); ?></label>
												<div class="col-md-7 col-xs-7">	
													 <input type="radio" name="ic_event_allday" id="ic_event_alldayT" value="true" ><?php echo lang('yes'); ?>
													 <input type="radio" name="ic_event_allday" id="ic_event_alldayF" value="false"><?php echo lang('no'); ?>	
												</div>												
											</div>	
											
											<!-- text input-->
											<div class="form-group">
												<label class="control-label col-md-4 col-xs-4" for="inputURL"><?php echo lang('calendar_modal_eventurl'); ?></label>
												<div class="col-md-7 col-xs-7">	
													<input class="form-control" type="text" name="ic_event_urllink" id="ic_event_urllink" placeholder="http://" />
												</div>
											</div>

											<!-- Option select -->
											<div class="form-group">	
												<label class="control-label col-md-4 col-xs-4" for="inputShare"><?php echo lang('calendar_modal_eventshare'); ?></label>
												<div class="col-md-7 col-xs-7">											
													<select class="form-control" name="ic_event_shareit" id="ic_event_shareit">													
													  <option id="ic_event_shareitT" value="1"><?php echo lang('calendar_modal_eventprivate'); ?></option>
													  <option id="ic_event_shareitF" value="0"><?php echo lang('calendar_modal_eventpublic'); ?></option>				
													</select> 	
												</div>					
											</div>		
											
														
										</fieldset>								
									</div>
									<div id="panel2" class="tab-pane">
										<div id="content_wrapper">
											<div id="event_generation_wrapper">	
												<div class="form-group">
													<label class="control-label col-md-4 col-xs-4" for="inputCategory"><?php echo lang('calendar_modal_eventcategory'); ?></label>
													<div class="col-md-7 col-xs-7">	
														<select class="form-control" id="marker_category2" name="marker_category2">													
														</select>
													</div>	
												</div>		
												<!-- Option select-->
												<div class="form-group">
													<label class="control-label col-md-4 col-xs-4" for="inputRendering"><?php echo lang('calendar_modal_eventrendering'); ?></label>
													<div class="col-md-7 col-xs-7">	
														<select class="form-control" name="ic_event_rendering" id="ic_event_rendering" >
														  <option id="ic_event_renderingF" value="" ><?php echo lang('calendar_modal_eventfgrender'); ?></option>
														  <option id="ic_event_renderingB" value="background" ><?php echo lang('calendar_modal_eventbgrender'); ?></option>													
														</select>
													</div>											
												</div>	 
												<!-- Option select-->
												<div class="form-group">
													<label class="control-label col-md-4 col-xs-4" for="inputOverlap"><?php echo lang('calendar_modal_eventoverlap'); ?></label>
													<div class="col-md-7 col-xs-7">	
														<select class="form-control" name="ic_event_eventoverlap" id="ic_event_eventoverlap" >
														  <option id="ic_event_eventoverlapT" value="true" ><?php echo lang('yes'); ?></option>
														  <option id="ic_event_eventoverlapF" value="false" ><?php echo lang('no'); ?></option> 
														</select>
													</div>											
												</div>	 
												<!-- Color select-->
												<div class="form-group">	
													<label class="control-label col-md-4 col-xs-4" for="inputBgColor"><?php echo lang('calendar_modal_colorbackground'); ?></label>	
													<div class='col-xs-7 col-md-7'> 
														<input type="text" name="ic_event_bgcolor" id="ic_event_bgcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#05b0dc" value="#05b0dc">
													</div>
												</div>
												<!-- Color select-->
												<div class="form-group">	
													<label class="control-label col-md-4 col-xs-4" for="inputTxtColor"><?php echo lang('calendar_modal_colortext'); ?></label>	
													<div class='col-xs-7 col-md-7'>							
														<input type="text" name="ic_event_bordercolor" id="ic_event_bordercolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="#FFFFFF">	
													</div>
												</div> 													
												<!-- Color select-->
												<div class="form-group">	
													<label class="control-label col-md-4 col-xs-4" for="inputTxtColor"><?php echo lang('calendar_modal_colorborder'); ?></label>	
													<div class='col-xs-7 col-md-7'> 
														<input type="text" name="ic_event_textcolor" id="ic_event_textcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="#FFFFFF"> 
													</div>
												</div> 													
																									
											</div>	 
										</div> 
									</div>
									<div id="panel3" class="tab-pane">  
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-4" for="inputRecurring"><?php echo lang('calendar_modal_eventrecurring'); ?></label>
											<div class='col-xs-7 col-md-7'> 	 
												<select class="form-control" name="ic_event_recurring" id="ic_event_recurring" size="7">
												  <option id="ic_event_recurringnone" value="0" ><?php echo lang('calendar_modal_eventnonerecurring'); ?></option>
												  <option id="ic_event_recurringdaily" value="1" ><?php echo lang('calendar_modal_eventdaily'); ?></option>
												  <option id="ic_event_recurringweekly" value="7" ><?php echo lang('calendar_modal_eventweekly'); ?></option>	
												  <option id="ic_event_recurring2weeks" value="14" ><?php echo lang('calendar_modal_event2weeks'); ?></option>															  
												  <option id="ic_event_recurringmonthly" value="30" ><?php echo lang('calendar_modal_eventmonthly'); ?></option>													
												  <option id="ic_event_recurringyearly" value="365" ><?php echo lang('calendar_modal_eventyearly'); ?></option>													
												</select>
											</div>	 										 											
										</div> 	
										<div class="form-group"> 
											<label class="control-label col-md-4 col-xs-4" for="inputEndRecurring"  style="padding: 6px 0px;"><?php echo lang('calendar_modal_eventendrecurring'); ?></label> 
											<div class="col-md-7 col-xs-7">	 
												<div class="input-group date4" id="updatedtp3"> 
													<input class="form-control" type="text" name="ic_event_endrecurring" id="ic_event_endrecurring" value="" placeholder="<?php echo lang('calendar_modal_eventend'); ?>" />  
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
													</span>
												</div>  
											</div>  
										</div> 
									</div>
									<div id="panel4" class="tab-pane"> 				
										<input class="form-control" type="text" name="ic_event_location" id="ic_event_ulocation" >
										<div id="gmapsCanvas2" class="map" style="background-color:transparent;" ></div>  
										<div style="border-top: 1px #CCC dashed; margin-top: 5px; padding-top: 3px;"> Lat: <span id="show-lat">none</span> | Lng: <span id="show-lng">none</span></div>		
										<input type="hidden" name="markers_ulat" id="markers_ulat"> 
										<input type="hidden" name="markers_ulng" id="markers_ulng" >	
									</div>
									<div id="panel5" class="tab-pane">     
										<div class="form-group"> 
										  	<label class="control-label col-md-3 col-xs-3" for="inputFile"><?php echo lang('calendar_modal_attachment'); ?></label>	
										  	<div class='col-xs-9 col-md-9'>
											 <input class="form-control" type="file" name="userfile2" id="userfile2" />
											</div>  								
										</div>  
										<div class="form-group">  
											<label class="control-label col-md-3 col-xs-3" for="inputFileName"></label>	
										  	<div class='col-xs-9 col-md-9'>
												<div id='filename' ></div>  								
											</div>
											<?php $msg ?>				
										</div>	 
									</div>
						
							</div>
							<div class="modal-footer">	
							 
								<button class="btn btn-danger pull-left" type="submit" name="delButton" id="delButton" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button>	
								
								<div class="btn-group dropup ">
								 <button class="btn " id="btn_cancel" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> <?php echo lang('cancel'); ?></button> 
								</div>	
								<div class="btn-group dropup ">
									<button class="btn btn-success pull-left" type="submit" name="updateButton" id="updateButton" ><i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?></button>	
									<button type="button" id="btn_exports" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
									  <span class="caret"></span>
									  <span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right" role="menu">
									  <li><div class="btn" id="gexport"></div></li> 
									  <li><div class="btn" id="yexport"></div></li> 
									  <li><div class="btn" id="lexport"></div></li> 
									  <li><div class="btn" id="Iexport"></div></li> 
									</ul>
								</div> 						
							
							</div>
						</form> 
						</div>				
						</div>				
					</div>				
			
				</div>				
		
		
			<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="upload" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"><?php echo lang('calendar_modal_upload_eventsource'); ?></h4>
					</div>
					 <form id="upload_file" method="post" enctype="multipart/form-data"  >	 
						<div class="modal-body">   
							<h4><?php echo lang('calendar_modal_upload_event_message'); ?></h4> 
							<div class="form-inline">
							  <div class="form-group">  
								 <input type="file" name="userfile" id="userfile" />
							  </div> 
							</div> 
						</div>
						<div class="modal-footer ">
							<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
							<button type="submit" name="submit" id="uploadButton" class="btn btn-success" ><i class="fa fa-cloud-upload"></i> <?php echo lang('calendar_modal_upload_save'); ?></button> 
						</div> 
					</form> 
				</div>
				<!-- /.modal-content --> 
			  </div>
			  <!-- /.modal-dialog --> 
			</div>				
 
			<div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="change" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title custom_align" id="Heading"><?php echo lang('profile_change_password') ?></h4>
						</div>
						
						<form name="form_pass<?php echo $userinfo->id;  ?>" id="form" method="post" action="<?php echo site_url('profile/user/change_password') .'/';?>" >	

							<div class="modal-body">
								<input name="user_id" id="user_id" value="<?php echo $userinfo->id; ?>" type="hidden" >	
								<div class="alert alert-warning">
									<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('profile_change_warning') ?>
										<?php if(empty($userinfo->first_name) && empty($userinfo->last_name)) : ?>
											<b><?php echo $userinfo->username  ?></b>
										<?php else : ?>
											<b><?php echo $userinfo->first_name  ?> <?php echo $userinfo->last_name  ?></b>
										<?php endif ?> 
									
									<?php echo lang('password') ?>
									
								</div>								 
								<div class="form-group"> 
									<div class="input-group col-md-12">
										<input type="password" name="old_password" id="old_password" class="form-control" placeholder="<?php echo lang('profile_change_old_password') ?>"  />
										 <?php echo form_error('old_password') ?>
									</div>
								</div>								
								<div class="form-group"> 
									<div class="input-group col-md-12">
										<input type="password" name="new_password" id="new_password" class="form-control" placeholder="<?php echo lang('profile_change_new_password') ?>"  />
										 <?php echo form_error('new_password') ?>
									</div>
								</div>									
								<div class="form-group"> 
									<div class="input-group col-md-12">
										<input type="password" name="new_password_confirm" id="new_password_confirm" class="form-control" placeholder="<?php echo lang('profile_change_new_password_confirm') ?>"  />
										 <?php echo form_error('profile_change_new_password_confirm') ?>
									</div>
								</div>
								
							</div>									
							<div class="modal-footer ">
								<button type="submit" name="submitChange" class="btn btn-success" ><i class="fa fa-key"></i> <?php echo lang('yes') ?></button>
								<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no') ?></button>
							</div>
						
						</form> 
					</div>
					<!-- /.modal-content --> 
				</div>
			  <!-- /.modal-dialog --> 
			</div>		