<div class="jumbotron">
  <div class="container"> 
		<div class="box">
			  <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/bootlaces/img/logo.png" ></a>	 
			  
			<?php echo form_open('profile/user/reset_password/' . $usercode, array('class' => 'form-signin', 'id' => 'form_pass', 'name' => 'form_pass', 'role' => 'form' )); ?>  
		   
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
					<div class="input-group">
						<input type="password" name="new_password" id="new_password" class="form-control" placeholder="<?php echo lang('profile_change_new_password') ?>"  />
						 <?php echo form_error('new_password') ?>
					</div>
				</div>									
				<div class="form-group"> 
					<div class="input-group">
						<input type="password" name="new_password_confirm" id="new_password_confirm" class="form-control" placeholder="<?php echo lang('profile_change_new_password_confirm') ?>"  />
						 <?php echo form_error('profile_change_new_password_confirm') ?>
					</div>
				</div> 
				<div class="control-group"> 
					<div class="controls"> 
						<input class="btn btn-success" type="submit" name="submitChange" id="button" value="<?php echo lang('yes') ?>" />
					</div>
				</div>  
		    	<div class="checkbox">
					<?php echo anchor('/profile/login', lang('profile_login')) ?>
				</div>	 

			<?php echo form_close(); ?>	 	 
			
		</div>
		
		<p class="copyright"><?php echo lang('copyright') ?></p>
	</div>
</div> 		

	