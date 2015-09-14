 
	<div id="page-wrapper"> 
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo lang('users') ?></h1>
			</div>
			<!-- /.col-lg-12 -->		
		
		<div class="col-md-12 col-lg-12">

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<i class="fa fa-user" ></i> <?php echo lang('users') ?>
                            <div class="pull-right">
                                <div class="btn-group">
									<button class="btn btn-primary btn-xs" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i>  <?php echo lang('add') ?></button> 
                                   
                                </div>
                            </div>							
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
						
							<!-- table -->
							<div class="table-responsive">
								<div id="toolbar"> 
									<button class="btn btn-danger" id="remove-data" data-method="remove" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button>   
								</div>							
								<table id="allusers_dataTable" class="table" data-toolbar="#toolbar" data-show-export="true" >
									<thead>
										<tr> 
											<th data-field="chk" data-checkbox="true"></th>
											<th data-field="uname" data-align="center" data-sortable="true" data-width="15%"><?php echo lang('admin_table_username'); ?></th>
											<th data-field="fname" data-align="left" data-sortable="true" ><?php echo lang('admin_table_fname'); ?></th> 
											<th data-field="lname" data-align="left" data-sortable="true" ><?php echo lang('admin_table_lname'); ?></th> 
											<th data-field="email" data-align="left" data-sortable="true" ><?php echo lang('admin_table_email'); ?></th>   
											<th data-field="edit" data-sortable="false" data-formatter="editFormatter" data-width="7%"><?php echo lang('admin_table_edit'); ?></th>   
										</tr>
									</thead>
								</table>
							</div>
							<!-- /.table --> 
 
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
		
		</div>
		<!-- /.col-md-12 .col-lg-12 -->	  
		</div>
		<!-- /.row --> 


 
	
		<?php foreach ($allusers as $result): ?>		
			 <div class="modal fade" id="edit_<?php echo $result->id  ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_edit_user'); ?></h4>  
					    </div>
						<form name="form_<?php echo $result->id  ?>" id="form_<?php echo $result->id  ?>" method="post" action="<?php echo site_url('admin/userslist/edit') . '/';?><?php echo $result->id  ?>" >	
							<div class="modal-body">  
							
								<div class="container-fluid">
									<div class="row-fluid">
										<div class="col-md-4" >
											<img src="<?php echo base_url('assets/img/profile/'.$result->image) ?>" class="img-circle" style="height:150px;" >
											<div class="control-group"> 													
											<?php if($result->logged_in == 1): ?>
												<b><?php echo lang('username'); ?></b>:<br /><strong class="text-success" ><?php echo $result->uname ?></strong>
											<?php elseif($result->logged_in == 0): ?>
												<b><?php echo lang('username'); ?></b>:<br /> <em><?php echo $result->uname; ?></em>	
											<?php endif ?>												
											</div>												
											<div class="control-group"> 
												<b><?php echo lang('admin_modal_member_since'); ?></b>:<br /> <em><?php echo relativeTime($result->signupdate); ?></em>					
											</div>	
											<div class="control-group"> 
												<b><?php echo lang('admin_modal_member_last_log'); ?></b>:<br />  <em><?php echo relativeTime($result->signindate); ?></em>
											</div>	
											<div class="form-group">
												<b><?php echo lang('admin_modal_ip'); ?></b>:<br />  <em><?php echo $result->lastip  ?></em>
											</div>		 	
										</div>
										<div class="col-md-8"> 		 
											<div class="form-group">
												<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $result->fname  ?>" placeholder="<?php echo lang('admin_table_fname'); ?>">
											</div> 								
											<div class="form-group">
												<input type="text" class="form-control" name="lname" id="lname" value="<?php echo $result->lname  ?>" placeholder="<?php echo lang('admin_table_lname'); ?>">
											</div> 								
											<div class="form-group">
												<textarea class="form-control" name="address" id="address" placeholder="<?php echo lang('admin_table_address'); ?>" ><?php echo $result->address  ?></textarea>
											</div>  
											<div class="form-group">
												<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $result->phone  ?>" placeholder="<?php echo lang('admin_table_phone'); ?>">
											</div> 								
											<div class="form-group">
												<input type="text" class="form-control" name="email" id="email" value="<?php echo $result->email  ?>" placeholder="<?php echo lang('admin_table_email'); ?>">
											</div> 												
											<div class="form-group">
												<select class="form-control" name="level" id="level" >
												<?php if(($result->level) == 2):  ?>
													<option value="2" select><?php echo lang('admin_level_2'); ?></option>
													<option value="1" ><?php echo lang('admin_level_1'); ?></option> 	
												<?php else: ?>
													<option value="1" select><?php echo lang('admin_level_1'); ?></option> 	
													<option value="2" ><?php echo lang('admin_level_2'); ?></option>	
												<?php endif ?>
												</select>
											</div> 											
											<div class="form-group">
												<select class="form-control" name="status" id="status" >
												<?php if(($result->status) == 0):  ?>
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
										</div> 
									</div>
								</div> 

							
							</div>
							<div class="modal-footer ">
								<div class="btn-group">
									<button type="submit" name="submitEdit" class="btn btn-primary" ><i class="fa fa-pencil"></i> <?php echo lang('ok'); ?></button>
								</div>	
								<div class="btn-group">
									<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
								</div>	

							</div>
						</form> 
					</div>
					<!-- /.modal-content --> 
				  </div>
					  <!-- /.modal-dialog --> 
				</div>					
				<div class="modal fade" id="del_<?php echo $result->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_delete_user'); ?></h4>
							</div>
							
							<form name="form_<?php echo $result->id  ?>" id="form_<?php echo $result->id  ?>" method="post" action="<?php echo site_url('admin/userslist/del') . '/';?><?php echo $result->id  ?>" >	

								<div class="modal-body">
									<input name="id" id="id" value="<?php echo $result->id  ?>" type="hidden" >	
									<div class="alert alert-warning">
										<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('admin_modal_delete_user'); ?>  
											<?php if(empty($result->fname) && empty($result->lname)) : ?>
												<b><?php echo $result->uname  ?></b>?
											<?php else : ?>
												<b><?php echo $result->fname  ?> <?php echo $result->lname  ?></b>?
											<?php endif ?>
									</div>
								</div>
								<div class="modal-footer ">
									<button type="submit" name="submitDelete" class="btn btn-danger" ><i class="fa fa-trash"></i> <?php echo lang('yes'); ?></button>
									<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no'); ?></button>
								</div>
							
							</form> 
						</div>
				<!-- /.modal-content --> 
					</div>
				  <!-- /.modal-dialog --> 
				</div>	 
		<?php endforeach ?>	
		
		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_add_user'); ?></h4>
					</div>
					<form name="form_add" id="form_add" method="post" action="<?php echo site_url('admin/userslist/add');?>" >	 
						<div class="modal-body">   
							<div class="container-fluid">
								<div class="row-fluid">
									<div class="col-md-4" >
										<img src="<?php echo base_url('assets/img/profile/default.png'); ?>" class="img-circle" style="height:150px;" >	 	
									</div>
									<div class="col-md-8"> 	
										<div class="form-group">
											<input type="text" class="form-control" name="uname" id="uname" value="" placeholder="<?php echo lang('admin_table_username'); ?>">
										</div> 											
										<div class="form-group">
											<input type="text" class="form-control" name="fname" id="fname" value="" placeholder="<?php echo lang('admin_table_fname'); ?>">
										</div> 								
										<div class="form-group">
											<input type="text" class="form-control" name="lname" id="lname" value="" placeholder="<?php echo lang('admin_table_lname'); ?>">
										</div> 								
										<div class="form-group">
											<textarea class="form-control" name="address" id="address" placeholder="<?php echo lang('admin_table_address'); ?>" ></textarea>
										</div>  
										<div class="form-group">
											<input type="text" class="form-control" name="phone" id="phone" value="" placeholder="<?php echo lang('admin_table_phone'); ?>">
										</div> 								
										<div class="form-group">
											<input type="text" class="form-control" name="email" id="email" value="" placeholder="<?php echo lang('admin_table_email'); ?>">
										</div> 												
										<div class="form-group">
											<select class="form-control" name="level" id="level" >							
												<option value="1" select><?php echo lang('admin_level_1'); ?></option> 	
												<option value="2" ><?php echo lang('admin_level_2'); ?></option>											
											</select>
										</div> 											
										<div class="form-group">
											<select class="form-control" name="status" id="status" >
												<option value="0" select><?php echo lang('admin_status_0'); ?></option>
												<option value="1" ><?php echo lang('admin_status_1'); ?></option> 	
											</select>
										</div> 
										<div class="form-group">
											<input type="password" class="form-control" name="password" id="password" value="" placeholder="<?php echo lang('admin_table_password'); ?>">
										</div> 																					
									</div> 
								</div>
							</div> 
 
						</div>
						<div class="modal-footer ">
							<button type="submit" name="submitAdd" class="btn btn-success" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('ok'); ?></button> 
							<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
						</div> 
					</form> 
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>
		
		
		
   </div>
    <!-- /#wrapper --> 