 
	
	<!-- Footer -->
		<footer>
			<div class="row">
				<div class="col-lg-12">
					<p><?php echo lang('current_v') ?> <?php echo $current_version ?> - Page rendered in <strong>{elapsed_time}</strong> seconds</p> 
				</div>
			</div>
		</footer>

	</div>
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-2.1.1.min.js" type="text/javascript"></script> 
	 
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
	
	<script type="text/javascript"> 
	gmaps_category();

	$("#marker_category").change(function() { 
		var value = $("#marker_category option:selected").val();
		gmaps_category(value);
	});
 
	getRequest("home/get_category", function(data) {
		 
		var data = JSON.parse(data.responseText);

		for (var i = 0; i < data.length; i++) {
			$("#marker_category").append("<option value="+data[i].category_id+">"+data[i].category_name+" ("+data[i].count+")</option>");
		}

	}); 
	</script>
 