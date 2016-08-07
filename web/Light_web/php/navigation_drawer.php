 <div class="mdl-layout__drawer" style="padding:0">
    <span style=""class="profile-background-drawer mdl-layout-title">
	<div style="margin: auto; position: absolute;left: 20px;top: 40px;">
		<button style="background-image:url(<?php $url="accounts/" .$_SESSION['username'] . "/images/profile_pic.jpg"; if(!is_file($url)){$url="/images/no_profile_pic.png";} echo $url; ?>) !important ;" class="profile-button mdl-button mdl-js-button mdl-button--fab mdl-button--colored "></button>
		<p class="profile-button-text"><?php echo $_SESSION['name'];?></p>
		</div>
		
	</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href=""><i class="navigation_icon material-icons">home</i>Consumo</a>
      <a class="mdl-navigation__link" href=""><i class="navigation_icon material-icons">search</i>Novedades</a>
      <a class="mdl-navigation__link" href=""><i class="navigation_icon material-icons">people</i>Social</a>
      <a class="mdl-navigation__link" href=""><i class="navigation_icon material-icons">style</i>Market</a>
	  
	  <?php if($_SESSION['clearance']>9){include $_SERVER['DOCUMENT_ROOT'] . '/php/navigation_drawer_admin.php';} ?>
	  
	  <div class="divider_line"></div>
	  <a class="mdl-navigation__link" href="/profile/settings.php"><i class="navigation_icon material-icons">settings</i>Ajustes</a>
	  <a class="mdl-navigation__link" href=""><i class="navigation_icon material-icons">feedback</i>Enviar opinión</a>
    </nav>
  </div>