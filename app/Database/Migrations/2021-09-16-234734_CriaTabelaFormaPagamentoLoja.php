<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaFormaPagamentoLoja extends Migration
{
	public function up(){

	
	$this->forge->addField([
		
		'id_forma_pagamento' => [
			'type' => 'INT',
			'constraint' => 5,
			'unsigned' => true,
		],

		'id_loja' => [
			'type' => 'INT',
			'constraint' => 5,
			'unsigned' => true,
		],
		
	]);

	$this->forge->addForeignKey('id_forma_pagamento', 'formas_pagamento', 'id');
	$this->forge->addForeignKey('id_loja', 'lojas', 'id');
	
	$this->forge->createTable('forma_pagamento_loja');

}

	public function down()
	{
		$this->forge->dropTable('forma_pagamento_loja');
	}
}
