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
                                    <h2>
									<div class="col-sm-10 col-md-12 col-lg-12">
									<strong><?php echo $site_name ?></strong> v<strong><?php echo $current_version ?></strong> with current <?php echo 'CodeIgniter v<strong>' . CI_VERSION . '</strong>' ?> and FullCalendar v<strong><span id="fcv"></span></strong>* fused like a&ldquo;Super Saiyan Fusion&rdquo;.
									</div></h2> 
									
                                    <div class="product-description">  
	
										<div class="col-md-12 col-lg-12">
											<h3>About</h3> 
						<p>CIFullCalendar is a server-side dynamic web application that is responsive to any layout of a viewing screen. The &ldquo;Super Saiyan Fusion&rdquo; power of CIFullCalendar allows users to organize, plan and share events to everyone. Simply, install it to your server and become a member then use the wonderful features by easily manipulating your events by dragging, dropping, resizing, clicking, touching, categorizing, grouping, filtering, linking and importing/exporting. </p> 
						<p>In addition, please see <b>features</b>. </p>
										 
										</div>
 
										
										<?php if ((!$this->ion_auth->is_admin()) && (!$this->ion_auth->is_member())): ?> 		
											<div class="col-md-4 col-sm-12">  
												<?php echo anchor('/register', '<i class="fa fa-arrow-circle-o-up"></i> '. lang('profile_signup'), 'style="width:100%;" class="btn btn-primary btn-lg"') ?> 
											</div>
											<div class="col-md-4 col-sm-12">
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

        <!-- Content -->
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <!-- about us -->
					<div class="about-us"> 
						
						<h3>Purpose</h3> 
						<p>If you already or considering having a site or a web application built on CodeIgniter framework, styled by bootstrap or other responsive theme and storing the data on MySQL or any supported databases. This calendar script can be very useful. For example, if you like to create an event site, booking site, appointment site, personal scheduling site, or any other site using CI framework; the script can be easily plug-in into it. The idea is to display shared events on a calendar on your frontend (visitors page) of your site and control it at the backend (admin page) similarly like any other CMS site that can easily edit contents and have it displayed to the public.</p>
						
						<p> <a href="<?php echo base_url();?>docs">Read more...</a></p>
 
					</div>
                    <!-- gallery -->
                    <div class="gallery">
                        <h3>Gallery</h3>
                        <p>Screen shots of CIFullcalendar in action.</p>
						
						<div class="gallery-images">						
							<div id="gallery-images" class="carousel slide " data-ride="carousel">
							  <ol class="carousel-indicators">
								<li data-target="#gallery-images" data-slide-to="0" class="active"></li>
								<li data-target="#gallery-images" data-slide-to="1"></li>
								<li data-target="#gallery-images" data-slide-to="2"></li>
								<li data-target="#gallery-images" data-slide-to="3"></li>
								<li data-target="#gallery-images" data-slide-to="4"></li>
								<li data-target="#gallery-images" data-slide-to="5"></li>
								<li data-target="#gallery-images" data-slide-to="6"></li>
								<li data-target="#gallery-images" data-slide-to="7"></li> 
								<li data-target="#gallery-images" data-slide-to="8"></li> 
								<li data-target="#gallery-images" data-slide-to="9"></li> 
							  </ol>
							  <div class="carousel-inner" role="listbox">
								<div class="item active">
								 <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot1.png" />
								</div>
								<div class="item">
								 <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot2.png" />
								</div>
								<div class="item">
								  <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot3.png" />
								</div>								
								<div class="item">
								  <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot4.png" />
								</div>								
								<div class="item">
								  <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot5.png" />
								</div>								
								<div class="item">
								  <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot6.png" />
								</div>								
								<div class="item">
								  <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot7.png" />
								</div>								
								<div class="item">
								  <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot8.png" />
								</div>							
								<div class="item">
								  <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot9.png" />
								</div>								
								<div class="item">
								  <img class="img-responsive" alt="" src="//www.cifullcalendar.com/assets/img/gallery/screen_shot10.png" />
								</div>
							  </div>
							  <a class="left carousel-control" href="#gallery-images" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							  </a>
							  <a class="right carousel-control" href="#gallery-images" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							  </a>
							</div>	
						</div>	
						
           
                    </div>
                    <div class="advertize">
                        <h3>Ads</h3> 
						<div class="col-md-10 feature-text">	
							 
						</div> 
                    </div>					
					
                </div>
                <div class="col-md-6">
                    <!-- features -->
                    <div class="features">
                        <h3>Features</h3> 
                        <div class="row single-feature">
                            <div class="col-md-2 feature-icon">
                                <i class="fa fa-cloud"></i>
                            </div>
                            <div class="col-md-10 feature-text">
                                <h4>Cloud Support</h4>
                                <p>Supports MySQL or any CodeIgniter supported databases.</p>								
								<p>Sitemaps – Search Engine Optimization purposes <a href="<?php echo base_url();?>sitemap.xml" >(yoursite.com/sitemap.xml)</a></p>
                                <p>JSON – Share all of your public events by url. <a href="<?php echo base_url();?>home/json" >(yoursite.com/home/json)</a>.</p>
								<p>RSS Feeds – Share your public events by rss feeds <a href="<?php echo base_url();?>feeds" >(yoursite.com/feeds)</a>.</p>
								<p>ICAL – Members are able to export a single event to their Google, Yahoo and live calendars or to a ICAL Format (ics/ical).</p> 
                            </div>
                        </div>     
                        <div class="row single-feature">
                            <div class="col-md-2 feature-icon">
                                <i class="fa fa-gears"></i>
                            </div>
                            <div class="col-md-10 feature-text">
                                <h4>Tools and Muscle</h4>
								<p>Supports FullCalendar Scheduler - Purchase <b>FullCalendar Scheduler</b> add-on license that displays events well and assign them easily to various categories. More details <a href="http://fullcalendar.io/scheduler/" >here</a></p>
								<p>Event Filtering – Easily filter/view your shared events on your calendar.</p> 
								<p>Group Sharing – Easily share events among members in various groups</p> 
								<p>Overlap – Deny or Allow events to overlap other events.</p>
								<p>Draggable Events - Allows members to easily drag and drop events by category on the calendar.</p> 
								<p>Calendar settings - Allows administrator and members to adjust the FullCalendar settings easily.</p>
								<p>Attachments – Add/Update/Delete events with an attachment (txt,docx,zip...).</p>
								<p>Recurring Events – Add/Update/Delete events multiple times weekly, monthly etc. by clicking, touching, resizing and dragging.</p>
								<p>Background Events – Add events that appear as background highlights.</p> 
								<p>Touch Support – Update or create events by touching or dragging events. Supported by many touch devices.</p>	
								<p>Import/Export – Allowing members to Import and Export events in bulk using ical format (ics/ical).</p>
								<p>Google Maps – Members are able to use the google maps to view all their events location instantly. More details <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#key" >here</a></p>
								<p>Search – Allowing visitors or members to search for public or their own private events.</p>
								<p>Event Category – Members are able to filter events by categories.</p>
								<p>Event Sources – Members are able to view calendar feeds from other urls on their own calendar.</p>	
								<p>Notifications – Email notifications about public events and others.</p>	 
                            </div>
                        </div>	
                        <div class="row single-feature">
                            <div class="col-md-2 feature-icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="col-md-10 feature-text">
                                <h4>Members and Administration</h4>
								<p>IonAuth - A simple and lightweight authentication library for the CodeIgniter framework. (Currently using IonAuth v2.6.0).</p>
                                <p>Administration – Administrators of the site are able to moderate the site and other activities.</p>
                                <p>Member Profile – Members of the site are able to manipulate their events and other activities.</p>
                                <p>Group – Easily become or not a member of a particular group.</p>
                                <p>Member's unique url – Share your own public events by URL <a href="<?php echo site_url('user') ?>" >(yoursite.com/yourusername)</a></p>
                            </div>
                        </div>
                        <div class="row single-feature">
                            <div class="col-md-2 feature-icon">
                                <i class="fa fa-paint-brush"></i>
                            </div>
                            <div class="col-md-10 feature-text">
                                <h4>Beautiful and Modern Design</h4>								
								<p>CMS – Easily create/update/delete pages and page contents.</p>
								<p>Print friendly - Use your browser to print your calendar events in its current view.</p>
								<p>Template – Easily customize your own themes. (Currently using bootstrap v3.3.7).</p>
								<p>Icons – Easily add icons within your own themes. (Currently using font-awesome v4.6.3).</p>
                                <p>Language – Easily select your desire language. (<strong><?php echo $lang; ?></strong> current language code).
								<a href="https://github.com/CIFullCalendar/cifullcalendar/tree/master/application/language" target="_blank">Language Request</a>
								</p>  
                            </div>
                        </div>						
                    </div>
                </div>
            </div> <!-- end row --> 
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