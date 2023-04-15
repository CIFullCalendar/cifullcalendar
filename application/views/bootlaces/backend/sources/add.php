	<div class="page-content-wrapper"> 
			
		<div class="page-content"> 
		
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li> 
						<a><i class="fa fa-link" ></i> <?php echo lang('sources_add_new') ?></a>
					</li> 
				</ul>
				<div class="page-toolbar">   
					<div class="btn-group pull-right">  
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="pages"> 
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
	 
									<?php echo form_open('calendar/sources/add', array('id' => 'form_add', 'name' => 'form_add', 'role' => 'form' )); ?> 
									
										<div class="modal-body"> 						 
											<div class="form-group">
												<input class="form-control" name="source_name" id="source_name" placeholder="<?php echo lang('sources_input_name'); ?>" >
												<?php echo form_error('source_name') ?> 
											</div> 
											<div class="form-group">
												<textarea rows="3" name="source_url" id="source_url" class="form-control" placeholder="<?php echo lang('sources_input_url'); ?>" ></textarea>
												<?php echo form_error('source_url') ?> 
											</div> 
										</div>
										<div class="modal-footer ">
											<div class="btn-group"> 
												<input type="submit" name="submitAdd" class="btn btn-primary" value="<?php echo lang('save') ?>" />
											</div>	
											<div class="btn-group"> 
												<input type="submit" name="submitCancel" class="btn btn-default" value="<?php echo lang('cancel') ?>" /> 
											</div>
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

<div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="change" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading"><?php echo lang('profile_change_password') ?></h4>
			</div>
			
			<?php echo form_open('profile/user/change_password', array('id' => 'form_pass', 'name' => 'form_pass', 'role' => 'form' )); ?>  
			
				<div class="modal-body">
					<input name="user_id" id="user_id" value="<?php echo $userinfo->id; ?>" type="hidden" >	
					<div class="alert alert-warning">
						<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('profile_change_warning') ?>
							<?php if(empty($userinfo->first_name) && empty($userinfo->last_name)) : ?>
								<b><?php echo $userinfo->username  ?></b>
							<?php else : ?>
								<b><?php echo $userinfo->first_name  ?> <?php echo $userinfo->last_name  ?></b>
							<?php endif ?> 
						
						<?php echo lang('password') ?>
						
					</div>								 
					<div class="form-group"> 
						<div class="input-group col-md-12">
							<input type="password" name="old_password" id="old_password" class="form-control" placeholder="<?php echo lang('profile_change_old_password') ?>"  />
							 <?php echo form_error('old_password') ?>
						</div>
					</div>								
					<div class="form-group"> 
						<div class="input-group col-md-12">
							<input type="password" name="new_password" id="new_password" class="form-control" placeholder="<?php echo lang('profile_change_new_password') ?>"  />
							 <?php echo form_error('new_password') ?>
						</div>
					</div>									
					<div class="form-group"> 
						<div class="input-group col-md-12">
							<input type="password" name="new_password_confirm" id="new_password_confirm" class="form-control" placeholder="<?php echo lang('profile_change_new_password_confirm') ?>"  />
							 <?php echo form_error('profile_change_new_password_confirm') ?>
						</div>
					</div>
					
				</div>									
				<div class="modal-footer ">
					<button type="submit" name="submitChange" class="btn btn-success" ><i class="fa fa-key"></i> <?php echo lang('yes') ?></button>
					<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no') ?></button>
				</div>
			
			<?php echo form_close(); ?>	 
		</div>
		<!-- /.modal-content --> 
	</div>
  <!-- /.modal-dialog --> 
</div>