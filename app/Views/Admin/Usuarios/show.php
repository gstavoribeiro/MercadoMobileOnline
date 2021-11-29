<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">

                    <div class="card-header bg-primary pb-0 pt-4">

                        <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>

                    </div>
                    <div class="card-body">
                    
                        <p class="card-text">
                            <span class="font-weight-bold">Nome: </span>
                            <?php echo esc($usuario->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">E-mail: </span>
                            <?php echo esc($usuario->email); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Data de Nascimento: </span>
                            <?php echo esc($usuario->data_nascimento); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Telefone: </span>
                            <?php echo esc($usuario->telefone); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Ativo: </span>
                            <?php echo esc($usuario->ativo ? 'Sim' : 'Não'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Perfil: </span>
                            <?php echo esc($usuario->is_admin ? 'Administrador' : 'Cliente'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Criado: </span>
                            <?php echo $usuario->criado_em->humanize(); ?>
                        </p>

                   

                        <div class="mt-4"> 


                        <?php if($usuario->deletado_em == null):?>
                            
                            <a href="<?php echo site_url("admin/usuarios/editar/$usuario->id");?>"class="btn btn-dark btn-sm mr-2">
                                <i class="mdi mdi-pencil ptn-iton-prepend"></i>
                                Editar
                            </a>
                            <a href="<?php echo site_url("admin/usuarios/excluir/$usuario->id");?>"class="btn btn-danger btn-sm mr-2">
                                <i class="mdi mdi-trash-can ptn-iton-prepend"></i>
                                Excluir
                            </a>

                            <a href="<?php echo site_url("admin/usuarios");?>"class="btn btn-light text-dark btn-sm">
                                <i class="mdi mdi-arrow-left ptn-iton-prepend"></i>
                                Voltar
                            </a>
                    
                        <?php else:?>

                            <a data-toggle="tooltip" data-placement="top" title="Desfazer Exclusão" href="<?php echo site_url("admin/usuarios/desfazerexclusao/$usuario->id");?>"class="btn btn-dark btn-sm">
                                    <i class="mdi mdi-undo btn-icon-prepend"></i>
                                    Desfazer
                            </a>

                            <a href="<?php echo site_url("admin/usuarios");?>"class="btn btn-light text-dark btn-sm">
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