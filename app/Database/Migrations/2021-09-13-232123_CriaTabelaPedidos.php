<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaPedidos extends Migration
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

			'codigo' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],

			'forma_pagamento' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],

			'situacao' => [
				'type' => 'BOOLEAN',
				'null' => false,
				'default' => false, 
				
				//0 = pedido realizado
				//1 = pronto para retirada
				//2 = pedido entregue
				//3 = pedido cancelado
			],

			'produtos' => [
				'type' => 'TEXT',
				'constraint' => '200',
			
			],

			'valor_produtos' => [
				'type' => 'DECIMAL',
				'constraint' => '10,2',
			
			],

			'valor_entrega' => [
				'type' => 'DECIMAL',
				'constraint' => '10,2',
			
			],

			'valor_pedido' => [
				'type' => 'DECIMAL',
				'constraint' => '10,2',
			
			],

			'endereco_entrega' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			
			],

			'observacoes' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			
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

		$this->forge->createTable('pedidos');
	}

	public function down()
	{
		$this->forge->dropTable('pedidos');
	}
}
