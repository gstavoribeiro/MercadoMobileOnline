<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoLojaModel extends Model
{
	protected $table                = 'produto_loja';
	protected $returnType           = 'object';
	protected $allowedFields        = ['id_loja', 'id_produto', 'preco', 'quantidade'];

	protected $validationRules    = [
        'preco'     => 'required|greater_than[0]',
		'quantidade'     => 'required|integer',

    ];

    protected $validationMessages = [
        'preco'        => [
			'required' => 'O campo Preço é obrigatório',

		
		],

		'quantidade'        => [
			'required' => 'O campo Quantidade é obrigatório',

		
		],
		
    ];

	public function buscaEspecificacoesDoProduto(int $id_produto){
		
		return $this->select('produto.nome AS produtos, produto_loja.*')
					->join('produto', 'produto.id = produto_loja.id_produto')
					->where('produto_loja.id_produto', $id_produto)
					->findAll();




	}

	public function listaPrecosProduto($id){
		
		$preco = $this->select(['produto_loja.*',  
								'produto.nome AS produto',
								'produto_loja.preco AS preco',
								'produto_loja.quantidade AS quantidade',])
						->join('produto', 'produto.id = produto_loja.id_produto')
						->join('loja', 'loja.id = produto_loja.id_loja')
						->where('loja.id', $_SESSION['loja_id'])
						->first();

		return $preco;

	}

}
