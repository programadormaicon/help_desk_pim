<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {


		$routes['login'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'login'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['home'] = array(
			'route' => '/home',
			'controller' => 'AppController',
			'action' => 'index'
		);

		$routes['caixa_pessoal'] = array(
			'route' => '/caixa_pessoal',
			'controller' => 'AppController',
			'action' => 'caixa_pessoal'
		);
		
		$routes['usuario'] = array(
			'route' => '/nav/usuario',
			'controller' => 'AppController',
			'action' => 'usuario'
		);

		$routes['criar_usuario'] = array(
			'route' => '/nav/criar_usuario',
			'controller' => 'AppController',
			'action' => 'criar_usuario'
		);
		$routes['cadastrar'] = array(
			'route' => '/nav/cadastrar',
			'controller' => 'AppController',
			'action' => 'cadastrar'
		);
		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);
		$routes['criar_chamado'] = array(
			'route' => '/nav/criar_chamado',
			'controller' => 'AppController',
			'action' => 'criar_chamado'
		);
		$routes['cadastrarChamado'] = array(
			'route' => '/nav/cadastrarChamado',
			'controller' => 'AppController',
			'action' => 'cadastrarChamado'
		);
		$routes['excluir'] = array(
			'route' => '/excluir',
			'controller' => 'AppController',
			'action' => 'excluir'
		);
		$routes['baixa'] = array(
			'route' => '/baixa',
			'controller' => 'AppController',
			'action' => 'baixa'
		);
		$routes['excluirUsuario'] = array(
			'route' => '/excluirUsuario',
			'controller' => 'AppController',
			'action' => 'excluirUsuario'
		);
		$routes['encaminha'] = array(
			'route' => '/nav/encaminha',
			'controller' => 'AppController',
			'action' => 'encaminha'
		);
		$this->setRoutes($routes);
	}

}

?>