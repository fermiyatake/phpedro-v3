<?php
session_start();

include_once '/app/Core/Controller.php';
include_once '/app/Core/View.php';
include_once '/app/Core/Model.php';

# Verifica se há a ação pelo GET
if(isset($_GET['acao'])) {
	# Verifica se a ação é login
	if($_GET['acao'] == 'login') {
		if(isset($_POST['email']) and isset($_POST['senha'])) {
			$controller = new Controller();
			$controller->start('login');
		} else {
			$view = new View();
			$view->start('login');
		}
	} 

	# Verifica se a ação é painel e se o usuário está logado
	else if($_GET['acao'] == 'painel' and isset($_SESSION['loginUsuario'])) {
		$view = new View();
		$view->start('painel');

		# Verifica se há a função pelo GET
		if(isset($_GET['funcao'])) {
			# Verifica se a função equivale a insert
			if($_GET['funcao'] == 'insert') {
				$controller = new Controller();
				$controller->start('insert');
			} 

			# Verifica se a função equivale a update
			else if($_GET['funcao'] == 'update') {
				$controller = new Controller();
				$controller->start('update');
			}

			# Verifica se a função equivale a delete
			else if($_GET['funcao'] == 'delete') {
				$controller = new Controller();
				$controller->start('delete');
			} 

			# Verifica se a função equivale a reset
			else if($_GET['funcao'] == 'reset') {
				$controller = new Controller();
				$controller->start('reset');
			}
		} else {

		}
	}

	else if($_GET['acao'] == 'change') {
		$controller = new Controller();
		$controller->start('change');
	}

	else if($_GET['acao'] == 'relatorio' and isset($_SESSION['loginUsuario'])) {
		Header("Location: lib/FPDF/Relatorio.php");
	}

	else {
		session_unset();

		header('Location: index.php');
		exit;
	}
}

# Caso o GET esteja vazio e o usuário não está logado, mostra o formulário de login
else {
	$view = new View();
	$view->start('login');
}
?>