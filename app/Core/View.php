<?php
require_once __DIR__.'/../Views/LoginView.php';
require_once __DIR__.'/../Views/UsuarioView.php';

class View {
	public function start($url) {
		if($url == 'login') {
			$view = new LoginView();
			$view->login();
		} else if($url == 'painel') {
			$view = new UsuarioView();
			$view->painel();
		}
	}
}
?>