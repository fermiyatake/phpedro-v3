<?php
require_once __DIR__ . '/../../lib/Database/Conexao.php';

class PerfilModel extends Conexao {
	protected $table = 'perfis';
	private $id;
	private $nome;

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

	public function selecionarTodos() {
		$sql = "SELECT * FROM $this->table";
		$stmt = Conexao::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function buscarPerfil($id) {
        $sql  = "SELECT * from $this->table where id =:id";
        $stmt = Conexao::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute(); 

        $perfis = $stmt->fetchAll(); 
        foreach($perfis as $key=>$value) {
            if ($value->id > 0){
                return $value->nome;   
            } else {
                return 0;
            }   
        }
    }

    public function carregarPerfis(){
        // Buscando todos os dados da tabela perfis
        $arr = $this->selecionarTodos();

        // Montando o array de objetos perfis
        foreach($arr as $chave => $valor){
            $objeto = new PerfilModel();
            $objeto->setId($valor->id);
            $objeto->setNome($valor->nome);
            $arrayPerfis[] = $objeto;
        }
        
        return $arrayPerfis;
    }
}
?>