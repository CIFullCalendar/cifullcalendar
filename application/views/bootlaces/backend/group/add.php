
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