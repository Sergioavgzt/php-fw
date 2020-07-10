{{ content() }}
<p><?php $this->flashSession->output() ?></p>

<header class="jumbotron subhead" id="overview">
	<div class="hero-unit">

		<div class="h1_title">
			<h1>Phalcon - micro</h1>
			<p class="lead">Заготовка-шаблон для создания веб-приложений, версия 1.0.</p>

			<p>Это публичная страница.</p>
		</div>
		<p class="lead"> 
			{# имя пользователя #}	
			{% if currentusername is defined %}
				Привет, {{ currentusername }}!		
			{% endif %}
		</p>
	</div>
</header>

<div class="advance">
    <div class="span4">
	    <h3>О проекте</h3>
		<div class="advance_inside">
		</div>
	</div>

    <div class="span4">
		<h3>Краткая инструкция</h3>
    	<div class="advance_inside">
      </div>
    </div>

    <div class="span4" style="text-align: center;">
		<h3>Контакты</h3>
	    <div class="advance_inside">
		</div>
    </div>
</div>