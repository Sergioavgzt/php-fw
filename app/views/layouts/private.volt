{# --- имя текущего сотрудника --- #}
{% set currentusername = auth.getName() %}

<?php 
	# ID профиля пользователя
	use Micro\Models\Users;
	$robot = Users::findFirstByName($currentusername);
	$profilenomer = $robot->profilesId;
	# заносим в сессию
	$this->session->set("profilenomer", $profilenomer);
	# название профиля пользователя
	$rob = $this->session->get('auth-identity');
	$profilename = $rob['profile'];
?> 

<div class="privat_page">

	<div class="navbar navbar-inverse">
		<div class="navbar-inner">
			<div class="container" style="width: auto;">
		    {{ link_to(null, 'class': 'logo', '<img src="http://phalcon-micro.ztua.org/img/favicon.ico" width="50" height="40" />')}}
		  
		    	<div class="nav-collapse">

		    		<div class="moduletable_menu">
				
			
						<ul class="nav pull-right">

      				  		<li>{{ link_to('about', 'Инструкции') }}</li>
							<li>{{ link_to('session/logout', '<i class="fas fa-sign-out-alt fa-lg" title="Выход"></i>') }}</li>

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
  
	<div class="container">

		<h2>{{ currentusername }}, добро пожаловать в админчасть приложения! </h2>
		{{ content() }}
	</div>
</div>

<footer>
Сделано с любовью 
© {{ date("Y") }} Sergio
</footer>
