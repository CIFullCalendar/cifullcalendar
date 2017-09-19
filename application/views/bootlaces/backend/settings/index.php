
        <div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li> 
								<a><i class="fa fa-gear fa-fw"></i> <?php echo lang('settings_basic_name') ?></a>
                            </li> 
                        </ul>
                        <div class="page-toolbar">   
                            <div class="btn-group pull-right">  
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings"> 
								<div class="panel-title">
                                    <div class="caption"> 
                                        <span class="">&nbsp;</span>
                                    </div>
                                </div>							
                                <div class="panel-body">
									<div class="row">
										<div class="col-md-12 col-lg-12"> 
										
											<?php echo form_open('admin/settings', array('class' => 'form-hoziontal', 'id' => 'form_settings', 'name' => 'form_settings', 'role' => 'form' )); ?>   
											
												<div class="form-group">
													<label><?php echo lang('settings_form_site_name') ?></label>
													<input class="form-control" type="text" name="site_name" id="site_name" value="<?php echo set_value('site_name', $site_name); ?>"/>
													<p class="help-block"><?php echo form_error('site_name'); ?></p>
												</div> 
												
												<div class="form-group">
													<label><?php echo lang('settings_form_site_email') ?></label>
													<input class="form-control" type="text" name="site_email" id="site_email" value="<?php echo set_value('site_email', $site_email); ?>"/>
													<p class="help-block"><?php echo form_error('site_email'); ?></p>
												</div>
												
												<div class="form-group">
													<label><?php echo lang('settings_form_meta_keywords') ?></label>
													<input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?php echo set_value('meta_keywords', $meta_keywords); ?>"/>
													<p class="help-block"><?php echo form_error('meta_keywords'); ?></p>
												</div>

												<div class="form-group">
													<label><?php echo lang('settings_form_meta_description') ?></label>
													<input class="form-control" type="text" name="meta_description" id="meta_description" value="<?php echo set_value('meta_description', $meta_description); ?>"/>
													<p class="help-block"><?php echo form_error('meta_description'); ?></p>
												</div> 											
												
												<div class="form-group">
													<label><?php echo lang('settings_form_timezone') ?></label>  
												<select class="form-control" name="site_timezone" id="site_timezone">
													<option value="UTC" <?php if($site_timezone =='UTC') { echo "SELECTED";}?>  >UTC</option>
													<option value="Africa/Abidjan" <?php if($site_timezone =='Africa/Abidjan') { echo "SELECTED";}?>  >Africa/Abidjan</option>
													<option value="Africa/Accra" <?php if($site_timezone =='Africa/Accra') { echo "SELECTED";}?>  >Africa/Accra</option>
													<option value="Africa/Addis_Ababa" <?php if($site_timezone =='Africa/Addis_Ababa') { echo "SELECTED";}?>  >Africa/Addis_Ababa</option>
													<option value="Africa/Algiers" <?php if($site_timezone =='Africa/Algiers') { echo "SELECTED";}?>  >Africa/Algiers</option>
													<option value="Africa/Asmara" <?php if($site_timezone =='Africa/Asmara') { echo "SELECTED";}?>  >Africa/Asmara</option>
													<option value="Africa/Bamako" <?php if($site_timezone =='Africa/Bamako') { echo "SELECTED";}?>  >Africa/Bamako</option>
													<option value="Africa/Bangui" <?php if($site_timezone =='Africa/Bangui') { echo "SELECTED";}?>  >Africa/Bangui</option>
													<option value="Africa/Banjul" <?php if($site_timezone =='Africa/Banjul') { echo "SELECTED";}?>  >Africa/Banjul</option>
													<option value="Africa/Bissau" <?php if($site_timezone =='Africa/Bissau') { echo "SELECTED";}?>  >Africa/Bissau</option>
													<option value="Africa/Blantyre" <?php if($site_timezone =='Africa/Blantyre') { echo "SELECTED";}?>  >Africa/Blantyre</option>
													<option value="Africa/Brazzaville" <?php if($site_timezone =='Africa/Brazzaville') { echo "SELECTED";}?>  >Africa/Brazzaville</option>
													<option value="Africa/Bujumbura" <?php if($site_timezone =='Africa/Bujumbura') { echo "SELECTED";}?>  >Africa/Bujumbura</option>
													<option value="Africa/Cairo" <?php if($site_timezone =='Africa/Cairo') { echo "SELECTED";}?>  >Africa/Cairo</option>
													<option value="Africa/Casablanca" <?php if($site_timezone =='Africa/Casablanca') { echo "SELECTED";}?>  >Africa/Casablanca</option>
													<option value="Africa/Ceuta" <?php if($site_timezone =='Africa/Ceuta') { echo "SELECTED";}?>  >Africa/Ceuta</option>
													<option value="Africa/Conakry" <?php if($site_timezone =='Africa/Conakry') { echo "SELECTED";}?>  >Africa/Conakry</option>
													<option value="Africa/Dakar" <?php if($site_timezone =='Africa/Dakar') { echo "SELECTED";}?>  >Africa/Dakar</option>
													<option value="Africa/Dar_es_Salaam" <?php if($site_timezone =='Africa/Dar_es_Salaam') { echo "SELECTED";}?>  >Africa/Dar_es_Salaam</option>
													<option value="Africa/Djibouti" <?php if($site_timezone =='Africa/Djibouti') { echo "SELECTED";}?>  >Africa/Djibouti</option>
													<option value="Africa/Douala" <?php if($site_timezone =='Africa/Douala') { echo "SELECTED";}?>  >Africa/Douala</option>
													<option value="Africa/El_Aaiun" <?php if($site_timezone =='Africa/El_Aaiun') { echo "SELECTED";}?>  >Africa/El_Aaiun</option>
													<option value="Africa/Freetown" <?php if($site_timezone =='Africa/Freetown') { echo "SELECTED";}?>  >Africa/Freetown</option>
													<option value="Africa/Gaborone" <?php if($site_timezone =='Africa/Gaborone') { echo "SELECTED";}?>  >Africa/Gaborone</option>
													<option value="Africa/Harare" <?php if($site_timezone =='Africa/Harare') { echo "SELECTED";}?>  >Africa/Harare</option>
													<option value="Africa/Johannesburg" <?php if($site_timezone =='Africa/Johannesburg') { echo "SELECTED";}?>  >Africa/Johannesburg</option>
													<option value="Africa/Juba" <?php if($site_timezone =='Africa/Juba') { echo "SELECTED";}?>  >Africa/Juba</option>
													<option value="Africa/Kampala" <?php if($site_timezone =='Africa/Kampala') { echo "SELECTED";}?>  >Africa/Kampala</option>
													<option value="Africa/Khartoum" <?php if($site_timezone =='Africa/Khartoum') { echo "SELECTED";}?>  >Africa/Khartoum</option>
													<option value="Africa/Kigali" <?php if($site_timezone =='Africa/Kigali') { echo "SELECTED";}?>  >Africa/Kigali</option>
													<option value="Africa/Kinshasa" <?php if($site_timezone =='Africa/Kinshasa') { echo "SELECTED";}?>  >Africa/Kinshasa</option>
													<option value="Africa/Lagos" <?php if($site_timezone =='Africa/Lagos') { echo "SELECTED";}?>  >Africa/Lagos</option>
													<option value="Africa/Libreville" <?php if($site_timezone =='Africa/Libreville') { echo "SELECTED";}?>  >Africa/Libreville</option>
													<option value="Africa/Lome" <?php if($site_timezone =='Africa/Lome') { echo "SELECTED";}?>  >Africa/Lome</option>
													<option value="Africa/Luanda" <?php if($site_timezone =='Africa/Luanda') { echo "SELECTED";}?>  >Africa/Luanda</option>
													<option value="Africa/Lubumbashi" <?php if($site_timezone =='Africa/Lubumbashi') { echo "SELECTED";}?>  >Africa/Lubumbashi</option>
													<option value="Africa/Lusaka" <?php if($site_timezone =='Africa/Lusaka') { echo "SELECTED";}?>  >Africa/Lusaka</option>
													<option value="Africa/Malabo" <?php if($site_timezone =='Africa/Malabo') { echo "SELECTED";}?>  >Africa/Malabo</option>
													<option value="Africa/Maputo" <?php if($site_timezone =='Africa/Maputo') { echo "SELECTED";}?>  >Africa/Maputo</option>
													<option value="Africa/Maseru" <?php if($site_timezone =='Africa/Maseru') { echo "SELECTED";}?>  >Africa/Maseru</option>
													<option value="Africa/Mbabane" <?php if($site_timezone =='Africa/Mbabane') { echo "SELECTED";}?>  >Africa/Mbabane</option>
													<option value="Africa/Mogadishu" <?php if($site_timezone =='Africa/Mogadishu') { echo "SELECTED";}?>  >Africa/Mogadishu</option>
													<option value="Africa/Monrovia" <?php if($site_timezone =='Africa/Monrovia') { echo "SELECTED";}?>  >Africa/Monrovia</option>
													<option value="Africa/Nairobi" <?php if($site_timezone =='Africa/Nairobi') { echo "SELECTED";}?>  >Africa/Nairobi</option>
													<option value="Africa/Ndjamena" <?php if($site_timezone =='Africa/Ndjamena') { echo "SELECTED";}?>  >Africa/Ndjamena</option>
													<option value="Africa/Niamey" <?php if($site_timezone =='Africa/Niamey') { echo "SELECTED";}?>  >Africa/Niamey</option>
													<option value="Africa/Nouakchott" <?php if($site_timezone =='Africa/Nouakchott') { echo "SELECTED";}?>  >Africa/Nouakchott</option>
													<option value="Africa/Ouagadougou" <?php if($site_timezone =='Africa/Ouagadougou') { echo "SELECTED";}?>  >Africa/Ouagadougou</option>
													<option value="Africa/Porto-Novo" <?php if($site_timezone =='Africa/Porto-Novo') { echo "SELECTED";}?>  >Africa/Porto-Novo</option>
													<option value="Africa/Sao_Tome" <?php if($site_timezone =='Africa/Sao_Tome') { echo "SELECTED";}?>  >Africa/Sao_Tome</option>
													<option value="Africa/Tripoli" <?php if($site_timezone =='Africa/Tripoli') { echo "SELECTED";}?>  >Africa/Tripoli</option>
													<option value="Africa/Tunis" <?php if($site_timezone =='Africa/Tunis') { echo "SELECTED";}?>  >Africa/Tunis</option>
													<option value="Africa/Windhoek" <?php if($site_timezone =='Africa/Windhoek') { echo "SELECTED";}?>  >Africa/Windhoek</option>
													<option value="America/Adak" <?php if($site_timezone =='America/Adak') { echo "SELECTED";}?>  >America/Adak</option>
													<option value="America/Anchorage" <?php if($site_timezone =='America/Anchorage') { echo "SELECTED";}?>  >America/Anchorage</option>
													<option value="America/Anguilla" <?php if($site_timezone =='America/Anguilla') { echo "SELECTED";}?>  >America/Anguilla</option>
													<option value="America/Antigua" <?php if($site_timezone =='America/Antigua') { echo "SELECTED";}?>  >America/Antigua</option>
													<option value="America/Araguaina" <?php if($site_timezone =='America/Araguaina') { echo "SELECTED";}?>  >America/Araguaina</option>
													<option value="America/Argentina/Buenos_Aires" <?php if($site_timezone =='America/Argentina/Buenos_Aires') { echo "SELECTED";}?>  >America/Argentina/Buenos_Aires</option>
													<option value="America/Argentina/Catamarca" <?php if($site_timezone =='America/Argentina/Catamarca') { echo "SELECTED";}?>  >America/Argentina/Catamarca</option>
													<option value="America/Argentina/Cordoba" <?php if($site_timezone =='America/Argentina/Cordoba') { echo "SELECTED";}?>  >America/Argentina/Cordoba</option>
													<option value="America/Argentina/Jujuy" <?php if($site_timezone =='America/Argentina/Jujuy') { echo "SELECTED";}?>  >America/Argentina/Jujuy</option>
													<option value="America/Argentina/La_Rioja" <?php if($site_timezone =='America/Argentina/La_Rioja') { echo "SELECTED";}?>  >America/Argentina/La_Rioja</option>
													<option value="America/Argentina/Mendoza" <?php if($site_timezone =='America/Argentina/Mendoza') { echo "SELECTED";}?>  >America/Argentina/Mendoza</option>
													<option value="America/Argentina/Rio_Gallegos" <?php if($site_timezone =='America/Argentina/Rio_Gallegos') { echo "SELECTED";}?>  >America/Argentina/Rio_Gallegos</option>
													<option value="America/Argentina/Salta" <?php if($site_timezone =='America/Argentina/Salta') { echo "SELECTED";}?>  >America/Argentina/Salta</option>
													<option value="America/Argentina/San_Juan" <?php if($site_timezone =='America/Argentina/San_Juan') { echo "SELECTED";}?>  >America/Argentina/San_Juan</option>
													<option value="America/Argentina/San_Luis" <?php if($site_timezone =='America/Argentina/San_Luis') { echo "SELECTED";}?>  >America/Argentina/San_Luis</option>
													<option value="America/Argentina/Tucuman" <?php if($site_timezone =='America/Argentina/Tucuman') { echo "SELECTED";}?>  >America/Argentina/Tucuman</option>
													<option value="America/Argentina/Ushuaia" <?php if($site_timezone =='America/Argentina/Ushuaia') { echo "SELECTED";}?>  >America/Argentina/Ushuaia</option>
													<option value="America/Aruba" <?php if($site_timezone =='America/Aruba') { echo "SELECTED";}?>  >America/Aruba</option>
													<option value="America/Asuncion" <?php if($site_timezone =='America/Asuncion') { echo "SELECTED";}?>  >America/Asuncion</option>
													<option value="America/Atikokan" <?php if($site_timezone =='America/Atikokan') { echo "SELECTED";}?>  >America/Atikokan</option>
													<option value="America/Bahia" <?php if($site_timezone =='America/Bahia') { echo "SELECTED";}?>  >America/Bahia</option>
													<option value="America/Bahia_Banderas" <?php if($site_timezone =='America/Bahia_Banderas') { echo "SELECTED";}?>  >America/Bahia_Banderas</option>
													<option value="America/Barbados" <?php if($site_timezone =='America/Barbados') { echo "SELECTED";}?>  >America/Barbados</option>
													<option value="America/Belem" <?php if($site_timezone =='America/Belem') { echo "SELECTED";}?>  >America/Belem</option>
													<option value="America/Belize" <?php if($site_timezone =='America/Belize') { echo "SELECTED";}?>  >America/Belize</option>
													<option value="America/Blanc-Sablon" <?php if($site_timezone =='America/Blanc-Sablon') { echo "SELECTED";}?>  >America/Blanc-Sablon</option>
													<option value="America/Boa_Vista" <?php if($site_timezone =='America/Boa_Vista') { echo "SELECTED";}?>  >America/Boa_Vista</option>
													<option value="America/Bogota" <?php if($site_timezone =='America/Bogota') { echo "SELECTED";}?>  >America/Bogota</option>
													<option value="America/Boise" <?php if($site_timezone =='America/Boise') { echo "SELECTED";}?>  >America/Boise</option>
													<option value="America/Cambridge_Bay" <?php if($site_timezone =='America/Cambridge_Bay') { echo "SELECTED";}?>  >America/Cambridge_Bay</option>
													<option value="America/Campo_Grande" <?php if($site_timezone =='America/Campo_Grande') { echo "SELECTED";}?>  >America/Campo_Grande</option>
													<option value="America/Cancun" <?php if($site_timezone =='America/Cancun') { echo "SELECTED";}?>  >America/Cancun</option>
													<option value="America/Caracas" <?php if($site_timezone =='America/Caracas') { echo "SELECTED";}?>  >America/Caracas</option>
													<option value="America/Cayenne" <?php if($site_timezone =='America/Cayenne') { echo "SELECTED";}?>  >America/Cayenne</option>
													<option value="America/Cayman" <?php if($site_timezone =='America/Cayman') { echo "SELECTED";}?>  >America/Cayman</option>
													<option value="America/Chicago" <?php if($site_timezone =='America/Chicago') { echo "SELECTED";}?>  >America/Chicago</option>
													<option value="America/Chihuahua" <?php if($site_timezone =='America/Chihuahua') { echo "SELECTED";}?>  >America/Chihuahua</option>
													<option value="America/Costa_Rica" <?php if($site_timezone =='America/Costa_Rica') { echo "SELECTED";}?>  >America/Costa_Rica</option>
													<option value="America/Creston" <?php if($site_timezone =='America/Creston') { echo "SELECTED";}?>  >America/Creston</option>
													<option value="America/Cuiaba" <?php if($site_timezone =='America/Cuiaba') { echo "SELECTED";}?>  >America/Cuiaba</option>
													<option value="America/Curacao" <?php if($site_timezone =='America/Curacao') { echo "SELECTED";}?>  >America/Curacao</option>
													<option value="America/Danmarkshavn" <?php if($site_timezone =='America/Danmarkshavn') { echo "SELECTED";}?>  >America/Danmarkshavn</option>
													<option value="America/Dawson" <?php if($site_timezone =='America/Dawson') { echo "SELECTED";}?>  >America/Dawson</option>
													<option value="America/Dawson_Creek" <?php if($site_timezone =='America/Dawson_Creek') { echo "SELECTED";}?>  >America/Dawson_Creek</option>
													<option value="America/Denver" <?php if($site_timezone =='America/Denver') { echo "SELECTED";}?>  >America/Denver</option>
													<option value="America/Detroit" <?php if($site_timezone =='America/Detroit') { echo "SELECTED";}?>  >America/Detroit</option>
													<option value="America/Dominica" <?php if($site_timezone =='America/Dominica') { echo "SELECTED";}?>  >America/Dominica</option>
													<option value="America/Edmonton" <?php if($site_timezone =='America/Edmonton') { echo "SELECTED";}?>  >America/Edmonton</option>
													<option value="America/Eirunepe" <?php if($site_timezone =='America/Eirunepe') { echo "SELECTED";}?>  >America/Eirunepe</option>
													<option value="America/El_Salvador" <?php if($site_timezone =='America/El_Salvador') { echo "SELECTED";}?>  >America/El_Salvador</option>
													<option value="America/Fortaleza" <?php if($site_timezone =='America/Fortaleza') { echo "SELECTED";}?>  >America/Fortaleza</option>
													<option value="America/Glace_Bay" <?php if($site_timezone =='America/Glace_Bay') { echo "SELECTED";}?>  >America/Glace_Bay</option>
													<option value="America/Godthab" <?php if($site_timezone =='America/Godthab') { echo "SELECTED";}?>  >America/Godthab</option>
													<option value="America/Goose_Bay" <?php if($site_timezone =='America/Goose_Bay') { echo "SELECTED";}?>  >America/Goose_Bay</option>
													<option value="America/Grand_Turk" <?php if($site_timezone =='America/Grand_Turk') { echo "SELECTED";}?>  >America/Grand_Turk</option>
													<option value="America/Grenada" <?php if($site_timezone =='America/Grenada') { echo "SELECTED";}?>  >America/Grenada</option>
													<option value="America/Guadeloupe" <?php if($site_timezone =='America/Guadeloupe') { echo "SELECTED";}?>  >America/Guadeloupe</option>
													<option value="America/Guatemala" <?php if($site_timezone =='America/Guatemala') { echo "SELECTED";}?>  >America/Guatemala</option>
													<option value="America/Guayaquil" <?php if($site_timezone =='America/Guayaquil') { echo "SELECTED";}?>  >America/Guayaquil</option>
													<option value="America/Guyana" <?php if($site_timezone =='America/Guyana') { echo "SELECTED";}?>  >America/Guyana</option>
													<option value="America/Halif(ax" <?php if($site_timezone =='America/Halif(ax') { echo "SELECTED";}?>  >America/Halif(ax</option>
													<option value="America/Havana" <?php if($site_timezone =='America/Havana') { echo "SELECTED";}?>  >America/Havana</option>
													<option value="America/Hermosillo" <?php if($site_timezone =='America/Hermosillo') { echo "SELECTED";}?>  >America/Hermosillo</option>
													<option value="America/Indiana/Indianapolis" <?php if($site_timezone =='America/Indiana/Indianapolis') { echo "SELECTED";}?>  >America/Indiana/Indianapolis</option>
													<option value="America/Indiana/Knox" <?php if($site_timezone =='America/Indiana/Knox') { echo "SELECTED";}?>  >America/Indiana/Knox</option>
													<option value="America/Indiana/Marengo" <?php if($site_timezone =='America/Indiana/Marengo') { echo "SELECTED";}?>  >America/Indiana/Marengo</option>
													<option value="America/Indiana/Petersburg" <?php if($site_timezone =='America/Indiana/Petersburg') { echo "SELECTED";}?>  >America/Indiana/Petersburg</option>
													<option value="America/Indiana/Tell_City" <?php if($site_timezone =='America/Indiana/Tell_City') { echo "SELECTED";}?>  >America/Indiana/Tell_City</option>
													<option value="America/Indiana/Vevay" <?php if($site_timezone =='America/Indiana/Vevay') { echo "SELECTED";}?>  >America/Indiana/Vevay</option>
													<option value="America/Indiana/Vincennes" <?php if($site_timezone =='America/Indiana/Vincennes') { echo "SELECTED";}?>  >America/Indiana/Vincennes</option>
													<option value="America/Indiana/Winamac" <?php if($site_timezone =='America/Indiana/Winamac') { echo "SELECTED";}?>  >America/Indiana/Winamac</option>
													<option value="America/Inuvik" <?php if($site_timezone =='America/Inuvik') { echo "SELECTED";}?>  >America/Inuvik</option>
													<option value="America/Iqaluit" <?php if($site_timezone =='America/Iqaluit') { echo "SELECTED";}?>  >America/Iqaluit</option>
													<option value="America/Jamaica" <?php if($site_timezone =='America/Jamaica') { echo "SELECTED";}?>  >America/Jamaica</option>
													<option value="America/Juneau" <?php if($site_timezone =='America/Juneau') { echo "SELECTED";}?>  >America/Juneau</option>
													<option value="America/Kentucky/Louisville" <?php if($site_timezone =='America/Kentucky/Louisville') { echo "SELECTED";}?>  >America/Kentucky/Louisville</option>
													<option value="America/Kentucky/Monticello" <?php if($site_timezone =='America/Kentucky/Monticello') { echo "SELECTED";}?>  >America/Kentucky/Monticello</option>
													<option value="America/Kralendijk" <?php if($site_timezone =='America/Kralendijk') { echo "SELECTED";}?>  >America/Kralendijk</option>
													<option value="America/La_Paz" <?php if($site_timezone =='America/La_Paz') { echo "SELECTED";}?>  >America/La_Paz</option>
													<option value="America/Lima" <?php if($site_timezone =='America/Lima') { echo "SELECTED";}?>  >America/Lima</option>
													<option value="America/Los_Angeles" <?php if($site_timezone =='America/Los_Angeles') { echo "SELECTED";}?>  >America/Los_Angeles</option>
													<option value="America/Lower_Princes" <?php if($site_timezone =='America/Lower_Princes') { echo "SELECTED";}?>  >America/Lower_Princes</option>
													<option value="America/Maceio" <?php if($site_timezone =='America/Maceio') { echo "SELECTED";}?>  >America/Maceio</option>
													<option value="America/Managua" <?php if($site_timezone =='America/Managua') { echo "SELECTED";}?>  >America/Managua</option>
													<option value="America/Manaus" <?php if($site_timezone =='America/Manaus') { echo "SELECTED";}?>  >America/Manaus</option>
													<option value="America/Marigot" <?php if($site_timezone =='America/Marigot') { echo "SELECTED";}?>  >America/Marigot</option>
													<option value="America/Martinique" <?php if($site_timezone =='America/Martinique') { echo "SELECTED";}?>  >America/Martinique</option>
													<option value="America/Matamoros" <?php if($site_timezone =='America/Matamoros') { echo "SELECTED";}?>  >America/Matamoros</option>
													<option value="America/Mazatlan" <?php if($site_timezone =='America/Mazatlan') { echo "SELECTED";}?>  >America/Mazatlan</option>
													<option value="America/Menominee" <?php if($site_timezone =='America/Menominee') { echo "SELECTED";}?>  >America/Menominee</option>
													<option value="America/Merida" <?php if($site_timezone =='America/Merida') { echo "SELECTED";}?>  >America/Merida</option>
													<option value="America/Metlakatla" <?php if($site_timezone =='America/Metlakatla') { echo "SELECTED";}?>  >America/Metlakatla</option>
													<option value="America/Mexico_City" <?php if($site_timezone =='America/Mexico_City') { echo "SELECTED";}?>  >America/Mexico_City</option>
													<option value="America/Miquelon" <?php if($site_timezone =='America/Miquelon') { echo "SELECTED";}?>  >America/Miquelon</option>
													<option value="America/Moncton" <?php if($site_timezone =='America/Moncton') { echo "SELECTED";}?>  >America/Moncton</option>
													<option value="America/Monterrey" <?php if($site_timezone =='America/Monterrey') { echo "SELECTED";}?>  >America/Monterrey</option>
													<option value="America/Montevideo" <?php if($site_timezone =='America/Montevideo') { echo "SELECTED";}?>  >America/Montevideo</option>
													<option value="America/Montserrat" <?php if($site_timezone =='America/Montserrat') { echo "SELECTED";}?>  >America/Montserrat</option>
													<option value="America/Nassau" <?php if($site_timezone =='America/Nassau') { echo "SELECTED";}?>  >America/Nassau</option>
													<option value="America/New_York" <?php if($site_timezone =='America/New_York') { echo "SELECTED";}?>  >America/New_York</option>
													<option value="America/Nipigon" <?php if($site_timezone =='America/Nipigon') { echo "SELECTED";}?>  >America/Nipigon</option>
													<option value="America/Nome" <?php if($site_timezone =='America/Nome') { echo "SELECTED";}?>  >America/Nome</option>
													<option value="America/Noronha" <?php if($site_timezone =='America/Noronha') { echo "SELECTED";}?>  >America/Noronha</option>
													<option value="America/North_Dakota/Beulah" <?php if($site_timezone =='America/North_Dakota/Beulah') { echo "SELECTED";}?>  >America/North_Dakota/Beulah</option>
													<option value="America/North_Dakota/Center" <?php if($site_timezone =='America/North_Dakota/Center') { echo "SELECTED";}?>  >America/North_Dakota/Center</option>
													<option value="America/North_Dakota/New_Salem" <?php if($site_timezone =='America/North_Dakota/New_Salem') { echo "SELECTED";}?>  >America/North_Dakota/New_Salem</option>
													<option value="America/Ojinaga" <?php if($site_timezone =='America/Ojinaga') { echo "SELECTED";}?>  >America/Ojinaga</option>
													<option value="America/Panama" <?php if($site_timezone =='America/Panama') { echo "SELECTED";}?>  >America/Panama</option>
													<option value="America/Pangnirtung" <?php if($site_timezone =='America/Pangnirtung') { echo "SELECTED";}?>  >America/Pangnirtung</option>
													<option value="America/Paramaribo" <?php if($site_timezone =='America/Paramaribo') { echo "SELECTED";}?>  >America/Paramaribo</option>
													<option value="America/Phoenix" <?php if($site_timezone =='America/Phoenix') { echo "SELECTED";}?>  >America/Phoenix</option>
													<option value="America/Port-au-Prince" <?php if($site_timezone =='America/Port-au-Prince') { echo "SELECTED";}?>  >America/Port-au-Prince</option>
													<option value="America/Port_of_Spain" <?php if($site_timezone =='America/Port_of_Spain') { echo "SELECTED";}?>  >America/Port_of_Spain</option>
													<option value="America/Porto_Velho" <?php if($site_timezone =='America/Porto_Velho') { echo "SELECTED";}?>  >America/Porto_Velho</option>
													<option value="America/Puerto_Rico" <?php if($site_timezone =='America/Puerto_Rico') { echo "SELECTED";}?>  >America/Puerto_Rico</option>
													<option value="America/Rainy_River" <?php if($site_timezone =='America/Rainy_River') { echo "SELECTED";}?>  >America/Rainy_River</option>
													<option value="America/Rankin_Inlet" <?php if($site_timezone =='America/Rankin_Inlet') { echo "SELECTED";}?>  >America/Rankin_Inlet</option>
													<option value="America/Recife" <?php if($site_timezone =='America/Recife') { echo "SELECTED";}?>  >America/Recife</option>
													<option value="America/Regina" <?php if($site_timezone =='America/Regina') { echo "SELECTED";}?>  >America/Regina</option>
													<option value="America/Resolute" <?php if($site_timezone =='America/Resolute') { echo "SELECTED";}?>  >America/Resolute</option>
													<option value="America/Rio_Branco" <?php if($site_timezone =='America/Rio_Branco') { echo "SELECTED";}?>  >America/Rio_Branco</option>
													<option value="America/Santa_Isabel" <?php if($site_timezone =='America/Santa_Isabel') { echo "SELECTED";}?>  >America/Santa_Isabel</option>
													<option value="America/Santarem" <?php if($site_timezone =='America/Santarem') { echo "SELECTED";}?>  >America/Santarem</option>
													<option value="America/Santiago" <?php if($site_timezone =='America/Santiago') { echo "SELECTED";}?>  >America/Santiago</option>
													<option value="America/Santo_Domingo" <?php if($site_timezone =='America/Santo_Domingo') { echo "SELECTED";}?>  >America/Santo_Domingo</option>
													<option value="America/Sao_Paulo" <?php if($site_timezone =='America/Sao_Paulo') { echo "SELECTED";}?>  >America/Sao_Paulo</option>
													<option value="America/Scoresbysund" <?php if($site_timezone =='America/Scoresbysund') { echo "SELECTED";}?>  >America/Scoresbysund</option>
													<option value="America/Sitka" <?php if($site_timezone =='America/Sitka') { echo "SELECTED";}?>  >America/Sitka</option>
													<option value="America/St_Barthelemy" <?php if($site_timezone =='America/St_Barthelemy') { echo "SELECTED";}?>  >America/St_Barthelemy</option>
													<option value="America/St_Johns" <?php if($site_timezone =='America/St_Johns') { echo "SELECTED";}?>  >America/St_Johns</option>
													<option value="America/St_Kitts" <?php if($site_timezone =='America/St_Kitts') { echo "SELECTED";}?>  >America/St_Kitts</option>
													<option value="America/St_Lucia" <?php if($site_timezone =='America/St_Lucia') { echo "SELECTED";}?>  >America/St_Lucia</option>
													<option value="America/St_Thomas" <?php if($site_timezone =='America/St_Thomas') { echo "SELECTED";}?>  >America/St_Thomas</option>
													<option value="America/St_Vincent" <?php if($site_timezone =='America/St_Vincent') { echo "SELECTED";}?>  >America/St_Vincent</option>
													<option value="America/Swif(t_Current" <?php if($site_timezone =='America/Swif(t_Current') { echo "SELECTED";}?>  >America/Swif(t_Current</option>
													<option value="America/Tegucigalpa" <?php if($site_timezone =='America/Tegucigalpa') { echo "SELECTED";}?>  >America/Tegucigalpa</option>
													<option value="America/Thule" <?php if($site_timezone =='America/Thule') { echo "SELECTED";}?>  >America/Thule</option>
													<option value="America/Thunder_Bay" <?php if($site_timezone =='America/Thunder_Bay') { echo "SELECTED";}?>  >America/Thunder_Bay</option>
													<option value="America/Tijuana" <?php if($site_timezone =='America/Tijuana') { echo "SELECTED";}?>  >America/Tijuana</option>
													<option value="America/Toronto" <?php if($site_timezone =='America/Toronto') { echo "SELECTED";}?>  >America/Toronto</option>
													<option value="America/Tortola" <?php if($site_timezone =='America/Tortola') { echo "SELECTED";}?>  >America/Tortola</option>
													<option value="America/Vancouver" <?php if($site_timezone =='America/Vancouver') { echo "SELECTED";}?>  >America/Vancouver</option>
													<option value="America/Whitehorse" <?php if($site_timezone =='America/Whitehorse') { echo "SELECTED";}?>  >America/Whitehorse</option>
													<option value="America/Winnipeg" <?php if($site_timezone =='America/Winnipeg') { echo "SELECTED";}?>  >America/Winnipeg</option>
													<option value="America/Yakutat" <?php if($site_timezone =='America/Yakutat') { echo "SELECTED";}?>  >America/Yakutat</option>
													<option value="America/Yellowknife" <?php if($site_timezone =='America/Yellowknife') { echo "SELECTED";}?>  >America/Yellowknife</option>
													<option value="Antarctica/Casey" <?php if($site_timezone =='Antarctica/Casey') { echo "SELECTED";}?>  >Antarctica/Casey</option>
													<option value="Antarctica/Davis" <?php if($site_timezone =='Antarctica/Davis') { echo "SELECTED";}?>  >Antarctica/Davis</option>
													<option value="Antarctica/DumontDUrville" <?php if($site_timezone =='Antarctica/DumontDUrville') { echo "SELECTED";}?>  >Antarctica/DumontDUrville</option>
													<option value="Antarctica/Macquarie" <?php if($site_timezone =='Antarctica/Macquarie') { echo "SELECTED";}?>  >Antarctica/Macquarie</option>
													<option value="Antarctica/Mawson" <?php if($site_timezone =='Antarctica/Mawson') { echo "SELECTED";}?>  >Antarctica/Mawson</option>
													<option value="Antarctica/McMurdo" <?php if($site_timezone =='Antarctica/McMurdo') { echo "SELECTED";}?>  >Antarctica/McMurdo</option>
													<option value="Antarctica/Palmer" <?php if($site_timezone =='Antarctica/Palmer') { echo "SELECTED";}?>  >Antarctica/Palmer</option>
													<option value="Antarctica/Rothera" <?php if($site_timezone =='Antarctica/Rothera') { echo "SELECTED";}?>  >Antarctica/Rothera</option>
													<option value="Antarctica/Syowa" <?php if($site_timezone =='Antarctica/Syowa') { echo "SELECTED";}?>  >Antarctica/Syowa</option>
													<option value="Antarctica/Vostok" <?php if($site_timezone =='Antarctica/Vostok') { echo "SELECTED";}?>  >Antarctica/Vostok</option>
													<option value="Arctic/Longyearbyen" <?php if($site_timezone =='Arctic/Longyearbyen') { echo "SELECTED";}?>  >Arctic/Longyearbyen</option>
													<option value="Asia/Aden" <?php if($site_timezone =='Asia/Aden') { echo "SELECTED";}?>  >Asia/Aden</option>
													<option value="Asia/Almaty" <?php if($site_timezone =='Asia/Almaty') { echo "SELECTED";}?>  >Asia/Almaty</option>
													<option value="Asia/Amman" <?php if($site_timezone =='Asia/Amman') { echo "SELECTED";}?>  >Asia/Amman</option>
													<option value="Asia/Anadyr" <?php if($site_timezone =='Asia/Anadyr') { echo "SELECTED";}?>  >Asia/Anadyr</option>
													<option value="Asia/Aqtau" <?php if($site_timezone =='Asia/Aqtau') { echo "SELECTED";}?>  >Asia/Aqtau</option>
													<option value="Asia/Aqtobe" <?php if($site_timezone =='Asia/Aqtobe') { echo "SELECTED";}?>  >Asia/Aqtobe</option>
													<option value="Asia/Ashgabat" <?php if($site_timezone =='Asia/Ashgabat') { echo "SELECTED";}?>  >Asia/Ashgabat</option>
													<option value="Asia/Baghdad" <?php if($site_timezone =='Asia/Baghdad') { echo "SELECTED";}?>  >Asia/Baghdad</option>
													<option value="Asia/Bahrain" <?php if($site_timezone =='Asia/Bahrain') { echo "SELECTED";}?>  >Asia/Bahrain</option>
													<option value="Asia/Baku" <?php if($site_timezone =='Asia/Baku') { echo "SELECTED";}?>  >Asia/Baku</option>
													<option value="Asia/Bangkok" <?php if($site_timezone =='Asia/Bangkok') { echo "SELECTED";}?>  >Asia/Bangkok</option>
													<option value="Asia/Beirut" <?php if($site_timezone =='Asia/Beirut') { echo "SELECTED";}?>  >Asia/Beirut</option>
													<option value="Asia/Bishkek" <?php if($site_timezone =='Asia/Bishkek') { echo "SELECTED";}?>  >Asia/Bishkek</option>
													<option value="Asia/Brunei" <?php if($site_timezone =='Asia/Brunei') { echo "SELECTED";}?>  >Asia/Brunei</option>
													<option value="Asia/Choibalsan" <?php if($site_timezone =='Asia/Choibalsan') { echo "SELECTED";}?>  >Asia/Choibalsan</option>
													<option value="Asia/Chongqing" <?php if($site_timezone =='Asia/Chongqing') { echo "SELECTED";}?>  >Asia/Chongqing</option>
													<option value="Asia/Colombo" <?php if($site_timezone =='Asia/Colombo') { echo "SELECTED";}?>  >Asia/Colombo</option>
													<option value="Asia/Damascus" <?php if($site_timezone =='Asia/Damascus') { echo "SELECTED";}?>  >Asia/Damascus</option>
													<option value="Asia/Dhaka" <?php if($site_timezone =='Asia/Dhaka') { echo "SELECTED";}?>  >Asia/Dhaka</option>
													<option value="Asia/Dili" <?php if($site_timezone =='Asia/Dili') { echo "SELECTED";}?>  >Asia/Dili</option>
													<option value="Asia/Dubai" <?php if($site_timezone =='Asia/Dubai') { echo "SELECTED";}?>  >Asia/Dubai</option>
													<option value="Asia/Dushanbe" <?php if($site_timezone =='Asia/Dushanbe') { echo "SELECTED";}?>  >Asia/Dushanbe</option>
													<option value="Asia/Gaza" <?php if($site_timezone =='Asia/Gaza') { echo "SELECTED";}?>  >Asia/Gaza</option>
													<option value="Asia/Harbin" <?php if($site_timezone =='Asia/Harbin') { echo "SELECTED";}?>  >Asia/Harbin</option>
													<option value="Asia/Hebron" <?php if($site_timezone =='Asia/Hebron') { echo "SELECTED";}?>  >Asia/Hebron</option>
													<option value="Asia/Ho_Chi_Minh" <?php if($site_timezone =='Asia/Ho_Chi_Minh') { echo "SELECTED";}?>  >Asia/Ho_Chi_Minh</option>
													<option value="Asia/Hong_Kong" <?php if($site_timezone =='Asia/Hong_Kong') { echo "SELECTED";}?>  >Asia/Hong_Kong</option>
													<option value="Asia/Hovd" <?php if($site_timezone =='Asia/Hovd') { echo "SELECTED";}?>  >Asia/Hovd</option>
													<option value="Asia/Irkutsk" <?php if($site_timezone =='Asia/Irkutsk') { echo "SELECTED";}?>  >Asia/Irkutsk</option>
													<option value="Asia/Jakarta" <?php if($site_timezone =='Asia/Jakarta') { echo "SELECTED";}?>  >Asia/Jakarta</option>
													<option value="Asia/Jayapura" <?php if($site_timezone =='Asia/Jayapura') { echo "SELECTED";}?>  >Asia/Jayapura</option>
													<option value="Asia/Jerusalem" <?php if($site_timezone =='Asia/Jerusalem') { echo "SELECTED";}?>  >Asia/Jerusalem</option>
													<option value="Asia/Kabul" <?php if($site_timezone =='Asia/Kabul') { echo "SELECTED";}?>  >Asia/Kabul</option>
													<option value="Asia/Kamchatka" <?php if($site_timezone =='Asia/Kamchatka') { echo "SELECTED";}?>  >Asia/Kamchatka</option>
													<option value="Asia/Karachi" <?php if($site_timezone =='Asia/Karachi') { echo "SELECTED";}?>  >Asia/Karachi</option>
													<option value="Asia/Kashgar" <?php if($site_timezone =='Asia/Kashgar') { echo "SELECTED";}?>  >Asia/Kashgar</option>
													<option value="Asia/Kathmandu" <?php if($site_timezone =='Asia/Kathmandu') { echo "SELECTED";}?>  >Asia/Kathmandu</option>
													<option value="Asia/Khandyga" <?php if($site_timezone =='Asia/Khandyga') { echo "SELECTED";}?>  >Asia/Khandyga</option>
													<option value="Asia/Kolkata" <?php if($site_timezone =='Asia/Kolkata') { echo "SELECTED";}?>  >Asia/Kolkata</option>
													<option value="Asia/Krasnoyarsk" <?php if($site_timezone =='Asia/Krasnoyarsk') { echo "SELECTED";}?>  >Asia/Krasnoyarsk</option>
													<option value="Asia/Kuala_Lumpur" <?php if($site_timezone =='Asia/Kuala_Lumpur') { echo "SELECTED";}?>  >Asia/Kuala_Lumpur</option>
													<option value="Asia/Kuching" <?php if($site_timezone =='Asia/Kuching') { echo "SELECTED";}?>  >Asia/Kuching</option>
													<option value="Asia/Kuwait" <?php if($site_timezone =='Asia/Kuwait') { echo "SELECTED";}?>  >Asia/Kuwait</option>
													<option value="Asia/Macau" <?php if($site_timezone =='Asia/Macau') { echo "SELECTED";}?>  >Asia/Macau</option>
													<option value="Asia/Magadan" <?php if($site_timezone =='Asia/Magadan') { echo "SELECTED";}?>  >Asia/Magadan</option>
													<option value="Asia/Makassar" <?php if($site_timezone =='Asia/Makassar') { echo "SELECTED";}?>  >Asia/Makassar</option>
													<option value="Asia/Manila" <?php if($site_timezone =='Asia/Manila') { echo "SELECTED";}?>  >Asia/Manila</option>
													<option value="Asia/Muscat" <?php if($site_timezone =='Asia/Muscat') { echo "SELECTED";}?>  >Asia/Muscat</option>
													<option value="Asia/Nicosia" <?php if($site_timezone =='Asia/Nicosia') { echo "SELECTED";}?>  >Asia/Nicosia</option>
													<option value="Asia/Novokuznetsk" <?php if($site_timezone =='Asia/Novokuznetsk') { echo "SELECTED";}?>  >Asia/Novokuznetsk</option>
													<option value="Asia/Novosibirsk" <?php if($site_timezone =='Asia/Novosibirsk') { echo "SELECTED";}?>  >Asia/Novosibirsk</option>
													<option value="Asia/Omsk" <?php if($site_timezone =='Asia/Omsk') { echo "SELECTED";}?>  >Asia/Omsk</option>
													<option value="Asia/Oral" <?php if($site_timezone =='Asia/Oral') { echo "SELECTED";}?>  >Asia/Oral</option>
													<option value="Asia/Phnom_Penh" <?php if($site_timezone =='Asia/Phnom_Penh') { echo "SELECTED";}?>  >Asia/Phnom_Penh</option>
													<option value="Asia/Pontianak" <?php if($site_timezone =='Asia/Pontianak') { echo "SELECTED";}?>  >Asia/Pontianak</option>
													<option value="Asia/Pyongyang" <?php if($site_timezone =='Asia/Pyongyang') { echo "SELECTED";}?>  >Asia/Pyongyang</option>
													<option value="Asia/Qatar" <?php if($site_timezone =='Asia/Qatar') { echo "SELECTED";}?>  >Asia/Qatar</option>
													<option value="Asia/Qyzylorda" <?php if($site_timezone =='Asia/Qyzylorda') { echo "SELECTED";}?>  >Asia/Qyzylorda</option>
													<option value="Asia/Rangoon" <?php if($site_timezone =='Asia/Rangoon') { echo "SELECTED";}?>  >Asia/Rangoon</option>
													<option value="Asia/Riyadh" <?php if($site_timezone =='Asia/Riyadh') { echo "SELECTED";}?>  >Asia/Riyadh</option>
													<option value="Asia/Sakhalin" <?php if($site_timezone =='Asia/Sakhalin') { echo "SELECTED";}?>  >Asia/Sakhalin</option>
													<option value="Asia/Samarkand" <?php if($site_timezone =='Asia/Samarkand') { echo "SELECTED";}?>  >Asia/Samarkand</option>
													<option value="Asia/Seoul" <?php if($site_timezone =='Asia/Seoul') { echo "SELECTED";}?>  >Asia/Seoul</option>
													<option value="Asia/Shanghai" <?php if($site_timezone =='Asia/Shanghai') { echo "SELECTED";}?>  >Asia/Shanghai</option>
													<option value="Asia/Singapore" <?php if($site_timezone =='Asia/Singapore') { echo "SELECTED";}?>  >Asia/Singapore</option>
													<option value="Asia/Taipei" <?php if($site_timezone =='Asia/Taipei') { echo "SELECTED";}?>  >Asia/Taipei</option>
													<option value="Asia/Tashkent" <?php if($site_timezone =='Asia/Tashkent') { echo "SELECTED";}?>  >Asia/Tashkent</option>
													<option value="Asia/Tbilisi" <?php if($site_timezone =='Asia/Tbilisi') { echo "SELECTED";}?>  >Asia/Tbilisi</option>
													<option value="Asia/Tehran" <?php if($site_timezone =='Asia/Tehran') { echo "SELECTED";}?>  >Asia/Tehran</option>
													<option value="Asia/Thimphu" <?php if($site_timezone =='Asia/Thimphu') { echo "SELECTED";}?>  >Asia/Thimphu</option>
													<option value="Asia/Tokyo" <?php if($site_timezone =='Asia/Tokyo') { echo "SELECTED";}?>  >Asia/Tokyo</option>
													<option value="Asia/Ulaanbaatar" <?php if($site_timezone =='Asia/Ulaanbaatar') { echo "SELECTED";}?>  >Asia/Ulaanbaatar</option>
													<option value="Asia/Urumqi" <?php if($site_timezone =='Asia/Urumqi') { echo "SELECTED";}?>  >Asia/Urumqi</option>
													<option value="Asia/Ust-Nera" <?php if($site_timezone =='Asia/Ust-Nera') { echo "SELECTED";}?>  >Asia/Ust-Nera</option>
													<option value="Asia/Vientiane" <?php if($site_timezone =='Asia/Vientiane') { echo "SELECTED";}?>  >Asia/Vientiane</option>
													<option value="Asia/Vladivostok" <?php if($site_timezone =='Asia/Vladivostok') { echo "SELECTED";}?>  >Asia/Vladivostok</option>
													<option value="Asia/Yakutsk" <?php if($site_timezone =='Asia/Yakutsk') { echo "SELECTED";}?>  >Asia/Yakutsk</option>
													<option value="Asia/Yekaterinburg" <?php if($site_timezone =='Asia/Yekaterinburg') { echo "SELECTED";}?>  >Asia/Yekaterinburg</option>
													<option value="Asia/Yerevan" <?php if($site_timezone =='Asia/Yerevan') { echo "SELECTED";}?>  >Asia/Yerevan</option>
													<option value="Atlantic/Azores" <?php if($site_timezone =='Atlantic/Azores') { echo "SELECTED";}?>  >Atlantic/Azores</option>
													<option value="Atlantic/Bermuda" <?php if($site_timezone =='Atlantic/Bermuda') { echo "SELECTED";}?>  >Atlantic/Bermuda</option>
													<option value="Atlantic/Canary" <?php if($site_timezone =='Atlantic/Canary') { echo "SELECTED";}?>  >Atlantic/Canary</option>
													<option value="Atlantic/Cape_Verde" <?php if($site_timezone =='Atlantic/Cape_Verde') { echo "SELECTED";}?>  >Atlantic/Cape_Verde</option>
													<option value="Atlantic/Faroe" <?php if($site_timezone =='Atlantic/Faroe') { echo "SELECTED";}?>  >Atlantic/Faroe</option>
													<option value="Atlantic/Madeira" <?php if($site_timezone =='Atlantic/Madeira') { echo "SELECTED";}?>  >Atlantic/Madeira</option>
													<option value="Atlantic/Reykjavik" <?php if($site_timezone =='Atlantic/Reykjavik') { echo "SELECTED";}?>  >Atlantic/Reykjavik</option>
													<option value="Atlantic/South_Georgia" <?php if($site_timezone =='Atlantic/South_Georgia') { echo "SELECTED";}?>  >Atlantic/South_Georgia</option>
													<option value="Atlantic/St_Helena" <?php if($site_timezone =='Atlantic/St_Helena') { echo "SELECTED";}?>  >Atlantic/St_Helena</option>
													<option value="Atlantic/Stanley" <?php if($site_timezone =='Atlantic/Stanley') { echo "SELECTED";}?>  >Atlantic/Stanley</option>
													<option value="Australia/Adelaide" <?php if($site_timezone =='Australia/Adelaide') { echo "SELECTED";}?>  >Australia/Adelaide</option>
													<option value="Australia/Brisbane" <?php if($site_timezone =='Australia/Brisbane') { echo "SELECTED";}?>  >Australia/Brisbane</option>
													<option value="Australia/Broken_Hill" <?php if($site_timezone =='Australia/Broken_Hill') { echo "SELECTED";}?>  >Australia/Broken_Hill</option>
													<option value="Australia/Currie" <?php if($site_timezone =='Australia/Currie') { echo "SELECTED";}?>  >Australia/Currie</option>
													<option value="Australia/Darwin" <?php if($site_timezone =='Australia/Darwin') { echo "SELECTED";}?>  >Australia/Darwin</option>
													<option value="Australia/Eucla" <?php if($site_timezone =='Australia/Eucla') { echo "SELECTED";}?>  >Australia/Eucla</option>
													<option value="Australia/Hobart" <?php if($site_timezone =='Australia/Hobart') { echo "SELECTED";}?>  >Australia/Hobart</option>
													<option value="Australia/Lindeman" <?php if($site_timezone =='Australia/Lindeman') { echo "SELECTED";}?>  >Australia/Lindeman</option>
													<option value="Australia/Lord_Howe" <?php if($site_timezone =='Australia/Lord_Howe') { echo "SELECTED";}?>  >Australia/Lord_Howe</option>
													<option value="Australia/Melbourne" <?php if($site_timezone =='Australia/Melbourne') { echo "SELECTED";}?>  >Australia/Melbourne</option>
													<option value="Australia/Perth" <?php if($site_timezone =='Australia/Perth') { echo "SELECTED";}?>  >Australia/Perth</option>
													<option value="Australia/Sydney" <?php if($site_timezone =='Australia/Sydney') { echo "SELECTED";}?>  >Australia/Sydney</option>
													<option value="Europe/Amsterdam" <?php if($site_timezone =='Europe/Amsterdam') { echo "SELECTED";}?>  >Europe/Amsterdam</option>
													<option value="Europe/Andorra" <?php if($site_timezone =='Europe/Andorra') { echo "SELECTED";}?>  >Europe/Andorra</option>
													<option value="Europe/Athens" <?php if($site_timezone =='Europe/Athens') { echo "SELECTED";}?>  >Europe/Athens</option>
													<option value="Europe/Belgrade" <?php if($site_timezone =='Europe/Belgrade') { echo "SELECTED";}?>  >Europe/Belgrade</option>
													<option value="Europe/Berlin" <?php if($site_timezone =='Europe/Berlin') { echo "SELECTED";}?>  >Europe/Berlin</option>
													<option value="Europe/Bratislava" <?php if($site_timezone =='Europe/Bratislava') { echo "SELECTED";}?>  >Europe/Bratislava</option>
													<option value="Europe/Brussels" <?php if($site_timezone =='Europe/Brussels') { echo "SELECTED";}?>  >Europe/Brussels</option>
													<option value="Europe/Bucharest" <?php if($site_timezone =='Europe/Bucharest') { echo "SELECTED";}?>  >Europe/Bucharest</option>
													<option value="Europe/Budapest" <?php if($site_timezone =='Europe/Budapest') { echo "SELECTED";}?>  >Europe/Budapest</option>
													<option value="Europe/Busingen" <?php if($site_timezone =='Europe/Busingen') { echo "SELECTED";}?>  >Europe/Busingen</option>
													<option value="Europe/Chisinau" <?php if($site_timezone =='Europe/Chisinau') { echo "SELECTED";}?>  >Europe/Chisinau</option>
													<option value="Europe/Copenhagen" <?php if($site_timezone =='Europe/Copenhagen') { echo "SELECTED";}?>  >Europe/Copenhagen</option>
													<option value="Europe/Dublin" <?php if($site_timezone =='Europe/Dublin') { echo "SELECTED";}?>  >Europe/Dublin</option>
													<option value="Europe/Gibraltar" <?php if($site_timezone =='Europe/Gibraltar') { echo "SELECTED";}?>  >Europe/Gibraltar</option>
													<option value="Europe/Guernsey" <?php if($site_timezone =='Europe/Guernsey') { echo "SELECTED";}?>  >Europe/Guernsey</option>
													<option value="Europe/Helsinki" <?php if($site_timezone =='Europe/Helsinki') { echo "SELECTED";}?>  >Europe/Helsinki</option>
													<option value="Europe/Isle_of_Man" <?php if($site_timezone =='Europe/Isle_of_Man') { echo "SELECTED";}?>  >Europe/Isle_of_Man</option>
													<option value="Europe/Istanbul" <?php if($site_timezone =='Europe/Istanbul') { echo "SELECTED";}?>  >Europe/Istanbul</option>
													<option value="Europe/Jersey" <?php if($site_timezone =='Europe/Jersey') { echo "SELECTED";}?>  >Europe/Jersey</option>
													<option value="Europe/Kaliningrad" <?php if($site_timezone =='Europe/Kaliningrad') { echo "SELECTED";}?>  >Europe/Kaliningrad</option>
													<option value="Europe/Kiev" <?php if($site_timezone =='Europe/Kiev') { echo "SELECTED";}?>  >Europe/Kiev</option>
													<option value="Europe/Lisbon" <?php if($site_timezone =='Europe/Lisbon') { echo "SELECTED";}?>  >Europe/Lisbon</option>
													<option value="Europe/Ljubljana" <?php if($site_timezone =='Europe/Ljubljana') { echo "SELECTED";}?>  >Europe/Ljubljana</option>
													<option value="Europe/London" <?php if($site_timezone =='Europe/London') { echo "SELECTED";}?>  >Europe/London</option>
													<option value="Europe/Luxembourg" <?php if($site_timezone =='Europe/Luxembourg') { echo "SELECTED";}?>  >Europe/Luxembourg</option>
													<option value="Europe/Madrid" <?php if($site_timezone =='Europe/Madrid') { echo "SELECTED";}?>  >Europe/Madrid</option>
													<option value="Europe/Malta" <?php if($site_timezone =='Europe/Malta') { echo "SELECTED";}?>  >Europe/Malta</option>
													<option value="Europe/Mariehamn" <?php if($site_timezone =='Europe/Mariehamn') { echo "SELECTED";}?>  >Europe/Mariehamn</option>
													<option value="Europe/Minsk" <?php if($site_timezone =='Europe/Minsk') { echo "SELECTED";}?>  >Europe/Minsk</option>
													<option value="Europe/Monaco" <?php if($site_timezone =='Europe/Monaco') { echo "SELECTED";}?>  >Europe/Monaco</option>
													<option value="Europe/Moscow" <?php if($site_timezone =='Europe/Moscow') { echo "SELECTED";}?>  >Europe/Moscow</option>
													<option value="Europe/Oslo" <?php if($site_timezone =='Europe/Oslo') { echo "SELECTED";}?>  >Europe/Oslo</option>
													<option value="Europe/Paris" <?php if($site_timezone =='Europe/Paris') { echo "SELECTED";}?>  >Europe/Paris</option>
													<option value="Europe/Podgorica" <?php if($site_timezone =='Europe/Podgorica') { echo "SELECTED";}?>  >Europe/Podgorica</option>
													<option value="Europe/Prague" <?php if($site_timezone =='Europe/Prague') { echo "SELECTED";}?>  >Europe/Prague</option>
													<option value="Europe/Riga" <?php if($site_timezone =='Europe/Riga') { echo "SELECTED";}?>  >Europe/Riga</option>
													<option value="Europe/Rome" <?php if($site_timezone =='Europe/Rome') { echo "SELECTED";}?>  >Europe/Rome</option>
													<option value="Europe/Samara" <?php if($site_timezone =='Europe/Samara') { echo "SELECTED";}?>  >Europe/Samara</option>
													<option value="Europe/San_Marino" <?php if($site_timezone =='Europe/San_Marino') { echo "SELECTED";}?>  >Europe/San_Marino</option>
													<option value="Europe/Sarajevo" <?php if($site_timezone =='Europe/Sarajevo') { echo "SELECTED";}?>  >Europe/Sarajevo</option>
													<option value="Europe/Simferopol" <?php if($site_timezone =='Europe/Simferopol') { echo "SELECTED";}?>  >Europe/Simferopol</option>
													<option value="Europe/Skopje" <?php if($site_timezone =='Europe/Skopje') { echo "SELECTED";}?>  >Europe/Skopje</option>
													<option value="Europe/Sofia" <?php if($site_timezone =='Europe/Sofia') { echo "SELECTED";}?>  >Europe/Sofia</option>
													<option value="Europe/Stockholm" <?php if($site_timezone =='Europe/Stockholm') { echo "SELECTED";}?>  >Europe/Stockholm</option>
													<option value="Europe/Tallinn" <?php if($site_timezone =='Europe/Tallinn') { echo "SELECTED";}?>  >Europe/Tallinn</option>
													<option value="Europe/Tirane" <?php if($site_timezone =='Europe/Tirane') { echo "SELECTED";}?>  >Europe/Tirane</option>
													<option value="Europe/Uzhgorod" <?php if($site_timezone =='Europe/Uzhgorod') { echo "SELECTED";}?>  >Europe/Uzhgorod</option>
													<option value="Europe/Vaduz" <?php if($site_timezone =='Europe/Vaduz') { echo "SELECTED";}?>  >Europe/Vaduz</option>
													<option value="Europe/Vatican" <?php if($site_timezone =='Europe/Vatican') { echo "SELECTED";}?>  >Europe/Vatican</option>
													<option value="Europe/Vienna" <?php if($site_timezone =='Europe/Vienna') { echo "SELECTED";}?>  >Europe/Vienna</option>
													<option value="Europe/Vilnius" <?php if($site_timezone =='Europe/Vilnius') { echo "SELECTED";}?>  >Europe/Vilnius</option>
													<option value="Europe/Volgograd" <?php if($site_timezone =='Europe/Volgograd') { echo "SELECTED";}?>  >Europe/Volgograd</option>
													<option value="Europe/Warsaw" <?php if($site_timezone =='Europe/Warsaw') { echo "SELECTED";}?>  >Europe/Warsaw</option>
													<option value="Europe/Zagreb" <?php if($site_timezone =='Europe/Zagreb') { echo "SELECTED";}?>  >Europe/Zagreb</option>
													<option value="Europe/Zaporozhye" <?php if($site_timezone =='Europe/Zaporozhye') { echo "SELECTED";}?>  >Europe/Zaporozhye</option>
													<option value="Europe/Zurich" <?php if($site_timezone =='Europe/Zurich') { echo "SELECTED";}?>  >Europe/Zurich</option>
													<option value="Indian/Antananarivo" <?php if($site_timezone =='Indian/Antananarivo') { echo "SELECTED";}?>  >Indian/Antananarivo</option>
													<option value="Indian/Chagos" <?php if($site_timezone =='Indian/Chagos') { echo "SELECTED";}?>  >Indian/Chagos</option>
													<option value="Indian/Christmas" <?php if($site_timezone =='Indian/Christmas') { echo "SELECTED";}?>  >Indian/Christmas</option>
													<option value="Indian/Cocos" <?php if($site_timezone =='Indian/Cocos') { echo "SELECTED";}?>  >Indian/Cocos</option>
													<option value="Indian/Comoro" <?php if($site_timezone =='Indian/Comoro') { echo "SELECTED";}?>  >Indian/Comoro</option>
													<option value="Indian/Kerguelen" <?php if($site_timezone =='Indian/Kerguelen') { echo "SELECTED";}?>  >Indian/Kerguelen</option>
													<option value="Indian/Mahe" <?php if($site_timezone =='Indian/Mahe') { echo "SELECTED";}?>  >Indian/Mahe</option>
													<option value="Indian/Maldives" <?php if($site_timezone =='Indian/Maldives') { echo "SELECTED";}?>  >Indian/Maldives</option>
													<option value="Indian/Mauritius" <?php if($site_timezone =='Indian/Mauritius') { echo "SELECTED";}?>  >Indian/Mauritius</option>
													<option value="Indian/Mayotte" <?php if($site_timezone =='Indian/Mayotte') { echo "SELECTED";}?>  >Indian/Mayotte</option>
													<option value="Indian/Reunion" <?php if($site_timezone =='Indian/Reunion') { echo "SELECTED";}?>  >Indian/Reunion</option>
													<option value="Pacific/Apia" <?php if($site_timezone =='Pacific/Apia') { echo "SELECTED";}?>  >Pacific/Apia</option>
													<option value="Pacific/Auckland" <?php if($site_timezone =='Pacific/Auckland') { echo "SELECTED";}?>  >Pacific/Auckland</option>
													<option value="Pacific/Chatham" <?php if($site_timezone =='Pacific/Chatham') { echo "SELECTED";}?>  >Pacific/Chatham</option>
													<option value="Pacific/Chuuk" <?php if($site_timezone =='Pacific/Chuuk') { echo "SELECTED";}?>  >Pacific/Chuuk</option>
													<option value="Pacific/Easter" <?php if($site_timezone =='Pacific/Easter') { echo "SELECTED";}?>  >Pacific/Easter</option>
													<option value="Pacific/Efate" <?php if($site_timezone =='Pacific/Efate') { echo "SELECTED";}?>  >Pacific/Efate</option>
													<option value="Pacific/Enderbury" <?php if($site_timezone =='Pacific/Enderbury') { echo "SELECTED";}?>  >Pacific/Enderbury</option>
													<option value="Pacific/Fakaofo" <?php if($site_timezone =='Pacific/Fakaofo') { echo "SELECTED";}?>  >Pacific/Fakaofo</option>
													<option value="Pacific/Fiji" <?php if($site_timezone =='Pacific/Fiji') { echo "SELECTED";}?>  >Pacific/Fiji</option>
													<option value="Pacific/Funafuti" <?php if($site_timezone =='Pacific/Funafuti') { echo "SELECTED";}?>  >Pacific/Funafuti</option>
													<option value="Pacific/Galapagos" <?php if($site_timezone =='Pacific/Galapagos') { echo "SELECTED";}?>  >Pacific/Galapagos</option>
													<option value="Pacific/Gambier" <?php if($site_timezone =='Pacific/Gambier') { echo "SELECTED";}?>  >Pacific/Gambier</option>
													<option value="Pacific/Guadalcanal" <?php if($site_timezone =='Pacific/Guadalcanal') { echo "SELECTED";}?>  >Pacific/Guadalcanal</option>
													<option value="Pacific/Guam" <?php if($site_timezone =='Pacific/Guam') { echo "SELECTED";}?>  >Pacific/Guam</option>
													<option value="Pacific/Honolulu" <?php if($site_timezone =='Pacific/Honolulu') { echo "SELECTED";}?>  >Pacific/Honolulu</option>
													<option value="Pacific/Johnston" <?php if($site_timezone =='Pacific/Johnston') { echo "SELECTED";}?>  >Pacific/Johnston</option>
													<option value="Pacific/Kiritimati" <?php if($site_timezone =='Pacific/Kiritimati') { echo "SELECTED";}?>  >Pacific/Kiritimati</option>
													<option value="Pacific/Kosrae" <?php if($site_timezone =='Pacific/Kosrae') { echo "SELECTED";}?>  >Pacific/Kosrae</option>
													<option value="Pacific/Kwajalein" <?php if($site_timezone =='Pacific/Kwajalein') { echo "SELECTED";}?>  >Pacific/Kwajalein</option>
													<option value="Pacific/Majuro" <?php if($site_timezone =='Pacific/Majuro') { echo "SELECTED";}?>  >Pacific/Majuro</option>
													<option value="Pacific/Marquesas" <?php if($site_timezone =='Pacific/Marquesas') { echo "SELECTED";}?>  >Pacific/Marquesas</option>
													<option value="Pacific/Midway" <?php if($site_timezone =='Pacific/Midway') { echo "SELECTED";}?>  >Pacific/Midway</option>
													<option value="Pacific/Nauru" <?php if($site_timezone =='Pacific/Nauru') { echo "SELECTED";}?>  >Pacific/Nauru</option>
													<option value="Pacific/Niue" <?php if($site_timezone =='Pacific/Niue') { echo "SELECTED";}?>  >Pacific/Niue</option>
													<option value="Pacific/Norfolk" <?php if($site_timezone =='Pacific/Norfolk') { echo "SELECTED";}?>  >Pacific/Norfolk</option>
													<option value="Pacific/Noumea" <?php if($site_timezone =='Pacific/Noumea') { echo "SELECTED";}?>  >Pacific/Noumea</option>
													<option value="Pacific/Pago_Pago" <?php if($site_timezone =='Pacific/Pago_Pago') { echo "SELECTED";}?>  >Pacific/Pago_Pago</option>
													<option value="Pacific/Palau" <?php if($site_timezone =='Pacific/Palau') { echo "SELECTED";}?>  >Pacific/Palau</option>
													<option value="Pacific/Pitcairn" <?php if($site_timezone =='Pacific/Pitcairn') { echo "SELECTED";}?>  >Pacific/Pitcairn</option>
													<option value="Pacific/Pohnpei" <?php if($site_timezone =='Pacific/Pohnpei') { echo "SELECTED";}?>  >Pacific/Pohnpei</option>
													<option value="Pacific/Port_Moresby" <?php if($site_timezone =='Pacific/Port_Moresby') { echo "SELECTED";}?>  >Pacific/Port_Moresby</option>
													<option value="Pacific/Rarotonga" <?php if($site_timezone =='Pacific/Rarotonga') { echo "SELECTED";}?>  >Pacific/Rarotonga</option>
													<option value="Pacific/Saipan" <?php if($site_timezone =='Pacific/Saipan') { echo "SELECTED";}?>  >Pacific/Saipan</option>
													<option value="Pacific/Tahiti" <?php if($site_timezone =='Pacific/Tahiti') { echo "SELECTED";}?>  >Pacific/Tahiti</option>
													<option value="Pacific/Tarawa" <?php if($site_timezone =='Pacific/Tarawa') { echo "SELECTED";}?>  >Pacific/Tarawa</option>
													<option value="Pacific/Tongatapu" <?php if($site_timezone =='Pacific/Tongatapu') { echo "SELECTED";}?>  >Pacific/Tongatapu</option>
													<option value="Pacific/Wake" <?php if($site_timezone =='Pacific/Wake') { echo "SELECTED";}?>  >Pacific/Wake</option>
													<option value="Pacific/Wallis" <?php if($site_timezone =='Pacific/Wallis') { echo "SELECTED";}?>  >Pacific/Wallis</option>
												</select>
													<p class="help-block"><?php echo form_error('site_timezone'); ?></p>
												</div> 
												
												<div class="form-group">   
													<label class="control-label" for="inputLat"><?php echo lang('lat'); ?></label> 
													<input class="form-control" type="text" name="site_latitude" id="site_latitude" value="<?php echo set_value('site_latitude', $site_latitude); ?>"/> 
													<p class="help-block"><?php echo form_error('site_latitude'); ?></p>
												</div>	
												
												<div class="form-group">   
													<label class="control-label" for="inputLng"><?php echo lang('lng'); ?></label> 
													<input class="form-control" type="text" name="site_longitude" id="site_longitude" value="<?php echo set_value('site_longitude', $site_longitude); ?>"/> 
													<p class="help-block"><?php echo form_error('site_longitude'); ?></p>
												</div>												
												
												<div class="form-group">   
													<label class="control-label" for="inputAPIKEY"><?php echo lang('api'); ?> <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#key" target="_blank">Reference here</a></label> 
													<input class="form-control" type="text" name="cal_apikey" id="cal_apikey" value="<?php echo set_value('cal_apikey', $cal_apikey); ?>"/> 
													<p class="help-block"><?php echo form_error('cal_apikey'); ?></p>
												</div>
												
												<div class="form-group"> 
													<input class=" " name="captcha" id="captcha" type="checkbox" <?php echo $captcha ?> > 
													<label for="inputCaptcha"><?php echo lang('settings_form_captcha') ?></label>  
												</div> 	 

												<div class="form-group">  
													<input class=" " name="debug" id="debug" type="checkbox" <?php echo $debug ?> > 
													<label for="inputCheckbox"><?php echo lang('settings_form_debug') ?></label> 
												</div>  									 

												<div class="btn-group"> 
													<input type="submit" class="btn btn-primary" id="button" name="settings_submit" value="<?php echo lang('save') ?>" />
												</div> 						
												<div class="btn-group">
													<input type="submit" class="btn" id="button" name="settings_cancel" value="<?php echo lang('cancel') ?>" /> 
												</div>										 
																
											<?php echo form_close(); ?> 	
										</div>
										<!-- /.col-md-12 .col-lg-12 -->				
									</div>
									<!-- /.row -->
                                </div>
                            </div>
                        </div>
						<!-- /.col-md-12 -->
                    </div>
					<!-- /.row -->
                </div>
				<!-- /.page-content -->
            </div> 
			<!-- /.page-content-wrapper --> 
        </div>
		<!-- /.page-container --> 	