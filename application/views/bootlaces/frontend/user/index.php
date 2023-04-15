 

<div id="page-wrapper">
	<div class="container" >
		<div class="row panel">
			<div class="col-md-8 col-xs-12">
				 <div class="header">  
					<div data-role="content" id='calendar' ></div> 
					<div id='loading' style='display:none;'><?php echo lang('calendar_loading_title'); ?></div> 
					<div class="pull-left"><a><span id="timezone"></span></a></div>
					<div class="pull-right"><a class="hero hero-moment"><span id="digiclock"></span><span id="ampm"></span></a> </div>	
				</div>
			</div>
			<div class="col-md-4 col-xs-12">
				<img src="<?php echo $current_logo ?>" alt="" class="img-thumbnail picture hidden-xs img-circle" >  
				
			   <div class="details">
					<h2><?php echo $userinfo->first_name ?> <?php echo $userinfo->last_name ?></h2>	 
					<p><?php echo $userinfo->company ?></p> 
					<p><?php echo $userinfo->phone ?></p> 
					<p><i class="fa fa-calendar fa-lg"></i> <?php echo $allevents ?></p> 
			   </div>
			   
			</div>
		</div>    

	</div>
</div>
  
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
						<p class="open_info hide"><b><div class="controls controls-row" role="alert" id="ic_event_desc"></div></b></p>	
						
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
					</div>
					<div class="btn-group pull-right">
						<div class="pull-right" id="ic_event_allday"></div>
					</div>  
				</div>
			</div>
		</div>
	</div>	