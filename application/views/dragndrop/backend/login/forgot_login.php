
<div class="jumbotron">
  <div class="container">
			   
	    <div class="box">
			 <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/dragndrop/img/logo.png" >
			 <h3><?php echo $site_name ?></h3></a>
			<form class="form-signin" action="<?php echo site_url('profile/forgot_login') ?>" method="post">

				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><span class="fa fa-user"></span></span>
						<input class="form-control" type="text" name="identity" id="identity" placeholder="<?php echo lang('forgot_password_identity_label') ?>" />
					</div>
				</div>
				<div class="control-group"> 
					<div class="controls"> 
						<input class="btn btn-warning" type="submit" name="login_forgot_submit" id="button" value="<?php echo lang('forgot_login_email_submit') ?>" />
					</div>
				</div> 
			</form>
		 
			<?php if (!empty($message)) : echo $message; endif ?>
		</div>
	</div>
</div>