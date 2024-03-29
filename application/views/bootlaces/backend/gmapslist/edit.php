
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a><i class="fa fa-map-marker" ></i> <?php echo $markers->markers_name ?><div class="btn-group pull-right"></a> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">    
								<button class="btn btn-danger btn-sm" data-title="Delete" data-toggle="modal" data-target="#del_<?php echo $markers->markers_id  ?>" data-placement="top" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button>	
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="maplist"> 
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
																
										<?php echo form_open('admin/maplist/edit/'.$markers->markers_id, array('class' => 'form-horizontal', 'id' => 'form_edit'.$markers->markers_id, 'name' => 'form_edit', 'role' => 'form' )); ?> 
										
											<fieldset>   
												<input class="form-control" type="text" name="markers_address" id="markers_address" value="<?php echo $markers->markers_address ?>" > 
												<div id="gmapsCanvas2" class="map" style="background-color:transparent;" ></div> 
												<script type="text/javascript"> 

													gmaps_update(<?php echo $markers->markers_lat  ?>, <?php echo $markers->markers_lng  ?>, 'gmapsCanvas2', 'markers_address');

												</script>	

												<div class="form-group"> 
													<label class="control-label col-md-2 col-lg-1" for="inputLat"><?php echo lang('lat'); ?></label>
													<div class="col-md-5 col-lg-5">	  
														<span class="form-control" id="show_lat"><?php echo $markers->markers_lat ?></span>
													</div> 		
													<label class="control-label col-md-2 col-lg-1" for="inputLng"><?php echo lang('lng'); ?></label>
													<div class="col-md-5 col-lg-5">	  
														 <span class="form-control" id="show_lng"><?php echo $markers->markers_lng ?></span>
													</div> 
												</div>
														
												<input type="hidden" name="markers_lat" id="markers_lat" value="<?php echo $markers->markers_lat ?>" > 
												<input type="hidden" name="markers_lng" id="markers_lng" value="<?php echo $markers->markers_lng ?>" >	 
											</fieldset> 		
											 
											<div class="btn-group">
												<input type="submit" name="submitEdit" id="submitEdit" class="btn btn-primary" value="<?php echo lang('save'); ?>" > </input>
											</div>	
											<div class="btn-group">
												<a href="<?php echo site_url('admin/maplist');?>" class="btn btn-default" > <?php echo lang('cancel'); ?></a>
											</div>	
											<div class="btn-group pull-right">
												<b><?php echo lang('pubdate'); ?>:</b>
												<time datetime="<?php echo $markers->pubDate; ?>"><?php echo $pubDate; ?></time> 
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
	
	<div class="modal fade" id="del_<?php echo $markers->markers_id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_maps_calendar'); ?></h4>
				</div> 
				<?php echo form_open('admin/maplist/del/'.$markers->markers_id, array('id' => 'form_del'.$markers->markers_id, 'name' => 'form_del'.$markers->markers_id, 'role' => 'form')); ?>   
				<div class="modal-body">
					<input name="markers_id" id="markers_id" value="<?php echo $markers->markers_id  ?>" type="hidden" >	
					<div class="alert alert-warning">
						<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('admin_modal_maps_calendar'); ?>  
							<?php if(empty($markers->markers_address)) : ?>
								<b><?php echo $markers->markers_name ?></b>?
							<?php else : ?>
								<b><?php echo $markers->markers_address ?></b>?
							<?php endif ?>
					</div>
				</div>
				<div class="modal-footer ">
					<button type="submit" name="submitDelete" class="btn btn-danger" ><i class="fa fa-trash"></i> <?php echo lang('yes'); ?></button>
					<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no'); ?></button>
				</div> 
				<?php echo form_close();	?>
			</div>
			<!-- /.modal-content --> 
		</div>
	  <!-- /.modal-dialog --> 
	</div>	 