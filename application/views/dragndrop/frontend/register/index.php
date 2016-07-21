<div class="jumbotron">
  <div class="container">   
	<div class="box">
		 <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/img/logo.png" >
		 <h3><?php echo $site_name ?></h3></a>
	 
		<?php echo form_open('register', array('class' => 'form form-signup', 'id' => 'form_register', 'name' => 'form_register', 'role' => 'form' )); ?>  
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-user"></span></span> 
					<input class="form-control" type="text" name="identity" id="identity" placeholder="<?php echo lang('profile_register_uname') ?>" />
					  <?php echo form_error('identity') ?>
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
					<span class="input-group-addon"><span class="fa fa-phone"></span></span> 
					<input class="form-control" type="text" name="phone" id="phone" placeholder="<?php echo lang('profile_register_phone') ?>" />
					  <?php echo form_error('phone') ?>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-lock"></span></span> 
					<input class="form-control" type="password" name="password" id="password" placeholder="<?php echo lang('profile_register_password') ?>" />
					<?php echo form_error('password') ?>							
					
				</div>
			</div>			
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-lock"></span></span> 
					<input class="form-control" type="password" name="password_confirm" id="password_confirm" placeholder="<?php echo lang('profile_register_password_confirm') ?>" />
					<?php echo form_error('password_confirm') ?>							
					
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
		
		
		<?php echo form_close(); ?>	
		
	
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