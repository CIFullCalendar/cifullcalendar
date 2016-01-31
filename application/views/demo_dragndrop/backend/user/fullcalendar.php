	<div id="page-wrapper"> 
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header"><i class="fa fa-calendar fa-fw"></i> <?php echo lang('settings_cal_name') ?> </h2>
			</div>
			<!-- /.col-lg-12 -->		
		</div>
		<!-- /.row -->	
		<div class="row">
			<div class="col-md-12 col-lg-12">  						
				<form id="form_cal" class="form-group" name="form" method="post" action="<?php echo site_url('profile/user/fullcalendar'); ?>">
					<div class="form-group">
						<!-- Form Language-->
						<div class="form-group"> 
							<label for="inputLang"><?php echo lang('theme_language'); ?></label>  
							<select class="form-control" name="cal_language" id="language">
								<option value="en" <?php if($userinfo->lang =='en') { echo "SELECTED";}?>><?php echo lang('lang_english'); ?></option> 
								<option value="es" <?php if($userinfo->lang =='es') { echo "SELECTED";}?>><?php echo lang('lang_spanish'); ?></option> 
								<option value="fr" <?php if($userinfo->lang =='fr') { echo "SELECTED";}?>><?php echo lang('lang_french'); ?></option> 
								<option value="pt" <?php if($userinfo->lang =='pt') { echo "SELECTED";}?>><?php echo lang('lang_portuguese'); ?></option>
								<option value="nl" <?php if($userinfo->lang =='nl') { echo "SELECTED";}?>><?php echo lang('lang_dutch'); ?></option>
								<option value="de" <?php if($userinfo->lang =='de') { echo "SELECTED";}?>><?php echo lang('lang_german'); ?></option>
								<option value="nb" <?php if($userinfo->lang =='nb') { echo "SELECTED";}?>><?php echo lang('lang_norwegian'); ?></option>
								<option value="it" <?php if($userinfo->lang =='it') { echo "SELECTED";}?>><?php echo lang('lang_italian'); ?></option>
								<option value="ru" <?php if($userinfo->lang =='ru') { echo "SELECTED";}?>><?php echo lang('lang_russian'); ?></option>
								<option value="sv" <?php if($userinfo->lang =='sv') { echo "SELECTED";}?>><?php echo lang('lang_swedish'); ?></option>
								<option value="tr" <?php if($userinfo->lang =='tr') { echo "SELECTED";}?>><?php echo lang('lang_turkish'); ?></option>
								<option value="th" <?php if($userinfo->lang =='th') { echo "SELECTED";}?>><?php echo lang('lang_thai'); ?></option>	
								<option value="vi" <?php if($userinfo->lang =='vi') { echo "SELECTED";}?>><?php echo lang('lang_vietnamese'); ?></option>				
								<option value="ko" <?php if($userinfo->lang =='ko') { echo "SELECTED";}?>><?php echo lang('lang_korean'); ?></option>
								<option value="ja" <?php if($userinfo->lang =='ja') { echo "SELECTED";}?>><?php echo lang('lang_japanese'); ?></option>
								<option value="zh-cn" <?php if($userinfo->lang =='zh-cn') { echo "SELECTED";}?>><?php echo lang('lang_chinese'); ?></option>
							</select>
							<?php echo form_error('language') ?> 
						</div>									
					
						<label><?php echo lang('settings_form_timezone') ?></label>  
						<select class="form-control" name="cal_timezone" id="cal_timezone">											
							<option value="" <?php if($userinfo->cal_timezone =='') { echo "SELECTED";}?>  >none</option>
							<option value="local" <?php if($userinfo->cal_timezone =='local') { echo "SELECTED";}?>  >local</option>
							<option value="UTC" <?php if($userinfo->cal_timezone =='UTC') { echo "SELECTED";}?>  >UTC</option>
							<option value="Africa/Abidjan" <?php if($userinfo->cal_timezone =='Africa/Abidjan') { echo "SELECTED";}?>  >Africa/Abidjan</option>
							<option value="Africa/Accra" <?php if($userinfo->cal_timezone =='Africa/Accra') { echo "SELECTED";}?>  >Africa/Accra</option>
							<option value="Africa/Addis_Ababa" <?php if($userinfo->cal_timezone =='Africa/Addis_Ababa') { echo "SELECTED";}?>  >Africa/Addis_Ababa</option>
							<option value="Africa/Algiers" <?php if($userinfo->cal_timezone =='Africa/Algiers') { echo "SELECTED";}?>  >Africa/Algiers</option>
							<option value="Africa/Asmara" <?php if($userinfo->cal_timezone =='Africa/Asmara') { echo "SELECTED";}?>  >Africa/Asmara</option>
							<option value="Africa/Bamako" <?php if($userinfo->cal_timezone =='Africa/Bamako') { echo "SELECTED";}?>  >Africa/Bamako</option>
							<option value="Africa/Bangui" <?php if($userinfo->cal_timezone =='Africa/Bangui') { echo "SELECTED";}?>  >Africa/Bangui</option>
							<option value="Africa/Banjul" <?php if($userinfo->cal_timezone =='Africa/Banjul') { echo "SELECTED";}?>  >Africa/Banjul</option>
							<option value="Africa/Bissau" <?php if($userinfo->cal_timezone =='Africa/Bissau') { echo "SELECTED";}?>  >Africa/Bissau</option>
							<option value="Africa/Blantyre" <?php if($userinfo->cal_timezone =='Africa/Blantyre') { echo "SELECTED";}?>  >Africa/Blantyre</option>
							<option value="Africa/Brazzaville" <?php if($userinfo->cal_timezone =='Africa/Brazzaville') { echo "SELECTED";}?>  >Africa/Brazzaville</option>
							<option value="Africa/Bujumbura" <?php if($userinfo->cal_timezone =='Africa/Bujumbura') { echo "SELECTED";}?>  >Africa/Bujumbura</option>
							<option value="Africa/Cairo" <?php if($userinfo->cal_timezone =='Africa/Cairo') { echo "SELECTED";}?>  >Africa/Cairo</option>
							<option value="Africa/Casablanca" <?php if($userinfo->cal_timezone =='Africa/Casablanca') { echo "SELECTED";}?>  >Africa/Casablanca</option>
							<option value="Africa/Ceuta" <?php if($userinfo->cal_timezone =='Africa/Ceuta') { echo "SELECTED";}?>  >Africa/Ceuta</option>
							<option value="Africa/Conakry" <?php if($userinfo->cal_timezone =='Africa/Conakry') { echo "SELECTED";}?>  >Africa/Conakry</option>
							<option value="Africa/Dakar" <?php if($userinfo->cal_timezone =='Africa/Dakar') { echo "SELECTED";}?>  >Africa/Dakar</option>
							<option value="Africa/Dar_es_Salaam" <?php if($userinfo->cal_timezone =='Africa/Dar_es_Salaam') { echo "SELECTED";}?>  >Africa/Dar_es_Salaam</option>
							<option value="Africa/Djibouti" <?php if($userinfo->cal_timezone =='Africa/Djibouti') { echo "SELECTED";}?>  >Africa/Djibouti</option>
							<option value="Africa/Douala" <?php if($userinfo->cal_timezone =='Africa/Douala') { echo "SELECTED";}?>  >Africa/Douala</option>
							<option value="Africa/El_Aaiun" <?php if($userinfo->cal_timezone =='Africa/El_Aaiun') { echo "SELECTED";}?>  >Africa/El_Aaiun</option>
							<option value="Africa/Freetown" <?php if($userinfo->cal_timezone =='Africa/Freetown') { echo "SELECTED";}?>  >Africa/Freetown</option>
							<option value="Africa/Gaborone" <?php if($userinfo->cal_timezone =='Africa/Gaborone') { echo "SELECTED";}?>  >Africa/Gaborone</option>
							<option value="Africa/Harare" <?php if($userinfo->cal_timezone =='Africa/Harare') { echo "SELECTED";}?>  >Africa/Harare</option>
							<option value="Africa/Johannesburg" <?php if($userinfo->cal_timezone =='Africa/Johannesburg') { echo "SELECTED";}?>  >Africa/Johannesburg</option>
							<option value="Africa/Juba" <?php if($userinfo->cal_timezone =='Africa/Juba') { echo "SELECTED";}?>  >Africa/Juba</option>
							<option value="Africa/Kampala" <?php if($userinfo->cal_timezone =='Africa/Kampala') { echo "SELECTED";}?>  >Africa/Kampala</option>
							<option value="Africa/Khartoum" <?php if($userinfo->cal_timezone =='Africa/Khartoum') { echo "SELECTED";}?>  >Africa/Khartoum</option>
							<option value="Africa/Kigali" <?php if($userinfo->cal_timezone =='Africa/Kigali') { echo "SELECTED";}?>  >Africa/Kigali</option>
							<option value="Africa/Kinshasa" <?php if($userinfo->cal_timezone =='Africa/Kinshasa') { echo "SELECTED";}?>  >Africa/Kinshasa</option>
							<option value="Africa/Lagos" <?php if($userinfo->cal_timezone =='Africa/Lagos') { echo "SELECTED";}?>  >Africa/Lagos</option>
							<option value="Africa/Libreville" <?php if($userinfo->cal_timezone =='Africa/Libreville') { echo "SELECTED";}?>  >Africa/Libreville</option>
							<option value="Africa/Lome" <?php if($userinfo->cal_timezone =='Africa/Lome') { echo "SELECTED";}?>  >Africa/Lome</option>
							<option value="Africa/Luanda" <?php if($userinfo->cal_timezone =='Africa/Luanda') { echo "SELECTED";}?>  >Africa/Luanda</option>
							<option value="Africa/Lubumbashi" <?php if($userinfo->cal_timezone =='Africa/Lubumbashi') { echo "SELECTED";}?>  >Africa/Lubumbashi</option>
							<option value="Africa/Lusaka" <?php if($userinfo->cal_timezone =='Africa/Lusaka') { echo "SELECTED";}?>  >Africa/Lusaka</option>
							<option value="Africa/Malabo" <?php if($userinfo->cal_timezone =='Africa/Malabo') { echo "SELECTED";}?>  >Africa/Malabo</option>
							<option value="Africa/Maputo" <?php if($userinfo->cal_timezone =='Africa/Maputo') { echo "SELECTED";}?>  >Africa/Maputo</option>
							<option value="Africa/Maseru" <?php if($userinfo->cal_timezone =='Africa/Maseru') { echo "SELECTED";}?>  >Africa/Maseru</option>
							<option value="Africa/Mbabane" <?php if($userinfo->cal_timezone =='Africa/Mbabane') { echo "SELECTED";}?>  >Africa/Mbabane</option>
							<option value="Africa/Mogadishu" <?php if($userinfo->cal_timezone =='Africa/Mogadishu') { echo "SELECTED";}?>  >Africa/Mogadishu</option>
							<option value="Africa/Monrovia" <?php if($userinfo->cal_timezone =='Africa/Monrovia') { echo "SELECTED";}?>  >Africa/Monrovia</option>
							<option value="Africa/Nairobi" <?php if($userinfo->cal_timezone =='Africa/Nairobi') { echo "SELECTED";}?>  >Africa/Nairobi</option>
							<option value="Africa/Ndjamena" <?php if($userinfo->cal_timezone =='Africa/Ndjamena') { echo "SELECTED";}?>  >Africa/Ndjamena</option>
							<option value="Africa/Niamey" <?php if($userinfo->cal_timezone =='Africa/Niamey') { echo "SELECTED";}?>  >Africa/Niamey</option>
							<option value="Africa/Nouakchott" <?php if($userinfo->cal_timezone =='Africa/Nouakchott') { echo "SELECTED";}?>  >Africa/Nouakchott</option>
							<option value="Africa/Ouagadougou" <?php if($userinfo->cal_timezone =='Africa/Ouagadougou') { echo "SELECTED";}?>  >Africa/Ouagadougou</option>
							<option value="Africa/Porto-Novo" <?php if($userinfo->cal_timezone =='Africa/Porto-Novo') { echo "SELECTED";}?>  >Africa/Porto-Novo</option>
							<option value="Africa/Sao_Tome" <?php if($userinfo->cal_timezone =='Africa/Sao_Tome') { echo "SELECTED";}?>  >Africa/Sao_Tome</option>
							<option value="Africa/Tripoli" <?php if($userinfo->cal_timezone =='Africa/Tripoli') { echo "SELECTED";}?>  >Africa/Tripoli</option>
							<option value="Africa/Tunis" <?php if($userinfo->cal_timezone =='Africa/Tunis') { echo "SELECTED";}?>  >Africa/Tunis</option>
							<option value="Africa/Windhoek" <?php if($userinfo->cal_timezone =='Africa/Windhoek') { echo "SELECTED";}?>  >Africa/Windhoek</option>
							<option value="America/Adak" <?php if($userinfo->cal_timezone =='America/Adak') { echo "SELECTED";}?>  >America/Adak</option>
							<option value="America/Anchorage" <?php if($userinfo->cal_timezone =='America/Anchorage') { echo "SELECTED";}?>  >America/Anchorage</option>
							<option value="America/Anguilla" <?php if($userinfo->cal_timezone =='America/Anguilla') { echo "SELECTED";}?>  >America/Anguilla</option>
							<option value="America/Antigua" <?php if($userinfo->cal_timezone =='America/Antigua') { echo "SELECTED";}?>  >America/Antigua</option>
							<option value="America/Araguaina" <?php if($userinfo->cal_timezone =='America/Araguaina') { echo "SELECTED";}?>  >America/Araguaina</option>
							<option value="America/Argentina/Buenos_Aires" <?php if($userinfo->cal_timezone =='America/Argentina/Buenos_Aires') { echo "SELECTED";}?>  >America/Argentina/Buenos_Aires</option>
							<option value="America/Argentina/Catamarca" <?php if($userinfo->cal_timezone =='America/Argentina/Catamarca') { echo "SELECTED";}?>  >America/Argentina/Catamarca</option>
							<option value="America/Argentina/Cordoba" <?php if($userinfo->cal_timezone =='America/Argentina/Cordoba') { echo "SELECTED";}?>  >America/Argentina/Cordoba</option>
							<option value="America/Argentina/Jujuy" <?php if($userinfo->cal_timezone =='America/Argentina/Jujuy') { echo "SELECTED";}?>  >America/Argentina/Jujuy</option>
							<option value="America/Argentina/La_Rioja" <?php if($userinfo->cal_timezone =='America/Argentina/La_Rioja') { echo "SELECTED";}?>  >America/Argentina/La_Rioja</option>
							<option value="America/Argentina/Mendoza" <?php if($userinfo->cal_timezone =='America/Argentina/Mendoza') { echo "SELECTED";}?>  >America/Argentina/Mendoza</option>
							<option value="America/Argentina/Rio_Gallegos" <?php if($userinfo->cal_timezone =='America/Argentina/Rio_Gallegos') { echo "SELECTED";}?>  >America/Argentina/Rio_Gallegos</option>
							<option value="America/Argentina/Salta" <?php if($userinfo->cal_timezone =='America/Argentina/Salta') { echo "SELECTED";}?>  >America/Argentina/Salta</option>
							<option value="America/Argentina/San_Juan" <?php if($userinfo->cal_timezone =='America/Argentina/San_Juan') { echo "SELECTED";}?>  >America/Argentina/San_Juan</option>
							<option value="America/Argentina/San_Luis" <?php if($userinfo->cal_timezone =='America/Argentina/San_Luis') { echo "SELECTED";}?>  >America/Argentina/San_Luis</option>
							<option value="America/Argentina/Tucuman" <?php if($userinfo->cal_timezone =='America/Argentina/Tucuman') { echo "SELECTED";}?>  >America/Argentina/Tucuman</option>
							<option value="America/Argentina/Ushuaia" <?php if($userinfo->cal_timezone =='America/Argentina/Ushuaia') { echo "SELECTED";}?>  >America/Argentina/Ushuaia</option>
							<option value="America/Aruba" <?php if($userinfo->cal_timezone =='America/Aruba') { echo "SELECTED";}?>  >America/Aruba</option>
							<option value="America/Asuncion" <?php if($userinfo->cal_timezone =='America/Asuncion') { echo "SELECTED";}?>  >America/Asuncion</option>
							<option value="America/Atikokan" <?php if($userinfo->cal_timezone =='America/Atikokan') { echo "SELECTED";}?>  >America/Atikokan</option>
							<option value="America/Bahia" <?php if($userinfo->cal_timezone =='America/Bahia') { echo "SELECTED";}?>  >America/Bahia</option>
							<option value="America/Bahia_Banderas" <?php if($userinfo->cal_timezone =='America/Bahia_Banderas') { echo "SELECTED";}?>  >America/Bahia_Banderas</option>
							<option value="America/Barbados" <?php if($userinfo->cal_timezone =='America/Barbados') { echo "SELECTED";}?>  >America/Barbados</option>
							<option value="America/Belem" <?php if($userinfo->cal_timezone =='America/Belem') { echo "SELECTED";}?>  >America/Belem</option>
							<option value="America/Belize" <?php if($userinfo->cal_timezone =='America/Belize') { echo "SELECTED";}?>  >America/Belize</option>
							<option value="America/Blanc-Sablon" <?php if($userinfo->cal_timezone =='America/Blanc-Sablon') { echo "SELECTED";}?>  >America/Blanc-Sablon</option>
							<option value="America/Boa_Vista" <?php if($userinfo->cal_timezone =='America/Boa_Vista') { echo "SELECTED";}?>  >America/Boa_Vista</option>
							<option value="America/Bogota" <?php if($userinfo->cal_timezone =='America/Bogota') { echo "SELECTED";}?>  >America/Bogota</option>
							<option value="America/Boise" <?php if($userinfo->cal_timezone =='America/Boise') { echo "SELECTED";}?>  >America/Boise</option>
							<option value="America/Cambridge_Bay" <?php if($userinfo->cal_timezone =='America/Cambridge_Bay') { echo "SELECTED";}?>  >America/Cambridge_Bay</option>
							<option value="America/Campo_Grande" <?php if($userinfo->cal_timezone =='America/Campo_Grande') { echo "SELECTED";}?>  >America/Campo_Grande</option>
							<option value="America/Cancun" <?php if($userinfo->cal_timezone =='America/Cancun') { echo "SELECTED";}?>  >America/Cancun</option>
							<option value="America/Caracas" <?php if($userinfo->cal_timezone =='America/Caracas') { echo "SELECTED";}?>  >America/Caracas</option>
							<option value="America/Cayenne" <?php if($userinfo->cal_timezone =='America/Cayenne') { echo "SELECTED";}?>  >America/Cayenne</option>
							<option value="America/Cayman" <?php if($userinfo->cal_timezone =='America/Cayman') { echo "SELECTED";}?>  >America/Cayman</option>
							<option value="America/Chicago" <?php if($userinfo->cal_timezone =='America/Chicago') { echo "SELECTED";}?>  >America/Chicago</option>
							<option value="America/Chihuahua" <?php if($userinfo->cal_timezone =='America/Chihuahua') { echo "SELECTED";}?>  >America/Chihuahua</option>
							<option value="America/Costa_Rica" <?php if($userinfo->cal_timezone =='America/Costa_Rica') { echo "SELECTED";}?>  >America/Costa_Rica</option>
							<option value="America/Creston" <?php if($userinfo->cal_timezone =='America/Creston') { echo "SELECTED";}?>  >America/Creston</option>
							<option value="America/Cuiaba" <?php if($userinfo->cal_timezone =='America/Cuiaba') { echo "SELECTED";}?>  >America/Cuiaba</option>
							<option value="America/Curacao" <?php if($userinfo->cal_timezone =='America/Curacao') { echo "SELECTED";}?>  >America/Curacao</option>
							<option value="America/Danmarkshavn" <?php if($userinfo->cal_timezone =='America/Danmarkshavn') { echo "SELECTED";}?>  >America/Danmarkshavn</option>
							<option value="America/Dawson" <?php if($userinfo->cal_timezone =='America/Dawson') { echo "SELECTED";}?>  >America/Dawson</option>
							<option value="America/Dawson_Creek" <?php if($userinfo->cal_timezone =='America/Dawson_Creek') { echo "SELECTED";}?>  >America/Dawson_Creek</option>
							<option value="America/Denver" <?php if($userinfo->cal_timezone =='America/Denver') { echo "SELECTED";}?>  >America/Denver</option>
							<option value="America/Detroit" <?php if($userinfo->cal_timezone =='America/Detroit') { echo "SELECTED";}?>  >America/Detroit</option>
							<option value="America/Dominica" <?php if($userinfo->cal_timezone =='America/Dominica') { echo "SELECTED";}?>  >America/Dominica</option>
							<option value="America/Edmonton" <?php if($userinfo->cal_timezone =='America/Edmonton') { echo "SELECTED";}?>  >America/Edmonton</option>
							<option value="America/Eirunepe" <?php if($userinfo->cal_timezone =='America/Eirunepe') { echo "SELECTED";}?>  >America/Eirunepe</option>
							<option value="America/El_Salvador" <?php if($userinfo->cal_timezone =='America/El_Salvador') { echo "SELECTED";}?>  >America/El_Salvador</option>
							<option value="America/Fortaleza" <?php if($userinfo->cal_timezone =='America/Fortaleza') { echo "SELECTED";}?>  >America/Fortaleza</option>
							<option value="America/Glace_Bay" <?php if($userinfo->cal_timezone =='America/Glace_Bay') { echo "SELECTED";}?>  >America/Glace_Bay</option>
							<option value="America/Godthab" <?php if($userinfo->cal_timezone =='America/Godthab') { echo "SELECTED";}?>  >America/Godthab</option>
							<option value="America/Goose_Bay" <?php if($userinfo->cal_timezone =='America/Goose_Bay') { echo "SELECTED";}?>  >America/Goose_Bay</option>
							<option value="America/Grand_Turk" <?php if($userinfo->cal_timezone =='America/Grand_Turk') { echo "SELECTED";}?>  >America/Grand_Turk</option>
							<option value="America/Grenada" <?php if($userinfo->cal_timezone =='America/Grenada') { echo "SELECTED";}?>  >America/Grenada</option>
							<option value="America/Guadeloupe" <?php if($userinfo->cal_timezone =='America/Guadeloupe') { echo "SELECTED";}?>  >America/Guadeloupe</option>
							<option value="America/Guatemala" <?php if($userinfo->cal_timezone =='America/Guatemala') { echo "SELECTED";}?>  >America/Guatemala</option>
							<option value="America/Guayaquil" <?php if($userinfo->cal_timezone =='America/Guayaquil') { echo "SELECTED";}?>  >America/Guayaquil</option>
							<option value="America/Guyana" <?php if($userinfo->cal_timezone =='America/Guyana') { echo "SELECTED";}?>  >America/Guyana</option>
							<option value="America/Halifax" <?php if($userinfo->cal_timezone =='America/Halifax') { echo "SELECTED";}?>  >America/Halifax</option>
							<option value="America/Havana" <?php if($userinfo->cal_timezone =='America/Havana') { echo "SELECTED";}?>  >America/Havana</option>
							<option value="America/Hermosillo" <?php if($userinfo->cal_timezone =='America/Hermosillo') { echo "SELECTED";}?>  >America/Hermosillo</option>
							<option value="America/Indiana/Indianapolis" <?php if($userinfo->cal_timezone =='America/Indiana/Indianapolis') { echo "SELECTED";}?>  >America/Indiana/Indianapolis</option>
							<option value="America/Indiana/Knox" <?php if($userinfo->cal_timezone =='America/Indiana/Knox') { echo "SELECTED";}?>  >America/Indiana/Knox</option>
							<option value="America/Indiana/Marengo" <?php if($userinfo->cal_timezone =='America/Indiana/Marengo') { echo "SELECTED";}?>  >America/Indiana/Marengo</option>
							<option value="America/Indiana/Petersburg" <?php if($userinfo->cal_timezone =='America/Indiana/Petersburg') { echo "SELECTED";}?>  >America/Indiana/Petersburg</option>
							<option value="America/Indiana/Tell_City" <?php if($userinfo->cal_timezone =='America/Indiana/Tell_City') { echo "SELECTED";}?>  >America/Indiana/Tell_City</option>
							<option value="America/Indiana/Vevay" <?php if($userinfo->cal_timezone =='America/Indiana/Vevay') { echo "SELECTED";}?>  >America/Indiana/Vevay</option>
							<option value="America/Indiana/Vincennes" <?php if($userinfo->cal_timezone =='America/Indiana/Vincennes') { echo "SELECTED";}?>  >America/Indiana/Vincennes</option>
							<option value="America/Indiana/Winamac" <?php if($userinfo->cal_timezone =='America/Indiana/Winamac') { echo "SELECTED";}?>  >America/Indiana/Winamac</option>
							<option value="America/Inuvik" <?php if($userinfo->cal_timezone =='America/Inuvik') { echo "SELECTED";}?>  >America/Inuvik</option>
							<option value="America/Iqaluit" <?php if($userinfo->cal_timezone =='America/Iqaluit') { echo "SELECTED";}?>  >America/Iqaluit</option>
							<option value="America/Jamaica" <?php if($userinfo->cal_timezone =='America/Jamaica') { echo "SELECTED";}?>  >America/Jamaica</option>
							<option value="America/Juneau" <?php if($userinfo->cal_timezone =='America/Juneau') { echo "SELECTED";}?>  >America/Juneau</option>
							<option value="America/Kentucky/Louisville" <?php if($userinfo->cal_timezone =='America/Kentucky/Louisville') { echo "SELECTED";}?>  >America/Kentucky/Louisville</option>
							<option value="America/Kentucky/Monticello" <?php if($userinfo->cal_timezone =='America/Kentucky/Monticello') { echo "SELECTED";}?>  >America/Kentucky/Monticello</option>
							<option value="America/Kralendijk" <?php if($userinfo->cal_timezone =='America/Kralendijk') { echo "SELECTED";}?>  >America/Kralendijk</option>
							<option value="America/La_Paz" <?php if($userinfo->cal_timezone =='America/La_Paz') { echo "SELECTED";}?>  >America/La_Paz</option>
							<option value="America/Lima" <?php if($userinfo->cal_timezone =='America/Lima') { echo "SELECTED";}?>  >America/Lima</option>
							<option value="America/Los_Angeles" <?php if($userinfo->cal_timezone =='America/Los_Angeles') { echo "SELECTED";}?>  >America/Los_Angeles</option>
							<option value="America/Lower_Princes" <?php if($userinfo->cal_timezone =='America/Lower_Princes') { echo "SELECTED";}?>  >America/Lower_Princes</option>
							<option value="America/Maceio" <?php if($userinfo->cal_timezone =='America/Maceio') { echo "SELECTED";}?>  >America/Maceio</option>
							<option value="America/Managua" <?php if($userinfo->cal_timezone =='America/Managua') { echo "SELECTED";}?>  >America/Managua</option>
							<option value="America/Manaus" <?php if($userinfo->cal_timezone =='America/Manaus') { echo "SELECTED";}?>  >America/Manaus</option>
							<option value="America/Marigot" <?php if($userinfo->cal_timezone =='America/Marigot') { echo "SELECTED";}?>  >America/Marigot</option>
							<option value="America/Martinique" <?php if($userinfo->cal_timezone =='America/Martinique') { echo "SELECTED";}?>  >America/Martinique</option>
							<option value="America/Matamoros" <?php if($userinfo->cal_timezone =='America/Matamoros') { echo "SELECTED";}?>  >America/Matamoros</option>
							<option value="America/Mazatlan" <?php if($userinfo->cal_timezone =='America/Mazatlan') { echo "SELECTED";}?>  >America/Mazatlan</option>
							<option value="America/Menominee" <?php if($userinfo->cal_timezone =='America/Menominee') { echo "SELECTED";}?>  >America/Menominee</option>
							<option value="America/Merida" <?php if($userinfo->cal_timezone =='America/Merida') { echo "SELECTED";}?>  >America/Merida</option>
							<option value="America/Metlakatla" <?php if($userinfo->cal_timezone =='America/Metlakatla') { echo "SELECTED";}?>  >America/Metlakatla</option>
							<option value="America/Mexico_City" <?php if($userinfo->cal_timezone =='America/Mexico_City') { echo "SELECTED";}?>  >America/Mexico_City</option>
							<option value="America/Miquelon" <?php if($userinfo->cal_timezone =='America/Miquelon') { echo "SELECTED";}?>  >America/Miquelon</option>
							<option value="America/Moncton" <?php if($userinfo->cal_timezone =='America/Moncton') { echo "SELECTED";}?>  >America/Moncton</option>
							<option value="America/Monterrey" <?php if($userinfo->cal_timezone =='America/Monterrey') { echo "SELECTED";}?>  >America/Monterrey</option>
							<option value="America/Montevideo" <?php if($userinfo->cal_timezone =='America/Montevideo') { echo "SELECTED";}?>  >America/Montevideo</option>
							<option value="America/Montserrat" <?php if($userinfo->cal_timezone =='America/Montserrat') { echo "SELECTED";}?>  >America/Montserrat</option>
							<option value="America/Nassau" <?php if($userinfo->cal_timezone =='America/Nassau') { echo "SELECTED";}?>  >America/Nassau</option>
							<option value="America/New_York" <?php if($userinfo->cal_timezone =='America/New_York') { echo "SELECTED";}?>  >America/New_York</option>
							<option value="America/Nipigon" <?php if($userinfo->cal_timezone =='America/Nipigon') { echo "SELECTED";}?>  >America/Nipigon</option>
							<option value="America/Nome" <?php if($userinfo->cal_timezone =='America/Nome') { echo "SELECTED";}?>  >America/Nome</option>
							<option value="America/Noronha" <?php if($userinfo->cal_timezone =='America/Noronha') { echo "SELECTED";}?>  >America/Noronha</option>
							<option value="America/North_Dakota/Beulah" <?php if($userinfo->cal_timezone =='America/North_Dakota/Beulah') { echo "SELECTED";}?>  >America/North_Dakota/Beulah</option>
							<option value="America/North_Dakota/Center" <?php if($userinfo->cal_timezone =='America/North_Dakota/Center') { echo "SELECTED";}?>  >America/North_Dakota/Center</option>
							<option value="America/North_Dakota/New_Salem" <?php if($userinfo->cal_timezone =='America/North_Dakota/New_Salem') { echo "SELECTED";}?>  >America/North_Dakota/New_Salem</option>
							<option value="America/Ojinaga" <?php if($userinfo->cal_timezone =='America/Ojinaga') { echo "SELECTED";}?>  >America/Ojinaga</option>
							<option value="America/Panama" <?php if($userinfo->cal_timezone =='America/Panama') { echo "SELECTED";}?>  >America/Panama</option>
							<option value="America/Pangnirtung" <?php if($userinfo->cal_timezone =='America/Pangnirtung') { echo "SELECTED";}?>  >America/Pangnirtung</option>
							<option value="America/Paramaribo" <?php if($userinfo->cal_timezone =='America/Paramaribo') { echo "SELECTED";}?>  >America/Paramaribo</option>
							<option value="America/Phoenix" <?php if($userinfo->cal_timezone =='America/Phoenix') { echo "SELECTED";}?>  >America/Phoenix</option>
							<option value="America/Port-au-Prince" <?php if($userinfo->cal_timezone =='America/Port-au-Prince') { echo "SELECTED";}?>  >America/Port-au-Prince</option>
							<option value="America/Port_of_Spain" <?php if($userinfo->cal_timezone =='America/Port_of_Spain') { echo "SELECTED";}?>  >America/Port_of_Spain</option>
							<option value="America/Porto_Velho" <?php if($userinfo->cal_timezone =='America/Porto_Velho') { echo "SELECTED";}?>  >America/Porto_Velho</option>
							<option value="America/Puerto_Rico" <?php if($userinfo->cal_timezone =='America/Puerto_Rico') { echo "SELECTED";}?>  >America/Puerto_Rico</option>
							<option value="America/Rainy_River" <?php if($userinfo->cal_timezone =='America/Rainy_River') { echo "SELECTED";}?>  >America/Rainy_River</option>
							<option value="America/Rankin_Inlet" <?php if($userinfo->cal_timezone =='America/Rankin_Inlet') { echo "SELECTED";}?>  >America/Rankin_Inlet</option>
							<option value="America/Recife" <?php if($userinfo->cal_timezone =='America/Recife') { echo "SELECTED";}?>  >America/Recife</option>
							<option value="America/Regina" <?php if($userinfo->cal_timezone =='America/Regina') { echo "SELECTED";}?>  >America/Regina</option>
							<option value="America/Resolute" <?php if($userinfo->cal_timezone =='America/Resolute') { echo "SELECTED";}?>  >America/Resolute</option>
							<option value="America/Rio_Branco" <?php if($userinfo->cal_timezone =='America/Rio_Branco') { echo "SELECTED";}?>  >America/Rio_Branco</option>
							<option value="America/Santa_Isabel" <?php if($userinfo->cal_timezone =='America/Santa_Isabel') { echo "SELECTED";}?>  >America/Santa_Isabel</option>
							<option value="America/Santarem" <?php if($userinfo->cal_timezone =='America/Santarem') { echo "SELECTED";}?>  >America/Santarem</option>
							<option value="America/Santiago" <?php if($userinfo->cal_timezone =='America/Santiago') { echo "SELECTED";}?>  >America/Santiago</option>
							<option value="America/Santo_Domingo" <?php if($userinfo->cal_timezone =='America/Santo_Domingo') { echo "SELECTED";}?>  >America/Santo_Domingo</option>
							<option value="America/Sao_Paulo" <?php if($userinfo->cal_timezone =='America/Sao_Paulo') { echo "SELECTED";}?>  >America/Sao_Paulo</option>
							<option value="America/Scoresbysund" <?php if($userinfo->cal_timezone =='America/Scoresbysund') { echo "SELECTED";}?>  >America/Scoresbysund</option>
							<option value="America/Sitka" <?php if($userinfo->cal_timezone =='America/Sitka') { echo "SELECTED";}?>  >America/Sitka</option>
							<option value="America/St_Barthelemy" <?php if($userinfo->cal_timezone =='America/St_Barthelemy') { echo "SELECTED";}?>  >America/St_Barthelemy</option>
							<option value="America/St_Johns" <?php if($userinfo->cal_timezone =='America/St_Johns') { echo "SELECTED";}?>  >America/St_Johns</option>
							<option value="America/St_Kitts" <?php if($userinfo->cal_timezone =='America/St_Kitts') { echo "SELECTED";}?>  >America/St_Kitts</option>
							<option value="America/St_Lucia" <?php if($userinfo->cal_timezone =='America/St_Lucia') { echo "SELECTED";}?>  >America/St_Lucia</option>
							<option value="America/St_Thomas" <?php if($userinfo->cal_timezone =='America/St_Thomas') { echo "SELECTED";}?>  >America/St_Thomas</option>
							<option value="America/St_Vincent" <?php if($userinfo->cal_timezone =='America/St_Vincent') { echo "SELECTED";}?>  >America/St_Vincent</option>
							<option value="America/Swif(t_Current" <?php if($userinfo->cal_timezone =='America/Swif(t_Current') { echo "SELECTED";}?>  >America/Swif(t_Current</option>
							<option value="America/Tegucigalpa" <?php if($userinfo->cal_timezone =='America/Tegucigalpa') { echo "SELECTED";}?>  >America/Tegucigalpa</option>
							<option value="America/Thule" <?php if($userinfo->cal_timezone =='America/Thule') { echo "SELECTED";}?>  >America/Thule</option>
							<option value="America/Thunder_Bay" <?php if($userinfo->cal_timezone =='America/Thunder_Bay') { echo "SELECTED";}?>  >America/Thunder_Bay</option>
							<option value="America/Tijuana" <?php if($userinfo->cal_timezone =='America/Tijuana') { echo "SELECTED";}?>  >America/Tijuana</option>
							<option value="America/Toronto" <?php if($userinfo->cal_timezone =='America/Toronto') { echo "SELECTED";}?>  >America/Toronto</option>
							<option value="America/Tortola" <?php if($userinfo->cal_timezone =='America/Tortola') { echo "SELECTED";}?>  >America/Tortola</option>
							<option value="America/Vancouver" <?php if($userinfo->cal_timezone =='America/Vancouver') { echo "SELECTED";}?>  >America/Vancouver</option>
							<option value="America/Whitehorse" <?php if($userinfo->cal_timezone =='America/Whitehorse') { echo "SELECTED";}?>  >America/Whitehorse</option>
							<option value="America/Winnipeg" <?php if($userinfo->cal_timezone =='America/Winnipeg') { echo "SELECTED";}?>  >America/Winnipeg</option>
							<option value="America/Yakutat" <?php if($userinfo->cal_timezone =='America/Yakutat') { echo "SELECTED";}?>  >America/Yakutat</option>
							<option value="America/Yellowknife" <?php if($userinfo->cal_timezone =='America/Yellowknife') { echo "SELECTED";}?>  >America/Yellowknife</option>
							<option value="Antarctica/Casey" <?php if($userinfo->cal_timezone =='Antarctica/Casey') { echo "SELECTED";}?>  >Antarctica/Casey</option>
							<option value="Antarctica/Davis" <?php if($userinfo->cal_timezone =='Antarctica/Davis') { echo "SELECTED";}?>  >Antarctica/Davis</option>
							<option value="Antarctica/DumontDUrville" <?php if($userinfo->cal_timezone =='Antarctica/DumontDUrville') { echo "SELECTED";}?>  >Antarctica/DumontDUrville</option>
							<option value="Antarctica/Macquarie" <?php if($userinfo->cal_timezone =='Antarctica/Macquarie') { echo "SELECTED";}?>  >Antarctica/Macquarie</option>
							<option value="Antarctica/Mawson" <?php if($userinfo->cal_timezone =='Antarctica/Mawson') { echo "SELECTED";}?>  >Antarctica/Mawson</option>
							<option value="Antarctica/McMurdo" <?php if($userinfo->cal_timezone =='Antarctica/McMurdo') { echo "SELECTED";}?>  >Antarctica/McMurdo</option>
							<option value="Antarctica/Palmer" <?php if($userinfo->cal_timezone =='Antarctica/Palmer') { echo "SELECTED";}?>  >Antarctica/Palmer</option>
							<option value="Antarctica/Rothera" <?php if($userinfo->cal_timezone =='Antarctica/Rothera') { echo "SELECTED";}?>  >Antarctica/Rothera</option>
							<option value="Antarctica/Syowa" <?php if($userinfo->cal_timezone =='Antarctica/Syowa') { echo "SELECTED";}?>  >Antarctica/Syowa</option>
							<option value="Antarctica/Vostok" <?php if($userinfo->cal_timezone =='Antarctica/Vostok') { echo "SELECTED";}?>  >Antarctica/Vostok</option>
							<option value="Arctic/Longyearbyen" <?php if($userinfo->cal_timezone =='Arctic/Longyearbyen') { echo "SELECTED";}?>  >Arctic/Longyearbyen</option>
							<option value="Asia/Aden" <?php if($userinfo->cal_timezone =='Asia/Aden') { echo "SELECTED";}?>  >Asia/Aden</option>
							<option value="Asia/Almaty" <?php if($userinfo->cal_timezone =='Asia/Almaty') { echo "SELECTED";}?>  >Asia/Almaty</option>
							<option value="Asia/Amman" <?php if($userinfo->cal_timezone =='Asia/Amman') { echo "SELECTED";}?>  >Asia/Amman</option>
							<option value="Asia/Anadyr" <?php if($userinfo->cal_timezone =='Asia/Anadyr') { echo "SELECTED";}?>  >Asia/Anadyr</option>
							<option value="Asia/Aqtau" <?php if($userinfo->cal_timezone =='Asia/Aqtau') { echo "SELECTED";}?>  >Asia/Aqtau</option>
							<option value="Asia/Aqtobe" <?php if($userinfo->cal_timezone =='Asia/Aqtobe') { echo "SELECTED";}?>  >Asia/Aqtobe</option>
							<option value="Asia/Ashgabat" <?php if($userinfo->cal_timezone =='Asia/Ashgabat') { echo "SELECTED";}?>  >Asia/Ashgabat</option>
							<option value="Asia/Baghdad" <?php if($userinfo->cal_timezone =='Asia/Baghdad') { echo "SELECTED";}?>  >Asia/Baghdad</option>
							<option value="Asia/Bahrain" <?php if($userinfo->cal_timezone =='Asia/Bahrain') { echo "SELECTED";}?>  >Asia/Bahrain</option>
							<option value="Asia/Baku" <?php if($userinfo->cal_timezone =='Asia/Baku') { echo "SELECTED";}?>  >Asia/Baku</option>
							<option value="Asia/Bangkok" <?php if($userinfo->cal_timezone =='Asia/Bangkok') { echo "SELECTED";}?>  >Asia/Bangkok</option>
							<option value="Asia/Beirut" <?php if($userinfo->cal_timezone =='Asia/Beirut') { echo "SELECTED";}?>  >Asia/Beirut</option>
							<option value="Asia/Bishkek" <?php if($userinfo->cal_timezone =='Asia/Bishkek') { echo "SELECTED";}?>  >Asia/Bishkek</option>
							<option value="Asia/Brunei" <?php if($userinfo->cal_timezone =='Asia/Brunei') { echo "SELECTED";}?>  >Asia/Brunei</option>
							<option value="Asia/Choibalsan" <?php if($userinfo->cal_timezone =='Asia/Choibalsan') { echo "SELECTED";}?>  >Asia/Choibalsan</option>
							<option value="Asia/Chongqing" <?php if($userinfo->cal_timezone =='Asia/Chongqing') { echo "SELECTED";}?>  >Asia/Chongqing</option>
							<option value="Asia/Colombo" <?php if($userinfo->cal_timezone =='Asia/Colombo') { echo "SELECTED";}?>  >Asia/Colombo</option>
							<option value="Asia/Damascus" <?php if($userinfo->cal_timezone =='Asia/Damascus') { echo "SELECTED";}?>  >Asia/Damascus</option>
							<option value="Asia/Dhaka" <?php if($userinfo->cal_timezone =='Asia/Dhaka') { echo "SELECTED";}?>  >Asia/Dhaka</option>
							<option value="Asia/Dili" <?php if($userinfo->cal_timezone =='Asia/Dili') { echo "SELECTED";}?>  >Asia/Dili</option>
							<option value="Asia/Dubai" <?php if($userinfo->cal_timezone =='Asia/Dubai') { echo "SELECTED";}?>  >Asia/Dubai</option>
							<option value="Asia/Dushanbe" <?php if($userinfo->cal_timezone =='Asia/Dushanbe') { echo "SELECTED";}?>  >Asia/Dushanbe</option>
							<option value="Asia/Gaza" <?php if($userinfo->cal_timezone =='Asia/Gaza') { echo "SELECTED";}?>  >Asia/Gaza</option>
							<option value="Asia/Harbin" <?php if($userinfo->cal_timezone =='Asia/Harbin') { echo "SELECTED";}?>  >Asia/Harbin</option>
							<option value="Asia/Hebron" <?php if($userinfo->cal_timezone =='Asia/Hebron') { echo "SELECTED";}?>  >Asia/Hebron</option>
							<option value="Asia/Ho_Chi_Minh" <?php if($userinfo->cal_timezone =='Asia/Ho_Chi_Minh') { echo "SELECTED";}?>  >Asia/Ho_Chi_Minh</option>
							<option value="Asia/Hong_Kong" <?php if($userinfo->cal_timezone =='Asia/Hong_Kong') { echo "SELECTED";}?>  >Asia/Hong_Kong</option>
							<option value="Asia/Hovd" <?php if($userinfo->cal_timezone =='Asia/Hovd') { echo "SELECTED";}?>  >Asia/Hovd</option>
							<option value="Asia/Irkutsk" <?php if($userinfo->cal_timezone =='Asia/Irkutsk') { echo "SELECTED";}?>  >Asia/Irkutsk</option>
							<option value="Asia/Jakarta" <?php if($userinfo->cal_timezone =='Asia/Jakarta') { echo "SELECTED";}?>  >Asia/Jakarta</option>
							<option value="Asia/Jayapura" <?php if($userinfo->cal_timezone =='Asia/Jayapura') { echo "SELECTED";}?>  >Asia/Jayapura</option>
							<option value="Asia/Jerusalem" <?php if($userinfo->cal_timezone =='Asia/Jerusalem') { echo "SELECTED";}?>  >Asia/Jerusalem</option>
							<option value="Asia/Kabul" <?php if($userinfo->cal_timezone =='Asia/Kabul') { echo "SELECTED";}?>  >Asia/Kabul</option>
							<option value="Asia/Kamchatka" <?php if($userinfo->cal_timezone =='Asia/Kamchatka') { echo "SELECTED";}?>  >Asia/Kamchatka</option>
							<option value="Asia/Karachi" <?php if($userinfo->cal_timezone =='Asia/Karachi') { echo "SELECTED";}?>  >Asia/Karachi</option>
							<option value="Asia/Kashgar" <?php if($userinfo->cal_timezone =='Asia/Kashgar') { echo "SELECTED";}?>  >Asia/Kashgar</option>
							<option value="Asia/Kathmandu" <?php if($userinfo->cal_timezone =='Asia/Kathmandu') { echo "SELECTED";}?>  >Asia/Kathmandu</option>
							<option value="Asia/Khandyga" <?php if($userinfo->cal_timezone =='Asia/Khandyga') { echo "SELECTED";}?>  >Asia/Khandyga</option>
							<option value="Asia/Kolkata" <?php if($userinfo->cal_timezone =='Asia/Kolkata') { echo "SELECTED";}?>  >Asia/Kolkata</option>
							<option value="Asia/Krasnoyarsk" <?php if($userinfo->cal_timezone =='Asia/Krasnoyarsk') { echo "SELECTED";}?>  >Asia/Krasnoyarsk</option>
							<option value="Asia/Kuala_Lumpur" <?php if($userinfo->cal_timezone =='Asia/Kuala_Lumpur') { echo "SELECTED";}?>  >Asia/Kuala_Lumpur</option>
							<option value="Asia/Kuching" <?php if($userinfo->cal_timezone =='Asia/Kuching') { echo "SELECTED";}?>  >Asia/Kuching</option>
							<option value="Asia/Kuwait" <?php if($userinfo->cal_timezone =='Asia/Kuwait') { echo "SELECTED";}?>  >Asia/Kuwait</option>
							<option value="Asia/Macau" <?php if($userinfo->cal_timezone =='Asia/Macau') { echo "SELECTED";}?>  >Asia/Macau</option>
							<option value="Asia/Magadan" <?php if($userinfo->cal_timezone =='Asia/Magadan') { echo "SELECTED";}?>  >Asia/Magadan</option>
							<option value="Asia/Makassar" <?php if($userinfo->cal_timezone =='Asia/Makassar') { echo "SELECTED";}?>  >Asia/Makassar</option>
							<option value="Asia/Manila" <?php if($userinfo->cal_timezone =='Asia/Manila') { echo "SELECTED";}?>  >Asia/Manila</option>
							<option value="Asia/Muscat" <?php if($userinfo->cal_timezone =='Asia/Muscat') { echo "SELECTED";}?>  >Asia/Muscat</option>
							<option value="Asia/Nicosia" <?php if($userinfo->cal_timezone =='Asia/Nicosia') { echo "SELECTED";}?>  >Asia/Nicosia</option>
							<option value="Asia/Novokuznetsk" <?php if($userinfo->cal_timezone =='Asia/Novokuznetsk') { echo "SELECTED";}?>  >Asia/Novokuznetsk</option>
							<option value="Asia/Novosibirsk" <?php if($userinfo->cal_timezone =='Asia/Novosibirsk') { echo "SELECTED";}?>  >Asia/Novosibirsk</option>
							<option value="Asia/Omsk" <?php if($userinfo->cal_timezone =='Asia/Omsk') { echo "SELECTED";}?>  >Asia/Omsk</option>
							<option value="Asia/Oral" <?php if($userinfo->cal_timezone =='Asia/Oral') { echo "SELECTED";}?>  >Asia/Oral</option>
							<option value="Asia/Phnom_Penh" <?php if($userinfo->cal_timezone =='Asia/Phnom_Penh') { echo "SELECTED";}?>  >Asia/Phnom_Penh</option>
							<option value="Asia/Pontianak" <?php if($userinfo->cal_timezone =='Asia/Pontianak') { echo "SELECTED";}?>  >Asia/Pontianak</option>
							<option value="Asia/Pyongyang" <?php if($userinfo->cal_timezone =='Asia/Pyongyang') { echo "SELECTED";}?>  >Asia/Pyongyang</option>
							<option value="Asia/Qatar" <?php if($userinfo->cal_timezone =='Asia/Qatar') { echo "SELECTED";}?>  >Asia/Qatar</option>
							<option value="Asia/Qyzylorda" <?php if($userinfo->cal_timezone =='Asia/Qyzylorda') { echo "SELECTED";}?>  >Asia/Qyzylorda</option>
							<option value="Asia/Rangoon" <?php if($userinfo->cal_timezone =='Asia/Rangoon') { echo "SELECTED";}?>  >Asia/Rangoon</option>
							<option value="Asia/Riyadh" <?php if($userinfo->cal_timezone =='Asia/Riyadh') { echo "SELECTED";}?>  >Asia/Riyadh</option>
							<option value="Asia/Sakhalin" <?php if($userinfo->cal_timezone =='Asia/Sakhalin') { echo "SELECTED";}?>  >Asia/Sakhalin</option>
							<option value="Asia/Samarkand" <?php if($userinfo->cal_timezone =='Asia/Samarkand') { echo "SELECTED";}?>  >Asia/Samarkand</option>
							<option value="Asia/Seoul" <?php if($userinfo->cal_timezone =='Asia/Seoul') { echo "SELECTED";}?>  >Asia/Seoul</option>
							<option value="Asia/Shanghai" <?php if($userinfo->cal_timezone =='Asia/Shanghai') { echo "SELECTED";}?>  >Asia/Shanghai</option>
							<option value="Asia/Singapore" <?php if($userinfo->cal_timezone =='Asia/Singapore') { echo "SELECTED";}?>  >Asia/Singapore</option>
							<option value="Asia/Taipei" <?php if($userinfo->cal_timezone =='Asia/Taipei') { echo "SELECTED";}?>  >Asia/Taipei</option>
							<option value="Asia/Tashkent" <?php if($userinfo->cal_timezone =='Asia/Tashkent') { echo "SELECTED";}?>  >Asia/Tashkent</option>
							<option value="Asia/Tbilisi" <?php if($userinfo->cal_timezone =='Asia/Tbilisi') { echo "SELECTED";}?>  >Asia/Tbilisi</option>
							<option value="Asia/Tehran" <?php if($userinfo->cal_timezone =='Asia/Tehran') { echo "SELECTED";}?>  >Asia/Tehran</option>
							<option value="Asia/Thimphu" <?php if($userinfo->cal_timezone =='Asia/Thimphu') { echo "SELECTED";}?>  >Asia/Thimphu</option>
							<option value="Asia/Tokyo" <?php if($userinfo->cal_timezone =='Asia/Tokyo') { echo "SELECTED";}?>  >Asia/Tokyo</option>
							<option value="Asia/Ulaanbaatar" <?php if($userinfo->cal_timezone =='Asia/Ulaanbaatar') { echo "SELECTED";}?>  >Asia/Ulaanbaatar</option>
							<option value="Asia/Urumqi" <?php if($userinfo->cal_timezone =='Asia/Urumqi') { echo "SELECTED";}?>  >Asia/Urumqi</option>
							<option value="Asia/Ust-Nera" <?php if($userinfo->cal_timezone =='Asia/Ust-Nera') { echo "SELECTED";}?>  >Asia/Ust-Nera</option>
							<option value="Asia/Vientiane" <?php if($userinfo->cal_timezone =='Asia/Vientiane') { echo "SELECTED";}?>  >Asia/Vientiane</option>
							<option value="Asia/Vladivostok" <?php if($userinfo->cal_timezone =='Asia/Vladivostok') { echo "SELECTED";}?>  >Asia/Vladivostok</option>
							<option value="Asia/Yakutsk" <?php if($userinfo->cal_timezone =='Asia/Yakutsk') { echo "SELECTED";}?>  >Asia/Yakutsk</option>
							<option value="Asia/Yekaterinburg" <?php if($userinfo->cal_timezone =='Asia/Yekaterinburg') { echo "SELECTED";}?>  >Asia/Yekaterinburg</option>
							<option value="Asia/Yerevan" <?php if($userinfo->cal_timezone =='Asia/Yerevan') { echo "SELECTED";}?>  >Asia/Yerevan</option>
							<option value="Atlantic/Azores" <?php if($userinfo->cal_timezone =='Atlantic/Azores') { echo "SELECTED";}?>  >Atlantic/Azores</option>
							<option value="Atlantic/Bermuda" <?php if($userinfo->cal_timezone =='Atlantic/Bermuda') { echo "SELECTED";}?>  >Atlantic/Bermuda</option>
							<option value="Atlantic/Canary" <?php if($userinfo->cal_timezone =='Atlantic/Canary') { echo "SELECTED";}?>  >Atlantic/Canary</option>
							<option value="Atlantic/Cape_Verde" <?php if($userinfo->cal_timezone =='Atlantic/Cape_Verde') { echo "SELECTED";}?>  >Atlantic/Cape_Verde</option>
							<option value="Atlantic/Faroe" <?php if($userinfo->cal_timezone =='Atlantic/Faroe') { echo "SELECTED";}?>  >Atlantic/Faroe</option>
							<option value="Atlantic/Madeira" <?php if($userinfo->cal_timezone =='Atlantic/Madeira') { echo "SELECTED";}?>  >Atlantic/Madeira</option>
							<option value="Atlantic/Reykjavik" <?php if($userinfo->cal_timezone =='Atlantic/Reykjavik') { echo "SELECTED";}?>  >Atlantic/Reykjavik</option>
							<option value="Atlantic/South_Georgia" <?php if($userinfo->cal_timezone =='Atlantic/South_Georgia') { echo "SELECTED";}?>  >Atlantic/South_Georgia</option>
							<option value="Atlantic/St_Helena" <?php if($userinfo->cal_timezone =='Atlantic/St_Helena') { echo "SELECTED";}?>  >Atlantic/St_Helena</option>
							<option value="Atlantic/Stanley" <?php if($userinfo->cal_timezone =='Atlantic/Stanley') { echo "SELECTED";}?>  >Atlantic/Stanley</option>
							<option value="Australia/Adelaide" <?php if($userinfo->cal_timezone =='Australia/Adelaide') { echo "SELECTED";}?>  >Australia/Adelaide</option>
							<option value="Australia/Brisbane" <?php if($userinfo->cal_timezone =='Australia/Brisbane') { echo "SELECTED";}?>  >Australia/Brisbane</option>
							<option value="Australia/Broken_Hill" <?php if($userinfo->cal_timezone =='Australia/Broken_Hill') { echo "SELECTED";}?>  >Australia/Broken_Hill</option>
							<option value="Australia/Currie" <?php if($userinfo->cal_timezone =='Australia/Currie') { echo "SELECTED";}?>  >Australia/Currie</option>
							<option value="Australia/Darwin" <?php if($userinfo->cal_timezone =='Australia/Darwin') { echo "SELECTED";}?>  >Australia/Darwin</option>
							<option value="Australia/Eucla" <?php if($userinfo->cal_timezone =='Australia/Eucla') { echo "SELECTED";}?>  >Australia/Eucla</option>
							<option value="Australia/Hobart" <?php if($userinfo->cal_timezone =='Australia/Hobart') { echo "SELECTED";}?>  >Australia/Hobart</option>
							<option value="Australia/Lindeman" <?php if($userinfo->cal_timezone =='Australia/Lindeman') { echo "SELECTED";}?>  >Australia/Lindeman</option>
							<option value="Australia/Lord_Howe" <?php if($userinfo->cal_timezone =='Australia/Lord_Howe') { echo "SELECTED";}?>  >Australia/Lord_Howe</option>
							<option value="Australia/Melbourne" <?php if($userinfo->cal_timezone =='Australia/Melbourne') { echo "SELECTED";}?>  >Australia/Melbourne</option>
							<option value="Australia/Perth" <?php if($userinfo->cal_timezone =='Australia/Perth') { echo "SELECTED";}?>  >Australia/Perth</option>
							<option value="Australia/Sydney" <?php if($userinfo->cal_timezone =='Australia/Sydney') { echo "SELECTED";}?>  >Australia/Sydney</option>
							<option value="Europe/Amsterdam" <?php if($userinfo->cal_timezone =='Europe/Amsterdam') { echo "SELECTED";}?>  >Europe/Amsterdam</option>
							<option value="Europe/Andorra" <?php if($userinfo->cal_timezone =='Europe/Andorra') { echo "SELECTED";}?>  >Europe/Andorra</option>
							<option value="Europe/Athens" <?php if($userinfo->cal_timezone =='Europe/Athens') { echo "SELECTED";}?>  >Europe/Athens</option>
							<option value="Europe/Belgrade" <?php if($userinfo->cal_timezone =='Europe/Belgrade') { echo "SELECTED";}?>  >Europe/Belgrade</option>
							<option value="Europe/Berlin" <?php if($userinfo->cal_timezone =='Europe/Berlin') { echo "SELECTED";}?>  >Europe/Berlin</option>
							<option value="Europe/Bratislava" <?php if($userinfo->cal_timezone =='Europe/Bratislava') { echo "SELECTED";}?>  >Europe/Bratislava</option>
							<option value="Europe/Brussels" <?php if($userinfo->cal_timezone =='Europe/Brussels') { echo "SELECTED";}?>  >Europe/Brussels</option>
							<option value="Europe/Bucharest" <?php if($userinfo->cal_timezone =='Europe/Bucharest') { echo "SELECTED";}?>  >Europe/Bucharest</option>
							<option value="Europe/Budapest" <?php if($userinfo->cal_timezone =='Europe/Budapest') { echo "SELECTED";}?>  >Europe/Budapest</option>
							<option value="Europe/Busingen" <?php if($userinfo->cal_timezone =='Europe/Busingen') { echo "SELECTED";}?>  >Europe/Busingen</option>
							<option value="Europe/Chisinau" <?php if($userinfo->cal_timezone =='Europe/Chisinau') { echo "SELECTED";}?>  >Europe/Chisinau</option>
							<option value="Europe/Copenhagen" <?php if($userinfo->cal_timezone =='Europe/Copenhagen') { echo "SELECTED";}?>  >Europe/Copenhagen</option>
							<option value="Europe/Dublin" <?php if($userinfo->cal_timezone =='Europe/Dublin') { echo "SELECTED";}?>  >Europe/Dublin</option>
							<option value="Europe/Gibraltar" <?php if($userinfo->cal_timezone =='Europe/Gibraltar') { echo "SELECTED";}?>  >Europe/Gibraltar</option>
							<option value="Europe/Guernsey" <?php if($userinfo->cal_timezone =='Europe/Guernsey') { echo "SELECTED";}?>  >Europe/Guernsey</option>
							<option value="Europe/Helsinki" <?php if($userinfo->cal_timezone =='Europe/Helsinki') { echo "SELECTED";}?>  >Europe/Helsinki</option>
							<option value="Europe/Isle_of_Man" <?php if($userinfo->cal_timezone =='Europe/Isle_of_Man') { echo "SELECTED";}?>  >Europe/Isle_of_Man</option>
							<option value="Europe/Istanbul" <?php if($userinfo->cal_timezone =='Europe/Istanbul') { echo "SELECTED";}?>  >Europe/Istanbul</option>
							<option value="Europe/Jersey" <?php if($userinfo->cal_timezone =='Europe/Jersey') { echo "SELECTED";}?>  >Europe/Jersey</option>
							<option value="Europe/Kaliningrad" <?php if($userinfo->cal_timezone =='Europe/Kaliningrad') { echo "SELECTED";}?>  >Europe/Kaliningrad</option>
							<option value="Europe/Kiev" <?php if($userinfo->cal_timezone =='Europe/Kiev') { echo "SELECTED";}?>  >Europe/Kiev</option>
							<option value="Europe/Lisbon" <?php if($userinfo->cal_timezone =='Europe/Lisbon') { echo "SELECTED";}?>  >Europe/Lisbon</option>
							<option value="Europe/Ljubljana" <?php if($userinfo->cal_timezone =='Europe/Ljubljana') { echo "SELECTED";}?>  >Europe/Ljubljana</option>
							<option value="Europe/London" <?php if($userinfo->cal_timezone =='Europe/London') { echo "SELECTED";}?>  >Europe/London</option>
							<option value="Europe/Luxembourg" <?php if($userinfo->cal_timezone =='Europe/Luxembourg') { echo "SELECTED";}?>  >Europe/Luxembourg</option>
							<option value="Europe/Madrid" <?php if($userinfo->cal_timezone =='Europe/Madrid') { echo "SELECTED";}?>  >Europe/Madrid</option>
							<option value="Europe/Malta" <?php if($userinfo->cal_timezone =='Europe/Malta') { echo "SELECTED";}?>  >Europe/Malta</option>
							<option value="Europe/Mariehamn" <?php if($userinfo->cal_timezone =='Europe/Mariehamn') { echo "SELECTED";}?>  >Europe/Mariehamn</option>
							<option value="Europe/Minsk" <?php if($userinfo->cal_timezone =='Europe/Minsk') { echo "SELECTED";}?>  >Europe/Minsk</option>
							<option value="Europe/Monaco" <?php if($userinfo->cal_timezone =='Europe/Monaco') { echo "SELECTED";}?>  >Europe/Monaco</option>
							<option value="Europe/Moscow" <?php if($userinfo->cal_timezone =='Europe/Moscow') { echo "SELECTED";}?>  >Europe/Moscow</option>
							<option value="Europe/Oslo" <?php if($userinfo->cal_timezone =='Europe/Oslo') { echo "SELECTED";}?>  >Europe/Oslo</option>
							<option value="Europe/Paris" <?php if($userinfo->cal_timezone =='Europe/Paris') { echo "SELECTED";}?>  >Europe/Paris</option>
							<option value="Europe/Podgorica" <?php if($userinfo->cal_timezone =='Europe/Podgorica') { echo "SELECTED";}?>  >Europe/Podgorica</option>
							<option value="Europe/Prague" <?php if($userinfo->cal_timezone =='Europe/Prague') { echo "SELECTED";}?>  >Europe/Prague</option>
							<option value="Europe/Riga" <?php if($userinfo->cal_timezone =='Europe/Riga') { echo "SELECTED";}?>  >Europe/Riga</option>
							<option value="Europe/Rome" <?php if($userinfo->cal_timezone =='Europe/Rome') { echo "SELECTED";}?>  >Europe/Rome</option>
							<option value="Europe/Samara" <?php if($userinfo->cal_timezone =='Europe/Samara') { echo "SELECTED";}?>  >Europe/Samara</option>
							<option value="Europe/San_Marino" <?php if($userinfo->cal_timezone =='Europe/San_Marino') { echo "SELECTED";}?>  >Europe/San_Marino</option>
							<option value="Europe/Sarajevo" <?php if($userinfo->cal_timezone =='Europe/Sarajevo') { echo "SELECTED";}?>  >Europe/Sarajevo</option>
							<option value="Europe/Simferopol" <?php if($userinfo->cal_timezone =='Europe/Simferopol') { echo "SELECTED";}?>  >Europe/Simferopol</option>
							<option value="Europe/Skopje" <?php if($userinfo->cal_timezone =='Europe/Skopje') { echo "SELECTED";}?>  >Europe/Skopje</option>
							<option value="Europe/Sofia" <?php if($userinfo->cal_timezone =='Europe/Sofia') { echo "SELECTED";}?>  >Europe/Sofia</option>
							<option value="Europe/Stockholm" <?php if($userinfo->cal_timezone =='Europe/Stockholm') { echo "SELECTED";}?>  >Europe/Stockholm</option>
							<option value="Europe/Tallinn" <?php if($userinfo->cal_timezone =='Europe/Tallinn') { echo "SELECTED";}?>  >Europe/Tallinn</option>
							<option value="Europe/Tirane" <?php if($userinfo->cal_timezone =='Europe/Tirane') { echo "SELECTED";}?>  >Europe/Tirane</option>
							<option value="Europe/Uzhgorod" <?php if($userinfo->cal_timezone =='Europe/Uzhgorod') { echo "SELECTED";}?>  >Europe/Uzhgorod</option>
							<option value="Europe/Vaduz" <?php if($userinfo->cal_timezone =='Europe/Vaduz') { echo "SELECTED";}?>  >Europe/Vaduz</option>
							<option value="Europe/Vatican" <?php if($userinfo->cal_timezone =='Europe/Vatican') { echo "SELECTED";}?>  >Europe/Vatican</option>
							<option value="Europe/Vienna" <?php if($userinfo->cal_timezone =='Europe/Vienna') { echo "SELECTED";}?>  >Europe/Vienna</option>
							<option value="Europe/Vilnius" <?php if($userinfo->cal_timezone =='Europe/Vilnius') { echo "SELECTED";}?>  >Europe/Vilnius</option>
							<option value="Europe/Volgograd" <?php if($userinfo->cal_timezone =='Europe/Volgograd') { echo "SELECTED";}?>  >Europe/Volgograd</option>
							<option value="Europe/Warsaw" <?php if($userinfo->cal_timezone =='Europe/Warsaw') { echo "SELECTED";}?>  >Europe/Warsaw</option>
							<option value="Europe/Zagreb" <?php if($userinfo->cal_timezone =='Europe/Zagreb') { echo "SELECTED";}?>  >Europe/Zagreb</option>
							<option value="Europe/Zaporozhye" <?php if($userinfo->cal_timezone =='Europe/Zaporozhye') { echo "SELECTED";}?>  >Europe/Zaporozhye</option>
							<option value="Europe/Zurich" <?php if($userinfo->cal_timezone =='Europe/Zurich') { echo "SELECTED";}?>  >Europe/Zurich</option>
							<option value="Indian/Antananarivo" <?php if($userinfo->cal_timezone =='Indian/Antananarivo') { echo "SELECTED";}?>  >Indian/Antananarivo</option>
							<option value="Indian/Chagos" <?php if($userinfo->cal_timezone =='Indian/Chagos') { echo "SELECTED";}?>  >Indian/Chagos</option>
							<option value="Indian/Christmas" <?php if($userinfo->cal_timezone =='Indian/Christmas') { echo "SELECTED";}?>  >Indian/Christmas</option>
							<option value="Indian/Cocos" <?php if($userinfo->cal_timezone =='Indian/Cocos') { echo "SELECTED";}?>  >Indian/Cocos</option>
							<option value="Indian/Comoro" <?php if($userinfo->cal_timezone =='Indian/Comoro') { echo "SELECTED";}?>  >Indian/Comoro</option>
							<option value="Indian/Kerguelen" <?php if($userinfo->cal_timezone =='Indian/Kerguelen') { echo "SELECTED";}?>  >Indian/Kerguelen</option>
							<option value="Indian/Mahe" <?php if($userinfo->cal_timezone =='Indian/Mahe') { echo "SELECTED";}?>  >Indian/Mahe</option>
							<option value="Indian/Maldives" <?php if($userinfo->cal_timezone =='Indian/Maldives') { echo "SELECTED";}?>  >Indian/Maldives</option>
							<option value="Indian/Mauritius" <?php if($userinfo->cal_timezone =='Indian/Mauritius') { echo "SELECTED";}?>  >Indian/Mauritius</option>
							<option value="Indian/Mayotte" <?php if($userinfo->cal_timezone =='Indian/Mayotte') { echo "SELECTED";}?>  >Indian/Mayotte</option>
							<option value="Indian/Reunion" <?php if($userinfo->cal_timezone =='Indian/Reunion') { echo "SELECTED";}?>  >Indian/Reunion</option>
							<option value="Pacific/Apia" <?php if($userinfo->cal_timezone =='Pacific/Apia') { echo "SELECTED";}?>  >Pacific/Apia</option>
							<option value="Pacific/Auckland" <?php if($userinfo->cal_timezone =='Pacific/Auckland') { echo "SELECTED";}?>  >Pacific/Auckland</option>
							<option value="Pacific/Chatham" <?php if($userinfo->cal_timezone =='Pacific/Chatham') { echo "SELECTED";}?>  >Pacific/Chatham</option>
							<option value="Pacific/Chuuk" <?php if($userinfo->cal_timezone =='Pacific/Chuuk') { echo "SELECTED";}?>  >Pacific/Chuuk</option>
							<option value="Pacific/Easter" <?php if($userinfo->cal_timezone =='Pacific/Easter') { echo "SELECTED";}?>  >Pacific/Easter</option>
							<option value="Pacific/Efate" <?php if($userinfo->cal_timezone =='Pacific/Efate') { echo "SELECTED";}?>  >Pacific/Efate</option>
							<option value="Pacific/Enderbury" <?php if($userinfo->cal_timezone =='Pacific/Enderbury') { echo "SELECTED";}?>  >Pacific/Enderbury</option>
							<option value="Pacific/Fakaofo" <?php if($userinfo->cal_timezone =='Pacific/Fakaofo') { echo "SELECTED";}?>  >Pacific/Fakaofo</option>
							<option value="Pacific/Fiji" <?php if($userinfo->cal_timezone =='Pacific/Fiji') { echo "SELECTED";}?>  >Pacific/Fiji</option>
							<option value="Pacific/Funafuti" <?php if($userinfo->cal_timezone =='Pacific/Funafuti') { echo "SELECTED";}?>  >Pacific/Funafuti</option>
							<option value="Pacific/Galapagos" <?php if($userinfo->cal_timezone =='Pacific/Galapagos') { echo "SELECTED";}?>  >Pacific/Galapagos</option>
							<option value="Pacific/Gambier" <?php if($userinfo->cal_timezone =='Pacific/Gambier') { echo "SELECTED";}?>  >Pacific/Gambier</option>
							<option value="Pacific/Guadalcanal" <?php if($userinfo->cal_timezone =='Pacific/Guadalcanal') { echo "SELECTED";}?>  >Pacific/Guadalcanal</option>
							<option value="Pacific/Guam" <?php if($userinfo->cal_timezone =='Pacific/Guam') { echo "SELECTED";}?>  >Pacific/Guam</option>
							<option value="Pacific/Honolulu" <?php if($userinfo->cal_timezone =='Pacific/Honolulu') { echo "SELECTED";}?>  >Pacific/Honolulu</option>
							<option value="Pacific/Johnston" <?php if($userinfo->cal_timezone =='Pacific/Johnston') { echo "SELECTED";}?>  >Pacific/Johnston</option>
							<option value="Pacific/Kiritimati" <?php if($userinfo->cal_timezone =='Pacific/Kiritimati') { echo "SELECTED";}?>  >Pacific/Kiritimati</option>
							<option value="Pacific/Kosrae" <?php if($userinfo->cal_timezone =='Pacific/Kosrae') { echo "SELECTED";}?>  >Pacific/Kosrae</option>
							<option value="Pacific/Kwajalein" <?php if($userinfo->cal_timezone =='Pacific/Kwajalein') { echo "SELECTED";}?>  >Pacific/Kwajalein</option>
							<option value="Pacific/Majuro" <?php if($userinfo->cal_timezone =='Pacific/Majuro') { echo "SELECTED";}?>  >Pacific/Majuro</option>
							<option value="Pacific/Marquesas" <?php if($userinfo->cal_timezone =='Pacific/Marquesas') { echo "SELECTED";}?>  >Pacific/Marquesas</option>
							<option value="Pacific/Midway" <?php if($userinfo->cal_timezone =='Pacific/Midway') { echo "SELECTED";}?>  >Pacific/Midway</option>
							<option value="Pacific/Nauru" <?php if($userinfo->cal_timezone =='Pacific/Nauru') { echo "SELECTED";}?>  >Pacific/Nauru</option>
							<option value="Pacific/Niue" <?php if($userinfo->cal_timezone =='Pacific/Niue') { echo "SELECTED";}?>  >Pacific/Niue</option>
							<option value="Pacific/Norfolk" <?php if($userinfo->cal_timezone =='Pacific/Norfolk') { echo "SELECTED";}?>  >Pacific/Norfolk</option>
							<option value="Pacific/Noumea" <?php if($userinfo->cal_timezone =='Pacific/Noumea') { echo "SELECTED";}?>  >Pacific/Noumea</option>
							<option value="Pacific/Pago_Pago" <?php if($userinfo->cal_timezone =='Pacific/Pago_Pago') { echo "SELECTED";}?>  >Pacific/Pago_Pago</option>
							<option value="Pacific/Palau" <?php if($userinfo->cal_timezone =='Pacific/Palau') { echo "SELECTED";}?>  >Pacific/Palau</option>
							<option value="Pacific/Pitcairn" <?php if($userinfo->cal_timezone =='Pacific/Pitcairn') { echo "SELECTED";}?>  >Pacific/Pitcairn</option>
							<option value="Pacific/Pohnpei" <?php if($userinfo->cal_timezone =='Pacific/Pohnpei') { echo "SELECTED";}?>  >Pacific/Pohnpei</option>
							<option value="Pacific/Port_Moresby" <?php if($userinfo->cal_timezone =='Pacific/Port_Moresby') { echo "SELECTED";}?>  >Pacific/Port_Moresby</option>
							<option value="Pacific/Rarotonga" <?php if($userinfo->cal_timezone =='Pacific/Rarotonga') { echo "SELECTED";}?>  >Pacific/Rarotonga</option>
							<option value="Pacific/Saipan" <?php if($userinfo->cal_timezone =='Pacific/Saipan') { echo "SELECTED";}?>  >Pacific/Saipan</option>
							<option value="Pacific/Tahiti" <?php if($userinfo->cal_timezone =='Pacific/Tahiti') { echo "SELECTED";}?>  >Pacific/Tahiti</option>
							<option value="Pacific/Tarawa" <?php if($userinfo->cal_timezone =='Pacific/Tarawa') { echo "SELECTED";}?>  >Pacific/Tarawa</option>
							<option value="Pacific/Tongatapu" <?php if($userinfo->cal_timezone =='Pacific/Tongatapu') { echo "SELECTED";}?>  >Pacific/Tongatapu</option>
							<option value="Pacific/Wake" <?php if($userinfo->cal_timezone =='Pacific/Wake') { echo "SELECTED";}?>  >Pacific/Wake</option>
							<option value="Pacific/Wallis" <?php if($userinfo->cal_timezone =='Pacific/Wallis') { echo "SELECTED";}?>  >Pacific/Wallis</option>
						</select>
							<p class="help-block"><?php echo form_error('cal_timezone'); ?></p>
					</div> 							
				
					<div class="form-group">
						<label><?php echo lang('cal_defaultview') ?></label>
						<select class="form-control" name="cal_defaultview" id="cal_defaultview">
							<option value="month" <?php if($userinfo->cal_defaultview =='month'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_month'); ?></option>
							<option value="basicWeek" <?php if($userinfo->cal_defaultview =='basicWeek'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_basicweek'); ?></option>
							<option value="basicDay" <?php if($userinfo->cal_defaultview =='basicDay'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_basicday'); ?></option>
							<option value="agendaWeek" <?php if($userinfo->cal_defaultview =='agendaWeek'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_agendaweek'); ?></option>
							<option value="agendaDay" <?php if($userinfo->cal_defaultview =='agendaDay'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_agendaday'); ?></option>
							<option value="list" <?php if($userinfo->cal_defaultview =='list'){ echo "SELECTED";}?> ><?php echo lang('cal_defaultview_agendalist'); ?></option>
						</select>
						<p class="help-block"><?php echo form_error('cal_defaultview') ?></p>
					</div>	
					
					<div class="form-group">
						<label><?php echo lang('cal_header_left') ?></label>
						<input class="form-control" type="text" name="cal_header_left" id="cal_header_left" value="<?php echo set_value('cal_header_left', $userinfo->cal_header_left); ?>"/>
						<p class="help-block"><?php echo form_error('cal_header_left'); ?></p>
					</div> 										
					
					<div class="form-group">
						<label><?php echo lang('cal_header_center') ?></label>
						<input class="form-control" type="text" name="cal_header_center" id="cal_header_center" value="<?php echo set_value('cal_header_center', $userinfo->cal_header_center); ?>"/>
						<p class="help-block"><?php echo form_error('cal_header_center'); ?></p>
					</div> 										
					
					<div class="form-group">
						<label><?php echo lang('cal_header_right') ?></label>
						<input class="form-control" type="text" name="cal_header_right" id="cal_header_right" value="<?php echo set_value('cal_header_right', $userinfo->cal_header_right); ?>"/>
						<p class="help-block"><?php echo form_error('cal_header_right'); ?></p>
					</div> 									
					
					<div class="form-group">
						<label><?php echo lang('cal_aspectratio') ?></label>
						<input class="form-control" type="text" name="cal_aspectratio" id="cal_aspectratio" value="<?php echo set_value('cal_aspectratio', $userinfo->cal_aspectratio); ?>" />
						<p class="help-block"><?php echo form_error('cal_aspectratio') ?></p>
					</div>	

					<div class="form-group">
						<label><?php echo lang('cal_firstday') ?></label>
						<select class="form-control" name="cal_firstday" id="cal_firstday">									
							<option value="0" <?php if($userinfo->cal_firstday =='0'){ echo "SELECTED";}?> ><?php echo lang('sunday'); ?></option>
							<option value="1" <?php if($userinfo->cal_firstday =='1'){ echo "SELECTED";}?> ><?php echo lang('monday'); ?></option>
							<option value="2" <?php if($userinfo->cal_firstday =='2'){ echo "SELECTED";}?> ><?php echo lang('tuesday'); ?></option>
							<option value="3" <?php if($userinfo->cal_firstday =='3'){ echo "SELECTED";}?> ><?php echo lang('wednesday'); ?></option>
							<option value="4" <?php if($userinfo->cal_firstday =='4'){ echo "SELECTED";}?> ><?php echo lang('thursday'); ?></option>
							<option value="5" <?php if($userinfo->cal_firstday =='5'){ echo "SELECTED";}?> ><?php echo lang('friday'); ?></option>
							<option value="6" <?php if($userinfo->cal_firstday =='6'){ echo "SELECTED";}?> ><?php echo lang('saturday'); ?></option>
						</select>
						<p class="help-block"><?php echo form_error('cal_firstday') ?></p>
					</div>
					
					<div class="form-group">
						<label><?php echo lang('cal_hiddendays') ?></label>
						<input class="form-control" type="text" name="cal_hiddendays" id="cal_hiddendays" value="<?php echo set_value('cal_hiddendays', $userinfo->cal_hiddendays); ?>"/>
						<p class="help-block"><?php echo form_error('cal_hiddendays'); ?></p>
					</div> 									

					<div class="form-group">
						<label><?php echo lang('cal_businesshours') ?></label>
						<div class="form-group" style="margin:0px 20px">
							<label><?php echo lang('cal_businesshours_opendays') ?></label>
							<input class="form-control" type="text" name="cal_businessdays" id="cal_businessdays" value="<?php echo set_value('cal_businessdays', $userinfo->cal_businessdays); ?>"/> 
							<label><?php echo lang('cal_businesshours_start') ?></label>
							<input class="form-control" type="time" name="cal_businessstart" id="cal_businessstart" value="<?php echo set_value('cal_businessstart', $userinfo->cal_businessstart); ?>"/>	 
							<label><?php echo lang('cal_businesshours_end') ?></label>									
							<input class="form-control" type="time" name="cal_businessend" id="cal_businessend" value="<?php echo set_value('cal_businessend', $userinfo->cal_businessend); ?>"/> 
						</div>	
						<p class="help-block"><?php echo form_error('cal_businesshours') ?></p>
					</div>									
							
					<div class="form-group">
						<label><?php echo lang('cal_slotlabeling') ?></label>
						<select class="form-control" name="cal_slotlabeling" id="cal_slotlabeling">
							<option value="true" <?php if($userinfo->cal_slotlabeling =='true'){ echo "SELECTED";}?> ><?php echo lang('cal_slotlabel_groupformat'); ?></option>
							<option value="false" <?php if($userinfo->cal_slotlabeling =='false'){ echo "SELECTED";}?> ><?php echo lang('cal_slotlabel_listformat'); ?></option>
						</select>
						<p class="help-block"><?php echo form_error('cal_slotlabeling') ?></p>
					</div>									
					
					<div class="form-group">
						<label><?php echo lang('cal_slotduration') ?></label>
						<input class="form-control" type="text" name="cal_slotduration" id="cal_slotduration" value="<?php echo set_value('cal_slotduration', $userinfo->cal_slotduration); ?>" />
						<p class="help-block"><?php echo form_error('cal_slotduration') ?></p>
					</div>	
					
					<div class="form-group">
						<label><?php echo lang('cal_weeknumbers') ?></label>
						<select class="form-control" name="cal_weeknumbers" id="cal_weeknumbers">
							<option value="true" <?php if($userinfo->cal_weeknumbers =='true'){ echo "SELECTED";}?> ><?php echo lang('yes'); ?></option>
							<option value="false" <?php if($userinfo->cal_weeknumbers =='false'){ echo "SELECTED";}?> ><?php echo lang('no'); ?></option>
						</select>
						<p class="help-block"><?php echo form_error('cal_weeknumbers') ?></p>
					</div>										
					
					<div class="form-group">
						<label><?php echo lang('cal_eventlimit') ?></label>
						<select class="form-control" name="cal_eventlimit" id="cal_eventlimit">
							<option value="true" <?php if($userinfo->cal_eventlimit =='true'){ echo "SELECTED";}?> ><?php echo lang('yes'); ?></option>
							<option value="false" <?php if($userinfo->cal_eventlimit =='false'){ echo "SELECTED";}?> ><?php echo lang('no'); ?></option>
						</select>
						<p class="help-block"><?php echo form_error('cal_eventlimit') ?></p>
					</div>

					<div class="form-group">
						<label><?php echo lang('cal_alldayslot') ?></label>
						<select class="form-control" name="cal_alldayslot" id="cal_alldayslot">
							<option value="true" <?php if($userinfo->cal_alldayslot =='true'){ echo "SELECTED";}?> ><?php echo lang('yes'); ?></option>
							<option value="false" <?php if($userinfo->cal_alldayslot =='false'){ echo "SELECTED";}?> ><?php echo lang('no'); ?></option>
						</select>
						<p class="help-block"><?php echo form_error('cal_alldayslot') ?></p>
					</div>								
					
					<div class="form-group">
						<label><?php echo lang('cal_isrtl') ?></label>
						<select class="form-control" name="cal_isrtl" id="cal_isrtl">
							<option value="true" <?php if($userinfo->cal_isrtl =='true'){ echo "SELECTED";}?> ><?php echo lang('yes'); ?></option>
							<option value="false" <?php if($userinfo->cal_isrtl =='false'){ echo "SELECTED";}?> ><?php echo lang('no'); ?></option>
						</select>
						<p class="help-block"><?php echo form_error('cal_isrtl') ?></p>
					</div>	
			
					<div class="btn-group"> 
						<input type="submit" class="btn btn-primary" id="button" name="calendar_submit" value="<?php echo lang('save') ?>" />
					</div> 						
					<div class="btn-group">
						<input type="submit" class="btn" id="button" name="calendar_cancel" value="<?php echo lang('cancel') ?>" /> 
					</div>									
			 
				</form>								 

			</div>
			<!-- /.col-md-12 .col-lg-12 -->				
		</div>
		<!-- /.row --> 
   </div>
    <!-- /#wrapper --> 