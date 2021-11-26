<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\FormaPagamento;

class FormasPagamento extends BaseController
{
	private $formaPagamentoModel;
	private $formaPagamentoLojaModel;


	public function __construct(){

		$this->formaPagamentoModel = new \App\Models\FormaPagamentoModel();
		$this->formaPagamentoLojaModel = new \App\Models\FormaPagamentoLojaModel();
	}
	
	
	
	public function index(){
		$data = [
			'titulo' => 'Listando as formas de pagamento',
			'formas' => $this->formaPagamentoModel->withDeleted(true)->paginate(10),
			'pager' => $this->formaPagamentoModel->pager,
		];

		return view ('Admin/FormasPagamento/index', $data);
	}

	public function procurar(){

		if(!$this->request->isAJAX()){

			exit('Página não encontrada');
		}


		$formas = $this->formaPagamentoModel->procurar($this->request->getGet('term'));

		$retorno = [];

		foreach ($formas as $forma) {
			
			$data['id'] = $forma->id;
			$data['value'] = $forma->nome;

			$retorno[] = $data;
		}

		return $this->response->setJSON($retorno);

	}

	public function criar() {

		$formaPagamento = new FormaPagamento();

		$data = [
			'titulo' => "Criando nova forma de pagamento $formaPagamento->nome",
			'forma' => $formaPagamento,
		];

		return view('Admin/FormasPagamento/criar', $data);


	}

	public function cadastrar(){

		if($this->request->getMethod() === 'post'){

			$formaPagamento = new FormaPagamento($this->request->getPost());

			if($this->formaPagamentoModel->save($formaPagamento)){

				return redirect()->to(site_url("admin/formas/show/".$this->formaPagamentoModel->getInsertID()))
								->with('sucesso', "Forma de pagamento $formaPagamento->nome cadastrada com sucesso");
			}else{

				return redirect()->back()
								->with('errors_model', $this->formaPagamentoModel->errors())
								->with('atencao', 'Por favor verifique os erros abaixo')
								->withInput();

			}
	
		}else{
			
			return redirect()->back();
		}


	}

	public function show($id = null) {

		$formaPagamento = $this->buscaFormaPagamentoOu404($id);

		$data = [
			'titulo' => "Detalhando forma de pagamento $formaPagamento->nome",
			'forma' => $formaPagamento,
		];

		return view('Admin/FormasPagamento/show', $data);


	}

	public function editar($id = null) {

		$formaPagamento = $this->buscaFormaPagamentoOu404($id);

		$data = [
			'titulo' => "Editando forma de pagamento $formaPagamento->nome",
			'forma' => $formaPagamento,
		];

		return view('Admin/FormasPagamento/editar', $data);


	}

	public function atualizar($id = null){

		if($this->request->getMethod() === 'post'){

			$formaPagamento = $this->buscaFormaPagamentoOu404($id);

			$formaPagamento->fill($this->request->getPost());

			if(!$formaPagamento->hasChanged()){


				return redirect()->back()->with('info', 'Não há dados para atualizar');
			}

			if($this->formaPagamentoModel->save($formaPagamento)){

				return redirect()->to(site_url("admin/formas/show/$formaPagamento->id"))
								->with('sucesso', 'Forma de pagamento atualizada com sucesso');
			}else{

				return redirect()->back()
								->with('errors_model', $this->formaPagamentoModel->errors())
								->with('atencao', 'Por favor verifique os erros abaixo')
								->withInput();

			}
	
		}else{
			
			return redirect()->back();
		}


	}

	private function buscaFormaPagamentoOu404(int $id = null){

		if(!$id || !$formaPagamento = $this->formaPagamentoModel->withDeleted(true)->where('id', $id)->first()){

			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a forma de pagamento $id");


		}

		return $formaPagamento;

	}

	public function excluir($id = null){

		$formaPagamento = $this->buscaFormaPagamentoOu404($id);

		if($formaPagamento->deletado_em != null){

			return redirect()->back()
				->with('info', "A forma de pagamento $formaPagamento->nome já encontra-se excluida.");



		}

		if($this->request->getMethod() === 'post'){
			
			$this->formaPagamentoModel->delete($id);
			return redirect()->to(site_url('admin/formas'))
				->with('sucesso', "Forma de pagamento $formaPagamento->nome excluida com sucesso");

		}

		$data = [
			'titulo' => "Excluindo a forma de pagamento: $formaPagamento->nome",
				'forma' => $formaPagamento,


		];


		return view('Admin/FormasPagamento/excluir', $data);


	}

	public function desfazerExclusao($id = null){

		$formaPagamento = $this->buscaFormaPagamentoOu404($id);

		if($formaPagamento->deletado_em == null){

			return redirect()->back()
				->with('info', 'Apenas forma de pagamentos excluidas podem ser recuperadas');

		}

		if($this->formaPagamentoModel->desfazerExclusao($id)){
			return redirect()->back()
				->with('success', 'Exclusão desfeita com sucesso');
		}else{
			return redirect()->back()
					->with('errors_model', $this->formaPagamentoModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();

		}

	}



	public function vincularforma($id = null) {

		if($this->request->getMethod() === 'post' ){

			$formaPagamento = $this->buscaFormaPagamentoOu404($id);
						
			$forma = $this->request->getPost();
		
			$forma['id_loja'] = $_SESSION["loja_id"];
			$forma['id_forma_pagamento'] = $formaPagamento->id;

			
			if($this->formaPagamentoLojaModel->save($forma)){

				//->protect(false)
				
				redirect()->back()->to(site_url("admin/formas/formaspagamento/$formaPagamento->id"))->with('sucesso', 'Forma cadastrada com sucesso');

			}else{
				
				return redirect()->back()
					->with('errors_model', $this->formaPagamentoLojaModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();

			}

		}else{


			return redirect()->back();
		}



	}

	
	public function formasPagamento($id = null){

		$formaPagamento = $this->buscaFormaPagamentoOu404($id);

		$data = [
			'titulo' => "Gerenciar as formas de pagamento do produto $formaPagamento->nome",
			'forma' => $formaPagamento,
			'formaPagamentos' => $this->formaPagamentoLojaModel->buscaFormaPagamento($formaPagamento->id, 10),
			'pager'=> $this->formaPagamentoLojaModel->pager,
		];

		return view('Admin/FormasPagamento/formas', $data);
	}

}
