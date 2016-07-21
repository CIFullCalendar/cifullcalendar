 
	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-calendar fa-fw"></i> <?php echo lang('settings_cal_name') ?> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->			
			 
			<div class="row">
				<div class="col-md-12 col-lg-12">
							
					<?php echo form_open('admin/settings/calendar_settings', array('class' => 'form-horizontal', 'id' => 'form_cal', 'name' => 'form_cal'));	?> 
					
						<div class="form-group">
							<label><?php echo lang('cal_defaultview') ?></label>
							<select class="form-control" name="cal_defaultview" id="cal_defaultview">
								<option value="month" <?php if($defaultview =='month'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_month'); ?></option>
								<option value="basicWeek" <?php if($defaultview =='basicWeek'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_basicweek'); ?></option>
								<option value="basicDay" <?php if($defaultview =='basicDay'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_basicday'); ?></option>
								<option value="agendaWeek" <?php if($defaultview =='agendaWeek'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_agendaweek'); ?></option>
								<option value="agendaDay" <?php if($defaultview =='agendaDay'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_agendaday'); ?></option>
								<option value="list" <?php if($defaultview =='list'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_agendalist'); ?></option>
							</select>
							<p class="help-block"><?php echo form_error('cal_defaultview') ?></p>
						</div>	
						
						<div class="form-group">
							<label><?php echo lang('cal_header_left') ?></label>
							<input class="form-control" type="text" name="cal_header_left" id="cal_header_left" value="<?php echo set_value('cal_header_left', $header_left); ?>"/>
							<p class="help-block"><?php echo form_error('cal_header_left'); ?></p>
						</div> 										
						
						<div class="form-group">
							<label><?php echo lang('cal_header_center') ?></label>
							<input class="form-control" type="text" name="cal_header_center" id="cal_header_center" value="<?php echo set_value('cal_header_center', $header_center); ?>"/>
							<p class="help-block"><?php echo form_error('cal_header_center'); ?></p>
						</div> 										
						
						<div class="form-group">
							<label><?php echo lang('cal_header_right') ?></label>
							<input class="form-control" type="text" name="cal_header_right" id="cal_header_right" value="<?php echo set_value('cal_header_right', $header_right); ?>"/>
							<p class="help-block"><?php echo form_error('cal_header_right'); ?></p>
						</div> 
						
						<div class="form-group">
							<label><?php echo lang('cal_firstday') ?></label>
							<select class="form-control" name="cal_firstday" id="cal_firstday">									
								<option value="0" <?php if($firstday == '0'){ echo "SELECTED";}?> ><?php echo lang('sunday'); ?></option>
								<option value="1" <?php if($firstday == '1'){ echo "SELECTED";}?> ><?php echo lang('monday'); ?></option>
								<option value="2" <?php if($firstday == '2'){ echo "SELECTED";}?> ><?php echo lang('tuesday'); ?></option>
								<option value="3" <?php if($firstday == '3'){ echo "SELECTED";}?> ><?php echo lang('wednesday'); ?></option>
								<option value="4" <?php if($firstday == '4'){ echo "SELECTED";}?> ><?php echo lang('thursday'); ?></option>
								<option value="5" <?php if($firstday == '5'){ echo "SELECTED";}?> ><?php echo lang('friday'); ?></option>
								<option value="6" <?php if($firstday == '6'){ echo "SELECTED";}?> ><?php echo lang('saturday'); ?></option>
							</select>
							<p class="help-block"><?php echo form_error('cal_firstday') ?></p>
						</div>

						<div class="form-group">
							<label><?php echo lang('cal_aspectratio') ?></label>
							<input class="form-control" type="text" name="cal_aspectratio" id="cal_aspectratio" value="<?php echo set_value('cal_aspectratio', $aspectratio); ?>"/>
							<p class="help-block"><?php echo form_error('cal_aspectratio'); ?></p>
						</div> 		
						
						<div class="form-group">
							<label><?php echo lang('cal_businesshours') ?></label>
							<div class="form-group" style="margin:0px 20px">
								<label><?php echo lang('cal_businesshours_opendays') ?></label>
								<input class="form-control" type="text" name="cal_businessdays" id="cal_businessdays" value="<?php echo set_value('cal_businessdays', $businessdays); ?>"/> 
								<label><?php echo lang('cal_businesshours_start') ?></label>
								<input class="form-control" type="time" name="cal_businessstart" id="cal_businessstart" value="<?php echo set_value('cal_businessstart', $businessstart); ?>"/>	 
								<label><?php echo lang('cal_businesshours_end') ?></label>									
								<input class="form-control" type="time" name="cal_businessend" id="cal_businessend" value="<?php echo set_value('cal_businessend', $businessend); ?>"/> 
							</div>	
							<p class="help-block"><?php echo form_error('cal_businesshours') ?></p>
						</div>													
						
						<div class="form-group">
							<label><?php echo lang('cal_hiddendays') ?></label>
							<input class="form-control" type="text" name="cal_hiddendays" id="cal_hiddendays" value="<?php echo set_value('cal_hiddendays', $hiddendays); ?>"/>
							<p class="help-block"><?php echo form_error('cal_hiddendays'); ?></p>
						</div> 													
						
						<div class="form-group">
							<label><?php echo lang('cal_minmaxtime_range') ?></label>
							<div class="form-group" style="margin:0px 20px">
								<label><?php echo lang('cal_mintime') ?></label>
								<input class="form-control" type="text" name="cal_mintime" id="cal_mintime" value="<?php echo set_value('cal_mintime', $mintime); ?>" />
								<p class="help-block"><?php echo form_error('cal_mintime') ?></p>
						 
								<label><?php echo lang('cal_maxtime') ?></label>
								<input class="form-control" type="text" name="cal_maxtime" id="cal_maxtime" value="<?php echo set_value('cal_maxtime', $maxtime); ?>" />
								<p class="help-block"><?php echo form_error('cal_maxtime') ?></p>
							</div>	
						</div>													
						
						<div class="form-group">
							<label><?php echo lang('cal_slotduration') ?></label>
							<input class="form-control" type="text" name="cal_slotduration" id="cal_slotduration" value="<?php echo set_value('cal_slotduration', $slotduration); ?>" />
							<p class="help-block"><?php echo form_error('cal_slotduration') ?></p>
						</div>	

						<div class="form-group">
							<label><?php echo lang('cal_slotlabeling') ?></label>
							<select class="form-control" name="cal_slotlabeling" id="cal_slotlabeling">
								<option value="true" <?php if($slotlabeling =='true'){ echo "SELECTED";}?> ><?php echo lang('cal_slotlabel_groupformat'); ?></option>
								<option value="false" <?php if($slotlabeling =='false'){ echo "SELECTED";}?> ><?php echo lang('cal_slotlabel_listformat'); ?></option>
							</select>
							<p class="help-block"><?php echo form_error('cal_slotlabeling') ?></p>
						</div>											

						<div class="form-group">
							<label><?php echo lang('cal_editable') ?></label>
							<select class="form-control" name="cal_editable" id="cal_editable">
								<option value="true" <?php if($editable =='true'){ echo "SELECTED";}?> ><?php echo lang('yes'); ?></option>
								<option value="false" <?php if($editable =='false'){ echo "SELECTED";}?> ><?php echo lang('no'); ?></option>
							</select>
							<p class="help-block"><?php echo form_error('cal_editable') ?></p>
						</div>								

						<div class="form-group">
							<label><?php echo lang('cal_weeknumbers') ?></label>
							<select class="form-control" name="cal_weeknumbers" id="cal_weeknumbers">
								<option value="true" <?php if($weeknumbers =='true'){ echo "SELECTED";}?> ><?php echo lang('yes'); ?></option>
								<option value="false" <?php if($weeknumbers =='false'){ echo "SELECTED";}?> ><?php echo lang('no'); ?></option>
							</select>
							<p class="help-block"><?php echo form_error('cal_weeknumbers') ?></p>
						</div>										
						
						<div class="form-group">
							<label><?php echo lang('cal_eventlimit') ?></label>
							<select class="form-control" name="cal_eventlimit" id="cal_eventlimit">
								<option value="true" <?php if($eventlimit =='true'){ echo "SELECTED";}?> ><?php echo lang('yes'); ?></option>
								<option value="false" <?php if($eventlimit =='false'){ echo "SELECTED";}?> ><?php echo lang('no'); ?></option>
							</select>
							<p class="help-block"><?php echo form_error('cal_eventlimit') ?></p>
						</div>

						<div class="form-group">
							<label><?php echo lang('cal_alldayslot') ?></label>
							<select class="form-control" name="cal_alldayslot" id="cal_alldayslot">
								<option value="true" <?php if($alldayslot =='true'){ echo "SELECTED";}?> ><?php echo lang('yes'); ?></option>
								<option value="false" <?php if($alldayslot =='false'){ echo "SELECTED";}?> ><?php echo lang('no'); ?></option>
							</select>
							<p class="help-block"><?php echo form_error('cal_alldayslot') ?></p>
						</div>	

						<div class="form-group">
							<label><?php echo lang('cal_isrtl') ?></label>
							<select class="form-control" name="cal_isrtl" id="cal_isrtl">
								<option value="true" <?php if($isrtl =='true'){ echo "SELECTED";}?> ><?php echo lang('yes'); ?></option>
								<option value="false" <?php if($isrtl =='false'){ echo "SELECTED";}?> ><?php echo lang('no'); ?></option>
							</select>
							<p class="help-block"><?php echo form_error('cal_isrtl') ?></p> 
						</div>	 
						
						<div class="btn-group"> 
							<input type="submit" class="btn btn-primary" id="button" name="calendar_submit" value="<?php echo lang('save') ?>" />
						</div> 						
						<div class="btn-group">
							<input type="submit" class="btn" id="button" name="calendar_cancel" value="<?php echo lang('cancel') ?>" /> 
						</div>										
						

					<?php echo form_close(); ?>		
				 
				</div>
			</div>	 

    </div>
    <!-- /#wrapper -->