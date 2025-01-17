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

                        <?php if(session()->has('errors_model')): ?>

                            <ul>
                                <?php foreach (session('errors_model') as $erros):    ?>
                                    
                                    <li class="text-danger"><?php echo $erros; ?></li>

                                <?php endforeach; ?>

                            </ul>


                        <?php endif; ?>
                    


                        <?php echo form_open_multipart("admin/lojas/upload/$loja->id"); ?>

                        <div class="form-group mb-5">
                            <label>Upload de imagem</label>
                            <input type="file" name="foto_loja" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Escolha uma imagem">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        

                        <button type="submit" class="btn btn-primary mr-2 btn-sm">
                            <i class="mdi mdi-check-circle ptn-iton-prepend"></i>
                            Salvar
                        </a>
                        </button>

                        <a href="<?php echo site_url("admin/lojas/show/$loja->id");?>"class="btn btn-light text-dark btn-sm">
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
<script src="<?php echo site_url('admin/js/file-upload.js'); ?>"></script>


<?php echo $this->endSection(); ?>