<div class="public_page">
<div class="navbar">
    <div class="navbar-inner">
      <div class="container" style="width: auto;">
		    <?= $this->tag->linkTo([null, 'class' => 'logo', '<img src="http://phalcon-micro.ztua.org/img/favicon.ico" width="50" height="40" />']) ?>
        <div class="nav-collapse">
          <div class="moduletable_menu">
            <ul class="nav pull-right">
  		  
              <?php if (isset($logged_in) && !(empty($logged_in))) { ?>
  		
      				  <li><?= $this->tag->linkTo(['about', 'Инструкции']) ?></li>

      				  <li><?= $this->tag->linkTo(['session/logout', '<i class="fas fa-sign-out-alt fa-lg" title="Выход"></i>']) ?></li>
      			
              <?php } else { ?>

      				  <li><?= $this->tag->linkTo(['session/login', '<i class="fas fa-sign-in-alt fa-lg" title="Вход"></i>']) ?></li>

              <?php } ?>
  			
            </ul>
          </div>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </div>

<div class="container main-container">
  <?= $this->getContent() ?>
</div>
</div>

<footer>
Сделано с любовью 
© <?= date('Y') ?> Sergio
</footer>

