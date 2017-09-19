
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-file-o" ></i> <a href="<?php echo site_url('page/title').'/'.$pageinfo->seo; ?>" target="_blank" ><?php echo  $pageinfo->title ?></a>
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">   
								<button class="btn btn-danger btn-sm" data-title="Delete" data-toggle="modal" data-target="#del_<?php echo $pageinfo->id  ?>" data-placement="top" ><i class="fa fa-trash"></i> <?php echo lang('delete') ?></button>
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
										 
											<?php echo form_open('admin/pages/edit/'.$pageinfo->id, array('class' => 'form-horizontal', 'id' => 'form_edit'.$pageinfo->id, 'name' => 'form_edit', 'role' => 'form' )); ?> 
											
												<div class="form-group">
													<input class="form-control" type="text" name="title" id="title" value="<?php echo set_value('title',$pageinfo->title); ?>"/>
													<p class="help-block"><?php echo form_error('title'); ?></p>							
													<textarea cols="40" rows="10" class="jqtextarea" name="content" id="txtarea" style="width:100%;" ><?php echo set_value('content',$pageinfo->content) ?></textarea>
													<small><a href="<?php echo site_url('page/title').'/'.$pageinfo->seo; ?>" target="_blank" ><?php echo base_url('page/title').'/'.$pageinfo->seo; ?></a></small>
													<div style="border-top: 1px #CCC dashed; margin-top: 5px; padding-top: 3px;"></div>	
												</div>	
													
												<div class="form-group">
													
													<label><?php echo lang('pages_meta_keywords') ?></label>
													<input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?php echo set_value('meta_keywords', $pageinfo->meta_keywords); ?>"/>
													<p class="help-block"><?php echo form_error('meta_keywords'); ?></p>
													
													<label><?php echo lang('pages_meta_description') ?></label>
													<input class="form-control" type="text" name="meta_description" id="meta_description" value="<?php echo set_value('meta_description', $pageinfo->meta_description); ?>"/>
													<p class="help-block"><?php echo form_error('meta_description'); ?></p>		
													
													<label for="inputShareit"><?php echo lang('pages_access'); ?></label> 
													<select class="form-control" name="access" id="access">	 
													   <?php $selected = null; if ($pageinfo->access == 0) {$selected = 'selected';} ?>
														<option id="0" value="0" <?php echo $selected;?>><?php echo lang('pages_access_visitors'); ?></option>  
														<?php foreach ($groups as $group):?> 
														<?php $selected3 = null; if ($group['id'] == $pageinfo->access) {$selected3 = 'selected';} ?>
														<option id="<?php echo $group['id'];?>" value="<?php echo $group['id'];?>" <?php echo $selected3;?>><?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></option> 
														<?php endforeach ?> 	  
													</select> 		
													<p class="help-block"><?php echo form_error('access'); ?></p>	
													<label><?php echo lang('pubdate'); ?></label>
													<time datetime="<?php echo $pageinfo->pubdates; ?>"><?php echo $pubdate; ?></time> 
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
	
	<div class="modal fade" id="del_<?php echo $pageinfo->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_delete_calendar'); ?></h4>
				</div> 	
				<?php echo form_open('admin/pages/del/'.$pageinfo->id, array('id' => 'form_del'.$pageinfo->id, 'name' => 'form_del', 'role' => 'form' )); ?> 
						
				<div class="modal-body">
					<div class="alert alert-warning">
						<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('admin_modal_delete_calendar'); ?>  
						<b><?php echo $pageinfo->title  ?></b>? 
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