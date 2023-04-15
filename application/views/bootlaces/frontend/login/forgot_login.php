
<div class="jumbotron">
	<div class="container">
			   
	    <div class="box">
			 <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/bootlaces/img/logo.png" >
			 <h3><?php echo $site_name ?></h3></a>
			 
			<?php echo form_open('profile/forgot_login', array('class' => 'form-signin', 'id' => 'form_forgot', 'name' => 'form_forgot', 'role' => 'form'));	?> 
			  
                <input type="text" name="identity" id="identity" placeholder="<?php echo lang('forgot_password_identity_label') ?>" />
 
				<input class="btn btn-warning" type="submit" name="login_forgot_submit" id="button" value="<?php echo lang('forgot_login_email_submit') ?>" />
			 
				
				<label class="checkbox"><?php echo anchor('/profile/login', lang('profile_login')) ?></label>
				<label class="checkbox"> 
					<?php echo anchor('register',lang('profile_register')) ?> 
				</label>
				
				<label class="alert"> 
					<?php if (!empty($message)) : echo $message; endif ?>
				</label>
				
			<?php echo form_close();	?>
			
		</div>
	</div>
</div>