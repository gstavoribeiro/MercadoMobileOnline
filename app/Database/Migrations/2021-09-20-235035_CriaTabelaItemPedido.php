<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaItemPedido extends Migration
{
	public function up(){

	
		$this->forge->addField([
			
			'id_pedido' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
			],
	
			'id_produto' => [
				'type' => 'INT',
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
	
		$this->forge->addPrimaryKey('id_pedido');
		$this->forge->addPrimaryKey('id_produto');

		$this->forge->addForeignKey('id_pedido', 'pedidos', 'id');
		$this->forge->addForeignKey('id_produto', 'produtos', 'id');
		
		$this->forge->createTable('item_pedido');
	
	}
	
		public function down()
		{
			$this->forge->dropTable('item_pedido');
		}
}
