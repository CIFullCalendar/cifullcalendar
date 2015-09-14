 
	
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" >
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
            <!-- /.navbar-header -->
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

				<?php if ($this->secure->isMemberLoggedIn($this->session) || $this->secure->isManagerLoggedIn($this->session)): ?>		
			    <ul class="nav navbar-nav navbar-right">
			 	    <?php if ( $this->secure->isManagerLoggedIn($this->session)): ?>
						<li ><?php echo anchor('/admin', lang('admin_dashboard') ) ?></li> 	
					<?php endif ?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						   <img src="<?php echo $current_logo ?>" alt="" class="fa-fw" style="height:20px;" /> <i class="fa fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li>
								<div class="navbar-content ">
									<div class="row">
										<div class="col-md-5">
											<img src="<?php echo $current_logo ?>"
												alt="Alternate Text" class="img-responsive" />
											<p class="text-center small"> 
										</div>
										<div class="col-md-7">
											<span>Hi <?php echo $userinfo->uname  ?></span>
											<p class="text-muted small">
												<?php echo $userinfo->email ?></p>
											<div class="divider"></div>
 
											<a href="<?php echo site_url('profile/user');?>" class="btn" > <i class="fa fa-user"></i></a>
											<a href="<?php echo site_url('profile/user/fullcalendar');?>" class="btn" ><i class="fa fa-calendar"></i></a>
											<a href="<?php echo site_url('profile/gmaps');?>" class="btn" ><i class="fa fa-location-arrow"></i></a>
											<a href="<?php echo site_url('profile/categories');?>" class="btn" ><i class="fa fa-list"></i></a>
											<a href="<?php echo site_url('profile/sources');?>" class="btn" ><i class="fa fa-link"></i></a>
											<?php if ( $this->secure->isManagerLoggedIn($this->session)): ?>		
												<a href="<?php echo site_url('admin');?>" class="btn" ><i class="fa fa-users"></i></a>
											<?php endif ?>
										</div>
									</div>
								</div>
								<div class="navbar-footer">
									<div class="navbar-footer-content ">
										<div class="row">									
											<div class="col-md-6 pull-right">
												<?php echo anchor('/profile/logout', lang('profile_log_out'), array('class' => 'btn btn-default btn-sm pull-right') ) ?> 
											</div>
											<div class="col-md-6 pull-right"> 
												<?php echo anchor('/profile/forgot_login', lang('recover_password'), array('class' => 'btn btn-default btn-sm pull-right') ) ?>  
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
				</ul> 	 
				
				<?php endif ?>	   
				<!-- /.navbar-top-links -->
		 
				<!-- /.navigation-side-menu -->
				<div class="navbar-default sidebar" role="navigation"> 
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
							<h3 ><?php echo lang('submenu_dropdown_all_categories'); ?></h3>
                        </li>					
                        <li>
							<a href="<?php echo site_url('profile');?>" id="side-menu" ><i class="fa fa-calendar fa-fw"></i> <?php echo lang('calendar') ?></a> 
                        </li>
						<li>
							<a href="<?php echo site_url('profile/gmaps');?>" id="side-menu"><i class="fa fa-location-arrow fa-fw"></i> <?php echo lang('submenu_dropdown_all_locations'); ?></a>
						</li> 
						<li>
							<a class="active" href="<?php echo site_url('profile/categories');?>" id="side-menu"><i class="fa fa-list fa-fw"></i> <?php echo lang('submenu_dropdown_all_categories'); ?></a>
						</li> 							
						<li>
							<a href="<?php echo site_url('profile/sources');?>" id="side-menu"><i class="fa fa-link fa-fw"></i> <?php echo lang('submenu_dropdown_all_sources'); ?></a>
						</li> 							
 
                    </ul>
                </div>
               
            </div>
             <!-- /.sidebar-collapse -->
        </nav>	
		<!-- /.navbar-static-side -->