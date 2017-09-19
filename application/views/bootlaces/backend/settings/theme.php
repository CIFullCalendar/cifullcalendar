
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li> 
								<a><i class="fa fa-paint-brush fa-fw"></i> <?php echo lang('settings_theme_name') ?></a>
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
  										 
											<?php echo form_open('admin/settings/theme', array('class' => 'form-horizontal', 'id' => 'form_settings_theme', 'name' => 'form_settings_theme', 'role' => 'form' )); ?>  
											
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
														<option value="ar" <?php if($lang =='ar'){ echo "SELECTED";}?> ><?php echo lang('lang_arabic'); ?></option> 	
														<option value="es" <?php if($lang =='es'){ echo "SELECTED";}?> ><?php echo lang('lang_spanish'); ?></option> 
														<option value="fr" <?php if($lang =='fr'){ echo "SELECTED";}?> ><?php echo lang('lang_french'); ?></option> 
														<option value="id" <?php if($lang =='id'){ echo "SELECTED";}?> ><?php echo lang('lang_indonesian'); ?></option>
														<option value="it" <?php if($lang =='it'){ echo "SELECTED";}?> ><?php echo lang('lang_italian'); ?></option>
														<option value="nl" <?php if($lang =='nl'){ echo "SELECTED";}?> ><?php echo lang('lang_dutch'); ?></option>
														<option value="pt" <?php if($lang =='pt'){ echo "SELECTED";}?> ><?php echo lang('lang_portuguese'); ?></option> 
														<option value="ru" <?php if($lang =='ru'){ echo "SELECTED";}?> ><?php echo lang('lang_russian'); ?></option>
														<option value="ja" <?php if($lang =='ja'){ echo "SELECTED";}?> ><?php echo lang('lang_japanese'); ?></option>
														<option value="ko" <?php if($lang =='ko'){ echo "SELECTED";}?> ><?php echo lang('lang_korean'); ?></option> 
														<option value="vi" <?php if($lang =='vi'){ echo "SELECTED";}?> ><?php echo lang('lang_vietnamese'); ?></option>
														<option value="zh-cn" <?php if($lang =='zh-cn'){ echo "SELECTED";}?> ><?php echo lang('lang_chinese'); ?></option>		
													</select>
													<?php echo form_error('language') ?> 
												</div>											
																	
												<div class="btn-group"> 
													<input type="submit" class="btn btn-primary" id="button" name="theme_submit" value="<?php echo lang('save') ?>" />
												</div> 						
												<div class="btn-group">
													<input type="submit" class="btn" id="button" name="theme_cancel" value="<?php echo lang('cancel') ?>" /> 
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