  
	<!-- Page Content -->
	<div id="page-wrapper">
					
		<div class="container">
			<div class="row">  
				<div class="col-md-12 col-lg-12 page-background">			   
					<div class="btn-group btn-breadcrumb">
						<a href="<?php echo base_url(); ?>" class="btn btn-default"><?php echo lang('home'); ?></a>
						<a href="<?php echo site_url('page'); ?>" class="btn btn-default"><?php echo lang('page'); ?></a>
						<a href="<?php echo site_url($page_seo); ?>" class="btn btn-default"><?php echo substr($page_title, 0, 20); ?>...</a>
					</div>	
					<div class="col-md-12">
						<h1 class="page-header"><?php echo $page_title ?></h1>
					</div>
					<!-- /.col-md-12 -->
					<div class="col-md-12 col-lg-12">		 
						 <?php echo $page_content ?>
					</div>				
					<!-- /.col-md-9 --> 
				</div> 
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
