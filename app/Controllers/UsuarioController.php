<?php
require_once __DIR__.'/../Models/UsuarioModel.php';
require_once __DIR__.'/../Views/UsuarioView.php';

class UsuarioController {
	public function insert() {
		if(isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['senha']) and isset($_POST['perfil'])) {
			$usuario = new UsuarioModel();
			$usuario->setNome($_POST['nome']);
			$usuario->setEmail($_POST['email']);
			$usuario->setSenha($_POST['senha']);
			$usuario->setPerfil($_POST['perfil']);
			$usuario->insert();

			$_SESSION['resposta'] = '<p style=color:green>Usuário cadastrado com sucesso</p>';
			header("Location: index.php");
		} else {
			$_SESSION['resposta'] = '<p style=color:red>Erro ao cadastrar usuário</p>';
			header("Location: index.php");
		}
	}

	public function update() {
		if(isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['id']) and isset($_POST['perfil'])) {
			$usuario = new UsuarioModel();
			$usuario->setNome($_POST['nome']);
			$usuario->setEmail($_POST['email']);
			$usuario->setId($_POST['id']);
			$usuario->setPerfil($_POST['perfil']);
			$usuario->update();

			$_SESSION['resposta'] = '<p style=color:green>Usuário alterado com sucesso</p>';
			header("Location: index.php");
		} else {
			$_SESSION['resposta'] = '<p style=color:red>Erro ao alterar usuário</p>';
			# header("Refresh:0");
		}
	}

	public function delete() {
		if(isset($_POST['id'])) {
			$usuario = new UsuarioModel();
			$usuario->setId($_POST['id']);
			$usuario->delete();

			$_SESSION['resposta'] = '<p style=color:purple>Usuário deletado com sucesso</p>';
			header("Location: index.php");
		}
	}

	public function reset() {
		if(isset($_POST['id']) and isset($_POST['senha'])) {
			$usuario = new UsuarioModel();
			$usuario->setId($_POST['id']);
			$usuario->reset();

			$_SESSION['resposta'] = '<p style=color:blue>Senha redefinida para 123456</p>';
			header("Location: index.php");
		}
	}

	public function change() {
		if(isset($_POST['id']) and isset($_POST['senha']) and isset($_POST['cp'])) {
			$usuario = new UsuarioModel();
			$usuario->setId($_POST['id']);
			$usuario->setSenha($_POST['senha']);
			$usuario->change();

			$_SESSION['resposta'] = '<p style=color:brown>Senha alterada com sucesso</p>';
			unset($_SESSION['isDefault']);
			header("Location: index.php");
		}
	}
}
?>