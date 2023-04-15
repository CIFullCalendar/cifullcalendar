
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li> 
								<a><i class="fa fa-file-archive-o fa-fw"></i> <?php echo lang('settings_attach_name') ?></a>
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">  
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings"> 
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