
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li> 
								<a><i class="fa fa-pencil-square-o fa-fw"></i> <?php echo lang('templates_title') ?></a>
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
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
                                </div>							
                                <div class="panel-body">
									<div class="row">
										<div class="col-md-12 col-lg-12"> 

											<div class="btn-group">
												 <a class="btn btn-default btn-sm" href="<?php echo site_url('admin/settings/template'); ?>" role="button"><?php echo lang('templates_nav_notify'); ?></a> 
											</div>	
											<div class="btn-group">
												 <a class="btn btn-default btn-sm" href="<?php echo site_url('admin/settings/template/registration'); ?>" role="button"><?php echo lang('templates_nav_register'); ?></a> 
											</div>				
											<div class="btn-group">
												<a class="btn btn-default btn-sm" href="<?php echo site_url('admin/settings/template/forgot_password'); ?>" role="button"><?php echo lang('templates_nav_forgot_password'); ?></a> 
											</div> 			
											<div class="btn-group">
												<a class="btn btn-default btn-sm" href="<?php echo site_url('admin/settings/template/reset_password'); ?>" role="button"><?php echo lang('templates_nav_reset_password'); ?></a> 
											</div> 
											<div class="btn-group">
												<a class="btn btn-default btn-sm" href="<?php echo site_url('admin/settings/template/change_email'); ?>" role="button"><?php echo lang('templates_nav_change_email'); ?></a> 
											</div> 				
											<div class="btn-group">
												<a class="btn btn-default btn-sm" href="<?php echo site_url('admin/settings/template/reset_email'); ?>" role="button"><?php echo lang('templates_nav_reset_email'); ?></a> 
											</div> 		
												 
											<?php echo form_open_multipart('admin/settings/template/'.$notify_type, array('class' => 'form-horizontal', 'id' => 'form_settings_tpl', 'name' => 'form_settings_tpl', 'role' => 'form')); ?>
											
												<div class="form-group">
													<label class="col-lg-12"><?=lang('templates_name')?></label>
													<div class="col-lg-12">
														<input class="form-control" name="template_title" value="<?php echo set_value('subject',$msg_subject) ?>" />
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-12"><?=lang('templates_content')?></label>
													<div class="col-lg-12">
													<textarea cols="40" rows="10" class="note" id="note" name="template_body" ><?php echo set_value('body',$msg_body) ?></textarea> 
													</div>
												</div> 	
											 
												<div class="btn-group">
													<input type="submit" name="template_submit" id="template_submit" class="btn btn-primary" value="<?php echo lang('save'); ?>" > </input> 
												</div>		
												
												<div class="btn-group">
													<input type="submit" name="template_cancel" id="template_cancel" class="btn btn-default" value="<?php echo lang('cancel'); ?>" > </input>  
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