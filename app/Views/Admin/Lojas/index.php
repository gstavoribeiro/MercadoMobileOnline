<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>" />


<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo $titulo; ?></h4>
                    
                    <div class="ui-widget">
                        <input id="query" name="query" placeholder="Pesquise por um loja" class="form-control bg-light mb-5">
                    </div>
                    <?php if ($_SESSION['super_admin'] == 1){ ?>
                    <a href="<?php echo site_url("admin/lojas/criar");?>"class="btn btn-success btn-sm float-left mb-5">
                        <i class="mdi mdi-plus btn-icon-prepend"></i>
                         Cadastrar
                    </a>
                    <?php } ?>


                    <div class="table-responsive">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>CNPJ</th>
                            <th>Data de criação</th>
                            <th>Ativo</th>
                            <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lojas as $loja): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo site_url("admin/lojas/show/$loja->id"); ?>"><?php echo $loja->nome; ?></a> 
                                </td>
                                <td><?php echo $loja->rua;  ?></td>
                                <td><?php echo $loja->cnpj;  ?></td>
                                <td><?php echo $loja->criado_em->humanize();  ?></td>
                                <td><?php echo ($loja->ativo && $loja->deletado_em == null ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>') ?></td>
                                <td>
                                    <?php echo ($loja->deletado_em == null ? '<label class="badge badge-primary">Disponivel</label>' : '<label class="badge badge-danger">Excluido</label>') ?>

                                    <?php if($loja->deletado_em != null):?>
                                        <a href="<?php echo site_url("admin/lojas/desfazerexclusao/$loja->id");?>"class="badge badge-dark ml-5">
                                            <i class="mdi mdi-undo btn-icon-prepend"></i>
                                            Desfazer
                                        </a>


                                    <?php endif; ?>      


                                </td>


                        <?php endforeach;  ?>

                    

                        </tbody>
                        </table>
                    </div>

                    <div class="mt-3"> 
                                    
                        <?php echo $pager->links();    ?>


                    </div>
                    </div>
                </div>
        </div>
</div>



<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>  

<script>

    $(function(){
        
        $( "#query" ).autocomplete({
            
            source: function(request, response){

                $.ajax({

                    url: "<?php echo site_url('admin/lojas/procurar');?>",
                    dataType: "json",
                    data:{
                        term: request.term
                    
                    },

                        success: function (data){
                            if (data.length < 1){

                                var data= [
                                    {
                                        label: 'loja não encontrado',
                                        value: -1
                                    }
                                ];
                            }

                            response(data); // Aqui Tem Valor no Data

                        },

                }); //Fim do Ajax



            },

            minLength: 1,
            select: function(event, ui){

                if(ui.item.value == -1){

                    $(this).val("");
                    return false

                }else{

                    window.location.href = '<?php echo site_url('admin/lojas/show/');?>' + ui.item.id;
                    
                }

            }

        }); //Fim do auto-complete


    })



    

</script>

<script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>  
<script src="<?php echo site_url('admin/vendors/mask/app.js'); ?>"></script>  



<?php echo $this->endSection(); ?>