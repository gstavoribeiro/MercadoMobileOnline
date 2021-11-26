<?php

namespace App\Libraries;

//Essa classe cuidará da parte de autenticação na nossa aplicação

class Autenticacao{
    
    private $usuario;

    public function login(string $email, string $password){

        $usuarioModel = new \App\Models\UsuarioModel();
        
        $usuario = $usuarioModel->buscaUsuarioPorEmail($email);

        // se não encontrar o usuário por e-mail, então retorna false
        if($usuario === null){

            return false;
        }
        
        // se a senha não bater com o password_hash, retorna false
        if(!$usuario->verificaPassword($password)){

            return false;
        }

        // só permitiremos o login de usuários ativos
        if(!$usuario->ativo){
            
            return false;
        }

        // nesse ponto está tudo certo para logar
        $this->logaUsuario($usuario);

        return true;
    }

    public function logout(){

        session()->destroy();

    }

    public function pegaUsuarioLogado(){

        if($this->usuario === null){

            $this->usuario = $this->pegaUsuarioDaSessao();

        }

        return $this->usuario;


    }

    public function estaLogado(){

        return $this->pegaUsuarioLogado() !== null;
    }

    private function pegaUsuarioDaSessao(){

        if(!session()->has('usuario_id')){

            return null;
        }

        //Instanciamos o Model Usuário
        $usuarioModel = new \App\Models\UsuarioModel();

        //Recupero o Usuario de acordo com a chave da sessao 'usuario_id'
        $usuario = $usuarioModel->find(session()->get('usuario_id'));

        //Só retorno o objeto $usuario se o mesmo for encontrado e estiver ativo
        if($usuario && $usuario->ativo){

            return $usuario;
        }

    }
    
    private function logaUsuario(object $usuario){

        $session = session();
        $session->regenerate();
        $session->set('usuario_id', $usuario->id);


    }

}

   




?>