 
			<div class="page-content-wrapper"> 
			
                <div class="page-content"> 
				
                    <div class="page-bar">
                        <ul class="page-breadcrumb">                              
							<li>
								
                            </li> 
                        </ul>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">  
									
                                <button type="button" class="btn btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> <?php echo lang('options'); ?>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">  
                                    <li>  
                                        <a href="<?php echo site_url('profile/home/export_all');?>">
                                           <i class="fa fa-cloud-download"></i> <?php echo lang('calendar_export'); ?></a>
                                    </li>  
                                    <li class="divider"> </li>
								    <li> 
                                        <a href="<?php echo site_url('profile/user/fullcalendar');?>">
                                            <i class="fa fa-calendar"></i> <?php echo lang('settings_cal_name'); ?></a>
                                    </li>
                                </ul>
                            </div>					 
                        </div>
                    </div>    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="sessionlist"> 
								<div class="panel-title">
                                    <div class="caption">&nbsp;</div>
                                </div>							
                                <div class="panel-body">
									<div class="row">
										<div class="col-md-12 col-lg-12"> 
									
			<header class="header bg-light "> 
				<button class="btn btn-success btn-sm btn-icon" id="task-new"><i class="fa fa-plus"></i></button>  
			</header>								 
            <section id="content">
            <section class="hbox height" id="taskapp">
                <aside>
                    <section class="vbox"> 
                        <section class="bg-light lter">
                            <section class="hbox height">
                                <!-- .aside -->
                                <aside>
                                    <section class="vbox ">
                                        <section class="scrollable wrapper">
											<!-- task list -->
											<ul class="list-group list-group-sp" id="task-list" >
											<?php if($user_tasks) { ?>
												<?php $listControl = 0; ?>
												<?php foreach ($user_tasks as $task) { ?>
													<li id="<?php echo $task['task_id']; ?>" class="list-group-item hover" hash="<?php echo $task['token']; ?>">
														<div class="view" id="task-<?php echo $task['task_id']; ?>">
															<button class="destroy close hover-action">×</button>
															<div class="checkbox"> <input class="toggle" type="checkbox"> 
															   <span class="task-name"><?php echo $task['title']; ?></span>  
															</div>
														</div> 							 
													</li>
													<?php $listControl++; ?>
													<?php if($listControl % 10 == 0) { ?>
											</ul>
											<ul>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												There are no tasks assigned to you.
											<?php } ?>
											</ul>	 
                                        </section>
                                    </section>
                                </aside><!-- /.aside -->
                            </section>
                        </section>
                        <footer class="footer bg-white-only b-t">
                            <p class="checkbox"><label><input id="toggle-all"
                            type="checkbox"> Mark all as complete</label></p>
                        </footer>
                    </section>
                </aside><!-- .aside -->
                <aside class="col-lg-4 bg-white">
                    <section class="vbox flex b-l" id="task-detail">
                        <!-- task detail -->
      					 <?php foreach ($events as $event) : ?>
								<div class="" id="item<?php echo $event['id']; ?>" >  
							    <?php echo anchor('tasks/todo/'.$event['id'],  $event['title'],  array('id' => $event['id'], 'class' => 'fc-event', 'style' => 'background-color:#05b0dc;border-color:#05f6dc;color:#ffffff')); ?> 
                                    <div class="tasks">
                                      	<?php if($event['tasks']) { ?>
											<ul>
											<?php foreach ($event['tasks'] as $key => $task) : ?>
												<?php if($key < 4) { ?>
												<li><?php echo anchor('task/view/'.$event['id'].'/'.$task['task_id'], '#'.$task['code'].' - '.$task['title']); ?>
													<em>(<?php echo $status_array[$task['status']] ?>)</em></li>
												<?php } else { ?>
												<li><em>more ...</em></li>
												<?php } ?>
											<?php endforeach ?>	  
											</ul>
											<p class="form-save-buttons"><?php echo anchor('project/tasks/'.$event['id'], 'View all tasks', 'class="btn-blue dash_view_all_tasks"'); ?></p>
											<?php } else { ?>
											No tasks here!
											<?php } ?>
									</div>  
								</div>								 
						   <?php endforeach ?>	                  
                    </section>
                </aside><!-- /.aside -->
            </section> 								
            </section> 								
									
									
									
									
									
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