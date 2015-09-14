 
	<div id="page-wrapper"> 
		<div class="row">
		 	
		
		<div class="col-md-12 col-lg-12">

			<div class="row">
				 	<h3 class="page-header"><?php echo lang('add') ?> <?php echo lang('pages') ?></h3>
				<div class="col-lg-12 col-md-12">
			
					<form class="form-horizontal" name="form" id="form" method="post" action="<?php echo site_url('admin/pages/add'); ?>" >
						<div class="form-group">
							<input class="form-control" type="text" name="title" id="title" placeholder="<?php echo lang('page_title'); ?>"/>
							<p class="help-block"><?php echo form_error('title'); ?></p>							
							<textarea cols="40" rows="10" class="jqtextarea" name="content" id="txtarea" style="width:100%;" > </textarea>
							<p class="help-block"><?php echo form_error('content'); ?></p> 
							<div style="border-top: 1px #CCC dashed; margin-top: 5px; padding-top: 3px;"></div>	
						</div>	
							
						<div class="form-group">
							
							<label><?php echo lang('pages_meta_keywords') ?></label>
							<input class="form-control" type="text" name="meta_keywords" id="meta_keywords" placeholder="<?php echo lang('page_meta_keywords');?>" />
							<p class="help-block"><?php echo form_error('meta_keywords'); ?></p>
							
							<label><?php echo lang('pages_meta_description') ?></label>
							<input class="form-control" type="text" name="meta_description" id="meta_description" placeholder="<?php echo lang('page_meta_description');?>" />
							<p class="help-block"><?php echo form_error('meta_description'); ?></p>		
							
							<label><?php echo lang('pages_access') ?></label>
							<select class="form-control" name="access" id="access" >
								<option value="2" ><?php echo lang('pages_access_admins'); ?></option>	
								<option value="1" ><?php echo lang('pages_access_members'); ?></option>									
								<option value="0" ><?php echo lang('pages_access_visitors'); ?></option>										
							</select>		
							<p class="help-block"><?php echo form_error('access'); ?></p>								
							<div style="border-top: 1px #CCC dashed; margin-top: 5px; padding-top: 3px;"></div>	 
						</div> 	 		
						<div class="form-group">
							<div class="btn-group"> 
								<input type="submit" class="btn btn-primary" id="button" name="page_submit" value="<?php echo lang('save') ?>" />
							</div> 						
							<div class="btn-group">
								<input type="submit" class="btn" id="button" name="page_cancel" value="<?php echo lang('cancel') ?>" /> 
							</div> 	
						</div> 
										
					</form>
		
				</div>
				<!-- /.col-lg-12 -->
			</div>
		
		</div>
		<!-- /.col-md-12 .col-lg-12 -->	  
		</div>
		<!-- /.row --> 
	
		
   </div>
    <!-- /#wrapper --> 
	
		