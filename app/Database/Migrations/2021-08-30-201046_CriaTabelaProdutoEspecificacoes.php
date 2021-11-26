<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaProdutoEspecificacoes extends Migration
{
	public function up()
	{
		$this->forge->addField([

			'id_loja' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
			],


			'id_produto' => [
				'type' => 'int',
				'constraint' => 5,
				'unsigned' => true,
				
			],

			'preco' => [
				'type' => 'DECIMAL',
				'constraint' => '10,2',
			],

			'quantidade' => [
				'type' => 'INT',
				'constraint' => 10,
			],

		]);

		$this->forge->addPrimaryKey('id_loja');
		$this->forge->addPrimaryKey('id_produto');
		$this->forge->addForeignKey('id_produto', 'produtos', 'id');

		$this->forge->createTable('produtos_especificacoes');
	}

	public function down()
	{
		$this->forge->dropTable('produtos_especificacoes');
	}
}
