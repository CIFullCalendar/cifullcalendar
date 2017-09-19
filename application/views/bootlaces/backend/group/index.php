
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li> 
								<a><i class="fa fa-group" ></i> <?php echo lang('groups') ?></a>
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">  
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" group"> 
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
 
	
	<?php foreach ($allgroups as $result): ?> 
		<div class="modal fade" id="del_<?php echo $result->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="heading"> <?php echo lang('admin_modal_delete_user'); ?></h4>
					</div>			
					<?php echo form_open('admin/group/del/'.$result->id, array('id' => 'form_del'.$result->id, 'name' => 'form_del'.$result->id, 'role' => 'form' )); ?>   
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
					<?php echo form_close(); ?>
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
				<?php echo form_open('admin/group/add', array('id' => 'form_add', 'name' => 'form_add', 'role' => 'form' )); ?>  
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
				<?php echo form_close(); ?>
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>