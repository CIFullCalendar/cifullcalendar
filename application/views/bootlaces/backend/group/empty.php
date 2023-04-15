        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a><i class="fa fa-map-marker" ></i> <?php echo lang('queues') ?></a> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">  
								<button class="btn btn-primary btn-xs" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i>  <?php echo lang('add') ?></button> 		
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" queuelist"> 
								<div class="panel-title">
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
                                </div>							
                                <div class="panel-body">
									<div class="row">
										<div class="col-md-12 col-lg-12">  		
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
					<h4 class="modal-title custom_align" id="heading"> <?php echo lang('create_group_title'); ?></h4>
				</div> 
				<?php echo form_open('admin/group/add', array('id' => 'form_add', 'name' => 'form_add', 'role' => 'form'));	?> 
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
				<?php echo form_close();	?> 
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>
 