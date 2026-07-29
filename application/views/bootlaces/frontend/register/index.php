<div class="jumbotron">
  <div class="container">   
	<div class="box">
		 <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/bootlaces/img/logo.png" >
		 <h3><?php echo $site_name ?></h3></a> 
		 
		<?php echo form_open('register', array('class' => 'form form-signup', 'id' => 'form_register', 'name' => 'form_register', 'role' => 'form' )); ?>  
		
			<div class="form-group">
				<div class="input-group"> 
					<input type="text" name="identity" id="identity" placeholder="<?php echo lang('profile_register_uname') ?>" />
					  <?php echo form_error('identity') ?>
		 
					<input type="text" name="email" id="email" placeholder="<?php echo lang('profile_register_email') ?>" />
					  <?php echo form_error('email') ?>
  
					<input type="text" name="phone" id="phone" placeholder="<?php echo lang('profile_register_phone') ?>" />
					  <?php echo form_error('phone') ?>
 
					<input type="password" name="password" id="password" placeholder="<?php echo lang('profile_register_password') ?>" />
					<?php echo form_error('password') ?>							
 
					<input type="password" name="password_confirm" id="password_confirm" placeholder="<?php echo lang('profile_register_password_confirm') ?>" />
					<?php echo form_error('password_confirm') ?>							
					
				</div>
			</div>
		
			<?php if($vcaptcha == 1): ?>
			<div class="form-group">
				<div class="input-group"> 
					<input class="form-captcha" type="text" name="captcha" id="captcha" placeholder="<?php echo lang('profile_register_captcha') ?>"/>
				</div>
				<div class="input-group">
					<span class="input-group-addon"> <?php echo $captcha_image ?> 	</span> 
					 <?php echo form_error('captcha') ?>			
				</div>
			</div>
			<?php endif ?>	
			
			<input class="btn btn-success full-width" type="submit" name="user_submit" id="button" value="<?php echo lang('profile_register_button') ?>" /> 
			<label class="checkbox"><?php echo anchor('/profile/login', lang('profile_login')) ?></label>
		
			<label class="alert"> 
				 <?php echo $message ?> 
			</label>		 	


		<?php echo form_close(); ?>	
	
	</div>	
  </div>	   	
</div>