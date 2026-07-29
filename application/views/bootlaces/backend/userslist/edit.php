
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li> 
								<a><i class="fa fa-user" ></i> <?php echo lang('admin_modal_edit_user') ?></a>
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">   
								<button class="btn btn-danger btn-sm" data-title="Delete" data-toggle="modal" data-target="#del_<?php echo $user->id  ?>" data-placement="top" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button> 
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="userslist"> 
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
 
											<?php echo form_open_multipart('admin/userslist/edit/'.$user->id, array('id' => 'form_edit', 'name' => 'form_edit', 'role' => 'form' )); ?>   
											
												<div class="container-fluid">
													<div class="row-fluid">
														<div class="col-md-4" >
															<div class="control-group"> 		
																<img src="<?php echo base_url('assets/img/profile/'.$user->image) ?>" alt="" class="img-circle" style="height:150px;"> 
																	<input type="file" name="userfile" size="20"  /><br>								
																	<label class="hidden"><?php echo lang('profile_edit_logo_upload') ?></label> 
															</div> 
															<div class="control-group"> 		 
																<b><?php echo lang('username'); ?></b>:<br /> <em><?php echo $user->username; ?></em>	 
															</div>												
															<div class="control-group"> 
																<b><?php echo lang('admin_modal_member_since'); ?></b>:<br /> <em><?php echo relativeTime($user->created_on); ?></em> 
															</div>	
															<div class="control-group"> 
																<b><?php echo lang('admin_modal_member_last_log'); ?></b>:<br />  <em><?php echo relativeTime($user->last_login); ?></em>
															</div>	
															<div class="control-group">
																<b><?php echo lang('admin_modal_ip'); ?></b>:<br />  <em><?php echo $user->ip_address ?></em>
															</div>		 	
														</div>
														<div class="col-md-8"> 		 
															<div class="form-group">
																<input type="text" class="form-control" name="fname" id="fname" value="<?php echo set_value('first_name',$user->first_name) ?>" placeholder="<?php echo lang('admin_table_fname'); ?>">
															</div> 								
															<div class="form-group">
																<input type="text" class="form-control" name="lname" id="lname" value="<?php echo set_value('last_name',$user->last_name) ?>" placeholder="<?php echo lang('admin_table_lname'); ?>">
															</div> 	   
															<div class="form-group"> 
																<textarea class="form-control" type="text" name="address" id="address" placeholder="<?php echo lang('profile_edit_address') ?>" ><?php echo set_value('address',$user->address) ?></textarea>  
															</div>	 
															<div class="form-group">
																<input type="text" class="form-control" name="company" id="company" value="<?php echo set_value('company',$user->company) ?>" placeholder="<?php echo lang('admin_table_company'); ?>">
															</div>											
															<div class="form-group">
																<input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone',$user->phone) ?>" placeholder="<?php echo lang('admin_table_phone'); ?>">
															</div> 								
															<div class="form-group">
																<input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email',$user->email) ?>" placeholder="<?php echo lang('admin_table_email'); ?>">
															</div> 												
														
															<div class="form-group">
																<select class="form-control" name="status" id="status" >
																<?php if(($user->active) == 0):  ?>
																	<option value="0" select><?php echo lang('admin_status_0'); ?></option>
																	<option value="1" ><?php echo lang('admin_status_1'); ?></option> 	
																<?php else: ?>
																	<option value="1" select><?php echo lang('admin_status_1'); ?></option> 	
																	<option value="0" ><?php echo lang('admin_status_0'); ?></option>	
																<?php endif ?>
																</select>
															</div> 
															<div class="form-group">
																<input type="password" class="form-control" name="password" id="password" value="" placeholder="<?php echo lang('profile_change_password'); ?>">
															</div>
															<div class="form-group">
																<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="<?php echo lang('edit_user_validation_password_confirm_label'); ?>">
															</div> 	
															<div class="form-group"> 
																<div class="dropup"> 
																   <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?php echo lang('edit_user_groups_heading') ?> <span class="caret"></span></button> 
																	<ul class="dropdown-menu" role="menu">
																	  <?php foreach ($groups as $group):?>
																		<li><?php $checked = null; foreach($currentGroups as $grp) { if ($group['id'] == $grp->id) { $checked= ' checked="checked"'; break;}} ?>
																		  <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
																		  <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></li>
																	  <?php endforeach?>
																	</ul>
																</div>		 
															</div>  
														</div>   
													</div>
													<div class="row-fluid">
														<div class="btn-group">
															<button type="submit" name="submitEdit" class="btn btn-primary" ><i class="fa fa-pencil"></i> <?php echo lang('ok'); ?></button>
														</div>	
														<div class="btn-group">
															<a href="<?php echo site_url('admin/userslist');?>" class="btn btn-default" role="button" ><i class="fa fa-times"></i> <?php echo lang('cancel'); ?></a>  
														</div> 
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


	<div class="modal fade" id="del_<?php echo $user->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="heading"> <?php echo lang('admin_modal_delete_user'); ?></h4>
				</div>
				 
				<?php echo form_open('admin/userslist/del/'.$user->id, array('id' => 'form_del'.$user->id, 'name' => 'form_del'.$user->id )); ?> 
				
					<div class="modal-body">
						<input name="id" id="id" value="<?php echo $user->id  ?>" type="hidden" >	
						<div class="alert alert-warning">
						<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('admin_modal_delete_user'); ?>  
							<?php if(empty($user->first_name) && empty($user->last_name)) : ?>
								<b><?php echo $user->username ?></b>?
							<?php else : ?>
								<b><?php echo $user->first_name ?> <?php echo $user->last_name ?></b>?
							<?php endif ?>
						</div>							
					</div>
					<div class="modal-footer ">
						<button type="submit" name="submitDelete" class="btn btn-danger" ><i class="fa fa-trash"></i> <?php echo lang('yes'); ?></button>
						<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no'); ?></button>
					</div>
					
				<?php echo form_close(); ?>  
			</div>
			<!-- /.modal-content --> 
		</div>
	  <!-- /.modal-dialog --> 
	</div>		