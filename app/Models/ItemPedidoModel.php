<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemPedidoModel extends Model
{
	protected $table                = 'item_pedido';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $allowedFields        = [
		'id_pedido',
		'id_produto',
		'quantidade',
		'preco',
		
	];


	public function listaProdutosPedido($id){
		
		$produto = $this->select(['item_pedido.*', 
								'pedido.id AS pedido', 
								'produto.nome AS produto',])
						->join('produto', 'produto.id = item_pedido.id_produto')
						->join('pedido', 'pedido.id = item_pedido.id_pedido')
						->where('pedido.id', $id)
						->findAll();

		return $produto;

	}



}
