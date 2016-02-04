	
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
			
				<div class="pull-right">
					<div class="btn-group">
						<button class="btn btn-primary btn-xs" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i>  <?php echo lang('add') ?></button> 
					   
					</div>
				</div>		
				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
						×</button>
					<span class="glyphicon glyphicon-record"></span> <strong><?php echo lang('sources_message_title'); ?></strong>
					<hr class="message-inner-separator">
					<p>
						<?php echo lang('sources_message_warning'); ?> </p>
				</div>
				
			</div>
			<!-- /.col-md-12 .col-lg-12 -->				
		</div>
		<!-- /.row -->  
    </div>
    <!-- /#wrapper -->  
 
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
 