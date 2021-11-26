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
                            <span class="font-weight-bold">Cliente: </span>
                            <?php echo $pedidos->cliente; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Endereço: </span>
                            <?php echo $pedidos->rua; ?>,
                            <?php echo $pedidos->numero; ?> -
                            <?php echo $pedidos->bairro; ?> -
                            <?php echo $pedidos->cidade; ?> 
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Forma de Pagamento: </span>
                            <?php echo $pedidos->forma_pagamento; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Pedido realizado em: </span>
                            <?php echo $pedidos->criado_em; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Valor dos Produtos: </span>
                            R$&nbsp;<?php echo (number_format($pedidos->valor_produtos, 2)); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Valor da Entrega: </span>
                            R$&nbsp;<?php echo (number_format($pedidos->valor_entrega, 2)); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Valor Total: </span>
                            R$&nbsp;<?php echo (number_format($pedidos->valor_total, 2)); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Situação: </span>
                            <?php $pedidos->exibeSituacaoPedido(); ?>
                        </p>
                    
                       

                        <div class="table-responsive">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($produtos as $produto): ?>
                           		 <tr>
                                    <td><?php echo $produto->produto;  ?></td>
                                    <td>R$&nbsp;<?php echo esc(number_format($produto->preco, 2));  ?></td>
                                    <td><?php echo $produto->quantidade;  ?></td>
    
                        
                        <?php endforeach;  ?>

                        </tbody>
                        </table>
                        </div>





                   
                        <div class="mt-4"> 

                         
                        <a href="<?php echo site_url("admin/pedidos/editar/$pedidos->id");?>"class="btn btn-dark btn-sm mr-2">
                                <i class="mdi mdi-pencil ptn-iton-prepend"></i>
                                Editar
                            </a>
                            <?php if ($_SESSION['super_admin'] == 1){ ?>
                            <a href="<?php echo site_url("admin/pedidos/excluir/$pedidos->id");?>"class="btn btn-danger btn-sm mr-2">
                                <i class="mdi mdi-trash-can ptn-iton-prepend"></i>
                                Excluir
                            </a>
                            <?php } ?>

                            <a href="<?php echo site_url("admin/pedidos");?>"class="btn btn-light text-dark btn-sm">
                                <i class="mdi mdi-arrow-left ptn-iton-prepend"></i>
                                Voltar
                            </a>
                        
                        </div>
                    
                    </div>
                </div>
        </div>
</div>


<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<?php echo $this->endSection(); ?>