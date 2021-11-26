<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

	protected $table                = 'usuarios';
	protected $returnType           = 'App\Entities\Usuario';
	protected $allowedFields        = ['nome', 'email', 'telefone'];
	
	//datas
	protected $useTimestamps = true;
	protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $dateFormat = 'datetime'; //para usar com softdelete
	protected $useSoftDeletes = true;
	protected $deletedField  = 'deletado_em';
	
	//Validações
	protected $validationRules    = [
        'nome'     => 'required|min_length[2]|max_length[120]',
        'email'        => 'required|valid_email|is_unique[usuarios.email]',
		'cpf'        => 'required|max_length[18]|validaCpf|is_unique[usuarios.cpf]',
		'telefone'        => 'required',
		'password'     => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]'
    ];

    protected $validationMessages = [
        'nome'        => [
			'required' => 'O campo Nome é obrigatório',
		],

		'email'        => [
            'is_unique' => 'Desculpe. Esse e-mail já existe.',
			'required' => 'O campo E-mail é obrigatório',
		],
		
		'cpf'        => [
            'is_unique' => 'Desculpe. Esse CPF já existe.',
			'required' => 'O campo CPF é obrigatório',
		],
		
    ];


	protected $beforeInsert = ['hashPassword'];
	protected $beforeUpdate = ['hashPassword'];

	protected function hashPassword(array $data){

		if(isset($data['data']['password'])){

			$data['data']['senha'] = md5($data['data']['password']);
			//password_hash($data['data']['password'], PASSWORD_DEFAULT);

			unset($data['data']['password']);
			unset($data['data']['password_confirmation']);
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

	public function desabilitaValidacaoSenha(){

		unset($this->validationRules['password']);
		unset($this->validationRules['password_confirmation']);
	}

	public function desfazerExclusao(int $id){

		return $this->protect(false)
					->where('id', $id)
					->set('deletado_em', null)
					->update();

		
	}

	//Classe Autenticação
	public function buscaUsuarioPorEmail(string $email){

		return $this->where('email', $email)->first();


	}

	public function recuperaTotalClientesAtivos(){
		
		return $this->where('is_admin', false)
					->where('ativo', true)
					->countAllResults();
	}




}