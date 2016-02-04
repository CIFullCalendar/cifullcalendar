	<div id="page-wrapper"> 
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-group" ></i> <?php echo lang('groups') ?></h1>
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
					<table id="allgroups_dataTable" class="table" data-toolbar="#toolbar" data-show-export="true" data-locale="<?php echo $lang ?>" >
						<thead>
							<tr> 
								<th data-field="chk" data-checkbox="true"></th>
								<th data-field="name" data-align="center" data-sortable="true" data-width="15%"><?php echo lang('create_group_name_label'); ?></th>
								<th data-field="description" data-align="left" data-sortable="true" ><?php echo lang('edit_group_desc_label'); ?></th>  
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
	
	<?php foreach ($allgroups as $result): ?> 
		<div class="modal fade" id="del_<?php echo $result->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="heading"> <?php echo lang('admin_modal_delete_user'); ?></h4>
					</div>					
					<form name="form_<?php echo $result->id  ?>" id="form_<?php echo $result->id  ?>" method="post" action="<?php echo site_url('admin/group/del') . '/';?><?php echo $result->id  ?>" >	

						<div class="modal-body">
							<input name="id" id="id" value="<?php echo $result->id  ?>" type="hidden" >	
							<div class="alert alert-warning">
								<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('admin_modal_delete_user'); ?>  
								<b><?php echo $result->name ?></b>? 
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
					<h4 class="modal-title custom_align" id="heading"> <?php echo lang('create_group_title'); ?></h4>
				</div>
				<form name="form_add" id="form_add" method="post" action="<?php echo site_url('admin/group/add');?>" >	 
					<div class="modal-body">   
						<div class="container-fluid">
							<div class="row-fluid"> 
								<div class="col-md-12"> 	
									<div class="form-group">
										<label class="control-label" for="inputName"><?php echo lang('edit_group_name_label'); ?></label>
										<input type="text" class="form-control" name="group_name" id="group_name" value="" >
										<?php echo form_error('group_name') ?>
									</div> 											
									<div class="form-group">
										<label class="control-label" for="inputDescription"><?php echo lang('edit_group_desc_label'); ?></label>
										<textarea class="form-control" name="description" id="description" ></textarea>
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