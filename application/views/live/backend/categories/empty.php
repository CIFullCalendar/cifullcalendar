 
	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo lang('categories_all_heading'); ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
  
			
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-list fa-fw"></i>  
                            <div class="pull-right">
								<div class="btn-group ">
									<button class="btn btn-primary btn-md" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" ><i class="fa fa-pencil-square-o"></i> <?php echo lang('add'); ?></button>
								</div>    
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
 
								<div class="alert alert-warning">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
										×</button>
									<span class="fa fa-warning"></span> <strong><?php echo lang('categories_message_title'); ?></strong>
									<hr class="message-inner-separator">
									<p>
										<?php echo lang('categories_message_warning'); ?> </p>
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
				<h4 class="modal-title custom_align" id="Heading"> <?php echo lang('categories_add_new'); ?></h4>
			</div>
			<form name="form_add" id="form_add" method="post" action="<?php echo site_url('profile/categories/add'); ?>" >	

				<div class="modal-body">
				 
					<div class="modal-body">  
																	 
						<div class="form-group">
							<label class="control-label" for="inputName"><?php echo lang('categories_input_name'); ?></label>
							<input class="form-control" name="category_name" id="category_name" placeholder="<?php echo lang('categories_input_name'); ?>" >
						</div> 
						<!-- textarea select-->
						<div class="form-group">
							<label class="control-label" for="inputDesc"><?php echo lang('categories_input_description'); ?></label>
							<textarea rows="3" name="category_desc" id="category_desc" class="form-control" placeholder="<?php echo lang('categories_input_description'); ?>" ></textarea>
						</div> 
						<!-- Color select-->
						<div class="form-group">	
							<label class="control-label" for="inputBgColor"><?php echo lang('calendar_modal_colorbackground'); ?></label>	 
							<input type="text" name="category_bgcolor" id="category_bgcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#05b0dc" value="#05b0dc"> 
						</div>
						<!-- Color select-->
						<div class="form-group">	
							<label class="control-label" for="inputTxtColor"><?php echo lang('calendar_modal_colortext'); ?></label>
							<input type="text" name="category_color" id="category_color" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="#FFFFFF"> 
						</div> 												
						<!-- Color select-->
						<div class="form-group">	
							<label class="control-label" for="inputBColor"><?php echo lang('calendar_modal_colorborder'); ?></label>	 
							<input type="text" name="category_bcolor" id="category_bcolor" class="form-control color_picker" data-position="bottom right" data-defaultValue="#FFFFFF" value="#FFFFFF">	
						</div> 	  
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