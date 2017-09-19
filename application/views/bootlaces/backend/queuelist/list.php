
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a><i class="fa fa-map-marker" ></i> <?php echo lang('queues') ?></a> 
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">  
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" queuelist"> 
								<div class="panel-title">
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
                                </div>							
                                <div class="panel-body">
									<div class="row">
										<div class="col-md-12 col-lg-12"> 
											<div class="table-responsive">
												<div id="toolbar"> 
													<button class="btn btn-success" id="approve-data" data-method="remove" ><i class="fa fa-check"></i> <?php echo lang('approve'); ?></button>   
													<button class="btn btn-danger" id="remove-data" data-method="remove" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button>   
												</div>							
												<table id="queues_dataTable" class="table" data-toolbar="#toolbar" data-show-export="true" data-locale="<?php echo $lang ?>" >
													<thead>
														<tr> 
															<th data-field="chk" data-checkbox="true"></th>
															<th data-field="username" data-align="center" data-sortable="true" data-width="15%"><?php echo lang('admin_table_username'); ?></th>
															<th data-field="title" data-align="left" data-sortable="true" data-width="25%"><?php echo lang('admin_table_event_title'); ?></th> 
															<th data-field="start" data-align="left" data-sortable="true" ><?php echo lang('admin_table_event_start'); ?></th> 
															<th data-field="end" data-align="left" data-sortable="true"><?php echo lang('admin_table_event_end'); ?></th> 
															<th data-field="allDay" data-align="left" data-sortable="true" data-formatter="alldayFormatter" ><?php echo lang('admin_table_event_allday'); ?></th> 
															<th data-field="auth" data-align="left" data-sortable="true" data-formatter="authFormatter" ><?php echo lang('admin_table_event_type'); ?></th> 
															<th data-field="edit" data-sortable="false" data-formatter="editFormatter" data-width="7%"><?php echo lang('admin_table_edit'); ?></th>   
														</tr>
													</thead>
												</table>
												<!-- /.table --> 
											</div>
											<!-- /.table-responsive -->		
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
		  
	
	<?php foreach ($alleventsqueues as $result): ?>		 
		<div class="modal fade" id="del_<?php echo $result['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('calendar_delete_event'); ?></h4>
					</div>
					
					<?php echo form_open('admin/queuelist/del/'.$result['id'] , array('id' => 'form_del'.$result['id'], 'name' => 'form_del', 'role' => 'form' )); ?>   

					<div class="modal-body">
						<div class="alert alert-warning">
							<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('calendar_delete_warning'); ?>  
							<b><?php echo $result['title'] ?></b>? 
						</div>							
					</div>
					<div class="modal-footer ">
						<button type="submit" name="submitDelete" class="btn btn-danger" ><i class="fa fa-trash"></i> <?php echo lang('yes'); ?></button>
						<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no'); ?></button>
					</div>
					
					<?php echo form_close(); ?> 
				</div>
				<!-- /.modal-content --> 
			</div>
		  <!-- /.modal-dialog --> 
		</div>	 
	<?php endforeach ?>	 