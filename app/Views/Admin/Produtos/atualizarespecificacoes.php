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
                    


                        <?php echo form_open("admin/produtos/atualizarespecificacoes/$produto->id"); ?>

                        <div class="form-group col-md-8">
                            <label for="preco">Preco</label>
                            <input type="text" class="form-control" name="preco" id="preco" value="<?php echo $especificacao['preco'];?>">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="nome">Quantidade</label>
                            <input type="text" class="form-control" name="quantidade" id="quantidade" value="<?php echo $especificacao['quantidade'];?>">
                        </div> 
                        
                        <button type="submit" class="btn btn-primary mr-2 btn-sm">
                            <i class="mdi mdi-check-circle ptn-iton-prepend"></i>
                            Salvar
                            </a>
                        </button>
    

                            <a href="<?php echo site_url("admin/produtos/show/$produto->id");?>"class="btn btn-light text-dark btn-sm">
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