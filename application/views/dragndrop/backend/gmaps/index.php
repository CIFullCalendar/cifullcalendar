 	<div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-location-arrow fa-fw"></i> <?php echo lang('locations_all_heading'); ?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row --> 
			
            <div class="row">
                <div class="col-md-12 col-lg-12">   
    
                        <div class="panel-heading"> 
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
				<!-- /.col-md-12 .col-lg-12 -->
			</div>
            <!-- /.row -->			
	</div>
    <!-- /.page-wrapper -->
 
		<div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="change" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title custom_align" id="Heading"><?php echo lang('profile_change_password') ?></h4>
					</div>
					
					<form name="form_pass<?php echo $userinfo->id;  ?>" id="form" method="post" action="<?php echo site_url('profile/user/change_password') .'/';?>" >	

						<div class="modal-body">
							<input name="user_id" id="user_id" value="<?php echo $userinfo->id; ?>" type="hidden" >	
							<div class="alert alert-warning">
								<i class="fa fa-exclamation-triangle btn-lg"></i> <?php echo lang('profile_change_warning') ?>
									<?php if(empty($userinfo->first_name) && empty($userinfo->last_name)) : ?>
										<b><?php echo $userinfo->username  ?></b>
									<?php else : ?>
										<b><?php echo $userinfo->first_name  ?> <?php echo $userinfo->last_name  ?></b>
									<?php endif ?> 
								
								<?php echo lang('password') ?>
								
							</div>								 
							<div class="form-group"> 
								<div class="input-group col-md-12">
									<input type="password" name="old_password" id="old_password" class="form-control" placeholder="<?php echo lang('profile_change_old_password') ?>"  />
									 <?php echo form_error('old_password') ?>
								</div>
							</div>								
							<div class="form-group"> 
								<div class="input-group col-md-12">
									<input type="password" name="new_password" id="new_password" class="form-control" placeholder="<?php echo lang('profile_change_new_password') ?>"  />
									 <?php echo form_error('new_password') ?>
								</div>
							</div>									
							<div class="form-group"> 
								<div class="input-group col-md-12">
									<input type="password" name="new_password_confirm" id="new_password_confirm" class="form-control" placeholder="<?php echo lang('profile_change_new_password_confirm') ?>"  />
									 <?php echo form_error('profile_change_new_password_confirm') ?>
								</div>
							</div>
							
						</div>									
						<div class="modal-footer ">
							<button type="submit" name="submitChange" class="btn btn-success" ><i class="fa fa-key"></i> <?php echo lang('yes') ?></button>
							<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-remove"></i> <?php echo lang('no') ?></button>
						</div>
					
					</form> 
				</div>
				<!-- /.modal-content --> 
			</div>
		  <!-- /.modal-dialog --> 
		</div>		