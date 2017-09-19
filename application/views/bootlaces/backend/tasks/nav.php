  
        <div class="page-header navbar navbar-fixed-top"> 
		
            <div class="page-header-inner "> 
			
                <div class="page-logo"> 
					<a href="<?php echo base_url();?>" class="logo-default" >
						<span class="fa fa-calendar logo-default"></span> <?php echo $site_name ?>
					</a>	 
                    <div class="menu-toggler sidebar-toggler"><i class="fa fa-bars"></i></div>
                </div>
				
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
				
					<?php if($pagename): ?>
					<ul class="nav navbar-nav pull-left">      
					<?php foreach ($pagename as $result): ?>	
						<li>
							<a href="<?php echo site_url('/'.$result->seo); ?>" class="dropdown-toggle" ><?php echo substr($result->title, 0, 12); ?></a>
						</li> 		
					<?php endforeach ?>	 
					</ul><?php else: ?><?php endif ?> 					
                <div class="top-menu"> 
				
                    <ul class="nav navbar-nav pull-right">  
						<?php if (  $this->ion_auth->is_admin()): ?>
						<li ><?php echo anchor('/admin', lang('admin_dashboard') ) ?></li> 	
						<?php endif ?> 					
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img src="<?php echo $current_logo ?>" alt="" class="img-circle" />
                                <span class="username username-hide-on-mobile"> <?php echo $userinfo->username  ?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>  
                            <ul class="dropdown-menu dropdown-menu-default"> 
								<li>
								<div class="navbar-content ">
									<div class="row">
										<div class="col-md-5">
											<img src="<?php echo $current_logo ?>"
												alt="Alternate Text" class="img-responsive" />
											<p class="text-center small"> 
										</div>
										<div class="col-md-7">
											<span><?php echo lang('hi'); ?> <?php echo $userinfo->username;  ?></span>
											<p class="text-muted small">
												<?php echo $userinfo->email ?></p>
											<div class="divider"></div>
 
											<a href="<?php echo site_url('profile/user');?>" class="btn" > <i class="fa fa-user"></i></a>
											<a href="<?php echo site_url('profile/user/fullcalendar');?>" class="btn" ><i class="fa fa-calendar"></i></a>
											<a href="<?php echo site_url('profile/gmaps');?>" class="btn" ><i class="fa fa-location-arrow"></i></a>
											<a href="<?php echo site_url('profile/categories');?>" class="btn" ><i class="fa fa-list"></i></a>
											<a href="<?php echo site_url('profile/sources');?>" class="btn" ><i class="fa fa-link"></i></a>
											<?php if ($this->ion_auth->is_admin()): ?>		
												<a href="<?php echo site_url('admin');?>" class="btn" ><i class="fa fa-users"></i></a>
											<?php endif ?>
										</div>
									</div>
								</div>
								<div class="navbar-footer">
									<div class="navbar-footer-content ">
										<div class="row">									
											<div class="col-md-6 pull-right">
												<a href="<?php echo site_url('profile/logout');?>" class="btn btn-default btn-sm pull-right" ><i class="fa fa-sign-out"></i> <?php echo lang('profile_log_out'); ?></a> 
											</div>
											<div class="col-md-6 pull-right"> 
												<button data-title="Change" data-toggle="modal" data-target="#change" data-placement="top" type="button" class="btn btn-default btn-sm pull-right"><i class="fa fa-key"></i> <?php echo lang('recover_password'); ?></button>   
											</div>
										</div>
									</div>
								</div>
							</li>					
								
                            </ul> 	 
                        </li>
						
                    </ul>
                </div>
				
            </div>
			
        </div> 
		
        <div class="clearfix"> </div>  
		
        <div class="page-container"> 
		
            <div class="page-sidebar-wrapper"> 
			
                <div class="page-sidebar navbar-collapse collapse"> 
				
                    <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px"> 
					
                        <li class="sidebar-toggler-wrapper hide"> 
                            <div class="sidebar-toggler"> </div> 
                        </li>
						
                        <li class="sidebar-search-wrapper">&nbsp;</li>
						
                        <li class="nav-item  ">  
							<a href="<?php echo site_url('profile');?>" class="nav-link nav-toggle"  ><i class="fa fa-calendar fa-fw"></i> <span class="title"><?php echo lang('calendar') ?></span></a> 
                        </li>		
						<li class="nav-item active open">
							<a href="<?php echo site_url('profile/tasks');?>" class="nav-link nav-toggle" ><i class="fa fa-tasks fa-fw"></i> <span class="title"><?php echo lang('submenu_dropdown_all_tasks'); ?></span></a> 
						</li> 							
						<li class="nav-item  ">
							<a href="<?php echo site_url('profile/gmaps');?>" class="nav-link nav-toggle" ><i class="fa fa-location-arrow fa-fw"></i> <span class="title"><?php echo lang('submenu_dropdown_all_locations'); ?></span></a> 
						</li> 
						<li class="nav-item  ">
							<a href="<?php echo site_url('profile/categories');?>" class="nav-link nav-toggle" ><i class="fa fa-list fa-fw"></i> <span class="title"><?php echo lang('submenu_dropdown_all_categories'); ?></span><span class="selected"></span></a>
						</li> 						
						<li class="nav-item  "> 
							<a href="<?php echo site_url('profile/sources');?>" class="nav-link nav-toggle" ><i class="fa fa-link fa-fw"></i> <span class="title"><?php echo lang('submenu_dropdown_all_sources'); ?></span></a>
						</li>  

                    </ul>
					
                </div>
				
            </div>