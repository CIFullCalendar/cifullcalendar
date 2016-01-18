 
	<div id="page-wrapper">
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-file-text-o fa-fw"></i> <?php echo lang('settings_file_name') ?></h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->			
		
		<div class="row">
			<div class="col-md-12 col-lg-12">
			    <form id="form_settings" name="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/settings/icsfile'); ?>">
								
					<div class="form-group">
						<label><?php echo lang('sync_path_location') ?></label>
						<input class="form-control" type="text" name="sync_path_location" id="sync_path_location" value="<?php echo set_value('sync_path_location', $sync_path_location); ?>"/>
						<p class="help-block"><?php echo form_error('sync_path_location'); ?></p>
					</div> 								
					
					<div class="form-group">
						<label><?php echo lang('sync_allowed_extension') ?></label>
						<input class="form-control" type="text" name="sync_allowed_extension" id="sync_allowed_extension" value="<?php echo set_value('sync_allowed_extension', $sync_allowed_extension); ?>"/>
						<p class="help-block"><?php echo form_error('sync_allowed_extension'); ?></p>
					</div> 

					<div class="form-group">
						<label><?php echo lang('sync_max_size') ?></label>
						<input class="form-control" type="text" name="sync_max_size" id="sync_max_size" value="<?php echo set_value('sync_max_size', $sync_max_size); ?>"/>
						<p class="help-block"><?php echo form_error('sync_max_size'); ?></p>
					</div>  
					
					<div class="btn-group"> 
						<input type="submit" class="btn btn-primary" id="button" name="file_submit" value="<?php echo lang('save') ?>" />
					</div> 						
					<div class="btn-group">
						<input type="submit" class="btn" id="button" name="file_cancel" value="<?php echo lang('cancel') ?>" /> 
					</div>								 
					
				</form>                           
		 
			</div>
			<!-- /.col-md-12 .col-lg-12 -->				
		</div>
		<!-- /.row --> 
    </div>
    <!-- /#wrapper --> 
 	
 