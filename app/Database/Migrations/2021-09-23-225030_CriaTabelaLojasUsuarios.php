<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaLojasUsuarios extends Migration
{
	public function up(){

	
		$this->forge->addField([
			
			'id_loja' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
			],
	
			'id_usuario' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
			],
			
		]);
	
		$this->forge->addForeignKey('id_loja', 'lojas', 'id');
		$this->forge->addForeignKey('id_usuario', 'usuarios', 'id');
		
		$this->forge->createTable('lojas_usuarios');
	
	}
	
		public function down()
		{
			$this->forge->dropTable('lojas_usuarios');
		}
}
