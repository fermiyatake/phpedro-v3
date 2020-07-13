<?php

require_once __DIR__ . '/../../lib/Database/Conexao.php';

class LoginModel extends Conexao {
	protected $table = 'usuarios';
	private $email;
	private $senha;

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setSenha($senha) {
		$this->senha = md5($senha);
	}

	public function getSenha() {
		return $this->senha;
	}

	public function validarLogin() {
		$sql = "SELECT * FROM $this->table WHERE email = :email
		and senha = :senha";
		$stmt = Conexao::prepare($sql);

		$email = $this->getEmail();
		$senha = $this->getSenha();
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':senha', $senha);

		$stmt->execute();

		$vetorUsuario = $stmt->fetchAll();

		if(count($vetorUsuario) > 0)
			return $vetorUsuario[0]->id;
		return 0;
	}
}