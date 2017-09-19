	<div class="page-content-wrapper"> 
			
		<div class="page-content"> 
		
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li> 
						<a><i class="fa fa-file" ></i> <?php echo lang('add') ?> <?php echo lang('pages') ?></a>
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
							<div class="caption"> 
								<span class="">&nbsp;</span>
							</div>
						</div>							
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-lg-12"> 
								 
									<?php echo form_open('admin/pages/add', array('class' => 'form-horizontal', 'id' => 'form_add', 'name' => 'form_add', 'role' => 'form' )); ?> 
									
										<div class="form-group">
											<input class="form-control" type="text" name="title" id="title" placeholder="<?php echo lang('page_title'); ?>"/>
											<p class="help-block"><?php echo form_error('title'); ?></p>							
											<textarea cols="40" rows="10" class="jqtextarea" name="content" id="txtarea" style="width:100%;" > </textarea>
											<p class="help-block"><?php echo form_error('content'); ?></p> 
											<div style="border-top: 1px #CCC dashed; margin-top: 5px; padding-top: 3px;"></div>	
										</div>	
											
										<div class="form-group">
											
											<label><?php echo lang('pages_meta_keywords') ?></label>
											<input class="form-control" type="text" name="meta_keywords" id="meta_keywords" placeholder="<?php echo lang('page_meta_keywords');?>" />
											<p class="help-block"><?php echo form_error('meta_keywords'); ?></p>
											
											<label><?php echo lang('pages_meta_description') ?></label>
											<input class="form-control" type="text" name="meta_description" id="meta_description" placeholder="<?php echo lang('page_meta_description');?>" />
											<p class="help-block"><?php echo form_error('meta_description'); ?></p>		
											
											<label for="inputShareit"><?php echo lang('pages_access'); ?></label> 
											<select class="form-control" name="access" id="access">	   
												<?php foreach ($groups as $group):?>  
												<option id="<?php echo $group['id'];?>" value="<?php echo $group['id'];?>" ><?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></option> 
												<?php endforeach ?> 	
												<option id="0" value="0" ><?php echo lang('pages_access_visitors'); ?></option>  
											</select> 	
											<p class="help-block"><?php echo form_error('access'); ?></p>								
											<div style="border-top: 1px #CCC dashed; margin-top: 5px; padding-top: 3px;"></div>	 
										</div> 	 		
										<div class="form-group">
											<div class="btn-group"> 
												<input type="submit" class="btn btn-primary" id="button" name="page_submit" value="<?php echo lang('save') ?>" />
											</div> 						
											<div class="btn-group">
												<input type="submit" class="btn" id="button" name="page_cancel" value="<?php echo lang('cancel') ?>" /> 
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