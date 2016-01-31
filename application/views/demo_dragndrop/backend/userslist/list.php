 
	<div id="page-wrapper"> 
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-user" ></i> <?php echo lang('users') ?></h1>
			</div>
			<!-- /.col-lg-12 -->		
		</div>
		<!-- /.row -->			
		<div class="row">
			<div class="col-md-12 col-lg-12">			
				<div class="table-responsive">
					<div id="toolbar"> 
						<button class="btn btn-danger" id="remove-data" data-method="remove" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button>   
						<button class="btn btn-primary" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i>  <?php echo lang('add') ?></button> 	
					</div>							
					<table id="allusers_dataTable" class="table" data-toolbar="#toolbar" data-show-export="true" data-locale="<?php echo $lang ?>" >
						<thead>
							<tr> 
								<th data-field="chk" data-checkbox="true"></th>
								<th data-field="username" data-align="center" data-sortable="true" data-width="15%"><?php echo lang('admin_table_username'); ?></th>
								<th data-field="first_name" data-align="left" data-sortable="true" ><?php echo lang('admin_table_fname'); ?></th> 
								<th data-field="last_name" data-align="left" data-sortable="true" ><?php echo lang('admin_table_lname'); ?></th> 
								<th data-field="email" data-align="left" data-sortable="true" ><?php echo lang('admin_table_email'); ?></th>   
								<th data-field="edit" data-sortable="false" data-formatter="editFormatter" data-width="7%"><?php echo lang('admin_table_edit'); ?></th>   
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
    <!-- /#wrapper -->  
	
	<?php foreach ($allusers as $result): ?> 
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
									<?php if(empty($result->first_name) && empty($result->last_name)) : ?>
										<b><?php echo $result->username  ?></b>?
									<?php else : ?>
										<b><?php echo $result->first_name  ?> <?php echo $result->last_name  ?></b>?
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
					</form> 
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>
		
