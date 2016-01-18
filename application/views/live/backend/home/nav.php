 
	
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
					<?php foreach ($pagename as $result): ?>	
						<li>
							<a href="<?php echo site_url('/'.$result->seo); ?>"><?php echo substr($result->title, 0, 12); ?></a>
						</li> 		
					<?php endforeach ?>	 
					</ul>						
				<?php else: ?> 
				<?php endif ?> 		

				<?php if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) : ?>		
			    <ul class="nav navbar-nav navbar-right">
			 	    <?php if (  $this->ion_auth->is_admin()): ?>
						<li ><?php echo anchor('/admin', lang('admin_dashboard') ) ?></li> 	
					<?php endif ?> 
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bell-o"></i><span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-alert" role="menu">
							<h4 class="text-center" ><?php echo lang('notify'); ?></h4>
							<li>
								<span class="item"> 
									<span class="item-info">  
									 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
									Ipsum has been the industry's standard dummy text ever since the 1500s.<strong> strong
									message</strong>. <a href="http://www.jquery2dotnet.com/2013/07/cool-notification-css-style.html">
									Cool Notification Css Style</a> 
									</span> 
								</span>
							</li> 
							<li class="divider"></li>
							<li><a class="text-center" href="">View More</a></li>
						</ul>
					</li>
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
											<span>Hi <?php echo $userinfo->username  ?></span>
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
												<?php echo anchor('/profile/logout', lang('profile_log_out'), array('class' => 'btn btn-default btn-sm pull-right') ) ?> 
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
				
				<?php endif ?>	   
				<!-- /.navbar-top-links -->
		 
				<!-- /.navigation-side-menu -->
				<div class="navbar-default sidebar" role="navigation"> 
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group ">
							
							<form class="custom-search-form" role="search" method="post" >
								<div class="input-group" style="width:100%;">
									<input type="text" class="form-control" placeholder="Search..." name="title" id="title" value="" />
									<span class="input-group-btn">
									<button class="btn btn-default" id="submitsearch" type="submit"><i class="fa fa-search"></i></button>
									</span>
								</div> 
							</form>
                        
                            </div>
                            <!-- /input-group -->
                        </li>					
                        <li>
							<a class="active" href="<?php echo site_url('profile');?>" id="side-menu" ><i class="fa fa-calendar fa-fw"></i> <?php echo lang('calendar') ?></a> 
                        </li>
						<li>
							<a id="side-menu"><i class="fa fa-arrows-alt fa-fw"></i> <?php echo lang('categories_draggable_title'); ?>
							<div class="overflow" id="helper">
								<div class="fc-view-container" id='external-events'></div> 
							</div>
							<p>
								<input type='checkbox' id='drop-remove' />
								<label for='drop-remove'><?php echo lang('categories_draggable_removable'); ?></label>
							</p>
							</a>
						</li>						
						<li>
							<a href="<?php echo site_url('profile/gmaps');?>" id="side-menu"><i class="fa fa-location-arrow fa-fw"></i> <?php echo lang('submenu_dropdown_all_locations'); ?></a>
						</li> 
						<li>
							<a href="<?php echo site_url('profile/categories');?>" id="side-menu"><i class="fa fa-list fa-fw"></i> <?php echo lang('submenu_dropdown_all_categories'); ?></a>
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