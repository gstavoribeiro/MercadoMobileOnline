<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Produto;

class Produtos extends BaseController
{

	private $produtoModel;
	private $categoriaModel;
	private $produtoLojaModel;

	public function __construct(){

		$this->produtoModel = new \App\Models\ProdutoModel();
		$this->categoriaModel = new \App\Models\CategoriaModel();
		$this->produtoLojaModel = new \App\Models\produtoLojaModel();



	}

	public function index()
	{
		$data = [
			'titulo' => 'Listando os produtos',
			'produtos' => $this->produtoModel->select('produto.*, categorias.nome AS categoria,')
											 ->join('categorias', 'categorias.id = produto.id_categoria')
											 ->withDeleted(true)
											 ->paginate(10),

			//'precos' => $this->produtoLojaModel->listaPrecosProduto(),
			
			'pager' => $this->produtoModel->pager,

		];


		return view('Admin/Produtos/index', $data);
	}

	public function procurar(){

		if(!$this->request->isAJAX()){

			exit('Página não encontrada');
		}


		$produtos = $this->produtoModel->procurar($this->request->getGet('term'));

		$retorno = [];

		foreach ($produtos as $produto) {
			
			$data['id'] = $produto->id;
			$data['value'] = $produto->nome;

			$retorno[] = $data;
		}

		return $this->response->setJSON($retorno);

	}

	private function buscaProdutoOu404(int $id = null){

		if(!$id || !$produto = $this->produtoModel->select('produto.*, 
														   categorias.nome AS categoria,')
													->join('categorias', 'categorias.id = produto.id_categoria')
													->where('produto.id', $id)
													->withDeleted(true)
													->first()){

			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o produto $id");


		}

		return $produto;

	}


	public function criar(){

		$produto = new Produto();

		$data = [
			'titulo' => "Criando novo produto",
			'produto' => $produto,
			'categorias' => $this->categoriaModel->where('ativo', true)->findAll()


		];

		return view('Admin/Produtos/criar', $data);

		
	}

	public function cadastrar(){

		if($this->request->getMethod() === 'post'){

			$produto = new Produto($this->request->getPost());

			if($this->produtoModel->save($produto)){
				
				return redirect()->to(site_url("admin/produtos/show/".$this->produtoModel->getInsertID()))
								->with('sucesso', "Produto $produto->nome cadastrado com sucesso");


			}else{

				//erros de validação
				return redirect()->back()
					->with('errors_model', $this->produtoModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();

			}


		}else{


			return redirect()->back();
		}




	}


	
	
	public function show($id = null){

		$produto = $this->buscaProdutoOu404($id);

		$preco = $this->produtoLojaModel->listaPrecosProduto($produto->id);

		$data = [
			'titulo' => "Detalhando o produto: $produto->nome",
			'produto' => $produto,
			'precos' => $preco,
			


		];


		return view('Admin/Produtos/show', $data);


	}


	public function editar($id = null){

		$produto = $this->buscaProdutoOu404($id);

		$data = [
			'titulo' => "Editando o produto: $produto->nome",
			'produto' => $produto,
			'categorias' => $this->categoriaModel->where('ativo', true)->findAll()


		];


		return view('Admin/Produtos/editar', $data);


	}

	public function atualizar($id = null){

		if($this->request->getMethod() === 'post'){


			$produto = $this->buscaProdutoOu404($id);

			$produto->fill($this->request->getPost());

			if(!$produto->hasChanged()){

				return redirect()->back()->with('info', 'Não há dados para atualizar');

			}


			if($this->produtoModel->save($produto)){
				
				return redirect()->to(site_url("admin/produtos/show/$id"))->with('sucesso', 'Produto atualizado com sucesso');

			}else{

				//Erros de Validação
				return redirect()->back()
					->with('errors_model', $this->produtoModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();

			}


		}else{


			return redirect()->back();
		}





	}

	public function excluir($id = null){

		$produto = $this->buscaProdutoOu404($id);

		if($produto->deletado_em != null){

			return redirect()->back()
				->with('info', "O produto $produto->nome já encontra-se excluido.");



		}

		if($this->request->getMethod() === 'post'){
			
			$this->produtoModel->delete($id);
				return redirect()->to(site_url('admin/produtos'))
					->with('sucesso', "produto $produto->nome excluido com sucesso");

		}

		$data = [
			'titulo' => "Excluindo o produto: $produto->nome",
				'produto' => $produto,


		];


		return view('Admin/produtos/excluir', $data);


	}

	public function desfazerExclusao($id = null){

		$produto = $this->buscaProdutoOu404($id);

		if($produto->deletado_em == null){

			return redirect()->back()
				->with('info', 'Apenas produtos excluidos podem ser recuperados');

		}

		if($this->produtoModel->desfazerExclusao($id)){
			return redirect()->back()
				->with('success', 'Exclusão desfeita com sucesso');
		}else{
			return redirect()->back()
					->with('errors_model', $this->produtoModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();

		}

	}

	public function editarImagem($id = null){

		$produto = $this->buscaProdutoOu404($id);

		$data = [
			'titulo' => "Editando a imagem do produto $produto->nome",
			'produto' => $produto,
			
		];

		return view('Admin/Produtos/editar_imagem', $data);



	}

	public function upload($id = null){

		$produto = $this->buscaProdutoOu404($id);

		$imagem = $this->request->getFile('foto_produto');

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
			'jpeg', 'webp'
		];

		if(!in_array($tipoImagemLimpo[1], $tiposPermitidos)){

			return redirect()->back()->with('atencao', 'O formato do arquivo é inválido. Apenas: '. implode(', ',$tiposPermitidos));

		}

		list($largura, $altura) = getimagesize($imagem->getPathName());

		if($largura > "400" || $altura > "400"){

			return redirect()->back()->with('atencao', 'A imagem não pode ser maior que 100 x 100 pixels.');

		}

		//STORE DA IMAGEM
		$base64 = base64_encode($data);
		$imagemCaminho = $imagem->store('produtos');
		$imagemCaminho = WRITEPATH . 'uploads/'. $imagemCaminho;

		//FORÇANDO TAMANHO DA IMAGEM
		service('image')
			->withFile($imagemCaminho)
			->fit(400, 400, 'center')
			->save($imagemCaminho);

		//RECUPERANDO IMAGEM ANTIGA PARA EXCLUIR
		$imagemAntiga = $produto->imagem;

		//ATRIBUINDO NOVA IMAGEM
		$produto->imagem = $base64;

		//ATUALIZANDO IMAGEM DO PRODUTO
		$this->produtoModel->save($produto);

		//DEFININDO O CAMINHO DA IMAGEM ANTIGA
		$caminhoImagem = WRITEPATH . 'uploads/produtos/' . $imagemAntiga;

		if(is_file($caminhoImagem)){

			unlink($caminhoImagem);

		}

		return redirect()->to(site_url("admin/produtos/show/$produto->id"))->with('sucesso', 'Imagem alterada com sucesso');


	}
	
	public function imagem(string $imagem = null){

		if($imagem){

			
			$caminhoImagem = WRITEPATH . 'uploads/produtos/' . $imagem;

			$infoImagem = new \finfo(FILEINFO_MIME);

			$tipoImagem = $infoImagem->file($caminhoImagem);

			header("Content-Type: $tipoImagem");
			header("Content-length: ".filesize($caminhoImagem));
			readfile($caminhoImagem);
			exit;

		}

	}

	public function especificacoes($id = null){

		$produto = $this->buscaProdutoOu404($id);

		$data = [
			'titulo' => "Gerenciar as especificações do produto $produto->nome",
			'produto' => $produto,
			'produtosEspecificacoes' => $this->produtoLojaModel->buscaEspecificacoesDoProduto($produto->id),
		];

		return view('Admin/Produtos/especificacoes', $data);
	}


	public function cadastrarEspecificacoes($id = null) {

		if($this->request->getMethod() === 'post' ){

			$produto = $this->buscaProdutoOu404($id);

			$especificacao = $this->request->getPost();
		
			$especificacao['id_loja'] = $_SESSION["loja_id"];
			$especificacao['id_produto'] = $produto->id;
			$especificacao['preco'] = str_replace(",", "",$especificacao['preco']);
			$especificacao['quantidade'] = str_replace(",", "",$especificacao['quantidade']);
			
			if($this->produtoLojaModel->replace($especificacao)){

				return redirect()->to(site_url("admin/produtos/show/$id"))->with('sucesso', 'Estoque cadastrado com sucesso');

			}else{
				
				return redirect()->back()
					->with('errors_model', $this->produtoLojaModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();

			}

		}else{


			return redirect()->back();
		}



	}

	public function atualizarEspecificacao($id = null){

		if($this->request->getMethod() === 'post'){


			$produto = $this->buscaProdutoOu404($id);

			$especificacao->fill($this->request->getPost());

			if(!$especificacao->hasChanged()){

				return redirect()->back()->with('info', 'Não há dados para atualizar');

			}


			if($this->produtoLojaModel->save($especificacao)){
				
				return redirect()->to(site_url("admin/produtos/show/$id"))->with('sucesso', 'Produto atualizado com sucesso');

			}else{

				//Erros de Validação
				return redirect()->back()
					->with('errors_model', $this->produtoLojaModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();

			}


		}else{


			return redirect()->back();
		}
	}
}