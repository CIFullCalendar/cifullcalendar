 
	<div id="page-wrapper"> 
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-exchange" ></i> <?php echo lang('sessions') ?> </h1>
			</div>
			<!-- /.col-lg-12 -->		
		</div>
		<!-- /.row -->			
		<div class="row">
			<div class="col-md-12 col-lg-12">  
				<div class="table-responsive">
					<div id="toolbar"> 
						<button class="btn btn-danger" id="remove-data" data-method="remove" ><i class="fa fa-times"></i> <?php echo lang('admin_remove_session'); ?></button>   
					</div>							
					<table id="allsessions_dataTable" class="table" data-toolbar="#toolbar" data-show-export="true" data-locale="<?php echo $lang ?>" >
						<thead>
							<tr> 
								<th data-field="chk" data-checkbox="true"></th>
								<th data-field="timestamp" data-align="left" data-formatter="timestampFormatter" data-sortable="true" data-width="20%" ><?php echo lang('admin_table_timestamp'); ?></th>  
								<th data-field="ip_address" data-align="center" data-sortable="true" data-width="15%"><?php echo lang('admin_table_ipaddress'); ?></th>
								<th data-field="user_agent" data-align="left" data-sortable="true" ><?php echo lang('admin_table_uagent'); ?></th>  
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