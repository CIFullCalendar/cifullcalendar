	
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
					<h4 class="modal-title custom_align" id="heading"> <?php echo lang('create_group_title'); ?></h4>
				</div>
				<form name="form_add" id="form_add" method="post" action="<?php echo site_url('admin/group/add');?>" >	 
					<div class="modal-body">   
						<div class="container-fluid">
							<div class="row-fluid"> 
								<div class="col-md-12"> 	
									<div class="form-group">
										<input type="text" class="form-control" name="group_name" id="group_name" value="" placeholder="<?php echo lang('edit_group_name_label'); ?>">
										<?php echo form_error('group_name') ?>
									</div> 											
									<div class="form-group">
										<textarea class="form-control" name="description" id="description" ><?php echo lang('edit_group_desc_label'); ?></textarea>
										<?php echo form_error('description') ?>
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
 