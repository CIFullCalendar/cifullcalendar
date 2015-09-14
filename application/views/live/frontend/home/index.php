
        <!-- Product -->
        <div class="product">
            <div class="product-pattern">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 product-background">
                            <div class="row">								
                                <div class="col-sm-6 col-md-12 col-lg-12 calendar">	 
									<div data-role="content" id='calendar' ></div> 
									<strong><?php echo lang('timezone'); ?></strong>: <?php echo $timezone; ?> 
								</div>
                                <div class="col-sm-5 col-md-12 col-lg-5">
									<h2>
										<div class="col-md-10 col-sm-12">
											<strong><?php echo  $page_title ?></strong> <?php echo lang('calendar'); ?> 
										</div>
									</h2>
									<div class="col-md-1 col-sm-12">
										<div class="hero hero-moment hero-circle">
											<div class="hero-face">
												<div id="hour" class="hero-hour"></div>
												<div id="minute" class="hero-minute"></div>
												<div id="second" class="hero-second"></div>
												<div id="ampm" class="hero-ampm"></div>
											</div>
										</div>										
									</div> 		
									
									 <div class="product-description"> 
									<!-- /.col-md-12 -->
										<div class="col-sm-12 col-md-12 col-lg-12 ">							
											<ul class="list-unstyled"> 
												<li><?php echo lang('pages'); ?>						
												<?php foreach($pagename as $pages): ?> 
													<ul>
														<li><a href="<?php echo site_url('/').$pages->seo; ?>" ><?php echo $pages->title; ?></a></li> 
													</ul> 
												<?php endforeach; ?>	
												</li> 
											</ul>	 
										</div>							
									</div>									
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
 
		<!-- end container -->
  
		<div class="modal" id="viewEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content"> 
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="text-danger fa fa-times"></i></button>
						<h3 id="myModalLabel2"><i class="fa fa-calendar col-md-1"></i><div clss="col-md-11" id="ic_event_title"></div></h3>
						<div class="control-group"> 
							<div class="controls controls-row" role="alert" id="when"  >
							</div>	 
						</div>						
						
					</div>
					<div class="modal-body"> 
						<div class="col-md-12 col-sm-12"> 
							<div class="btn-toggle-info ">	
								<i class="open_info fa fa-minus-square-o"></i>
								 <i class="open_info hide fa fa-plus-square-o"></i> <?php echo lang('detail'); ?>
							</div>				
							<p class="open_info hide">
							
							<h4 id="ic_event_desc"></h4>	
							
							<i><div id="ic_event_urllink"></div></i>	
							<i><div id="ic_event_location"></div></i>	
							<i><div id="filename"></div></i>	
						</div>
					 <div class="clearfix"></div>
					</div> 
					<div class="modal-footer">  
						<div class="btn-group pull-left">
							<div class="btn btn-success btn-xs pull-left" id="gexport"></div>
							<div class="btn btn-success btn-xs pull-left" id="yexport"></div>	
							<div class="btn btn-success btn-xs pull-left" id="lexport"></div>						  
						</div>
						<div class="btn-group pull-right">
							<div class="pull-right" id="ic_event_allday"></div>
						</div>  
					</div>
				</div>
			</div>
		</div>	 