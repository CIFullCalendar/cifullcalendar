  
	<!-- Page Content -->
	<div id="page-wrapper">
					
		<div class="container">
			<div class="row">  
				<div class="col-md-12 page-background">			   
					<div class="btn-group btn-breadcrumb">
						<a href="<?php echo base_url(); ?>" class="btn btn-default"><?php echo lang('home'); ?></a>
						<a href="<?php echo site_url('page'); ?>" class="btn btn-default"><?php echo lang('pages'); ?></a> 
					</div>	
					<div class="col-md-12">
						<h1 class="page-header"><?php echo lang('pages'); ?></h1>
					</div>
					<!-- /.col-md-12 -->
					<div class="col-md-12">							
						<ul class="list-unstyled"> 
							<li><?php echo lang('pages'); ?>						
							<?php foreach($allpages as $pages): ?> 
								<ul>
									<li><a href="<?php echo site_url('/').$pages->seo; ?>" ><?php echo $pages->title; ?></a></li> 
								</ul> 
							<?php endforeach; ?>	
							</li> 
						</ul>	 
					</div>				
					<!-- /.col-md-9 --> 
				</div> 
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
