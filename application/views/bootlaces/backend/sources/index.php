	
            <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a id="location" href=""><?php echo lang('sources_all_heading'); ?></a> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">
						    <div class="pull-right">  
						   
							</div> 
                        </div>
                    </div>
					<!-- /.page-bar -->
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sources"> 
								<div class="panel-title">
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
                                </div>							
                                <div class="panel-body">
								
									<!-- table --> 
									<div class="table-responsive">
										<div id="toolbar"> 
											<button class="btn btn-primary" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('sources_add_new'); ?></button>  
										</div>							
										<table class="sources_dataTable" id="sources_dataTable" data-toolbar="#toolbar" data-locale="<?php echo $lang ?>" >
											<thead>
												<tr> 
													<th data-field="source_name" data-align="right" data-sortable="true"><?php echo lang('name'); ?></th>
													<th data-field="source_url" data-align="left" data-sortable="true"><?php echo lang('url'); ?></th> 
													<th data-field="operate" data-sortable="false" data-formatter="operateFormatter" data-width="10%"><?php echo lang('edit'); ?></th>   
												</tr>
											</thead>
										</table> 
										<!-- /.table -->		
									</div>
						
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
 
		<?php foreach ($sources as $result): ?>		
			 <div class="modal fade" id="edit_<?php echo $result['source_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('sources_edit_source'); ?></h4>
					  </div>  
					<?php echo form_open('profile/sources/edit/'.$result['source_id'], array('id' => 'form_edit'.$result['source_id'], 'name' => 'form_edit', 'role' => 'form' )); ?>  
						<div class="modal-body">  
							<input type="hidden" name="source_id" id="source_id" value="<?php echo $result['source_id'] ?>">												 
							<div class="form-group">
								<input class="form-control" name="source_name" id="source_name" value="<?php echo $result['source_name'] ?>" >
							</div> 
							<div class="form-group">
								<textarea rows="3" name="source_url" id="source_url" class="form-control" ><?php echo $result['source_url'] ?></textarea>
							</div> 
						</div>
						<div class="modal-footer ">
							<div class="btn-group">
								<button type="submit" name="submitEdit" class="btn btn-primary" ><i class="fa fa-pencil"></i> <?php echo lang('ok'); ?></button>
							</div>	
							<div class="btn-group">
								<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
							</div>	

						</div> 
					<?php echo form_close(); ?>	
					</div>
					<!-- /.modal-content --> 
				  </div>
					  <!-- /.modal-dialog --> 
				</div>					
				
				<div class="modal fade" id="delete_<?php echo $result['source_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('sources_del_source'); ?></h4>
							</div>
						<?php echo form_open('profile/sources/del/'.$result['source_id'], array('id' => 'form_del'.$result['source_id'], 'name' => 'form_del', 'role' => 'form' )); ?> 
							<div class="modal-body">
								<input type="hidden" name="source_id" id="source_id" value="<?php echo $result['source_id'] ?>" >	
								<div class="alert alert-warning">
									<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('sources_delete_warning'); ?> <b><?php echo $result['source_name'] ?></b> <?php echo lang('source'); ?>?</div>
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
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('sources_add_new'); ?></h4>
					</div>
					
					<?php echo form_open('profile/sources/add', array('id' => 'form_add', 'name' => 'form_add', 'role' => 'form' )); ?> 
					
						<div class="modal-body"> 						 
							<div class="form-group">
								<input class="form-control" name="source_name" id="source_name" placeholder="<?php echo lang('sources_input_name'); ?>" >
							</div> 
							<div class="form-group">
								<textarea rows="3" name="source_url" id="source_url" class="form-control" placeholder="<?php echo lang('sources_input_url'); ?>" ></textarea>
							</div> 
						</div>
						<div class="modal-footer ">
							<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
							<button type="submit" name="submitAdd" class="btn btn-success" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('ok'); ?></button> 
						</div> 
						
					<?php echo form_close(); ?>	
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>	 
		
		
		<div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="change" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"><?php echo lang('profile_change_password') ?></h4>
					</div>
					
					<?php echo form_open('profile/user/change_password', array('id' => 'form_pass', 'name' => 'form_pass', 'role' => 'form' )); ?>  
					
						<div class="modal-body">
							<input name="user_id" id="user_id" value="<?php echo $userinfo->id; ?>" type="hidden" >	
							<div class="alert alert-warning">
								<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('profile_change_warning') ?>
									<?php if(empty($userinfo->first_name) && empty($userinfo->last_name)) : ?>
										<b><?php echo $userinfo->username  ?></b>
									<?php else : ?>
										<b><?php echo $userinfo->first_name  ?> <?php echo $userinfo->last_name  ?></b>
									<?php endif ?> 
								
								<?php echo lang('password') ?>
								
							</div>								 
							<div class="form-group"> 
								<div class="input-group col-md-12">
									<input type="password" name="old_password" id="old_password" class="form-control" placeholder="<?php echo lang('profile_change_old_password') ?>"  />
									 <?php echo form_error('old_password') ?>
								</div>
							</div>								
							<div class="form-group"> 
								<div class="input-group col-md-12">
									<input type="password" name="new_password" id="new_password" class="form-control" placeholder="<?php echo lang('profile_change_new_password') ?>"  />
									 <?php echo form_error('new_password') ?>
								</div>
							</div>									
							<div class="form-group"> 
								<div class="input-group col-md-12">
									<input type="password" name="new_password_confirm" id="new_password_confirm" class="form-control" placeholder="<?php echo lang('profile_change_new_password_confirm') ?>"  />
									 <?php echo form_error('profile_change_new_password_confirm') ?>
								</div>
							</div>
							
						</div>									
						<div class="modal-footer ">
							<button type="submit" name="submitChange" class="btn btn-success" ><i class="fa fa-key"></i> <?php echo lang('yes') ?></button>
							<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no') ?></button>
						</div>
					
					<?php echo form_close(); ?>	 
				</div>
				<!-- /.modal-content --> 
			</div>
		  <!-- /.modal-dialog --> 
		</div>					