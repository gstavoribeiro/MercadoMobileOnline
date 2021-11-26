

<div class="form-row">

    <div class="form-group col-md-4">
        <label for="nome">Usuario</label>
        <select class="form-control" name="id_usuario">

        <option value="">Escolha o usuário</option>
            <?php foreach ($usuarios as $usuario): ?>

                <?php if($loja->id):    ?>

                    <option value="<?php echo $usuario->id;   ?>" <?php echo ($usuario->id == $loja->id_usuario ? 'selected' : '')     ?>> <?php echo esc($usuario->nome);?></option>
                    

            
                <?php else:    ?>
                    
                    <option value="<?php echo $usuario->id;   ?>"><?php echo esc($usuario->nome);?></option>


                <?php endif; ?>



            <?php endforeach;   ?>
        


        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome',  esc($loja->nome));?>">
    </div>
    <div class="form-group col-md-4">
        <label for="nome">CNPJ</label>
        <input type="text" class="form-control cnpj" name="cnpj" id="cnpj" value="<?php echo old('cnpj',  esc($loja->cnpj));?>">
    </div>
    <div class="form-group col-md-4">
        <label for="nome">Rua</label>
        <input type="text" class="form-control" name="rua" id="rua" value="<?php echo old('rua',  esc($loja->rua));?>">
    </div>
    <div class="form-group col-md-4">
        <label for="nome">Numero</label>
        <input type="text" class="form-control" name="numero" id="numero" value="<?php echo old('numero',  esc($loja->numero));?>">
    </div>
    <div class="form-group col-md-4">
        <label for="nome">Bairro</label>
        <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo old('bairro',  esc($loja->bairro));?>">
    </div>
    <div class="form-group col-md-4">
        <label for="nome">Cidade</label>
        <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo old('cidade',  esc($loja->cidade));?>">
    </div>
    <div class="form-group col-md-4">
        <label for="nome">Complemento</label>
        <input type="text" class="form-control" name="complemento" id="complemento" value="<?php echo old('complemento',  esc($loja->complemento));?>">
    </div>
    <div class="form-group col-md-4">
        <label for="nome">Valor de Entrega</label>
        <input type="text" class="form-control" name="valor_entrega_padrao" id="valor_entrega_padrao" value="<?php echo old('valor_entrega_padrao',  esc($loja->valor_entrega_padrao));?>">
    </div>
    <div class="form-group col-md-4">
        <label for="nome">Valor Entrega Gratis</label>
        <input type="text" class="form-control" name="valor_entrega_gratis" id="valor_entrega_gratis" value="<?php echo old('valor_entrega_gratis',  esc($loja->valor_entrega_gratis));?>">
    </div>
    <div class="form-group col-md-4">
        <label for="nome">Previsão de Entrega</label>
        <input type="text" class="form-control" name="previsao" id="previsao" value="<?php echo old('previsao',  esc($loja->previsao));?>">
    </div>

    

    

</div>

<div class="form-check form-check-flat form-check-primary mb-4">
    <label for="entrega_gratis" class="form-check-label">
        <input type="hidden" name="entrega_gratis" value="0">
         <input type="checkbox" class="form-check-input" id="entrega_gratis" name="entrega_gratis" value="1" <?php if(old('entrega_gratis', $loja->entrega_gratis)): ?> checked= "" <?php endif; ?>>
            Entrega Grátis
    </label>

</div>

<div class="form-check form-check-flat form-check-primary mb-4">
    <label for="ativo" class="form-check-label">
        <input type="hidden" name="ativo" value="0">
         <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if(old('ativo', $loja->ativo)): ?> checked= "" <?php endif; ?>>
            Ativo
    </label>

</div>


    <button type="submit" class="btn btn-primary mr-2 btn-sm">
        <i class="mdi mdi-check-circle ptn-iton-prepend"></i>
        
         Salvar
    </a>
    
    </button>
    
                  
    