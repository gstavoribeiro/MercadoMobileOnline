<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function email(){

		$email = \Config\Services::email();

		$email->setFrom('gustavoribeiro.ma@gmail.com', 'Gustavo Ribeiro');
		$email->setTo('yotavem677@5ubo.com');
		//$email->setCC('another@another-example.com');
		//$email->setBCC('them@their-example.com');

		$email->setSubject('Teste de Email');
		$email->setMessage('Testing the email class.');

		if($email->send()){

			echo 'Email enviado';
		}else{

			echo $email->printDebugger();
		}


	}
}

