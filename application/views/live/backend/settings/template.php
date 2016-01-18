 
	<div id="page-wrapper"> 
	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-pencil-square-o fa-fw"></i> <?php echo lang('templates_title') ?></h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->		
			
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
				
				<form  class="form-horizontal" id="form_settings" name="form" method="post" action="<?php echo site_url('admin/settings/template') .'/'.$notify_type; ?>">  
				
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
				 
				</form>  
 
			</div>
			<!-- /.col-md-12 .col-lg-12 -->	  
		</div>
		<!-- /.row --> 		
   </div>
    <!-- /#wrapper --> 
 