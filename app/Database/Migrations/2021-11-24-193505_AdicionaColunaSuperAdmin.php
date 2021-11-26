<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdicionaColunaSuperAdmin extends Migration
{
	public function up(){

	
		$fields = [
			'super_admin' => [
				'type' => 'INT',
				'constraint' => 1,
				'unsigned' => true,
				'default' => 0,
			],
	
		];
		
		$this->forge->AddColumn('usuarios', $fields);
	
	}
	
		public function down()
		{
			$this->forge->DropColumn('usuarios', 'super_admin');
		}
}
