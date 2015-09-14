 
	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo lang('categories_all_heading') ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->			
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-list fa-fw"></i>  
                            <div class="pull-right">
								 <div class="btn-group ">
									<button class="btn btn-primary btn-md" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('categories_add_new'); ?></button>
								 </div>    
                            </div>
							<!-- /.pull-right -->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">  
							<div class="table-responsive">
								<div id="toolbar"> 
									<button class="btn btn-danger" id="remove-data" data-method="remove" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button>   
								</div>	
								<table id="categories_dataTable" class="table" data-toolbar="#toolbar" >
									<thead>
										<tr> 
											<th data-field="chk" data-checkbox="true"></th>
											<th data-field="category_name" data-align="right" data-sortable="true"><?php echo lang('name'); ?></th>
											<th data-field="category_desc" data-align="left" data-sortable="true"><?php echo lang('description'); ?></th> 
											<th data-field="operate" data-sortable="false" data-formatter="operateFormatter" data-width="10%"><?php echo lang('edit'); ?></th>   
										</tr>
									</thead>
								</table>
								<!-- /.table -->		
							</div>
						</div>
						<!-- /.panel-body -->							
                    </div>
                    <!-- /.panel -->
                </div>
				<!-- /.col-md-12 /.col-lg-12 -->
			</div>
			<!-- /.row -->
	</div>
	<!-- /.page-wrapper -->

	<?php foreach ($categories as $result): ?>		
		<div class="modal fade" id="edit_<?php echo $result->category_id  ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('categories_edit_source'); ?></h4>
					</div>
					<form name="form_<?php echo $result->category_id  ?>" id="form_<?php echo $result->category_id  ?>" method="post" action="<?php echo site_url('profile/categories/edit') . '/';?><?php echo $result->category_id  ?>" >	
						<div class="modal-body">  
							<input name="category_id" id="category_id" value="<?php echo $result->category_id  ?>" type="hidden" >												 
							<div class="form-group">
								<label class="control-label" for="inputName"><?php echo lang('categories_input_name'); ?></label>
								<input class="form-control" name="category_name" id="category_name" value="<?php echo $result->category_name  ?>" >
							</div> 
							<div class="form-group">
								<label class="control-label" for="inputDesc"><?php echo lang('categories_input_description'); ?></label>
								<textarea rows="3" name="category_desc" id="category_desc" class="form-control" ><?php echo $result->category_desc  ?></textarea>
							</div> 
							<!-- Color select-->
							<div class="form-group">	
								<label class="control-label" for="inputBgColor"><?php echo lang('calendar_modal_colorbackground'); ?></label>	 
								<input type="text" name="category_bgcolor" id="category_bgcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#05b0dc" value="<?php echo $result->backgroundColor  ?>"> 
							</div>
							<!-- Color select-->
							<div class="form-group">	
								<label class="control-label" for="inputTxtColor"><?php echo lang('calendar_modal_colortext'); ?></label>
								<input type="text" name="category_color" id="category_color" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="<?php echo $result->textColor  ?>">  
							</div> 													
							<!-- Color select-->
							<div class="form-group">	
								<label class="control-label" for="inputBColor"><?php echo lang('calendar_modal_colorborder'); ?></label>	 
								<input type="text" name="category_bcolor" id="category_bcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="<?php echo $result->borderColor  ?>">	
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
					</form> 
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>					
		
		<div class="modal fade" id="delete_<?php echo $result->category_id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('categories_delete_category'); ?></h4>
			</div>
			<form name="form_<?php echo $result->category_id  ?>" id="form_<?php echo $result->category_id  ?>" method="post" action="<?php echo site_url('profile/categories/del') . '/';?><?php echo $result->category_id  ?>" >	

				<div class="modal-body">
					<input name="category_id" id="category_id" value="<?php echo $result->category_id  ?>" type="hidden" >	
					<div class="alert alert-warning">
						<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('profile_delete_warning'); ?> <b><?php echo $result->category_name  ?></b> <?php echo lang('records'); ?>?</div>
					</div>
				<div class="modal-footer ">
					<button type="submit" name="submitDelete" class="btn btn-danger" ><i class="fa fa-trash"></i> <?php echo lang('yes'); ?></button>
					<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no'); ?></button>
				</div>
			
			</form> 
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
				<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('categories_add_new'); ?></h4>
			</div>
			<form name="form_add" id="form_add" method="post" action="<?php echo site_url('profile/categories/add'); ?>" >	

				<div class="modal-body">
				 
					<div class="modal-body">  
																	 
						<div class="form-group">
							<label class="control-label" for="inputName"><?php echo lang('categories_input_name'); ?></label>
							<input class="form-control" name="category_name" id="category_name" placeholder="<?php echo lang('categories_input_name'); ?>" >
						</div> 
						<!-- textarea select-->
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
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" > <?php echo lang('cancel'); ?></button>
					<button type="submit" name="submitAdd" class="btn btn-success" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('ok'); ?></button> 
				</div>
			
			</form> 
			</div>
		<!-- /.modal-content --> 
		</div>
		  <!-- /.modal-dialog --> 
	</div>	 
				

 