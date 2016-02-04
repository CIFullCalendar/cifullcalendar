

<div class="jumbotron">
  <div class="container">

    <div class="box">
			 <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/dragndrop/img/logo.png" >
			 <h3><?php echo $site_name ?></h3></a>
		 	
			<div class="alert alert-success">
				<?php echo lang('forgot_login_email_send'); ?>
			</div>	 
		
			<label class="checkbox"> 
				<?php echo anchor('profile/login',lang('profile_signin')); ?> 
			</label>		
    </div>
  </div> 
</div>