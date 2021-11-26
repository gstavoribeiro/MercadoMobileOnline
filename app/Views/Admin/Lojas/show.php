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

                        <?php if ($loja->logo):   ?>


                            <img class="card-img-top w-75" src="data:image/png;base64,<?php echo $loja->logo;    ?>" alt="<?php echo esc($loja->nome); ?>">

                        <?php else:   ?> 

                            <img class="card-img-top w-75" src="<?php echo site_url('admin/images/loja-sem-imagem.png');   ?>" alt="loja sem imagem">

                        <?php endif;   ?>


                        </div>

                        <a href="<?php echo site_url("admin/lojas/editarimagem/$loja->id");?>"class="btn btn-outline-primary mt-3 mb-3 btn-sm">
                                <i class="mdi mdi-image ptn-iton-prepend"></i>
                                Editar Imagem
                        </a>
                    
                        <p class="card-text">
                            <span class="font-weight-bold">Nome: </span>
                            <?php echo esc($loja->nome); ?>
                        </p>

                        <div class="mt-4"> 

                       


                        <?php if($loja->deletado_em == null):?>
                            
                            <a href="<?php echo site_url("admin/lojas/editar/$loja->id");?>"class="btn btn-dark btn-sm mr-2">
                                <i class="mdi mdi-pencil ptn-iton-prepend"></i>
                                Editar
                            </a>
                            <a href="<?php echo site_url("admin/lojas/excluir/$loja->id");?>"class="btn btn-danger btn-sm mr-2">
                                <i class="mdi mdi-trash-can ptn-iton-prepend"></i>
                                Excluir
                            </a>

                            <a href="<?php echo site_url("admin/lojas");?>"class="btn btn-light text-dark btn-sm">
                                <i class="mdi mdi-arrow-left ptn-iton-prepend"></i>
                                Voltar
                            </a>
                    
                        <?php else:?>

                            <a data-toggle="tooltip" data-placement="top" title="Desfazer Exclusão" href="<?php echo site_url("admin/lojas/desfazerexclusao/$loja->id");?>"class="btn btn-dark btn-sm">
                                    <i class="mdi mdi-undo btn-icon-prepend"></i>
                                    Desfazer
                            </a>

                            <a href="<?php echo site_url("admin/lojas");?>"class="btn btn-light text-dark btn-sm">
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