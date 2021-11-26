<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController

{

	private $lojaModel;

	public function __construct(){

		$this->lojaModel = new \App\Models\LojaModel();
		$this->Home = new \App\Controllers\Admin\Home();

	}


	public function novo()
	{
		$data = [
			'titulo' => 'Realize o login',

		];

		return view('Login/novo', $data);
		
	}

	public function criar(){


		if($this->request->getMethod() === 'post'){

			$email = $this->request->getPost('email');
			$password = $this->request->getPost('password');

			$autenticacao = service('autenticacao');

			if($autenticacao->login($email, $password)){

				$usuario = $autenticacao->pegaUsuarioLogado();
				
				//if(!$usuario->is_admin){

					//return redirect()->to(site_url('/'));

				//}

				//return redirect()->to(site_url('admin/home/'))
					//->with('sucesso', "Olá $usuario->nome, bem vindo ao sistema!");
					
					session()->set('usuario_id', $usuario->id);
					session()->set('super_admin', $usuario->super_admin);
					return $this->listarLojas($usuario->id);
			


			}else{

				return redirect()->back()->with('atencao', 'Não encontramos suas credenciais de acesso');
			}
				
		}else{

			return redirect()->back();

		}

	}

	public function logout(){
		service('autenticacao')->logout();

		return redirect()->to('login');

	}

	public function listarLojas($usuario_id){

		$data = [
			'titulo' => 'Listando as Lojas',
			'lojas' => $this->lojaModel->buscaLoja($usuario_id),

		];

		return view('Admin/Lojas/menu', $data);



	}

	public function selecionarLoja(){

			$loja_id = $this->request->getPost('loja_id');
			
			if(isset($loja_id)){

				session()->set('loja_id', $loja_id);

				return $this->Home->index();
				
			}else{

				return view('Admin/login');
			}
	}

}
