<?php
require_once __DIR__.'/../Controllers/LoginController.php';
require_once __DIR__.'/../Controllers/UsuarioController.php';

class Controller {
	public function start($url) {
		if($url == 'login') {
			$controller = new LoginController();
			$controller->login();
		} else if ($url == 'insert') {
			$controller = new UsuarioController();
			$controller->insert();
		} else if ($url == 'update') {
			$controller = new UsuarioController();
			$controller->update();
		} else if ($url == 'delete') {
			$controller = new UsuarioController();
			$controller->delete();
		} else if ($url == 'reset') {
			$controller = new UsuarioController();
			$controller->reset();
		} else if ($url == 'change') {
			$controller = new UsuarioController();
			$controller->change();
		} else {

		}
	}
}
?>