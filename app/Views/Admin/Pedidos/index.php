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
                        <input id="query" name="query" placeholder="Pesquise por um pedido" class="form-control bg-light mb-5">
                    </div>

                    <?php if(!isset($pedidos)):   ?>

                    <p>Não há pedidos para exibir</p>

                    
                    <?php else:  ?>

                        <div class="table-responsive">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Codigo do Pedido</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Data do Pedido</th>
                            <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo site_url("admin/pedidos/show/$pedido->id"); ?>"><?php echo $pedido->id; ?></a> 
                                </td>
                                <td><?php echo $pedido->cliente;  ?></td>
                                <td>R$&nbsp;<?php echo esc(number_format($pedido->valor_total, 2));  ?></td>
                                <td><?php echo $pedido->criado_em;  ?></td>
                                <td><?php $pedido->exibeSituacaoPedido();  ?></td>
                        <?php endforeach;  ?>

                        </tbody>
                        </table>
                    </div>

                    <?php endif;  ?>

                    

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

                    url: "<?php echo site_url('admin/pedidos/procurar');?>",
                    dataType: "json",
                    data:{
                        term: request.term
                    
                    },

                        success: function (data){
                            if (data.length < 1){

                                var data= [
                                    {
                                        label: 'Pedido não encontrado',
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

                    window.location.href = '<?php echo site_url('admin/pedidos/show/');?>' + ui.item.id;
                    
                }

            }

        }); //Fim do auto-complete


    })



</script>



<?php echo $this->endSection(); ?>