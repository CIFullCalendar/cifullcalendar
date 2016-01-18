<div class="jumbotron">
	<div class="container">
		<div class="box">
		 <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/img/logo.png" >
		 <h3><?php echo $site_name ?></h3></a>		
			<form  action="<?php echo site_url('profile/login');?>" method="post"  >
				
		 
				<input type="text" name="login_username" id="login_username" placeholder="<?php echo lang('forgot_password_identity_label') ?>" required="" autofocus="" />
				<input type="password" name="login_password" id="login_password" placeholder="<?php echo lang('profile_login_password') ?>" required="" autofocus="" />
				 
				<input type="submit" name="login_submit" value="<?php echo lang('profile_login') ?>" class="btn btn-default full-width">
				<label class="checkbox">
				<a><?php echo lang('profile_remember_label') ?></a></label>
				<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
				<label class="checkbox"> 
					<?php echo anchor('register',lang('profile_register')) ?> 
				</label>	 	
				<label class="checkbox"> 
					<?php echo anchor('profile/forgot_login',lang('profile_forgot_password')) ?> 
				</label>
				<label class="alert"> 
					 <?php echo $message ?> 
				</label>
			</form>			
		</div>
	</div>  
</div>