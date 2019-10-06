<?php 
	
namespace App\Controllers;


//os recursos do sistema
// Action classe responsavel por renderizar layout
use MF\Controller\Action;
// Container class static que ira criar uma instancia da classe desejada
// vinda do Models
use MF\Model\Container;

	// classe responsavel pelo controler
	class AuthController extends Action {

		public function autenticar(){

			$usuario = Container::getModel('Usuario');
			$usuario->__set('matricula',$_POST['matricula']);
			$usuario->__set('senha',$_POST['senha']);

			$usuario->autenticarLogin();
			
			if($usuario->__get('id') != '' && $usuario->__get('nome')){
				session_start();
				$_SESSION['id'] = $usuario->__get('id');
				$_SESSION['nome'] = $usuario->__get('nome');
				$_SESSION['id_setor'] = $usuario->__get('id_setor');
				header("location: /home");
			}else {
				header("location: /?login=erro");
			}
		}
		public function sair(){
			session_start();
			session_destroy();
			header("location: /");
		}

	}


?>