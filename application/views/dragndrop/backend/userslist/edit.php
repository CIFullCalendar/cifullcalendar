 
	<div id="page-wrapper"> 
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-user" ></i> <?php echo lang('admin_modal_edit_user') ?></h1>
			</div>
			<!-- /.col-lg-12 -->		
		</div>
		<!-- /.row -->			
		<div class="row">
			<div class="col-md-12 col-lg-12"> 
				 
				<form class="form-horizontal" name="form_edit" id="form_edit" method="post" accept-charset="utf-8" action="<?php echo site_url('admin/userslist/edit') . '/';?><?php echo $userinfo->id  ?>" >	  
					<div class="container-fluid">
						<div class="row-fluid">
							<div class="col-md-4" >
								<img src="<?php echo base_url('assets/img/profile/'.$userinfo->image) ?>" class="img-circle" style="height:150px;" >
								<div class="control-group"> 		 
									<b><?php echo lang('username'); ?></b>:<br /> <em><?php echo $userinfo->username; ?></em>	 
								</div>												
								<div class="control-group"> 
									<b><?php echo lang('admin_modal_member_since'); ?></b>:<br /> <em><?php echo relativeTime($userinfo->created_on); ?></em> 
								</div>	
								<div class="control-group"> 
									<b><?php echo lang('admin_modal_member_last_log'); ?></b>:<br />  <em><?php echo relativeTime($userinfo->last_login); ?></em>
								</div>	
								<div class="control-group">
									<b><?php echo lang('admin_modal_ip'); ?></b>:<br />  <em><?php echo $userinfo->ip_address ?></em>
								</div>		 	
							</div>
							<div class="col-md-8"> 		 
								<div class="form-group">
									<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $userinfo->first_name  ?>" placeholder="<?php echo lang('admin_table_fname'); ?>">
								</div> 								
								<div class="form-group">
									<input type="text" class="form-control" name="lname" id="lname" value="<?php echo $userinfo->last_name  ?>" placeholder="<?php echo lang('admin_table_lname'); ?>">
								</div> 	  
								<div class="form-group">
									<input type="text" class="form-control" name="company" id="company" value="<?php echo $userinfo->company  ?>" placeholder="<?php echo lang('admin_table_company'); ?>">
								</div>											
								<div class="form-group">
									<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $userinfo->phone  ?>" placeholder="<?php echo lang('admin_table_phone'); ?>">
								</div> 								
								<div class="form-group">
									<input type="text" class="form-control" name="email" id="email" value="<?php echo $userinfo->email  ?>" placeholder="<?php echo lang('admin_table_email'); ?>">
								</div> 												
							
								<div class="form-group">
									<select class="form-control" name="status" id="status" >
									<?php if(($userinfo->active) == 0):  ?>
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
									<div class="btn-group">
										<button type="button" class="btn btn-default">
											<?php echo lang('edit_user_groups_heading') ?></button>
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span><span class="sr-only"><?php echo lang('edit_group_name_label') ?></span>
										</button>
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
							<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
							</div> 
						</div>
					</div>   
				</form>  
				
				<label class="alert"> 
					 <?php echo $message ?> 
				</label>				
				
			</div>
			<!-- /.col-md-12 .col-lg-12 -->				
		</div>
		<!-- /.row -->  
   </div>
    <!-- /#wrapper -->  