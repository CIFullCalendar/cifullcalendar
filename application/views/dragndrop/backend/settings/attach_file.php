 
	<div id="page-wrapper">
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-file-archive-o fa-fw"></i> <?php echo lang('settings_attach_name') ?></h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->			
		
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<?php echo form_open('admin/settings/attachments', array('class' => 'form-horizontal', 'id' => 'form_settings', 'name' => 'form_settings')); ?>  				
					<div class="form-group">
						<label><?php echo lang('attach_allowed_extension') ?></label>
						<input class="form-control" type="text" name="attach_allowed_extension" id="attach_allowed_extension" value="<?php echo set_value('attach_allowed_extension', $attach_allowed_extension); ?>"/>
						<p class="help-block"><?php echo form_error('attach_allowed_extension'); ?></p>
					</div> 								
					
					<div class="form-group">
						<label><?php echo lang('attach_max_size') ?></label>
						<input class="form-control" type="text" name="attach_max_size" id="attach_max_size" value="<?php echo set_value('attach_max_size', $attach_max_size); ?>"/>
						<p class="help-block"><?php echo form_error('attach_max_size'); ?></p>
					</div> 
					
					<div class="btn-group"> 
						<input type="submit" class="btn btn-primary" id="button" name="file_submit" value="<?php echo lang('save') ?>" />
					</div> 						
					<div class="btn-group">
						<input type="submit" class="btn" id="button" name="file_cancel" value="<?php echo lang('cancel') ?>" /> 
					</div>	 
				<?php echo form_close(); ?>  
			</div>
			<!-- /.col-md-12 .col-lg-12 -->				
		</div>
		<!-- /.row --> 
    </div>
    <!-- /#wrapper --> 
 	
 