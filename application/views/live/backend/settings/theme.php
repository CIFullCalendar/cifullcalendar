 
	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo lang('settings_theme_name') ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->			
			
            <div class="row">
				
	            <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-paint-brush fa-fw"></i> <?php echo lang('settings_theme_name') ?> 
                        </div>
						
                        <!-- /.panel-heading -->
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-lg-12">
											
									<form id="form_theme" name="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/settings/theme'); ?>">
								 
										<!-- Form theme-->
										<div class="form-group"> 
											<label for="inputTheme"><?php echo lang('theme_name'); ?></label>  
											<?php $js = 'class="form-control"'; ?>
											<?php echo form_dropdown('theme', $themes, $selected_theme, $js) ?>
											<?php echo form_error('theme') ?> 
										</div>								
										
										<!-- Form Language-->
										<div class="form-group"> 
											<label for="inputLang"><?php echo lang('theme_language'); ?></label>  
											<select class="form-control" name="language" id="language">
												<option value="en" <?php if($lang =='en'){ echo "SELECTED";}?> ><?php echo lang('lang_english'); ?></option>
												<option value="fr" <?php if($lang =='fr'){ echo "SELECTED";}?> ><?php echo lang('lang_french'); ?></option>
												<option value="es" <?php if($lang =='es'){ echo "SELECTED";}?> ><?php echo lang('lang_spanish'); ?></option>
												<option value="pt" <?php if($lang =='pt'){ echo "SELECTED";}?> ><?php echo lang('lang_portuguese'); ?></option>
												<option value="nl" <?php if($lang =='nl'){ echo "SELECTED";}?> ><?php echo lang('lang_dutch'); ?></option>
											</select>
											<?php echo form_error('language') ?> 
										</div>											
															
										<div class="btn-group"> 
											<input type="submit" class="btn btn-primary" id="button" name="theme_submit" value="<?php echo lang('save') ?>" />
										</div> 						
										<div class="btn-group">
											<input type="submit" class="btn" id="button" name="theme_cancel" value="<?php echo lang('cancel') ?>" /> 
										</div>	
										
									</form>
								 
								</div>
							</div>	 
                        </div>
                        <!-- /.panel-body -->
						
                    </div>
           
                </div>
                <!-- /.col-md-12 .col-lg-12 -->			
		  
		  </div>	

    </div>
    <!-- /#wrapper -->
	

 	
 