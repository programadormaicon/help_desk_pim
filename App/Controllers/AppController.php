<?php	
namespace App\Controllers;


//os recursos do sistema
// Action classe responsavel por renderizar layout
use MF\Controller\Action;
// Container class static que ira criar uma instancia da classe desejada
// vinda do Models
use MF\Model\Container;

	// classe responsavel pelo controler
	class AppController extends Action {
		// classe que irá renderizar a tela home principal



		public function index() {
			session_start();
			if (!empty($_SESSION['id']) && !empty($_SESSION['nome'])) {

				$chamado = Container::getModel('Chamado');
				$chamado->getChamados();
				$listaChamado = $chamado->getChamados();

				$this->view->chamados = $listaChamado;
				
				$this->render('index','layout');			
			}else {
				header("location: /?login=erro");
			}	
		}

		// classe que irá renderizar a tela caixa pessoal
		public function caixa_pessoal() {
			session_start();
			if (!empty($_SESSION['id']) && !empty($_SESSION['nome'])) {
				
				$chamado = Container::getModel('Chamado');
				$chamado->getMeusChamados();
				$listaChamado = $chamado->getChamados();

				$this->view->chamados = $listaChamado;
				

				$this->render('caixa_pessoal','layout');
			}else {
				header("location: /?login=erro");
			}

		}

		// classe que irá renderizar a tela que apresenta os usuarios
		public function usuario() {
			session_start();

			if (!empty($_SESSION['id']) && !empty($_SESSION['nome'])) {
				
				$usuario = Container::getModel('Usuario');
				$usuario->getUsuarios();

				$lista = $usuario->getUsuarios();

				$this->view->lista = $lista;



				$this->render('nav/usuario','layout2');

			}else {
				header("location: /?login=erro");
			}

		}

		public function criar_usuario() {
			session_start();
			if (!empty($_SESSION['id']) && !empty($_SESSION['nome'])) {
				$this->view->erroAutenticacao = false;
				$this->render('nav/criar_usuario','layout2');			
			}else {
				header("location: /?login=erro");
			}
			
		}
		public function criar_chamado() {
			session_start();
			if (!empty($_SESSION['id']) && !empty($_SESSION['nome'])) {
				$this->view->erroAutenticacao = false;
				$this->render('nav/criar_chamado','layout2');			
			}else {
				header("location: /?login=erro");
			}
			
		}

		public function cadastrar(){
			session_start();
			if (!empty($_SESSION['id']) && !empty($_SESSION['nome'])) {
				$usuario = Container::getModel('Usuario');
				$usuario->__set('nome',$_POST['nome']);
				$usuario->__set('matricula',$_POST['matricula']);
				$usuario->__set('email',$_POST['email']);
				$usuario->__set('telefone',$_POST['telefone']);
				$usuario->__set('id_setor',$_POST['id_setor']);
				$usuario->__set('senha',$_POST['senha']);

				if($usuario->validaUsuario() && count($usuario->getMatriculaExistente()) == 0) {
					$usuario->salvar();
					header("location: /nav/usuario");
				}else {
					$this->view->erroAutenticacao = true;
					$this->render('nav/criar_usuario','layout2');
				}
					
			}else {
				header("location: /");
			}
			
		}
		public function cadastrarChamado(){
			session_start();
			if (!empty($_SESSION['id']) && !empty($_SESSION['nome'])) {
				
				$chamado = Container::getModel('Chamado');
				$nr_chamadoRand = rand(1000, 9999);

				$chamado->__set('nr_chamado',$nr_chamadoRand);				
				$chamado->__set('prioridade',$_POST['prioridade']);
				$chamado->__set('descricao',$_POST['descricao']);
				$chamado->__set('setor',$_POST['setor']);
				$chamado->__set('servico',$_POST['servico']);
				$chamado->__set('id_usuario',$_SESSION['id']);
				$chamado->__set('status',$_POST['status']);				
				
				$chamado->salvarChamado();
				header("location: /home");
			}else {
				header("location: /");
				

			}
			
		}
		public function excluirUsuario (){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$chamado = Container::getModel('Usuario');
				$chamado->excluirUsuario($id);
				header("location: /nav/usuario");
			}
		}
		public function excluir (){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$chamado = Container::getModel('Chamado');
				$chamado->excluirChamado($id);
				header("location: /home");
			}
		}
		public function baixa (){

			if(isset($_GET['id'])){
				$id = $_GET['id'];

				$atualizaChamado = Container::getModel('Chamado');

				$atualizaChamado->baixaChamado($id);
				header("location: /home");
			}
		}
		public function encaminha(){

			$this->render('nav/encaminha','layout2');

		}
	}

?>