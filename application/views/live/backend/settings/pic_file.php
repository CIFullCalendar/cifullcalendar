 
	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo lang('settings_pic_name') ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->			
			
            <div class="row">
			 
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-image fa-fw"></i> <?php echo lang('profile_picture_title') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						   <form id="form_settings" name="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/settings/picfile'); ?>">
											
								<div class="form-group">
									<label><?php echo lang('profile_max_upload_width') ?></label>
									<input class="form-control" type="text" name="max_upload_width" id="max_upload_width" value="<?php echo set_value('max_upload_width', $max_upload_width); ?>"/>
									<p class="help-block"><?php echo form_error('max_upload_width'); ?></p>
								</div> 								
								
								<div class="form-group">
									<label><?php echo lang('profile_max_upload_height') ?></label>
									<input class="form-control" type="text" name="max_upload_height" id="max_upload_height" value="<?php echo set_value('max_upload_height', $max_upload_height); ?>"/>
									<p class="help-block"><?php echo form_error('max_upload_height'); ?></p>
								</div> 
								
								<div class="form-group">
									<label><?php echo lang('profile_allowed_extensions') ?></label>
									<input class="form-control" type="text" name="allowed_extensions" id="allowed_extensions" value="<?php echo set_value('allowed_extensions', $allowed_extensions); ?>"/>
									<p class="help-block"><?php echo form_error('allowed_extensions'); ?></p>
								</div> 
								
								<div class="form-group">
									<label><?php echo lang('profile_max_upload_filesize') ?></label>
									<input class="form-control" type="text" name="max_upload_filesize" id="max_upload_filesize" value="<?php echo set_value('max_upload_filesize', $max_upload_filesize); ?>"/>
									<p class="help-block"><?php echo form_error('max_upload_filesize'); ?></p>
								</div> 	

								<div class="btn-group"> 
									<input type="submit" class="btn btn-primary" id="button" name="profile_pic_submit" value="<?php echo lang('save') ?>" />
								</div> 						
								<div class="btn-group">
									<input type="submit" class="btn" id="button" name="profile_pic_cancel" value="<?php echo lang('cancel') ?>" /> 
								</div>							
								
							</form>                           
						   
                        </div>
                        <!-- /.panel-body -->
                    </div>
           
                </div>
                <!-- /.col-md-6 .col-lg-6 -->
 
			</div>
			
    </div>
    <!-- /#wrapper -->
	
	 
 