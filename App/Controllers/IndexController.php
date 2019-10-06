<?php

namespace App\Controllers;


//os recursos do sistema
// Action classe responsavel por renderizar layout
use MF\Controller\Action;
// Container class static que ira criar uma instancia da classe desejada
// vinda do Models
use MF\Model\Container;

// classe responsavel pelo controler
class IndexController extends Action {

	// classe que irá renderizar a tela login
	public function login() {
		session_start();
		if(!empty($_SESSION['id'])){
			header("location: /home");
		}else {
			$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
			$this->render('login','layout1');
		}
	}
	
}


?>