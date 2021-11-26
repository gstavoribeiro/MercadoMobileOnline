<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
	protected $table                = 'pedido';
	protected $primaryKey           = 'id';
	protected $returnType           = 'App\Entities\Pedido';
	protected $useSoftDeletes       = true;
	protected $allowedFields        = [
		'id',
		'loja_id',
		'usuario_id',
		'codigo',
		'forma_pagamento',
		'situacao',
		'produtos',
		'valor_produtos',
		'valor_entrega',
		'valor_pedido',
		'endereco_entrega',
		'observacoes',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'criado_em';
	protected $updatedField         = 'atualizado_em';
	protected $deletedField         = 'deletado_em';

	//public function geraCodigoPedido(){

		//do{

			//$codigoPedido = random_string('numeric', 8);
			//$this->where('codigo', $codigoPedido);

		//}while($this->countAllResults() > 1);

		//return $codigoPedido;
	//}

	public function procurar($term){


		if ($term === null){

			return [];
		}
		
		return $this->select('id')
						->like('id', $term)
						->withDeleted(true)
						->get()
						->getResult();

	}

	public function listaTodosPedidos(){

		return $this->select([
				'pedido.*',
				'usuarios.nome AS cliente',
		]
		)
		->join('usuarios', 'usuarios.id = pedido.id_usuario')
		->where('id_loja', $_SESSION["loja_id"])
		->orderBy('pedido.criado_em', 'DESC')
		->paginate(10);
	}

	public function buscaPedidoOu404($id){

		//if(!$id){

			//throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound("Não encontramos o Pedido $id");

		//}

		$pedido = $this->select(['pedido.*', 
								'formas_pagamento.nome AS forma_pagamento', 
								'usuarios.nome AS cliente',
								'endereco_clientes.rua AS rua',
								'endereco_clientes.numero AS numero',
								'endereco_clientes.bairro AS bairro',
								'endereco_clientes.cidade AS cidade',])
						->join('formas_pagamento', 'formas_pagamento.id = pedido.id_forma_pagamento')
						->join('usuarios', 'usuarios.id = pedido.id_usuario')
						->join('endereco_clientes', 'endereco_clientes.id = pedido.id_endereco')
						->where('pedido.id', $id)
						->first();

		if(!$pedido){

			throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound("Não encontramos o Pedido $id");

		}

		return $pedido;
	}

	public function valorPedidosEntregues(){
		return $this->select('COUNT(*) AS total')
					->selectSum('valor_total')
					->where('status', 2)
					->where('id_loja', $_SESSION["loja_id"])
					->first();
					
	}

	public function valorPedidosCancelados(){
		return $this->select('COUNT(*) AS total')
					->selectSum('valor_total')
					->where('status', 3)
					->where('id_loja', $_SESSION["loja_id"])
					->first();
					
	}

	public function valorPedidosRealizados(){
		return $this->select('COUNT(*) AS total')
					->selectSum('valor_total')
					->where('status', 0)
					->where('id_loja', $_SESSION["loja_id"])
					->first();
					
	}

	public function valorPedidosEmRota(){
		return $this->select('COUNT(*) AS total')
					->selectSum('valor_total')
					->where('status', 1)
					->where('id_loja', $_SESSION["loja_id"])
					->first();
					
	}




}
