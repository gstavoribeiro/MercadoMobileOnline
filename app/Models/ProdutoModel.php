<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
	protected $table                = 'produto';
	protected $returnType           = 'App\Entities\Produto';
	protected $useSoftDeletes       = true;
	protected $allowedFields        = [
		'id_categoria',
		'nome',
		'slug',
		'ativo',
		'imagem',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'criado_em';
	protected $updatedField         = 'atualizado_em';
	protected $deletedField         = 'deletado_em';

	// Validation
	protected $validationRules    = [
        'nome'     => 'required|min_length[2]|max_length[120]|is_unique[produto.nome]',
		'id_categoria'     => 'required|integer',

    ];

    protected $validationMessages = [
        'nome'        => [
			'required' => 'O campo Nome é obrigatório',
			'is_unique' => 'Esse produto já existe',

		
		],

		'id_categoria'        => [
			'required' => 'O campo Categoria é obrigatório',

		
		],
		
    ];


	protected $beforeInsert = ['criaSlug'];
	protected $beforeUpdate = ['criaSlug'];

	protected function criaSlug(array $data){

		if(isset($data['data']['nome'])){

			$data['data']['slug'] = mb_url_title($data['data']['nome'],'-', TRUE);

		}

		return $data;

	}


	public function procurar($term){


		if ($term === null){

			return [];
		}
		
		return $this->select('id, nome')
						->like('nome', $term)
						->withDeleted(true)
						->get()
						->getResult();

						
	}



	public function desfazerExclusao(int $id){

		return $this->protect(false)
					->where('id', $id)
					->set('deletado_em', null)
					->update();

		
	}

	public function recuperaProdutosAtivos(){
		
		return $this->where('ativo', true)
					->countAllResults();
	}


	

	
}
