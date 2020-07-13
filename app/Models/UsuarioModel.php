<?php
require_once __DIR__.'/../../lib/Database/Conexao.php';

class UsuarioModel extends Conexao {
	protected $table = 'usuarios';
	private $id;
	private $nome;
	private $email;
	private $senha;
	private $perfil;

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}

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

	public function setPerfil($perfil) {
		$this->perfil = $perfil;
	}

	public function getPerfil() {
		return $this->perfil;
	}

	public function insert() {
		$sql  = "INSERT INTO $this->table (nome, email, senha, id_perfil) VALUES (:nome, :email, :senha, :id_perfil)";
		$stmt = Conexao::prepare($sql);
		$usuarioNome = $this->getNome();
		$usuarioEmail = $this->getEmail();
		$usuarioSenha = $this->getSenha();
		$idPerfil = $this->getPerfil();

		$stmt->bindParam(':nome', $usuarioNome);
		$stmt->bindParam(':email', $usuarioEmail);
		$stmt->bindParam(':senha', $usuarioSenha);
		$stmt->bindParam(':id_perfil', $idPerfil);

		return $stmt->execute(); 
	}

	public function update() {
		$sql  = "UPDATE $this->table SET nome = :nome, email = :email, id_perfil = :id_perfil WHERE id = :id";
		$stmt = Conexao::prepare($sql);

		$usuarioNome = $this->getNome();
		$usuarioEmail = $this->getEmail();
		$idPerfil = $this->getPerfil(); 
		$usuarioId = $this->getId();

		$stmt->bindParam(':nome',  $usuarioNome);
		$stmt->bindParam(':email',  $usuarioEmail);
		$stmt->bindParam(':id_perfil', $idPerfil);
		$stmt->bindParam(':id', $usuarioId );

		return $stmt->execute();	
	}

	public function delete() {
		$sql = "DELETE FROM $this->table WHERE id = :id";
		$stmt = Conexao::prepare($sql);

		$id = $this->getId();

		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute(); 
	}

	public function reset() {
		$sql = "UPDATE $this->table SET senha = :senha WHERE id = :id";
		$stmt = Conexao::prepare($sql);

		$usuarioSenha = md5("123456");
		$usuarioId = $this->getId();

		$stmt->bindParam(':senha', $usuarioSenha);
		$stmt->bindParam(':id', $usuarioId);

		return $stmt->execute();
	}

	public function change() {
		$sql = "UPDATE $this->table SET senha = :senha WHERE id = :id";
		$stmt = Conexao::prepare($sql);

		$usuarioSenha = $this->getSenha();
		$usuarioId = $this->getId();

		$stmt->bindParam(':senha', $usuarioSenha);
		$stmt->bindParam(':id', $usuarioId);

		return $stmt->execute();
	}

	public function selecionarTodos() {
		$sql = "SELECT * FROM $this->table";
		$stmt = Conexao::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function carregarUsuarios(){
        // Buscando todos os dados da tabela perfis
		$arr = $this->selecionarTodos();

        // Montando o array de objetos perfis
		foreach($arr as $chave => $valor){
			$objeto = new UsuarioModel();
			$objeto->setId($valor->id);
			$objeto->setNome($valor->nome);
			$objeto->setEmail($valor->email);
			$objeto->setPerfil($valor->id_perfil);
			$arrayUsuarios[] = $objeto;
		}

		return $arrayUsuarios;
	}
}
?>