 
	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo lang('maps'); ?> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row --> 
			
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-map-marker" ></i> <?php echo lang('maps') ?>
                        </div> 
						 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
 
								<div class="alert alert-warning">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
										×</button>
									<span class="glyphicon glyphicon-record"></span> <strong><?php echo lang('sources_message_title'); ?></strong>
									<hr class="message-inner-separator">
									<p>
										<?php echo lang('sources_message_warning'); ?> </p>
								</div>
 
                        </div>
                        <!-- /.panel-body -->
                    </div>
           
                </div>
                <!-- /.col-lg-8 -->
			</div> 
 
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
 