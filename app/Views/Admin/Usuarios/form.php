

<div class="form-row">

    <div class="form-group col-md-4">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome',  esc($usuario->nome));?>">
    </div>

    <div class="form-group col-md-2">
        <label for="data_nascimento">Data de Nascimento</label>
        <input type="date" class="form-control date" name="data_nascimento" id="data_nascimento" value="<?php echo old('data_nascimento', esc($usuario->data_nascimento));?>">
    </div>

    <div class="form-group col-md-3">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" value="<?php echo old('telefone', esc($usuario->telefone));?>">
    </div>

    <div class="form-group col-md-3">
        <label for="email">E-mail</label>
        <input type="text" class="form-control" name="email" id="email" value="<?php echo old('email', esc($usuario->email));?>">
    </div>

</div>

<div class="form-row">

    <div class="form-group col-md-3">
        <label for="password">Senha</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div class="form-group col-md-3">
        <label for="password_confirmation">Confirmar Senha</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
    </div>

</div>


<div class="form-check form-check-flat form-check-primary mb-2">
    <label for="ativo" class="form-check-label">
        <input type="hidden" name="ativo" value="0">
         <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if(old('ativo', $usuario->ativo)): ?> checked= "" <?php endif; ?>>
            Ativo
    </label>
</div>

<div class="form-check form-check-flat form-check-primary mb-4">
    <label for="is_admin" class="form-check-label">
        <input type="hidden" name="is_admin" value="0">
         <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" <?php if(old('is_admin', $usuario->is_admin)): ?> checked= "" <?php endif; ?>>
            Administrador
    </label>
</div>



    <button type="submit" class="btn btn-primary mr-2 btn-sm">
        <i class="mdi mdi-check-circle ptn-iton-prepend"></i>
         Salvar
    </a>
    
    </button>
    
                  
                  