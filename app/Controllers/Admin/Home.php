<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{

	private $pedidoModel;
	private $usuarioModel;
	private $produtoModel;

	public function __construct(){

		$this->pedidoModel = new \App\Models\PedidoModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->produtoModel = new \App\Models\ProdutoModel();
	}

	public function index()
	{
		$data = [
			'titulo' => 'Home da área restrita',
			'valorPedidosEntregues' => $this->pedidoModel->valorPedidosEntregues(),
			'valorPedidosEmRota' => $this->pedidoModel->valorPedidosEmRota(),
			'valorPedidosCancelados' => $this->pedidoModel->valorPedidosCancelados(),
			'valorPedidosRealizados' => $this->pedidoModel->valorPedidosRealizados(),
			'totalClientesAtivos' => $this->usuarioModel->recuperaTotalClientesAtivos(),
			'totalProdutosAtivos' => $this->produtoModel->recuperaProdutosAtivos(),
			
		];

		$novosPedidos = $this->pedidoModel->where('status', 0)
										  ->where('id_loja', $_SESSION["loja_id"])
										  ->orderBy('criado_em', 'DESC')
										  ->findAll();
		
		if(!empty($novosPedidos)){

			$data['novosPedidos'] = $novosPedidos;
		}

		return view('Admin/Home/index', $data);
	}




}
