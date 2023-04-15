 

            <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a id="location" href=""><?php echo lang('sources_all_heading'); ?></a> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">
						    <div class="pull-right">  
								<div class="btn-group ">
									<button class="btn btn-primary btn-md" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i> Add New Source</button>
								 </div>						   
							</div> 
                        </div>
                    </div>
					<!-- /.page-bar -->
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sources"> 
								<div class="panel-title">
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
                                </div>							
                                <div class="panel-body">
								
									<div class="alert alert-warning">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
											×</button>
										<span class="fa fa-warning"></span> <strong><?php echo lang('sources_message_title'); ?></strong>
										<hr class="message-inner-separator">
										<p>
											<?php echo lang('sources_message_warning'); ?> </p>
									</div>
							
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
  
 
		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('sources_add_new'); ?></h4>
				</div>
				
				<?php echo form_open('calendar/sources/add', array('id' => 'form_add', 'name' => 'form_add', 'role' => 'form' )); ?>  
				
					<div class="modal-body">  						 
						<div class="form-group">
							<input class="form-control" name="source_name" id="source_name" placeholder="<?php echo lang('sources_input_name'); ?>" >
						</div> 
						<div class="form-group">
							<textarea rows="3" name="source_url" id="source_url" class="form-control" placeholder="<?php echo lang('sources_input_url'); ?>" ></textarea>
						</div>  
					</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
						<input type="submit" name="submitAdd" class="btn btn-success" value="<?php echo lang('save') ?>" />  
					</div>
				
				<?php echo form_close(); ?>	
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>	 

			
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