            <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a id="location" href=""><?php echo lang('categories_all_heading'); ?></a> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">
						   <div class="pull-right">
								<div class="btn-group ">
									<button class="btn btn-primary btn-md" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('add'); ?></button>
								</div>						   
							</div> 
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit"> 
								<div class="portlet-title">
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
                                </div>							
                                <div class="portlet-body">
									<div class="alert alert-warning">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
											×</button>
										<span class="fa fa-warning"></span> <strong><?php echo lang('categories_message_title'); ?></strong>
										<hr class="message-inner-separator">
										<p>
											<?php echo lang('categories_message_warning'); ?> </p>
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
		
 

	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('categories_add_new'); ?></h4>
				</div> 
				<?php echo form_open('profile/categories/add', array('id' => 'form_add', 'name' => 'form_add', 'role' => 'form' )); ?>  
				<div class="modal-body">  				 
					<div class="form-group">
						<label class="control-label" for="inputName"><?php echo lang('categories_input_name'); ?></label>
						<input class="form-control" name="category_name" id="category_name" placeholder="<?php echo lang('categories_input_name'); ?>" >
					</div> 
					<!-- textarea -->
					<div class="form-group">
						<label class="control-label" for="inputDesc"><?php echo lang('categories_input_description'); ?></label>
						<textarea rows="3" name="category_desc" id="category_desc" class="form-control" placeholder="<?php echo lang('categories_input_description'); ?>" ></textarea>
					</div> 
					<!-- Color select-->
					<div class="form-group">	
						<label class="control-label" for="inputBgColor"><?php echo lang('calendar_modal_colorbackground'); ?></label>	 
						<input type="text" name="category_bgcolor" id="category_bgcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#05b0dc" value="#05b0dc"> 
					</div>
					<!-- Color select-->
					<div class="form-group">	
						<label class="control-label" for="inputTxtColor"><?php echo lang('calendar_modal_colortext'); ?></label>
						<input type="text" name="category_color" id="category_color" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="#FFFFFF"> 
					</div> 												
					<!-- Color select-->
					<div class="form-group">	
						<label class="control-label" for="inputBColor"><?php echo lang('calendar_modal_colorborder'); ?></label>	 
						<input type="text" name="category_bcolor" id="category_bcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="#FFFFFF">	
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