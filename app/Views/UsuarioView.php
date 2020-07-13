<?php
ob_start();
include_once __DIR__ . '/../Models/UsuarioModel.php';
include_once __DIR__ . '/../Models/PerfilModel.php';

echo "
<html>
<head>
<title>Painel do Usuário</title>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
</head>
<body>";

$perfil = new PerfilModel();
$perfis = $perfil->carregarPerfis();

class UsuarioView {
	public function painel() {
		global $perfil;
		global $perfis;

		echo "<div class='container'>";
		echo "<h1>Cadastro de Usuários</h1>";

		if(!isset($_POST['alt'])) {
			echo "<form method='POST' action='index.php?acao=painel&funcao=insert'>";
			echo "<p>Nome: <input type='text' name='nome'></p>";
			echo "<p>Email: <input type='text' name='email'></p>";
			echo "<p>Senha: <input type='password' name='senha'></p>";

			echo "<p>Perfil: <select name='perfil'></p>";
			foreach($perfis as $key=>$value) {
				echo "<option value='".$value->getId()."'>".utf8_encode($value->getNome())."</option>";
			}
			echo "</select>";
			echo "<br><br>";

			echo "<input type='submit' value='Cadastrar'>";
			echo "</form>";		

			if(isset($_SESSION['resposta'])) {
				echo $_SESSION['resposta'];
				unset($_SESSION['resposta']);
			}

		} else {
			echo "<form method='POST' action='index.php?acao=painel&funcao=update'>";
			echo "<p>Nome: <input type='text' name='nome' value='".$_POST['nome']."'></p>";
			echo "<p>Email: <input type='text' name='email' value='".$_POST['email']."'></p>";
			echo "<p>Perfil: <select name='perfil'></p>";
			echo "<option value='".$_POST['perfil']."'>".utf8_encode($perfil->buscarPerfil($_POST['perfil']))."</option>";
			foreach($perfis as $key=>$value2) {
				echo "<option value='".$value2->getId()."'>".utf8_encode($value2->getNome())."</option>";
			}
			echo "</select>";
			echo "<br><br>";

			echo "<input type='hidden' name='id' value='".$_POST['id']."'>";

			echo "<input type='submit' value='Alterar'>";
			echo "</form>";

			if(isset($_SESSION['resposta'])) {
				echo $_SESSION['resposta'];
				unset($_SESSION['resposta']);
			}
		}
		echo "</div>";

		echo "<form method='POST' action='index.php?acao=logout'>";
		echo "<input type='submit' value='Logout'>";
		echo "</form>";

		echo "<form method='POST' action='index.php?acao=relatorio' target='_blank'>";
		echo "<input type='submit' value='Gerar relatório em PDF'>";
		echo "</form>";

		$this->lista();
	}

	public function lista() {
		echo "<div>";
		echo "<table border=1>";
		echo "<tr>";
		echo "<th width='25%'>Nome</th>";
		echo "<th width='25%'>Email</th>";
		echo "<th width='20%'>Perfil</th>";
		echo "<th width='30%'>Menu</th>";
		echo "</tr>";

		$usuarios = new UsuarioModel();
		global $perfil;

		foreach($usuarios->carregarUsuarios() as $key=>$value) {
			echo "<tr>";
			echo "<td>".$value->getNome()."</td>";
			echo "<td>".$value->getEmail()."</td>";
			echo "<td>".utf8_encode($perfil->buscarPerfil($value->getPerfil()))."</td>";

			echo "<td>";
			echo "<div class='container'>";
			echo "<div class='row'>";
			echo "<div class='col-sm' style='padding-top:7px'>";
			echo "<form method='POST' action=''>";
			echo "<input type='hidden' name='nome' value='".$value->getNome()."'>";
			echo "<input type='hidden' name='email' value='".$value->getEmail()."'>";
			echo "<input type='hidden' name='perfil' value='".$value->getPerfil()."'>";
			echo "<input type='hidden' name='id' value='".$value->getId()."'>";
			echo "<input type='hidden' name='alt' value=1>";
			echo "<input type='submit' value='Alterar'>";
			echo "</form>";
			echo "</div>";

			echo "<div class='col-sm' style='padding-top:7px'>";
			echo "<form method='POST' action='index.php?acao=painel&funcao=delete'>";
			echo "<input type='hidden' name='id' value='".$value->getId()."'>";
			echo "<input type='submit' value='Excluir'>";
			echo "</form>";
			echo "</div>";

			echo "<div class='col-sm' style='padding-top:7px'>";
			echo "<form method='POST' action='index.php?acao=painel&funcao=reset'>";
			echo "<input type='hidden' name='senha' value='".$value->getSenha()."'>";
			echo "<input type='hidden' name='id' value='".$value->getId()."'>";
			echo "<input type='submit' value='Redefinir senha'>";
			echo "</form>";
			echo "</div>";

			echo "</div>";
			echo "</td>";

			echo "</tr>";
			echo "</div>";
		}
		
	}
}

echo "
</body>
</html>";
?>

