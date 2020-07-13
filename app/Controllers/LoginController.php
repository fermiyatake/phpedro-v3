<?php
include __DIR__ . '/../Models/LoginModel.php';
include __DIR__ . '/../Views/LoginView.php';

class LoginController {
	public function login() {
		$login = new LoginModel();
		$login->setEmail($_POST['email']);
		$login->setSenha($_POST['senha']);

		$validacao = $login->validarLogin();

		if($_POST['senha'] == 123456) {
			$_SESSION['isDefault'] = 'yes';
		} 
		
		$_SESSION['validacao'] = $validacao;

		$view = new LoginView();
		$view->login();
	}
}
?>