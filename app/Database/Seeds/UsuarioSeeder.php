<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
	public function run()
	{
		$usuarioModel = new \App\Models\UsuarioModel;

		$usuario = [
			
			'nome' => 'Cacildo ',
			'email' => 'Cacildo@tcc.com.br',
			'cpf ' => '848.184.123-64',
			'telefone ' => '353932821',
		];


		$usuarioModel->protect(false)->insert($usuario);

		dd($usuarioModel->errors()); //debug
	}
}
