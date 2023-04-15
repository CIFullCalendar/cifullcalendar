			
			<div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
								<a id="categories" href="#categories"><?php echo lang('categories_all_heading') ?></a>  
                            </li> 
                        </ul>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                            
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="categories"> 
								<div class="panel-title">
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
                                </div>							
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12"> 
											<div class="table-responsive">
												<div id="toolbar"> 
													<button class="btn btn-danger" id="remove-data" data-method="remove" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button> 
													<button class="btn btn-primary btn-md" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('categories_add_new'); ?></button>
												</div>	
												<table id="categories_dataTable" class="table" data-toolbar="#toolbar" data-locale="<?php echo $lang ?>" >
													<thead>
														<tr> 
															<th data-field="chk" data-checkbox="true"></th> 
															<th data-field="category_name" data-align="right" data-sortable="true" data-width="20%"><?php echo lang('name'); ?></th>
															<th data-field="category_desc" data-align="left" data-sortable="true"  ><?php echo lang('description'); ?></th>  
															<th data-field="operate" data-sortable="false" data-formatter="operateFormatter" data-width="2%"><?php echo lang('edit'); ?></th>   
														</tr>
													</thead>
												</table>
												<!-- /.table -->		
											</div>
                                        </div>
										<!-- /.col-md-12 .col-lg-12 -->	
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
					<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
					<input type="submit" name="submitAdd" class="btn btn-primary" value="<?php echo lang('save') ?>" /> 
				</div> 
			<?php echo form_close(); ?>	 
			</div>
			<!-- /.modal-content --> 
		</div>
		  <!-- /.modal-dialog --> 
	</div>	 
	  