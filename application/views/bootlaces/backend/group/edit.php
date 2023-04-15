
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a><i class="fa fa-group" ></i> <?php echo lang('edit_group_title') ?></a> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right"> 
								<?php if(empty($readonly)) : ?><button class="btn btn-danger btn-sm" data-title="Delete" data-toggle="modal" data-target="#del_<?php echo $group->id  ?>" data-placement="top" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button><?php endif ?>							
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel"> 
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
										
											<?php echo form_open('admin/group/edit/'.$group->id, array('id' => 'form_edit'.$group->id, 'name' => 'form_edit'.$group->id, 'role' => 'form' )); ?>   	 
												<div class="form-group">
													<input type="text" class="form-control" name="group_name" id="group_name" value="<?php echo set_value('group_name',$group->name) ?>" placeholder="<?php echo lang('edit_group_name_label'); ?>" <?php echo $readonly; ?>>
												</div> 								
												<div class="form-group">
													<input type="text" class="form-control" name="description" id="description" value="<?php echo set_value('description',$group->description) ?>" placeholder="<?php echo lang('edit_group_desc_label'); ?>">
												</div> 	 
												<div class="btn-group">
													<button type="submit" name="submitEdit" class="btn btn-primary" ><i class="fa fa-pencil"></i> <?php echo lang('ok'); ?></button>
												</div>	
												<div class="btn-group">
													<a href="<?php echo site_url('admin/group');?>" class="btn btn-default" > <?php echo lang('cancel'); ?></a>
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
	
	<?php if(empty($readonly)) : ?>
	<div class="modal fade" id="del_<?php echo $group->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="heading"> <?php echo lang('admin_modal_delete_user'); ?></h4>
				</div>			
				<?php echo form_open('admin/group/del/'.$group->id, array('id' => 'form_del'.$group->id, 'name' => 'form_del'.$group->id, 'role' => 'form' )); ?>   
				<div class="modal-body">
					<input name="id" id="id" value="<?php echo $group->id  ?>" type="hidden" >	
					<div class="alert alert-warning">
						<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('admin_modal_delete_user'); ?>  
						<b><?php echo $group->name ?></b>? 
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
	<?php endif ?>