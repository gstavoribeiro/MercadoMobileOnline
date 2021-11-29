<?php

namespace App\Models;

use CodeIgniter\Model;

class LojaModel extends Model
{
	protected $table                = 'loja';
	protected $returnType           = 'App\Entities\Loja';
	protected $useSoftDeletes       = true;
	protected $allowedFields        = [
		'id', 'id_usuario', 'rua', 'numero', 'bairro', 'cidade', 'complemento', 'logo', 'nome', 'previsao', 'valor_entrega_padrao', 'entrega_gratis', 'valor_entrega_gratis', 'cnpj'
	];
	
	//datas
	protected $useTimestamps = true;
	protected $dateFormat	 = 'datetime';
	protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
	protected $deletedField  = 'deletado_em';

	public function buscaLoja($id){

		$lojas = $this->select([
				'loja.id',
				'loja.nome'
		]
		)
		//->join('lojas_usuarios', 'loja.id = lojas_usuarios.id_loja')
		->where('id_usuario = '.$id)
		->orderBy('nome', 'ASC')
		->findAll();
		
		return $lojas;
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



    }

