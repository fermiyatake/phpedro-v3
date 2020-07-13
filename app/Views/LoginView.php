<?php
class LoginView {
	public function login() {
		if(!isset($_SESSION['validacao'])) {
			$this->formulario();
		} else {
			if($_SESSION['validacao'] == 0) {
				$this->formulario();
				echo "<p align='center' style='color:red'>Informações de login incorretas</p>";
			} else if($_SESSION['validacao'] != 0 and $_SESSION['isDefault']) {
				$this->novaSenha();
			} else if($_SESSION['validacao'] != 0) {
				$_SESSION['loginUsuario'] = 'sucesso';
				Header("Location: index.php?acao=painel");
 			}
		}
	}

	public function formulario() {
		echo
		"<div align='center' style='margin-top:10em'>
		<h3>Login</h3>
		<form action='index.php?acao=login' method='POST'>
		<p>Usuario</p>
		<input type='text' name='email' required></br>
		<p>Senha</p>
		<input type='password' name='senha' required></br></br>
		<input type='submit' value='Logar'>
		</form>
		</div>";

		if(isset($_SESSION['resposta'])) {
			echo $_SESSION['resposta'];
			unset($_SESSION['resposta']);
		}
	}

	public function novaSenha() {
 		echo "<div align='center' style='margin-top:10em'>";
 		echo "<p align=center style='color:red;'>
 		Você está utilizando a senha padrão '123456'<br>
 		Por motivos de segurança, altere sua senha!</p>";
 		echo "<div align=center>";
 		echo "<form method='POST' action='index.php?acao=change'>";
 		echo "<br>";
 		echo "<input type='hidden' name='id' value='".$_SESSION['validacao']."'>";
 		echo "<input type='hidden' name='cp' value='ok'>";
 		echo "<h3>Nova senha: <input type='password' name='senha' required></h3>";
 		echo "<input type='submit' value='Alterar'>";
 		echo "</form></div>";
	}
}
?>