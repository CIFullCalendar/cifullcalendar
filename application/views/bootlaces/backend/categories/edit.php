
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-file-o" ></i> <?php echo  $editcategory->category_name ?> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">   
								<button class="btn btn-danger btn-sm" data-title="Delete" data-toggle="modal" data-target="#del_<?php echo $editcategory->category_id  ?>" data-placement="top" ><i class="fa fa-trash"></i> <?php echo lang('delete') ?></button>
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pages"> 
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
										<?php echo form_open('calendar/categories/edit/'.$editcategory->category_id, array('id' => 'form_edit', 'name' => 'form_edit', 'role' => 'form' )); ?>  
											<div class="modal-body">   
												 											
												<div class="form-group">
													<label class="control-label" for="inputName"><?php echo lang('categories_input_name'); ?></label>
													<input class="form-control" name="category_name" id="category_name" value="<?php echo $editcategory->category_name ?>" >
												</div> 
												<div class="form-group">
													<label class="control-label" for="inputDesc"><?php echo lang('categories_input_description'); ?></label>
													<textarea rows="3" name="category_desc" id="category_desc" class="form-control" ><?php echo $editcategory->category_desc ?></textarea>
												</div> 
												<!-- Color select-->
												<div class="form-group">	
													<label class="control-label" for="inputBgColor"><?php echo lang('calendar_modal_colorbackground'); ?></label>	 
													<input type="text" name="category_bgcolor" id="category_bgcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#05b0dc" value="<?php echo $editcategory->backgroundColor ?>"> 
												</div>
												<!-- Color select-->
												<div class="form-group">	
													<label class="control-label" for="inputTxtColor"><?php echo lang('calendar_modal_colortext'); ?></label>
													<input type="text" name="category_color" id="category_color" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="<?php echo $editcategory->textColor ?>">  
												</div> 													
												<!-- Color select-->
												<div class="form-group">	
													<label class="control-label" for="inputBColor"><?php echo lang('calendar_modal_colorborder'); ?></label>	 
													<input type="text" name="category_bcolor" id="category_bcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="<?php echo $editcategory->borderColor ?>">	 
												</div>	 
											</div>
											<div class="modal-footer ">
												<div class="btn-group"> 
													<input type="submit" name="submitEdit" class="btn btn-primary" value="<?php echo lang('save') ?>" />
												</div>	
												<div class="btn-group"> 
													<input type="submit" name="submitCancel" class="btn btn-default" value="<?php echo lang('cancel') ?>" /> 
												</div>	 
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
	
	<div class="modal fade" id="del_<?php echo $editcategory->category_id ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('categories_delete_category'); ?></h4>
			</div>  
			<?php echo form_open('calendar/categories/del/'.$editcategory->category_id, array('id' => 'form_del', 'name' => 'form_del', 'role' => 'form' )); ?>  
			<div class="modal-body"> 
				<div class="alert alert-warning">
					<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('profile_delete_warning'); ?> <b><?php echo $editcategory->category_name ?></b> <?php echo lang('records'); ?>?</div>
			</div>
			<div class="modal-footer ">
				<button type="submit" name="submitDelete" class="btn btn-danger" ><i class="fa fa-trash"></i> <?php echo lang('yes'); ?></button>
				<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no'); ?></button>
			</div> 
			<?php echo form_close(); ?>	 
		</div>
		<!-- /.modal-content --> 
	  </div>
	  <!-- /.modal-dialog --> 
	</div>	