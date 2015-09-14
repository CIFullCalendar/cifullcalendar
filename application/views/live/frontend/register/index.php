<div class="jumbotron">
  <div class="container">   
	<div class="box">
		 <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/img/logo.png" >
		 <h3><?php echo $site_name ?></h3></a>
	 
		<form class="form form-signup" role="form" id="form"  name="form" method="post" action="<?php echo site_url('register') ?>">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-user"></span></span> 
					<input class="form-control" type="text" name="uname" id="uname" placeholder="<?php echo lang('profile_register_uname') ?>" />
					  <?php echo form_error('uname') ?>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-envelope"></span></span> 
					<input class="form-control" type="text" name="email" id="email" placeholder="<?php echo lang('profile_register_email') ?>" />
					  <?php echo form_error('email') ?>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-lock"></span></span> 
					<input class="form-control" type="password" name="password" id="password" placeholder="<?php echo lang('profile_register_password') ?>" />
					<?php echo form_error('password') ?>							
					
				</div>
			</div>
		
			<?php if($vcaptcha == 1): ?>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span> 
					<input class="form-control" type="text" name="captcha" id="captcha" placeholder="<?php echo lang('profile_register_captcha') ?>"/>
				</div>
				<div class="input-group">
					<span class="input-group-addon"> <?php echo $captcha_image ?> 	</span> 
					 <?php echo form_error('captcha') ?>			
				</div>
			</div>
			<?php endif ?>	
			
			<input class="btn btn-success full-width" type="submit" name="user_submit" id="button" value="<?php echo lang('profile_register_button') ?>" /> 
			<label class="checkbox"><?php echo anchor('/profile/login', lang('profile_login')) ?></label>
		</form>
		
	
		<?php if(isset($message)): ?>
			<?php echo $message ?>   
		<?php endif ?>
		 <?php if ($error_message): ?>
			<?php echo $error_message ?> 
		<?php endif ?>		
		<?php if(isset($email_error)): ?>
			<?php echo $email_error ?>  
		<?php endif ?> 		
		<?php if(isset($name_error)): ?>
			<?php echo $name_error ?> 
		<?php endif ?>		
	
	</div>	
  </div>	   	
</div>