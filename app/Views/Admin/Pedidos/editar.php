<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

                    <div class="card-header bg-primary pb-0 pt-4">

                        <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>

                    </div>
                    <div class="card-body">

                        <?php if(session()->has('errors_model')): ?>

                            <ul>
                                <?php foreach (session('errors_model') as $erros):    ?>
                                    
                                    <li class="text-danger"><?php echo $erros; ?></li>

                                <?php endforeach; ?>

                            </ul>


                        <?php endif; ?>
                    


                        <?php echo form_open("admin/pedidos/atualizar/$pedidos->id"); ?>
                            
                        
                        <div class="form-check form-check-flat form-check-primary mb-4">
                            <label for="saiu_entrega" class="form-check-label">

                                <input type="radio" class="form-check-input" id="saiu_entrega" value="0" name="status" <?php echo ($pedidos->status == 0 ? 'checked' : '');  ?>>
                                    Pedido realizado

                            </label>

                        </div>
                       
                        <div class="form-check form-check-flat form-check-primary mb-4">
                            <label for="saiu_entrega" class="form-check-label">

                                <input type="radio" class="form-check-input" id="saiu_entrega" value="1" name="status" <?php echo ($pedidos->status == 1 ? 'checked' : '');  ?>>
                                    Entrega em Andamento

                            </label>

                        </div>
                        <div class="form-check form-check-flat form-check-primary mb-4">
                            <label class="form-check-label">

                                <input type="radio" class="form-check-input" value="2" name="status" <?php echo ($pedidos->status == 2 ? 'checked' : '');  ?>>
                                    Pedido entregue

                            </label>

                        </div>
                        <div class="form-check form-check-flat form-check-primary mb-4">
                            <label class="form-check-label">

                                <input type="radio" class="form-check-input" value="3" name="status" <?php echo ($pedidos->status == 3 ? 'checked' : '');  ?>>
                                    Pedido cancelado

                            </label>

                        </div>
                       
                        <button type="submit" class="btn btn-primary mr-2 btn-sm">
                            <i class="mdi mdi-check-circle ptn-iton-prepend"></i>
                            Salvar
                        </a>
                        
                        </button>        
                            <a href="<?php echo site_url("admin/pedidos/show/$pedidos->id");?>"class="btn btn-light text-dark btn-sm">
                                <i class="mdi mdi-arrow-left ptn-icon-prepend"></i>
                                Voltar
                            </a>


                        <?php echo form_close(); ?>

                        
                     


                    </div>


                    
                </div>
        </div>
</div>


<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>  
<script src="<?php echo site_url('admin/vendors/mask/app.js'); ?>"></script>  


<?php echo $this->endSection(); ?>