<div class="page-content-wrapper"> 
        <!-- Product -->
        <div class="product">
            <div class="product-pattern">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 product-background">
                            <div class="row">								
                                <div class="col-sm-6 col-md-12 col-lg-12 calendar">	 
									<div data-role="content" id='calendar' ></div>  
									<div id='loading' style='display:none;'><progress></progress></div> 	
									<div class="pull-left"><a><i class="fa fa-globe fa-fw"></i><span id="timezone"></span></a></div>
									<div class="pull-right"><a class="hero hero-moment"><i class="fa fa-clock-o fa-fw"></i><span id="digiclock"></span><span id="ampm"></span></a> </div>
								</div>
                                <div class="col-sm-5 col-md-12 col-lg-5">
									<h2><?php echo $site_name ?> v<strong><?php echo $current_version ?></strong></h2>  
									 
                                    <div class="product-description">  
	
										<div class="col-md-12 col-lg-12">
											<p>Built on the legacy <?php echo 'CodeIgniter v<strong>' . CI_VERSION . '</strong>' ?> and FullCalendar v<strong><span id="fcv"></span></strong>* fused like a&ldquo;Super Saiyan Fusion&rdquo;.</p>
											
											<h3>About</h3> 
											<p>CIFullCalendar is a server-side dynamic web application that is responsive to any layout of a viewing screen. The &ldquo;Super Saiyan Fusion&rdquo; power of CIFullCalendar allows users to organize, plan and share events to everyone. Simply, install it to your server and become a member then use the wonderful features by easily manipulating your events by dragging, dropping, resizing, clicking, touching, categorizing, grouping, filtering, linking and importing/exporting. </p>  
						
											<h3>Sign in and experience the modern power of CIFullCalendar.</h3>
											<h3>Demo Default logins:</h3> 
											<p><span><a href="<?php echo site_url('user');?>" >u: user p: password</a></span></p>
											<p><span><a href="<?php echo base_url();?>admin" >u: admin p: password1</a></span></p>
											
										</div> 
										
										<?php if ((!$this->ion_auth->is_admin()) && (!$this->ion_auth->is_member())): ?> 		
											<div class="col-md-6 col-sm-12">  
												<?php echo anchor('/register', '<i class="fa fa-arrow-circle-o-up"></i> '. lang('profile_signup'), 'style="width:100%;" class="btn btn-primary btn-lg"') ?> 
											</div>
											<div class="col-md-6 col-sm-12">
												<?php echo anchor('/profile', '<i class="fa fa-sign-in"></i> '. lang('profile_signin'), 'style="width:100%;" class="btn btn-success btn-lg"') ?>	 		
											</div>
										<?php endif ?>											
									</div>				
								
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 		<div class="page-footer">
			<div class="col-md-8 page-footer-inner pull-right">  
				<p><?php echo lang('current_v') ?><?php echo $current_version ?> - Page rendered in <strong>{elapsed_time}</strong> seconds</p>
			</div>
			<div class="col-md-3 scroll-to-top">
				<i class="fa fa-arrow-circle-o-up"></i>
			</div>
		</div>
		<!-- end container -->
  
		<div class="modal" id="viewEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content"> 
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="text-danger fa fa-times"></i></button>
						<h3 id="myModalLabel2"><i class="fa fa-calendar col-md-1"></i><span id="ic_event_title"></span></h3>
						<div class="control-group"> 
							<div class="controls controls-row" role="alert" id="when"  >
							</div>	 
						</div>						
						
					</div>
					<div class="modal-body"> 
						<div class="col-md-12 col-sm-12"> 
							<blockquote>
							  <span class="controls controls-row" role="message" id="ic_event_desc"></span>
							</blockquote>	
							
							<i><div id="ic_event_urllink"></div></i>	
							<i><div id="ic_event_location"></div></i>	    
							<div id="gmapsCanvas" class="map" style="background-color:transparent;" ></div>   
							<span id="markers_ulat"></span> <span id="markers_ulng"></span> 
							<i><div id="filename"></div></i>	
						</div>
					 <div class="clearfix"></div>
					</div> 
					<div class="modal-footer">  
						<div class="btn-group pull-left">
							<div class="btn btn-success btn-xs pull-left" id="gexport"></div>
							<div class="btn btn-success btn-xs pull-left" id="yexport"></div>	
							<div class="btn btn-success btn-xs pull-left" id="lexport"></div>						  
							<div class="btn btn-success btn-xs pull-left" id="Iexport"></div>						  
						</div>
						<div class="btn-group pull-right"> 
							<div class="pull-right" id="ic_event_allday"></div>
						</div>  
					</div>
				</div>
			</div>
		</div>	 