<?php 
	namespace App\Models;

	use MF\Model\Model;

	/**
	 * classe que sera reponsavel pela manipulação do usuario 
	 */
	class Usuario extends Model {
		private $id;
		private $nome;
		private $matricula;
		private $email;
		private $telefone;
		private $id_setor;
		private $senha;

		public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }


        public function getUsuarios(){
	        $res = array();

			$query = "SELECT tb_usuario.id_usuario, tb_usuario.nome, tb_usuario.matricula, tb_usuario.email, tb_usuario.telefone, tb_setor.nm_setor 
			FROM 
			tb_usuario INNER JOIN tb_setor ON (tb_usuario.id_setor = tb_setor.id_setor) ORDER BY nome"; 		    
		    $stmt = $this->db->prepare($query);
            $stmt->execute();	        

	        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    	}
        
        public function salvar(){
        	$query = "INSERT INTO tb_usuario (nome, matricula, email, telefone,id_setor, senha) VALUES (:n, :m, :e, :t,:ist,:s)";
            $stmt = $this->db->prepare($query);
	        $stmt->bindValue(":n",$this->__get('nome'));
	        $stmt->bindValue(":m",$this->__get('matricula'));
	        $stmt->bindValue(":e",$this->__get('email'));
	        $stmt->bindValue(":t",$this->__get('telefone'));
	        $stmt->bindValue(":ist",$this->__get('id_setor'));
	        $stmt->bindValue(":s",$this->__get('senha'));
	        $stmt->execute();
	        
	        return $this;

        } 
        public function validaUsuario(){
        	$valido = true;

           if(empty($this->__get('nome'))){
                $valido = false;
            }
            if(empty($this->__get('matricula'))){
                $valido = false;
            } 
            if(empty($this->__get('email'))){
                $valido = false;
            }
            if(empty($this->__get('telefone'))){
                $valido = false;
            }
            if(empty($this->__get('id_setor'))){
                $valido = false;
            }
            if(empty($this->__get('senha'))){
                $valido = false;
            }
            
            return $valido;
        }
        public function getMatriculaExistente() {
        	$query = "SELECT matricula FROM tb_usuario WHERE matricula = :m";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":m",$this->__get('matricula'));
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function autenticarLogin(){
        	$query = "SELECT id_usuario,nome,matricula,email,telefone FROM tb_usuario WHERE matricula= :m AND senha = :s";
	        $stmt = $this->db->prepare($query);
            $stmt->bindValue(":m",$this->__get('matricula'));
            $stmt->bindValue(":s",$this->__get('senha'));
            $stmt->execute();

            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            if($usuario['id_usuario'] != '' && $usuario['nome'] != ''){
            	$this->__set('id', $usuario['id_usuario']);
            	$this->__set('nome', $usuario['nome']);
            	$this->__set('email', $usuario['email']);
            	$this->__set('telefone', $usuario['telefone']);
                $this->__set('id_setor', $usuario['id_setor']);
            }else {
            	echo "erro no retorno!";
            }
            return $this;
        }
        public function excluirUsuario($id){
            $stmt = $this->db->prepare("DELETE FROM tb_usuario WHERE id_usuario = :id");
            $stmt -> bindValue(":id",$id);
            $stmt-> execute();
        }
		
	}

?>