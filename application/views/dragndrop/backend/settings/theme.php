 
	<div id="page-wrapper">
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"> <i class="fa fa-paint-brush fa-fw"></i> <?php echo lang('settings_theme_name') ?></h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->			
			
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
							<option value="es" <?php if($lang =='es'){ echo "SELECTED";}?> ><?php echo lang('lang_spanish'); ?></option>
							<option value="nl" <?php if($lang =='nl'){ echo "SELECTED";}?> ><?php echo lang('lang_dutch'); ?></option>
							<option value="fr" <?php if($lang =='fr'){ echo "SELECTED";}?> ><?php echo lang('lang_french'); ?></option>
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
    <!-- /#wrapper --> 