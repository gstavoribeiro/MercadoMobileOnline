<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Pedido;


class Pedidos extends BaseController
{

	private $pedidoModel;
	private $usuarioModel;
	private $itemPedidoModel;

	public function __construct(){

		$this->pedidoModel = new \App\Models\PedidoModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->itemPedidoModel = new \App\Models\ItemPedidoModel();
		
	}



	public function index()
	{
		$data = [
			'titulo' => 'Listando os pedidos',
			'pedidos' => $this->pedidoModel->listaTodosPedidos(),
			'pager' => $this->pedidoModel->pager
			

		];

		return view('Admin/Pedidos/index', $data);

	}


	public function procurar(){

		if(!$this->request->isAJAX()){

			exit('Página não encontrada');
		}


		$pedidos = $this->pedidoModel->procurar($this->request->getGet('term'));

		$retorno = [];

		foreach ($pedidos as $pedido) {
			
			$data['id'] = $pedido->id;
			$data['value'] = $pedido->id;

			$retorno[] = $data;
		}

		return $this->response->setJSON($retorno);

	}

	public function show($id = null){

		$pedido = $this->pedidoModel->buscaPedidoOu404($id);

		$produto = $this->itemPedidoModel->listaProdutosPedido($pedido->id);

		$data = [
			'titulo' => "Detalhando o pedido: $pedido->id",
			'pedidos' => $pedido,
			'produtos' => $produto,
			

		];

		return view('Admin/Pedidos/show', $data);


	}

	public function editar($id = null){

		$pedido = $this->pedidoModel->buscaPedidoOu404($id);

		if ($pedido->status == 2){
			
			return redirect()->back()->with('info', 'Esse pedido já foi entregue, sendo assim não é possível editá-lo');
		}

		if ($pedido->status == 3){
			
			return redirect()->back()->with('info', 'Esse pedido já foi cancelado, sendo assim não é possível editá-lo');
		}



		$data = [
			'titulo' => "Editando o pedido $pedido->id",
			'pedidos' => $pedido,

		];

		return view('Admin/Pedidos/editar', $data);


	}

	public function atualizar($id = null){

		if($this->request->getMethod() === 'post'){

			$pedido = $this->pedidoModel->buscaPedidoOu404($id);

			if ($pedido->deletado_em != null){
				return redirect()->back()->with('info', "O pedido $pedido->id encontra-se excluída. Portanto, não é possível edita-la");
			}


			$pedido->fill($this->request->getPost());

			if(!$pedido->hasChanged()){

				return redirect()->back()
					->with('info', 'Não há dados para serem atualizados');


			}

			if($this->pedidoModel->protect(false)->save($pedido)){
				
				return redirect()->to(site_url("admin/pedidos/show/$pedido->id")) 
					->with('sucesso', "O pedido $pedido->id foi atualizado com sucesso");
			}else{
				
				return redirect()->back()
					->with('errors_model', $this->pedidoModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();


			}
	

		}else{

			// Não é post
			return redirect()->back();
		}


	}

	private function buscaPedidoOu404(int $id = null){

		if(!$id || !$pedido = $this->pedidoModel->select('pedido.*, usuarios.nome AS cliente')
													->join('usuarios', 'usuarios.id = pedido.id_usuario')
													->where('produto.id', $id)
													->withDeleted(true)
													->first()){

			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o pedido $id");


		}

		return $pedido;

	}

	
	
	
}
