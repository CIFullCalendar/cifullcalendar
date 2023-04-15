
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a><?php if(empty($userinfo->first_name) && empty($userinfo->last_name)) : ?><b><?php echo $userinfo->username  ?></b><?php else : ?><b><?php echo $userinfo->first_name  ?> <?php echo $userinfo->last_name  ?></b><?php endif ?></a> 
                            </li> 
                        </ul>
						<div class="page-toolbar">   
							<div class="btn-group ">   
								<button type="button" class="btn btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> <?php echo lang('options'); ?>
									<i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">  
									<li>   
										<a data-title="Change" data-toggle="modal" data-target="#change" data-placement="top"  >
										<i class="fa fa-key"></i> <?php echo lang('profile_form_change_pass_button'); ?></a>  
									</li> 
									<li class="divider"> </li>
									<li>
										<a data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" >
										<i class="fa fa-remove"></i> <?php echo lang('profile_form_delete_button'); ?></a> 
									</li>	 
								</ul>
							</div>	
							
						</div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="user"> 
								<div class="panel-title">
									 <?php if(!empty($message)) : ?> 
									 <div class="alert-message alert-message-info">
										<h4> </h4>
										<p> <?php echo $message ?> </p>
									</div>
									<?php endif ?> 
                                </div>							
                                <div class="panel-body"> 
										
									<?php echo form_open_multipart('profile/user/edit/'.$userinfo->username, array('class' => 'form-horizontal', 'id' => 'form_profile', 'name' => 'form_profile', 'role' => 'form')); ?>
											
										<div class="container-fluid">
											<div class="row-fluid">										  

												<div class="col-md-2 col-lg-2 " align="center">  
													<div class="control-group">
														<img src="<?php echo $current_logo ?>" alt="" class="img-circle" > 
															<input type="file" name="userfile" size="20"  /><br>								
															<label class="hidden"><?php echo lang('profile_edit_logo_upload') ?></label> 
													</div> 		 
												</div> 
												<div class=" col-md-9 col-lg-9 ">  
												
													<!-- Text input-->
													<div class="form-group">
														<label class="control-label col-md-4" for="fname" ><?php echo lang('profile_edit_fname') ?></label> 
														<div class="col-md-8 col-lg-8">
															<input type="text" name="fname" id="fname" value="<?php echo set_value('fname',$userinfo->first_name) ?>" class="form-control"/>
															<?php echo form_error('fname') ?> 
														</div>
													</div>  

													<!-- Text input-->
													<div class="form-group"> 
														<label class="control-label col-md-4" for="lname" ><?php echo lang('profile_edit_lname') ?></label>
														<div class="col-md-8 col-lg-8"> 
															<input type="text" name="lname" id="lname" value="<?php echo set_value('lname',$userinfo->last_name) ?>" class="form-control"/>
															<?php echo form_error('lname') ?>
														</div>
													</div> 

													<!-- Textarea input-->
													<div class="form-group">
														<label class="control-label col-md-4" for="company" ><?php echo lang('profile_edit_address') ?></label>
														<div class="col-md-8 col-lg-8"> 
															<textarea class="form-control" type="text" name="address" id="address" placeholder="<?php echo lang('profile_edit_address') ?>" ><?php echo set_value('address',$userinfo->address) ?></textarea> 
															 <?php echo form_error('address') ?>
														</div>
													</div>															
													
													<!-- Text input-->
													<div class="form-group">
														<label class="control-label col-md-4" for="company" ><?php echo lang('profile_edit_company') ?></label>
														<div class="col-md-8 col-lg-8">
															<input type="text" name="company" id="company" value="<?php echo set_value('company',$userinfo->company) ?>" class="form-control"/> 
															 <?php echo form_error('company') ?>
														</div>
													</div>

													<!-- Text input-->
													<div class="form-group">
														<label class="control-label col-md-4" for="phone" ><?php echo lang('profile_edit_phone') ?></label>
														<div class="col-md-8 col-lg-8">
															 <input type="text" name="phone" id="phone" value="<?php echo set_value('phone',$userinfo->phone) ?>" class="form-control"/>
															 <?php echo form_error('phone') ?>
														</div>
													</div>

													<!-- Text input-->
													<div class="form-group">
														<label class="control-label col-md-4" for="email" ><?php echo lang('profile_edit_email') ?></label>
														<div class="col-md-8 col-lg-8">
															<input type="text" name="email" id="email" value="<?php echo set_value('email',$userinfo->email) ?>" class="form-control"/>
															 <?php echo form_error('email') ?>
															 <?php if(isset($email_error)): ?>
															  <?php echo $email_error ?> 
															 <?php endif ?>
														</div>
													</div> 									  

													<!-- checkbox input-->
													<div class="form-group">									
														 <?php if ($this->ion_auth->is_admin()): ?> 
															<label class="control-label col-md-4" for="groups" ><?php echo lang('edit_user_groups_heading');?></label>
															<div class="col-md-8 col-lg-8"> 
																<div class="dropup"> 
																   <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?php echo lang('edit_user_groups_heading') ?> <span class="caret"></span></button> 
																	<ul class="dropdown-menu" role="menu">
																	  <?php foreach ($groups as $group):?>
																		  <li><?php $checked = null; foreach($currentGroups as $grp) { if ($group['id'] == $grp->id) {$checked= ' checked="checked"';break;}}?>
																		  <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
																		  <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
																		  </li>
																	  <?php endforeach?>
																	</ul>
																</div> 
															</div>
															
														 <?php else: ?>	
														 
															<label class="control-label col-md-4" for="group" ><?php echo lang('group') ?></label>
															<div class="col-md-8 col-lg-8"> 
																<div class="dropup"> 
																   <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?php echo lang('edit_user_groups_heading') ?> <span class="caret"></span></button> 
																	<ul class="dropdown-menu" role="menu">
																		<?php foreach($currentGroups as $group): ?> 
																		   <li><?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?> </li>
																		<?php endforeach?> 
																	</ul>
																</div>
															</div> 	
																
														  <?php endif ?>

													</div> 
													
													<div class="row" >
														<div class="pull-right"> 			 
															<button type="submit" class="btn btn-sm btn-primary" name="submitProfile" ><i class="fa fa-pencil"></i> <?php echo lang('profile_form_submit_button') ?> </button> 
														</div>
													</div>												
												</div> 
														
											</div> 
										</div> 														
												   
									<?php echo form_close(); ?>	                                        
 
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
  
	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading"><?php echo lang('profile_delete_cancel') ?></h4>
				</div>
				 
				<?php echo form_open('profile/user/delete/'.$userinfo->id, array('id' => 'form_del', 'name' => 'form_del', 'role' => 'form' )); ?>  
					
					<div class="modal-body">
						<input name="user_id" id="user_id" value="<?php echo $userinfo->id; ?>" type="hidden" >	
						<div class="alert alert-warning">
							<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('profile_delete_warning') ?>
								<?php if(empty($userinfo->first_name) && empty($userinfo->last_name)) : ?>
									<b><?php echo $userinfo->username  ?></b>
								<?php else : ?>
									<b><?php echo $userinfo->first_name  ?> <?php echo $userinfo->last_name  ?></b>
								<?php endif ?> 
							
							<?php echo lang('profile_delete_profile') ?>
							
						</div>								 
						<div class="form-group"> 
							<div class="input-group col-md-12">
								<input type="password" name="password2" id="password2" class="form-control" placeholder="<?php echo lang('profile_edit_password') ?>"  />
								 <?php echo form_error('password2') ?>
							</div>
						</div>
						
					</div>									
					<div class="modal-footer ">
						<button type="submit" name="submitDelete" class="btn btn-danger" ><i class="fa fa-trash"></i> <?php echo lang('yes') ?></button>
						<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no') ?></button>
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