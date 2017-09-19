
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
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
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
												<label class="alert"> 
													 <?php echo $message ?> 
												</label>	
												
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