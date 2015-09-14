
<div class="jumbotron">
  <div class="container">
			   
	    <div class="box">
			 <a href="<?php echo base_url();?>" ><img src="<?php echo base_url();?>assets/img/logo.png" >
			 <h3><?php echo $site_name ?></h3></a>
			<form class="form-signin" action="<?php echo site_url('profile/forgot_login') ?>" method="post">

				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
						<input class="form-control" type="text" name="login_email" id="login_email" placeholder="<?php echo lang('forgot_login_email') ?>" value="<?php echo set_value('login_email') ?>"/>
					</div>
				</div>
				<div class="control-group"> 
					<div class="controls"> 
						<input class="btn btn-warning" type="submit" name="login_forgot_submit" id="button" value="<?php echo lang('forgot_login_email_submit') ?>" />
					</div>
				</div> 
			</form>
		
			<?php echo form_error('login_email') ?>
			<?php if ($message != ''): echo $message; endif ?>
		</div>
	</div>
</div>