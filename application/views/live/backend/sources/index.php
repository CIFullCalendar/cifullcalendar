
	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo lang('sources_all_heading'); ?> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
 
			
			
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-link fa-fw"></i> 
                            <div class="pull-right"> 
								<div class="btn-group ">
									<button class="btn btn-primary btn-md" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('sources_add_new'); ?></button>
								</div>     
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"> 
							<!-- table --> 
							<table id="table-pagination" class="sources_dataTable" >
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
						<!-- /.panel-body -->							
                    </div>
                    <!-- /.panel -->
                </div>
				<!-- /.col-md-12 /.col-lg-12 -->
			</div>
			<!-- /.row -->
	</div>
	<!-- /.page-wrapper -->

 
		<?php foreach ($sources as $result): ?>		
			 <div class="modal fade" id="edit_<?php echo $result->source_id  ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('sources_edit_source'); ?></h4>
					  </div>
						<form name="form_<?php echo $result->source_id  ?>" id="form_<?php echo $result->source_id  ?>" method="post" action="<?php echo site_url('profile/sources/edit') . '/';?><?php echo $result->source_id  ?>" >	
							<div class="modal-body">  
								<input name="source_id" id="source_id" value="<?php echo $result->source_id  ?>" type="hidden" >												 
								<div class="form-group">
									<input class="form-control" name="source_name" id="source_name" value="<?php echo $result->source_name  ?>" >
								</div> 
								<div class="form-group">
									<textarea rows="3" name="source_url" id="source_url" class="form-control" ><?php echo $result->source_url  ?></textarea>
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
				
				<div class="modal fade" id="delete_<?php echo $result->source_id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('sources_del_source'); ?></h4>
							</div>
							
							<form name="form_<?php echo $result->source_id  ?>" id="form_<?php echo $result->source_id  ?>" method="post" action="<?php echo site_url('profile/sources/del') . '/';?><?php echo $result->source_id  ?>" >	

								<div class="modal-body">
									<input name="source_id" id="source_id" value="<?php echo $result->source_id  ?>" type="hidden" >	
									<div class="alert alert-warning">
										<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('sources_delete_warning'); ?> <b><?php echo $result->source_name  ?></b> <?php echo lang('source'); ?>?</div>
									</div>
								<div class="modal-footer ">
									<button type="submit" name="submitDelete" class="btn btn-danger" ><i class="fa fa-trash"></i> <?php echo lang('yes'); ?></button>
									<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no'); ?></button>
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
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('sources_add_new'); ?></h4>
					</div>
					<form name="form_add" id="form_add" method="post" action="<?php echo site_url('profile/sources/add');?>" >	 
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
					</form> 
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>	 