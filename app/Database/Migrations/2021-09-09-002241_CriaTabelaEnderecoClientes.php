<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaEnderecoClientes extends Migration
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

			'id_usuario' => [
				'type' => 'INT',
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
				'constraint' => '128',
				'default' => 'Franca'
			],

			'complemento' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],

			'apelido' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],

			'ativo' => [
				'type' => 'BOOLEAN',
				'null' => false,
				'default' => true,
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
		$this->forge->addForeignKey('id_usuario', 'usuarios', 'id');

		$this->forge->createTable('endereco_clientes');
	}

	public function down()
	{
		$this->forge->dropTable('endereco_clientes');
	}
}
