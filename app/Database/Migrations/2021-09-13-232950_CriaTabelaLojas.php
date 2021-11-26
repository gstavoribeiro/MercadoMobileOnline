<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaLojas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true,
			],

			'usuario_id' => [
				'type' => 'int',
				'constraint' => 5,
				'unsigned' => true,
				
			],

			'rua' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],

			'numero' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],

			'bairro' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],

			'cidade' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
			
			],

			'complemento' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
			
			],

			'nome' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
			
			],

			'imagem' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => true,
			
			],

			'valor_entrega_padrao' => [
				'type' => 'int',
				'constraint' => 5,
			
			],

			'entrega_gratis' => [
				'type' => 'BOOLEAN',
				'null' => false,
				'default' => false,
			],

			'valor_entrega_gratis' => [
				'type' => 'int',
				'constraint' => 5,
			],

			'cnpj' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
			],

			'criado_em' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null,
			],

			'atualizado_em' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null,
			],

			'deletado_em' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null,
			],
		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('usuario_id', 'usuarios', 'id');
		

		$this->forge->createTable('lojas');
	}

	public function down()
	{
		$this->forge->dropTable('lojas');
	}
}
