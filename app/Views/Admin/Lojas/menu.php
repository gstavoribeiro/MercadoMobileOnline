<?php echo $this->extend('Admin/layout/principal_autenticacao'); ?>

<?php echo $this->section('titulo'); ?>

<?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>



<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>



<div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">


              <div class="brand-logo">
              <h3>Mercado Mobile Online</h3>
              </div>
              <h4>Olá, seja bem-vindo(a)!</h4>
              <h6 class="font-weight-light mb-3">Por favor selecione a loja</h6>
           
            <?php echo form_open('login/selecionarLoja');   ?>
            <select class="form-control" name="loja_id">

            
            <option value="">Escolha a Loja</option>
                <?php foreach ($lojas as $loja): ?>

                   
                    <?php if(isset($loja->id)):    ?>


                        <option value="<?php echo $loja->id;   ?>" > <?php echo esc($loja->nome);?></option>

                    <?php endif; ?>

                <?php endforeach;   ?>



            </select>

            <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" >Entrar na Loja</button>
            </div>
              
            <?php echo form_close();?>

            
            
            
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
</div>
    <!-- page-body-wrapper ends -->

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<?php echo $this->endSection(); ?>

