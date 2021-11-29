<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
    <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">

                    <div class="card-header bg-primary pb-0 pt-4">

                        <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>

                    </div>
                    <div class="card-body">

                        <div class="text-center">

                        <?php if ($produto->imagem):   ?>

                            
                            <img class="card-img-top w-75" src="data:image/png;base64,<?php echo $produto->imagem;    ?>" alt="<?php echo esc($produto->nome); ?>">


                        <?php else:   ?> 

                            <img class="card-img-top w-75" src="<?php echo site_url('admin/images/produto-sem-imagem.png');   ?>" alt="Produto sem imagem">

                        <?php endif;   ?>


                        </div>
                        <?php if ($_SESSION['super_admin'] == 1){ ?>
                            <a href="<?php echo site_url("admin/produtos/editarimagem/$produto->id");?>"class="btn btn-outline-primary mt-3 mb-3 btn-sm">
                                <i class="mdi mdi-image ptn-iton-prepend"></i>
                                Editar Imagem
                            </a>
                        <?php } ?>
                    
                        <p class="card-text">
                            <span class="font-weight-bold">Nome: </span>
                            <?php echo esc($produto->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Categoria: </span>
                            <?php echo esc($produto->categoria); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Preco: </span>
                            <?php echo esc($precos->preco); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Quantidade: </span>
                            <?php echo esc($precos->quantidade); ?>
                        </p>

                        <p class="card-text">
                            <span class="font-weight-bold">Ativo: </span>
                            <?php echo esc($produto->ativo ? 'Sim' : 'Não'); ?>
                        </p>

                        <p class="card-text">
                            <span class="font-weight-bold">Criado: </span>
                            <?php echo $produto->criado_em->humanize(); ?>
                        </p>

                        <?php if($produto->deletado_em == null):?>

                        <p class="card-text">
                            <span class="font-weight-bold">Atualizado: </span>
                            <?php echo $produto->atualizado_em->humanize(); ?>
                        </p>

                        <?php else:?>
                            
                            <p class="card-text">
                                <span class="font-weight-bold text-danger">Excluido: </span>
                                <?php echo $produto->deletado_em->humanize(); ?>
                            </p>



                        <?php endif;?>

                        <div class="mt-4"> 


                        <?php if($produto->deletado_em == null):?>
                        <?php if ($_SESSION['super_admin'] == 1){ ?>    
                            <a href="<?php echo site_url("admin/produtos/editar/$produto->id");?>"class="btn btn-dark btn-sm mr-2">
                                <i class="mdi mdi-pencil ptn-iton-prepend"></i>
                                Editar (Admin)
                            </a>
                        <?php } ?>
                            <a href="<?php echo site_url("admin/produtos/especificacoes/$produto->id");?>"class="btn btn-primary btn-sm mr-2">
                                <i class="mdi mdi-pencil ptn-iton-prepend"></i>
                                Editar
                            </a>
                        <?php if ($_SESSION['super_admin'] == 1){ ?>
                            <a href="<?php echo site_url("admin/produtos/excluir/$produto->id");?>"class="btn btn-danger btn-sm mr-2">
                                <i class="mdi mdi-trash-can ptn-iton-prepend"></i>
                                Excluir
                            </a>
                        <?php } ?>
                            <a href="<?php echo site_url("admin/produtos");?>"class="btn btn-light text-dark btn-sm">
                                <i class="mdi mdi-arrow-left ptn-iton-prepend"></i>
                                Voltar
                            </a>
                    
                        <?php else:?>

                            <a data-toggle="tooltip" data-placement="top" title="Desfazer Exclusão" href="<?php echo site_url("admin/produtos/desfazerexclusao/$produto->id");?>"class="btn btn-dark btn-sm">
                                    <i class="mdi mdi-undo btn-icon-prepend"></i>
                                    Desfazer
                            </a>

                            <a href="<?php echo site_url("admin/produtos");?>"class="btn btn-light text-dark btn-sm">
                                <i class="mdi mdi-arrow-left ptn-iton-prepend"></i>
                                Voltar
                            </a>

                            


                        <?php endif;?>

                        
                           
                    
                        
                        
                        </div>
                        


                     


                    </div>
                </div>
        </div>
</div>


<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<?php echo $this->endSection(); ?>