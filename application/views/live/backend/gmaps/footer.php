 
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>  
	
	<script type="text/javascript"> 
	gmaps_category(); 
	$("#marker_category").change(function(){var e=$("#marker_category option:selected").val();gmaps_category(e)}),getMarkers("home/get_category",function(e){for(var e=JSON.parse(e.responseText),a=0;a<e.length;a++)$("#marker_category").append("<option value="+e[a].category_id+">"+e[a].category_name+" ("+e[a].count+")</option>")});
	</script>
	
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>