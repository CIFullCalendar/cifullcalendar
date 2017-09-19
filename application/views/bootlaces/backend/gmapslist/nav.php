  
        <div class="page-header navbar navbar-fixed-top"> 
		
            <div class="page-header-inner "> 
			
                <div class="page-logo"> 
					<a href="<?php echo base_url();?>" class="logo-default" >
						<span class="fa fa-calendar logo-default"></span> <?php echo $site_name ?>
					</a>	 
                    <div class="menu-toggler sidebar-toggler"><i class="fa fa-bars"></i></div>
                </div>
				
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
					
				<div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
					<?php if ($this->ion_auth->is_admin()): ?>	
						<li class="shortcut"><!-- /.shortcut -->
							<a href="<?php echo site_url('profile');?>"><i class="fa fa-calendar fa-fw"></i></a> 
						</li>               
						<li class="shortcut "><!-- /.shortcut -->
							<a href="<?php echo site_url('profile/gmaps');?>" ><i class="fa fa-location-arrow"></i></a>
						</li>				
						<li class="shortcut "><!-- /.shortcut -->
							<a href="<?php echo site_url('profile/categories');?>" ><i class="fa fa-list"></i></a>											
						</li>				
						<li class="shortcut "><!-- /.shortcut -->
							<a href="<?php echo site_url('profile/sources');?>" ><i class="fa fa-link"></i></a>
						</li>				
					
							
						<li class="dropdown dropdown-user"><!-- /.shortcut -->
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<img alt="" class="img-circle" src="<?php echo $current_logo ?>" />
								<span class="username username-hide-on-mobile"> <?php echo $userinfo->username ?> </span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu pull-right" role="menu">
								<li class="nav-item start">
									<a href="<?php echo site_url('profile/user');?>"><i class="fa fa-user fa-fw"></i> <?php echo $userinfo->username ?></a>
								</li>
								<li class="nav-item  ">
									<a href="<?php echo site_url('admin/settings');?>"><i class="fa fa-gear fa-fw"></i> <?php echo lang('settings_name') ?></a>
								</li>
								<li class="divider"></li>
								<li class="nav-item  ">
								<?php echo anchor('/admin/logout', lang('profile_log_out'), array('class' => 'btn btn-default btn-sm pull-right') ) ?>
								</li>
							</ul>	
			 
						</li>
						<!-- /.dropdown -->
						
						<?php endif ?>	
					</ul>
					<!-- /.navbar-top-links -->				
				
                
                </div>
				
            </div>
			
        </div> 
		
        <div class="clearfix"> </div>  
		
        <div class="page-container"> 
		
            <div class="page-sidebar-wrapper"> 
			
                <div class="page-sidebar navbar-collapse collapse"> 
				     <!-- page-sidebar-menu page-header-fixed -->
                    <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px"> 
					
                        <li class="sidebar-toggler-wrapper hide"> 
                            <div class="sidebar-toggler"> </div> 
                        </li>
						
                        <li class="sidebar-search-wrapper">&nbsp;</li>
						
						<li class="nav-item start">
							<a href="<?php echo site_url('admin');?>" class="nav-link nav-toggle">
                                <i class="fa fa-dashboard fa-fw"></i>
                                <span class="title"><?php echo lang('dashboard') ?></span> 
                            </a> 						 
                        </li>                        
                        <li class="nav-item active open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-table fa-fw"></i> 
                                <span class="title"><?php echo lang('admin_nav_events') ?></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="<?php echo site_url('admin/calendarlist'); ?>" class="nav-link ">
                                        <i class="fa fa-calendar"></i>
                                        <span class="title"><?php echo lang('calendar') ?></span>
										<span class="badge badge-success"><?php echo $events_count; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item  active open">
                                    <a href="<?php echo site_url('admin/maplist'); ?>" class="nav-link ">
                                        <i class="fa fa-location-arrow"></i>
                                        <span class="title"><?php echo lang('maps') ?></span>
                                        <span class="badge badge-success"><?php echo $gmaps_count; ?></span>
                                    </a>
                                </li>
                            </ul>			
                            <!-- /.nav-second-level -->
                        </li>
                        <li class="nav-item  ">
							<a href="<?php echo site_url('admin/queuelist'); ?>" class="nav-link nav-toggle">
                                <i class="fa fa-calendar-check-o fa-fw"></i>
                                <span class="title"><?php echo lang('admin_nav_queue') ?></span> 
								<span class="badge badge-success"><?php echo $queue_count; ?></span>
                            </a>  
                        </li>                         
                        <li class="nav-item  "> 
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-user fa-fw"></i> 
                                <span class="title"><?php echo lang('users') ?></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="<?php echo site_url('admin/userslist'); ?>" class="nav-link ">
                                        <i class="fa fa-user"></i>
                                        <span class="title"><?php echo lang('users') ?></span>
										<span class="badge badge-success"><?php echo $users_count; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="<?php echo site_url('admin/sessionlist'); ?>" class="nav-link ">
                                        <i class="fa fa-exchange"></i>
                                        <span class="title"><?php echo lang('admin_nav_sessions') ?></span> 
                                    </a>
                                </li>
                            </ul>			 
							 <!-- /.nav-second-level -->
                        </li>  
                        <li class="nav-item  ">
							<a href="<?php echo site_url('admin/group'); ?>" class="nav-link nav-toggle">
                                <i class="fa fa-group fa-fw"></i>
                                <span class="title"><?php echo lang('admin_nav_group') ?></span>  
                            </a>   
                        </li> 						
						<li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-file-o fa-fw"></i> 
                                <span class="title"><?php echo lang('pages') ?></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu"> 
							<?php if($pagename): ?>
								<?php foreach ($pagename as $result): ?>
							<li class="nav-item ">
								<a href="<?php echo site_url('admin/pages/edit/'.$result->id); ?>" class="nav-link ">
									<i class="fa fa-file"></i>
									<span class="title"><?php echo substr($result->title, 0, 25)."..."; ?></span> 
								</a>
							</li>			 		
								<?php endforeach ?>	
							<li class="nav-item ">
								<a href="<?php echo site_url('admin/pages'); ?>" class="nav-link ">
									<i class="fa fa-file-o"></i>
									<span class="title"><?php echo lang('all') ?></span> 
								</a>
							</li>			 	
							<?php else: ?>
							<li class="nav-item ">
								<a href="<?php echo site_url('admin/pages'); ?>" class="nav-link ">
									<i class="fa fa-file-o"></i>
									<span class="title"><?php echo lang('all') ?></span> 
								</a>
							</li>	
							<?php endif ?>	 
                            </ul>			 
							 <!-- /.nav-second-level -->			 
                        </li>						
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-gears fa-fw"></i> 
                                <span class="title"><?php echo lang('settings_name') ?></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="<?php echo site_url('admin/settings'); ?>" class="nav-link ">
                                        <i class="fa fa-gear"></i>
                                        <span class="title"><?php echo lang('settings_basic_name') ?></span> 
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="<?php echo site_url('admin/settings/calendar_settings'); ?>" class="nav-link ">
                                        <i class="fa fa-calendar"></i>
                                        <span class="title"><?php echo lang('settings_cal_name') ?></span> 
                                    </a>
                                </li>                                
								<li class="nav-item ">
                                    <a href="<?php echo site_url('admin/settings/attachments'); ?>" class="nav-link ">
                                        <i class="fa fa-file-archive-o"></i>
                                        <span class="title"><?php echo lang('settings_attach_name') ?></span> 
                                    </a>
                                </li>								
								<li class="nav-item ">
                                    <a href="<?php echo site_url('admin/settings/icsfile'); ?>" class="nav-link ">
                                        <i class="fa fa-file"></i>
                                        <span class="title"><?php echo lang('settings_file_name') ?></span> 
                                    </a>
                                </li>								
								<li class="nav-item ">
                                    <a href="<?php echo site_url('admin/settings/picfile'); ?>" class="nav-link ">
                                        <i class="fa fa-image"></i>
                                        <span class="title"><?php echo lang('settings_pic_name') ?></span> 
                                    </a>
                                </li>								
								<li class="nav-item ">
                                    <a href="<?php echo site_url('admin/settings/template'); ?>" class="nav-link ">
                                        <i class="fa fa-pencil-square-o"></i>
                                        <span class="title"><?php echo lang('settings_template_name') ?></span> 
                                    </a>
                                </li>								
								<li class="nav-item ">
                                    <a href="<?php echo site_url('admin/settings/theme'); ?>" class="nav-link ">
                                        <i class="fa fa-paint-brush"></i>
                                        <span class="title"><?php echo lang('settings_theme_name') ?></span> 
                                    </a>
                                </li>
                            </ul>			 
							 <!-- /.nav-second-level -->						
						 					
                        </li> 

                    </ul>
					
                </div>
				
            </div>