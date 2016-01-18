 
	<div id="page-wrapper"> 
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-file-o" ></i> <?php echo lang('page_header') ?></h1>
			</div>
			<!-- /.col-lg-12 -->		
		</div>
		<!-- /.row -->	
		<div class="row">
			<div class="col-md-12 col-lg-12">  
				<div class="table-responsive">
					<div id="toolbar"> 
						<button class="btn btn-danger" id="remove-data" data-method="remove" ><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></button>  
						<a href="<?php echo site_url('admin/pages/add') ?>" class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('add') ?></a> 								
					</div>	
					<table id="pages_dataTable" class="table" data-toolbar="#toolbar" >
						<thead>
							<tr> 
								<th data-field="chk" data-checkbox="true"></th>
								<th data-field="uname" data-align="right" data-sortable="true" data-width="15%" ><?php echo lang('page_username'); ?></th>
								<th data-field="title" data-align="left" data-sortable="true"><?php echo lang('page_title'); ?></th> 
								<th data-field="pubdates" data-align="left" data-sortable="true" data-formatter="timestampFormatter" data-width="20%"><?php echo lang('pubdate'); ?></th> 
								<th data-field="operate" data-sortable="false" data-formatter="operateFormatter" data-width="10%"><?php echo lang('edit'); ?></th>   
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
    <!-- /#wrapper --> 
	
	<?php foreach ($allpages as $result): ?>		
	 
		<div class="modal fade" id="del_<?php echo $result->id  ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('admin_modal_delete_calendar'); ?></h4>
					</div>
					
					<form name="form_<?php echo $result->id  ?>" id="form_<?php echo $result->id  ?>" method="post" action="<?php echo site_url('admin/pages/del') . '/'. $result->id;?>" >	

						<div class="modal-body">
							<div class="alert alert-warning">
								<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('admin_modal_delete_calendar'); ?>  
								<b><?php echo $result->title  ?></b>? 
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
	<?php endforeach ?>	 