<?php

namespace App\Models;

use CodeIgniter\Model;

class FormaPagamentoLojaModel extends Model
{
	protected $table                = 'forma_pagamento_loja';
	protected $returnType           = 'object';
	protected $allowedFields        = ['id_forma_pagamento', 'id_loja'];

	protected $validationRules    = [
        'id_forma_pagamento'     => 'required|integer',
        'id_loja'     => 'required|integer',


    ];

    protected $validationMessages = [
        'id_forma_pagamento'        => [
			'required' => 'O campo Categoria é obrigatório',

		
		],
		'id_loja'        => [
			'required' => 'O campo Categoria é obrigatório',

		
		],
    ];


	public function buscaFormaPagamento(int $id_forma_pagamento, int $quantidade_paginacao){
		
		return $this->select('formas_pagamento.nome AS formas, forma_pagamento_loja.*')
					->join('formas_pagamento', 'formas_pagamento.id = forma_pagamento_loja.id_forma_pagamento')
					//->where('produto_loja.id_produto', $id_produto)
					->paginate($quantidade_paginacao);




	}
}
