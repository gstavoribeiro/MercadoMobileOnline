<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Loja;

class Lojas extends BaseController
{
	private $lojaModel;
	private $usuarioModel;
	
	public function __construct(){

		$this->lojaModel = new \App\Models\LojaModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
	}
	
	public function index()
	{

		$data = [
			'titulo' => 'Listando os lojas',
			'lojas' => $this->lojaModel->where('id', $_SESSION["loja_id"])
										->withDeleted(true)->paginate(10),
			'pager' => $this->lojaModel->pager,
		];
		
		//caso queria aparecer todos lojas em uma pagina use findAll()
		//caso queria aparecer os deletados withDeleted(true)->

		
		return view('Admin/lojas/index', $data,);

	}


	public function procurar(){

		if(!$this->request->isAJAX()){

			exit('Página não encontrada');
		}

		$lojas = $this->lojaModel->procurar($this->request->getGet('term'));

		$retorno = [];

		foreach ($lojas as $loja) {
			
			$data['id'] = $loja->id;
			$data['value'] = $loja->nome;

			$retorno[] = $data;
		}

		return $this->response->setJSON($retorno);

	}

	public function criar($id = null){

		$loja = new loja();

		$data = [
			'titulo' => "Criando nova loja",
			'loja' => $loja,
			'usuarios' => $this->usuarioModel->where('ativo', true)->findAll()


		];


		return view('Admin/lojas/criar', $data);


	}

	public function cadastrar(){

		if($this->request->getMethod() === 'post'){

			$loja = new loja($this->request->getPost());

			if($this->lojaModel->protect(false)->save($loja)){
				
				return redirect()->to(site_url("admin/lojas/show/".$this->lojaModel->getInsertID())) 
					->with('sucesso', "loja $loja->nome cadastrada com sucesso");
			}else{
				
				return redirect()->back()
					->with('errors_model', $this->lojaModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();


			}
	

		}else{

			// Não é post
			return redirect()->back();
		}


	}



	public function show($id = null){

		$loja = $this->buscaLojaOu404($id);

		$data = [
			'titulo' => "Detalhando a loja: $loja->nome",
				'loja' => $loja,


		];


		return view('Admin/lojas/show', $data);


	}

	public function editar($id = null){

		$loja = $this->buscaLojaOu404($id);

		if($loja->deletado_em != null){

			return redirect()->back()
				->with('info', "O loja $loja->nome encontra-se excluido. Portanto não é possível edita-lo");



		}

		$data = [
			'titulo' => "Editando o loja: $loja->nome",
			'loja' => $loja,
			'usuarios' => $this->usuarioModel->where('ativo', true)->findAll()


		];

		return view('Admin/lojas/editar', $data);


	}

	public function atualizar($id = null){

		if($this->request->getMethod() === 'post'){

			$loja = $this->buscaLojaOu404($id);

			if ($loja->deletado_em != null){
				return redirect()->back()->with('info', "o loja $loja->nome encontra-se excluído. Portanto, não é possível edita-lo");
			}

			$post = $this->request->getPost();

			$loja->fill($post);

			if(!$loja->hasChanged()){

				return redirect()->back()
					->with('info', 'Não há dados para serem atualizados');


			}

			if($this->lojaModel->protect(false)->save($loja)){
				
				return redirect()->to(site_url("admin/lojas/show/$loja->id")) 
					->with('sucesso', "loja $loja->nome atualizado com sucesso");
			}else{
				
				return redirect()->back()
					->with('errors_model', $this->lojaModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();


			}
	

		}else{

			// Não é post
			return redirect()->back();
		}


	}

	public function excluir($id = null){

		$loja = $this->buscaLojaOu404($id);

		if($loja->deletado_em != null){

			return redirect()->back()
				->with('info', "O loja $loja->nome já encontra-se excluido.");



		}


		if($loja->is_admin){

			return redirect()->back()
				->with('info', 'Não é possível excluir um loja <b>Administrador</b> ');
		}

		if($this->request->getMethod() === 'post'){
			
			$this->lojaModel->delete($id);
			return redirect()->to(site_url('admin/lojas'))
				->with('sucesso', "loja $loja->nome excluido com sucesso");

		}

		$data = [
			'titulo' => "Excluindo o loja: $loja->nome",
				'loja' => $loja,


		];


		return view('Admin/lojas/excluir', $data);


	}

	public function desfazerExclusao($id = null){

		$loja = $this->buscaLojaOu404($id);

		if($loja->deletado_em == null){

			return redirect()->back()
				->with('info', 'Apenas lojas excluidos podem ser recuperados');

		}

		if($this->lojaModel->desfazerExclusao($id)){
			return redirect()->back()
				->with('success', 'Exclusão desfeita com sucesso');
		}else{
			return redirect()->back()
					->with('errors_model', $this->lojaModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();

		}

	}

	
	private function buscaLojaOu404(int $id = null){

		if(!$id || !$loja = $this->lojaModel->withDeleted(true)->where('id', $id)->first()){

			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a loja $id");


		}

		return $loja;

	}

	public function editarImagem($id = null){

		$loja = $this->buscaLojaOu404($id);

		$data = [
			'titulo' => "Editando a imagem do loja $loja->nome",
			'loja' => $loja,
			
		];

		return view('Admin/lojas/editar_imagem', $data);



	}

	public function upload($id = null){

		$loja = $this->buscaLojaOu404($id);

		$imagem = $this->request->getFile('foto_loja');

		$type = pathinfo($imagem, PATHINFO_EXTENSION);
		$data = file_get_contents($imagem);

		if(!$imagem->isValid()){

			$codigoErro = $imagem->getError();

			if($codigoErro == UPLOAD_ERR_NO_FILE){

				return redirect()->back()->with('atencao', 'Nenhum arquivo foi selecionado');
			}

		}

		$tamanhoImagem = $imagem->getSizeByUnit('mb');

		if($tamanhoImagem > 2){

			return redirect()->back()->with('atencao', 'O arquivo selecionado é muito grande. Máximo permitido é 2MB');
		}

		$tipoImagem = $imagem->getMimeType();

		$tipoImagemLimpo =  explode('/', $tipoImagem);

		$tiposPermitidos = [
			'jpeg', 'png', 'webp'
		];

		if(!in_array($tipoImagemLimpo[1], $tiposPermitidos)){

			return redirect()->back()->with('atencao', 'O formato do arquivo é inválido. Apenas: '. implode(', ',$tiposPermitidos));

		}

		list($largura, $altura) = getimagesize($imagem->getPathName());

		if($largura > "400" || $altura > "400"){

			return redirect()->back()->with('atencao', 'A imagem não pode ser menor que 400 x 400 pixels.');

		}

		//STORE DA IMAGEM
		$base64 = base64_encode($data);
		$imagemCaminho = $imagem->store('lojas');
		$imagemCaminho = WRITEPATH . 'uploads/'. $imagemCaminho;

		//FORÇANDO TAMANHO DA IMAGEM
		service('image')
			->withFile($imagemCaminho)
			->fit(400, 400, 'center')
			->save($imagemCaminho);

		//RECUPERANDO IMAGEM ANTIGA PARA EXCLUIR
		$imagemAntiga = $loja->logo;

		//ATRIBUINDO NOVA IMAGEM
		$loja->logo = $base64;

		//ATUALIZANDO IMAGEM DO loja
		$this->lojaModel->save($loja);

		//DEFININDO O CAMINHO DA IMAGEM ANTIGA
		$caminhoImagem = WRITEPATH . 'uploads/lojas/' . $imagemAntiga;

		if(is_file($caminhoImagem)){

			unlink($caminhoImagem);

		}

		return redirect()->to(site_url("admin/lojas/show/$loja->id"))->with('sucesso', 'Imagem alterada com sucesso');


	}
	
	public function imagem(string $imagem = null){

		if($imagem){

			$caminhoImagem = WRITEPATH . 'uploads/lojas/' . $imagem;

			$infoImagem = new \finfo(FILEINFO_MIME);

			$tipoImagem = $infoImagem->file($caminhoImagem);

			header("Content-Type: $tipoImagem");
			header("Content-length: ".filesize($caminhoImagem));
			readfile($caminhoImagem);
			exit;

		}

	}

	

}