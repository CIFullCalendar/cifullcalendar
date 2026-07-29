
<div class="jumbotron">
  <div class="container"> 
		<div class="box">
			  <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/bootlaces/img/logo.png" ></a>	
			 <h3><?php echo $site_name ?></h3></a>

			<legend><center><?php echo lang('forgot_login_subject') ?><center></legend>  

			<div class="alert alert-success">
				<?php echo lang('forgot_login_message'); ?>
			</div>	 
			<div class="checkbox"> 
				<?php echo anchor('profile/login',lang('profile_signin')); ?> 
			</div>	 
		</div>
		
		<p class="copyright"><?php echo lang('copyright') ?></p>
	</div>
</div>