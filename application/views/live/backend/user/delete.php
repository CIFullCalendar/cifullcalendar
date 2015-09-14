
<div class="container">
	<div id="myTabContent" class="tab-content bg-color-r1">  
		<div class="tab-pane active fade in">
			<div class="tabc-box editp-box">			

				<div class="alert alert-block alert-error fade in">
				<button type="button" class="close" data-dismiss="alert">*</button>
				
				 <legend>{{= lang('profile_delete_warning') }}</legend>
				 <h2 class="alert-heading">{{= lang('profile_delete_uname').' '.$user->name.' ' }}</h2>
				

				 <form class="form-horizontal" role="form" id="form" name="form" method="post" action="{{= base_url() . 'profile/edit/deleted/'.$user->id }}">	
				  <input class="btn btn-danger" id="button" type="submit" name="user" value="{{= lang('profile_delete_confirm') }}" />
				  &nbsp;|&nbsp;{{= anchor('manager/users',lang('profile_delete_cancel')) }}
				   
				 </form>
				</div>          
			</div>
		</div>
	</div>
</div>