<div class="public_page">
<div class="navbar">
    <div class="navbar-inner">
      <div class="container" style="width: auto;">
		    {{ link_to(null, 'class': 'logo', '<img src="http://phalcon-micro.ztua.org/img/favicon.ico" width="50" height="40" />')}}
        <div class="nav-collapse">
          <div class="moduletable_menu">
            <ul class="nav pull-right">
  		  
              {% if logged_in is defined and not(logged_in is empty) %}
  		
      				  <li>{{ link_to('about', 'Инструкции') }}</li>

      				  <li>{{ link_to('session/logout', '<i class="fas fa-sign-out-alt fa-lg" title="Выход"></i>') }}</li>
      			
              {% else %}

      				  <li>{{ link_to('session/login', '<i class="fas fa-sign-in-alt fa-lg" title="Вход"></i>') }}</li>

              {% endif %}
  			
            </ul>
          </div>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </div>

<div class="container main-container">
  {{ content() }}
</div>
</div>

<footer>
Сделано с любовью 
© {{ date("Y") }} Sergio
</footer>

