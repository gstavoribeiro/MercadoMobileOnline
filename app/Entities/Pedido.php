<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Pedido extends Entity
{
	protected $datamap = [];
	protected $dates   = [
		'criado_em',
		'atualizado_em',
		'deletado_em',
	];

	public function exibeSituacaoPedido(){

		switch ($this->status){

			case 0:

				echo '<label class="badge badge-primary">Pedido Realizado</label>';

				break;

			case 1:

				echo '<label class="badge badge-secondary">Entrega em andamento</label>';

				break;
			
			case 2:

				echo '<label class="badge badge-success">Pedido Entregue</label>';

				break;

			case 3:

				echo '<label class="badge badge-danger">Pedido Cancelado</label>';
	
				break;

			default:
				break;
		}
	}


	
}


