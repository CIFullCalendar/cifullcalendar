 	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-list fa-fw"></i> <?php echo lang('categories_all_heading'); ?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row --> 
			
            <div class="row">
                <div class="col-md-12 col-lg-12">  
				
					<div class="table-responsive">
						<div id="toolbar"> 
							<button class="btn btn-danger" id="remove-data" data-method="remove" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button> 
							<button class="btn btn-primary btn-md" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('categories_add_new'); ?></button>
						</div>	
						<table id="categories_dataTable" class="table" data-toolbar="#toolbar" data-locale="<?php echo $lang ?>" >
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
				<!-- /.col-md-12 --> 
			</div>
		  <!-- /.modal-dialog --> 
	</div>
	<!-- /.page-wrapper -->


	<?php foreach ($categories as $result): ?>		
		<div class="modal fade" id="edit_<?php echo $result['category_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('categories_edit_source'); ?></h4>
					</div> 
					
					<?php echo form_open('profile/categories/edit/'.$result['category_id'], array('id' => 'form_edit'.$result['category_id'], 'name' => 'form_edit', 'role' => 'form' )); ?> 
						
						<div class="modal-body">  
							<input name="category_id" id="category_id" value="<?php echo $result['category_id']  ?>" type="hidden" >												 
							<div class="form-group">
								<label class="control-label" for="inputName"><?php echo lang('categories_input_name'); ?></label>
								<input class="form-control" name="category_name" id="category_name" value="<?php echo $result['category_name'] ?>" >
							</div> 
							<div class="form-group">
								<label class="control-label" for="inputDesc"><?php echo lang('categories_input_description'); ?></label>
								<textarea rows="3" name="category_desc" id="category_desc" class="form-control" ><?php echo $result['category_desc'] ?></textarea>
							</div> 
							<!-- Color select-->
							<div class="form-group">	
								<label class="control-label" for="inputBgColor"><?php echo lang('calendar_modal_colorbackground'); ?></label>	 
								<input type="text" name="category_bgcolor" id="category_bgcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#05b0dc" value="<?php echo $result['backgroundColor'] ?>"> 
							</div>
							<!-- Color select-->
							<div class="form-group">	
								<label class="control-label" for="inputTxtColor"><?php echo lang('calendar_modal_colortext'); ?></label>
								<input type="text" name="category_color" id="category_color" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="<?php echo $result['textColor'] ?>">  
							</div> 													
							<!-- Color select-->
							<div class="form-group">	
								<label class="control-label" for="inputBColor"><?php echo lang('calendar_modal_colorborder'); ?></label>	 
								<input type="text" name="category_bcolor" id="category_bcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="<?php echo $result['borderColor'] ?>">	
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
		
		<div class="modal fade" id="delete_<?php echo $result['category_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('categories_delete_category'); ?></h4>
				</div>  
				<?php echo form_open('profile/categories/del/'.$result['category_id'], array('id' => 'form_del'.$result['category_id'], 'name' => 'form_del', 'role' => 'form' )); ?>  
				<div class="modal-body">
					<input name="category_id" id="category_id" value="<?php echo $result['category_id'] ?>" type="hidden" >	
					<div class="alert alert-warning">
						<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('profile_delete_warning'); ?> <b><?php echo $result['category_name'] ?></b> <?php echo lang('records'); ?>?</div>
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
		 
	<?php endforeach ?>	 	


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