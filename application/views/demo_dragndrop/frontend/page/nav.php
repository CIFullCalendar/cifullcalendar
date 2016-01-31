    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header"> 
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>">
                  <span class="fa fa-calendar"></span> <?php echo $site_name ?>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
				<?php if($pagename): ?>
					<ul class="nav navbar-nav">     
					<li>
                        <a href="<?php echo base_url("/docs") ?>">Docs</a>
                    </li>
                    <li>
                        <a href="http://themeforest.net/user/sirdre">Contact</a>
                    </li> 				
					<?php foreach ($pagename as $result): ?>	
						<li>
							<a href="<?php echo site_url('/'.$result->seo); ?>"><?php echo substr($result->title, 0, 12); ?></a>
						</li> 		
					<?php endforeach ?>	 
					</ul>						
				<?php else: ?> 
				<?php endif ?> 	

				<ul class="nav navbar-nav navbar-right">  
        
					<?php if ($this->ion_auth->is_member()): ?>	
						<a class="brand pull-left" href="<?php echo site_url("/profile") ?>"> 
								<img src="<?php echo $current_logo ?>" alt="" class="img-responsive" style="height:50px;" />
						</a>			
						<li ><?php echo anchor('/profile', lang('profile_dashboard') ) ?></li>
						<li ><?php echo anchor('/profile/logout', lang('profile_log_out') ) ?></li> 
						
					<?php elseif (!$this->ion_auth->is_member() && !$this->ion_auth->is_admin()): ?>  
						<li ><?php echo anchor('/profile/login', lang('profile_login')) ?></li>
						<li ><?php echo anchor('/register', lang('register')) ?></li>
					<?php endif ?>	
					
					<?php if ($this->ion_auth->is_admin()): ?>	
						<a class="brand pull-left" href="<?php echo site_url("/profile") ?>"> 
								<img src="<?php echo $current_logo ?>" alt="" class="img-responsive" style="height:50px;" />
						</a>			
						<li ><?php echo anchor('/admin', lang('admin_dashboard') ) ?></li>
						<li ><?php echo anchor('/admin/logout', lang('profile_log_out') ) ?></li> 
					<?php endif ?>	
                </ul>
 
				
				
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav> 