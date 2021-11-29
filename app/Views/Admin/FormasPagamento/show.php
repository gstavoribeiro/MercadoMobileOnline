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

                        <?php if($forma->id == 1): ?>

                            <div class="alert alert-primary" role="alert">

                            A forma de pagamento <strong><?php echo esc($forma->nome); ?></strong>
                            não pode ser <span class="text-danger">editada ou excluida</span>, pois essa opção terá vinculada ou não o envio de troco para o entregador quando o mesmo estiver no <strong>Checkout</strong>

                        </div>


                        <?php endif; ?>
                    
                        <p class="card-text">
                            <span class="font-weight-bold">Nome: </span>
                            <?php echo esc($forma->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Ativo: </span>
                            <?php echo esc($forma->ativo ? 'Sim' : 'Não'); ?>
                        </p>

                        <p class="card-text">
                            <span class="font-weight-bold">Criado: </span>
                            <?php echo $forma->criado_em->humanize(); ?>
                        </p>

                        <?php if($forma->deletado_em == null):?>

                        <p class="card-text">
                            <span class="font-weight-bold">Atualizado: </span>
                            <?php echo $forma->atualizado_em->humanize(); ?>
                        </p>

                        <?php else:?>
                            
                            <p class="card-text">
                                <span class="font-weight-bold text-danger">Excluido: </span>
                                <?php echo $forma->deletado_em->humanize(); ?>
                            </p>



                        <?php endif;?>

                        
                        <?php echo form_open("admin/formasPagamento/vincularforma/$forma->id"); ?>

                            <div class="form-check form-check-flat form-check-primary mb-2">
                            <label for="id_forma_pagamento" class="form-check-label">
                                <input type="hidden" name="id_forma_pagamento" value="0">
                                <input type="checkbox" class="form-check-input" id="id_forma_pagamento" name="id_forma_pagamento" value=<?php echo $forma->id?>>
                                    Vincular na Loja
                            </label>

                            <div class="form-check form-check-flat form-check-primary mb-2">
                            <label for="ativo" class="form-check-label">
                                <input type="hidden" name="ativo" value="0">
                                <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if(old('ativo', $forma->ativo)): ?> checked= "" <?php endif; ?>>
                                    Ativo
                            </label>
                        </div>

                            <button type="submit" class="btn btn-primary mr-2 mt-2 btn-sm">
                                <i class="mdi mdi-check-circle ptn-iton-prepend"></i>
                                Salvar
                            </a> 
                            
                            </button>
                        </div>

                        

                        <?php echo form_close(); ?>

                        <div class="mt-4"> 


                        <?php if($forma->deletado_em == null):?>
                            
                            <?php if($forma->id != 1):  ?>
                                <?php if ($_SESSION['super_admin'] == 1){ ?>
                                <a href="<?php echo site_url("admin/formas/editar/$forma->id");?>"class="btn btn-dark btn-sm mr-2">
                                    <i class="mdi mdi-pencil ptn-iton-prepend"></i>
                                    Editar
                                </a>
                                <a href="<?php echo site_url("admin/formas/excluir/$forma->id");?>"class="btn btn-danger btn-sm mr-2">
                                    <i class="mdi mdi-trash-can ptn-iton-prepend"></i>
                                    Excluir
                                </a>
                                <?php } ?>
                            <?php endif;   ?>

                           

                            <a href="<?php echo site_url("admin/formas");?>"class="btn btn-light text-dark btn-sm">
                                <i class="mdi mdi-arrow-left ptn-iton-prepend"></i>
                                Voltar
                            </a>
                    
                        <?php else:?>

                            <a data-toggle="tooltip" data-placement="top" title="Desfazer Exclusão" href="<?php echo site_url("admin/formas/desfazerexclusao/$forma->id");?>"class="btn btn-dark btn-sm">
                                    <i class="mdi mdi-undo btn-icon-prepend"></i>
                                    Desfazer
                            </a>

                            <a href="<?php echo site_url("admin/formas");?>"class="btn btn-light text-dark btn-sm">
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