
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a><i class="fa fa-user" ></i> <?php echo lang('users') ?></a> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">  
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="userslist"> 
								<div class="panel-title">
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
                                </div>							
                                <div class="panel-body">
									<div class="row">
										<div class="col-md-12 col-lg-12"> 
											<div class="table-responsive">
												<div id="toolbar">    
													<button class="btn btn-primary" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i>  <?php echo lang('add') ?></button> 	
												</div>							
												<table id="allusers_dataTable" class="table" data-toolbar="#toolbar" data-show-export="true" data-locale="<?php echo $lang ?>" >
													<thead>
														<tr>  
															<th data-field="username" data-align="center" data-sortable="true" data-width="15%"><?php echo lang('admin_table_username'); ?></th>
															<th data-field="first_name" data-align="left" data-sortable="true" ><?php echo lang('admin_table_fname'); ?></th> 
															<th data-field="last_name" data-align="left" data-sortable="true" ><?php echo lang('admin_table_lname'); ?></th> 
															<th data-field="email" data-align="left" data-sortable="true" ><?php echo lang('admin_table_email'); ?></th>   
															<th data-field="groups" data-align="left" data-sortable="true" data-formatter="groupsFormatter" ><?php echo lang('groups'); ?></th>   
															<th data-field="edit" data-sortable="false" data-formatter="editFormatter" data-width="3%"><?php echo lang('admin_table_edit'); ?></th>   
														</tr>
													</thead>
												</table>
												<!-- /.table --> 
											</div>
											<!-- /.table-responsive -->	
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
		
		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_add_user'); ?></h4>
					</div> 
					<?php echo form_open('admin/userslist/add', array('id' => 'form_add', 'name' => 'form_add', 'role' => 'form' )); ?>  					
						<div class="modal-body">   
							<div class="container-fluid">
								<div class="row-fluid">
									<div class="col-md-4" >
										<img src="<?php echo base_url('assets/img/profile/default.png'); ?>" class="img-circle" style="height:150px;" >	 	
									</div>
									<div class="col-md-8"> 	
										<div class="form-group">
											<input type="text" class="form-control" name="uname" id="uname" value="" placeholder="<?php echo lang('admin_table_username'); ?>">
											<?php echo form_error('uname') ?>
										</div> 											
										<div class="form-group">
											<input type="text" class="form-control" name="fname" id="fname" value="" placeholder="<?php echo lang('admin_table_fname'); ?>">
											<?php echo form_error('fname') ?>
										</div> 								
										<div class="form-group">
											<input type="text" class="form-control" name="lname" id="lname" value="" placeholder="<?php echo lang('admin_table_lname'); ?>">
											<?php echo form_error('lname') ?>
										</div>  		
										<div class="form-group"> 
											<textarea class="form-control" type="text" name="address" id="address" placeholder="<?php echo lang('profile_edit_address') ?>" ></textarea>  
											<?php echo form_error('address') ?>
										</div>											
										<div class="form-group">
											<input type="text" class="form-control" name="email" id="email" value="" placeholder="<?php echo lang('admin_table_email'); ?>">
											<?php echo form_error('email') ?>
										</div> 				 
										<div class="form-group">
											<input type="text" class="form-control" name="company" id="company" value="" placeholder="<?php echo lang('admin_table_company'); ?>">
											<?php echo form_error('company') ?>
										</div>			 
										<div class="form-group">
											<input type="text" class="form-control" name="phone" id="phone" value="" placeholder="<?php echo lang('admin_table_phone'); ?>">
											<?php echo form_error('phone') ?>
										</div>	 											
										<div class="form-group">
											<select class="form-control" name="status" id="status" >
												<option value="0" select><?php echo lang('admin_status_0'); ?></option>
												<option value="1" ><?php echo lang('admin_status_1'); ?></option> 	
											</select>
										</div> 
										<div class="form-group">
											<input type="password" class="form-control" name="password" id="password" value="" placeholder="<?php echo lang('admin_table_password'); ?>">
											<?php echo form_error('password') ?>
										</div> 											
										<div class="form-group">
											<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="<?php echo lang('edit_user_validation_password_confirm_label'); ?>">
											<?php echo form_error('password_confirm') ?>
										</div> 																					
									</div> 
								</div> 
							</div>   
						</div>
						<div class="modal-footer ">
							<button type="submit" name="submitAdd" class="btn btn-success" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('ok'); ?></button> 
							<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
						</div> 
					<?php echo form_close(); ?>	
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>
		
