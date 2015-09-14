	
	
	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo lang('locations_all_heading'); ?> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row --> 
			
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <i class="fa fa-location-arrow fa-fw"></i> 
                            <div class="pull-right">
							
								<div class="btn-group "> 
									<select class="form-control btn-sm" id="marker_category" name="marker_category">
										<option value="undefined"><?php echo lang('submenu_select_categories'); ?></option>
									</select> 
								</div>
 
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"> 
							 <div id="gmapsCanvas2" style="height: 400px; width: 100%"></div> 
                        </div>
                        <!-- /.panel-body -->
                    </div>
           
                </div> 
				<!-- /.col-md-12 .col-lg-12 -->
			</div>
            <!-- /.row -->
 