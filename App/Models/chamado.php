<?php 
	namespace App\Models;

	use MF\Model\Model;

	/**
	 * classe que sera reponsavel pela manipulação do usuario 
	 */
	class Chamado extends Model {
		private $id_chamado;
		private $nr_chamado;
		private $prioridade;
		private $descricao;
		private $setor;
		private $servico;
		private $id_usuario;
		private $status;



		public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }
     
        public function salvarChamado(){
        	$query = "INSERT INTO tb_chamado (nr_chamado,prioridade, descricao, setor,servico,id_usuario,status ) VALUES (:c, :p, :d, :s,:sc,:iu,:st)";
            $stmt = $this->db->prepare($query);   
            $stmt->bindValue(":c",$this->__get('nr_chamado'));         
	        $stmt->bindValue(":p",$this->__get('prioridade'));
	        $stmt->bindValue(":d",$this->__get('descricao'));
	        $stmt->bindValue(":s",$this->__get('setor'));
	        $stmt->bindValue(":sc",$this->__get('servico'));
	        $stmt->bindValue(":iu",$this->__get('id_usuario'));
	        $stmt->bindValue(":st",$this->__get('status'));	        
	        $stmt->execute();
	        
	       	
	        return $this;

        }
        public function getChamados(){
	        $res = array();

			$query = "SELECT c.id_chamado, c.nr_chamado, c.prioridade, c.descricao, c.setor,u.nome, c.servico,c.status
			 FROM tb_chamado AS c INNER JOIN tb_usuario AS u ON c.id_usuario = u.id_usuario WHERE status != 'Concluido' "; 		    
		    $stmt = $this->db->prepare($query);
            $stmt->execute();	        

	        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    	}
    	 public function getMeusChamados(){

			$query = "SELECT *	FROM tb_chamado WHERE id_usuario = :u "; 		    
		    $stmt = $this->db->prepare($query);
		    $stmt->bindValue(":u",$this->__get('id_usuario'));
            $stmt->execute();	        

	        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    	}

    	public function excluirChamado($id){
    		$stmt = $this->db->prepare("DELETE FROM tb_chamado WHERE id_chamado = :id");
	        $stmt -> bindValue(":id",$id);
	        $stmt-> execute();
    	}
    	public function baixaChamado($id){
    		$stmt = $this->db->prepare("UPDATE tb_chamado SET status = 'Concluido' WHERE id_chamado = :s");
	        $stmt -> bindValue(":s",$id);
	        $stmt-> execute();
    	}

    }


?>