 
	<div id="page-wrapper"> 
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-group" ></i> <?php echo lang('edit_group_title') ?></h1>
			</div>
			<!-- /.col-lg-12 -->		
		</div>
		<!-- /.row -->			
		<div class="row">
			<div class="col-md-12 col-lg-12"> 
				 
				<?php echo form_open('admin/group/edit/'.$group->id, array('id' => 'form_edit'.$group->id, 'name' => 'form_edit'.$group->id, 'role' => 'form' )); ?>   
					<div class="container-fluid">
						<div class="row-fluid"> 
							<div class="col-md-12"> 		 
								<div class="form-group">
									<input type="text" class="form-control" name="group_name" id="group_name" value="<?php echo set_value('group_name',$group->name) ?>" placeholder="<?php echo lang('edit_group_name_label'); ?>" <?php echo $readonly; ?>>
								</div> 								
								<div class="form-group">
									<input type="text" class="form-control" name="description" id="description" value="<?php echo set_value('description',$group->description) ?>" placeholder="<?php echo lang('edit_group_desc_label'); ?>">
								</div> 							 																	
							</div>  
						</div>
						<div class="row-fluid">
							<div class="btn-group">
								<button type="submit" name="submitEdit" class="btn btn-primary" ><i class="fa fa-pencil"></i> <?php echo lang('ok'); ?></button>
							</div>	
							<div class="btn-group">
								<a href="<?php echo site_url('admin/group');?>" class="btn btn-default" > <?php echo lang('cancel'); ?></a>
							</div> 
						</div>
					</div>   
				<?php echo form_close(); ?> 
				
				<label class="alert"> 
					 <?php echo $message ?> 
				</label>				
				
			</div>
			<!-- /.col-md-12 .col-lg-12 -->				
		</div>
		<!-- /.row -->  
   </div>
    <!-- /#wrapper -->  