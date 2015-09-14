 
<div id="page-wrapper"> 
	<div class="row"> 
		<div class="col-md-12 col-lg-12">

			<div class="row">
				<h3 class="page-header"> <a href="<?php echo site_url('page/title').'/'.$pageinfo->seo; ?>" target="_blank" ><?php echo  $pageinfo->title ?></a>
					<div class="btn-group pull-right">
						<button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#del_<?php echo $pageinfo->id  ?>" data-placement="top" ><i class="fa fa-trash"></i> <?php echo lang('delete') ?></button>
					</div> 	
				</h3>
					
				<div class="col-lg-12 col-md-12">
			
					<form class="form-horizontal" name="form" id="form" method="post" action="<?php echo site_url('admin/pages/edit') . '/';?><?php echo $pageinfo->id  ?>" >
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
							
							<label><?php echo lang('pages_access') ?></label>
							<select class="form-control" name="access" id="access" >
								<option value="2" <?php if($pageinfo->access == 2){ echo "SELECTED";}?> ><?php echo lang('pages_access_admins'); ?></option>	
								<option value="1" <?php if($pageinfo->access == 1){ echo "SELECTED";}?> ><?php echo lang('pages_access_members'); ?></option>									
								<option value="0" <?php if($pageinfo->access == 0){ echo "SELECTED";}?> ><?php echo lang('pages_access_visitors'); ?></option> 							
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
										
					</form> 
				</div>
				<!-- /.col-lg-12 -->
			</div>
		
		</div>
		<!-- /.col-md-12 .col-lg-12 -->	  
		</div>
		<!-- /.row --> 
	
				<div class="modal fade" id="del_<?php echo $pageinfo->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_delete_calendar'); ?></h4>
							</div>
							
							<form name="form_<?php echo $pageinfo->id  ?>" id="form_<?php echo $pageinfo->id  ?>" method="post" action="<?php echo site_url('admin/pages/del') . '/'. $pageinfo->id;?>" >	

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
							
							</form> 
						</div>
				<!-- /.modal-content --> 
					</div>
				  <!-- /.modal-dialog --> 
				</div>	 
				
   </div>
    <!-- /#wrapper --> 
	
		