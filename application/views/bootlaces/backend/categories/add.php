	<div class="page-content-wrapper"> 
			
		<div class="page-content"> 
		
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li> 
						<a><i class="fa fa-file" ></i> <?php echo lang('categories_add_new') ?></a>
					</li> 
				</ul>
				<div class="page-toolbar">   
					<div class="btn-group pull-right">  
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
									<?php echo form_open('calendar/categories/add', array('id' => 'form_add', 'name' => 'form_add', 'role' => 'form' )); ?>  
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
										<div class="btn-group"> 
											<input type="submit" name="submitAdd" class="btn btn-primary" value="<?php echo lang('save') ?>" />
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