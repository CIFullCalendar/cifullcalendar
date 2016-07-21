     
	 
     <div class="navbar-inverse" id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand" href="<?php echo base_url();?>">
                  <span class="fa fa-calendar"></span> <?php echo  $site_name ?>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li><!-- /.shortcut -->
                    <a href="<?php echo site_url('profile');?>"><i class="fa fa-calendar fa-fw"></i></a> 
                </li>               
				<li><!-- /.shortcut -->
					<a href="<?php echo site_url('profile/gmaps');?>" ><i class="fa fa-location-arrow"></i></a>
                </li>				
				<li><!-- /.shortcut -->
					<a href="<?php echo site_url('profile/categories');?>" class="btn" ><i class="fa fa-list"></i></a>											
                </li>				
				<li><!-- /.shortcut -->
					<a href="<?php echo site_url('profile/sources');?>" class="btn" ><i class="fa fa-link"></i></a>
                </li>
      
				<!-- /.dropdown -->
				<?php if ($this->ion_auth->is_admin()): ?>	
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					   <img src="<?php echo $current_logo ?>" alt="" class="fa-fw" style="height:20px;" /> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user"> 
						<li><a href="<?php echo site_url('profile/user');?>"><i class="fa fa-user fa-fw"></i> <?php echo $userinfo->username ?></a>
						</li>
						<li><a href="<?php echo site_url('admin/settings');?>"><i class="fa fa-gear fa-fw"></i> <?php echo lang('settings_name') ?></a>
						</li>
						<li class="divider"></li>
						<li>
						<?php echo anchor('/admin/logout', lang('profile_log_out'), array('class' => 'btn btn-default btn-sm pull-right') ) ?>
						</li>
					</ul>
					<!-- /.dropdown-user -->  
				</li>
				<?php endif ?>	
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
			
			 <!-- /.navigation-side-menu -->
            <div class="navbar-inverse sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
							<h3 ><?php echo $page_title ?></h3>
                        </li>					
                        <li>
                            <a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard fa-fw"></i> <?php echo lang('dashboard') ?></a>
                        </li>                        
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> <?php echo lang('admin_nav_events') ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('admin/calendarlist'); ?>"><?php echo lang('calendar') ?></a>
                                </li>                               
								<li>
                                    <a href="<?php echo site_url('admin/maplist'); ?>"><?php echo lang('maps') ?></a>
                                </li> 
								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                             <a href="<?php echo site_url('admin/queuelist'); ?>"><i class="fa fa-calendar-check-o fa-fw"></i> <?php echo lang('admin_nav_queue') ?></a>
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> <?php echo lang('users') ?><span class="fa arrow"></span></a> 
							 <ul class="nav nav-second-level">
								<li>
									<a href="<?php echo site_url('admin/userslist'); ?>"><i class="fa fa-user fa-fw"></i> <?php echo lang('admin_nav_users') ?></a>
								</li> 								
								<li>
									<a href="<?php echo site_url('admin/sessionlist');?>"><i class="fa fa-exchange fa-fw"></i> <?php echo lang('admin_nav_sessions') ?></a> 
								</li> 
							 </ul>
							 <!-- /.nav-second-level -->
                        </li>  
                        <li>
                             <a href="<?php echo site_url('admin/group'); ?>"><i class="fa fa-group fa-fw"></i> <?php echo lang('admin_nav_group') ?></a>
                        </li> 						
                        <li>
                            <a href="#"><i class="fa fa-file-o fa-fw"></i> <?php echo lang('pages') ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<?php if($pagename): ?>
									<?php foreach ($pagename as $result): ?>	
										<li>
											<a href="<?php echo site_url('admin/pages/edit/'.$result->id); ?>"><?php echo substr($result->title, 0, 25)."..."; ?></a>
										</li> 		
									<?php endforeach ?>	
										<li>
											<a href="<?php echo site_url('admin/pages'); ?>"><?php echo lang('all');?></a>
										</li> 	
								<?php else: ?>
									<li>
										<a href="<?php echo site_url('admin/pages'); ?>"><?php echo lang('all');?></a>
									</li> 
								<?php endif ?>								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>						
                        <li class="active" > 
                            <a href="#"><i class="fa fa-gears fa-fw"></i> <?php echo lang('settings_name') ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li>
									<a <?php echo $nav_class_b ?> href="<?php echo site_url('admin/settings');?>"><i class="fa fa-gear fa-fw"></i> <?php echo lang('settings_basic_name') ?></a> 
								</li>   
								<li>
									<a <?php echo $nav_class_c ?> href="<?php echo site_url('admin/settings/calendar_settings');?>"><i class="fa fa-calendar fa-fw"></i> <?php echo lang('settings_cal_name') ?></a> 
								</li> 								
								<li>
									<a <?php echo $nav_class_a ?> href="<?php echo site_url('admin/settings/attachments');?>"><i class="fa fa-file-archive-o fa-fw"></i> <?php echo lang('settings_attach_name') ?></a> 
								</li> 									
								<li>
									<a <?php echo $nav_class_i ?> href="<?php echo site_url('admin/settings/icsfile');?>"><i class="fa fa-file fa-fw"></i> <?php echo lang('settings_file_name') ?></a> 
								</li> 								
								<li>
									<a <?php echo $nav_class_p ?> href="<?php echo site_url('admin/settings/picfile');?>"><i class="fa fa-image fa-fw"></i> <?php echo lang('settings_pic_name') ?></a> 
								</li>                               
								<li>
									<a <?php echo $nav_class_tpl ?> href="<?php echo site_url('admin/settings/template');?>"><i class="fa fa-pencil-square-o fa-fw"></i> <?php echo lang('settings_template_name') ?></a> 
								</li>  								
								<li>
									<a <?php echo $nav_class_t ?> href="<?php echo site_url('admin/settings/theme');?>"><i class="fa fa-paint-brush fa-fw"></i> <?php echo lang('settings_theme_name') ?></a> 
								</li>  							
                            </ul>
                            <!-- /.nav-second-level -->							
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>