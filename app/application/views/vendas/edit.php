<?php $this->load->view('layout/navbar') ?>

<div class="content">
    <div class="container-fluid">
        <form class="user" action="" id="form" name="form_edit" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <!-- Page title -->
            <div class="page-header">
                <div class="row align-items-center mw-100">
                    <div class="col">
                        <div class="mb-1">
                            <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('vendas') ?>">Pedido de Venda</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $titulo ?></a></li>
                            </ol>
                        </div>
                        <h2 class="page-title">
                            <span class="text-truncate"><?php echo $titulo ?></span>
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <span class="d-none d-sm-inline">
                                <a href="<?php echo base_url('vendas') ?>" class="btn btn-white">
                                    Cancelar
                                </a>
                            </span>

                            <button type="submit" class="btn btn-primary d-none d-sm-inline-block" <?php echo ($venda->venda_status == 1 ? 'disabled' : '') ?>>Salvar</button>

                        </div>
                    </div>
                </div>
            </div>
            <?php if ($message = $this->session->flashdata('sucesso')) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-important alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="far fa-smile"></i>&nbsp; <?php echo $message; ?>
                                </div>
                            </div>
                            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($message = $this->session->flashdata('error')) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="fas fa-exclamation-triangle"></i>&nbsp; <?php echo $message; ?>
                                </div>
                            </div>
                            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card">

                <div class="card-body">
                    <fieldset id="vendas" class="mt-3 border p-2">

                        <legend class="font-small"><i class="fas fa-barcode"></i>&nbsp;&nbsp;Escolha os Produtos</legend>
                        <!--Row1-->
                        <div class="row">
                            <div class="ui-widget col-lg-12 mb-3 mt-1">
                                <input id="buscar_produtos" class="search form-control form-control-lg col-lg-12" placeholder="Que produto você está buscando?">
                            </div>
                        </div>



                        <!--Row1-->

                        <!--Row2-->

                        <div class="row">
                            <div class="table-responsive">
                                <table id="table_produtos" class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="" style="width: 55%">Produto</th>
                                            <th class="text-right pr-2" style="width: 12%">Valor unitário</th>
                                            <th class="text-center" style="width: 8%">Qty</th>
                                            <th class="" style="width: 8%">% Desc</th>
                                            <th class="text-right pr-2" style="width: 15%">Total</th>
                                            <th class="" style="width: 25%"></th>
                                            <th class="" style="width: 25%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="lista_produtos" class="item">

                                        <?php // if (isset($venda_produtos)): 
                                        ?>

                                        <?php $i = 0; ?>

                                        <?php foreach ($venda_produtos as $venda_produto) : ?>
                                    
                                            <?php $i++; ?>

                                            <tr>
                                                <td><input type="hidden" name="produto_id[]" value="<?php echo $venda_produto->venda_produto_id_produto; ?>" data-cell="A<?php echo $i; ?>" data-format="0" readonly></td>
                                                <td><input title="Descrição do produto" type="text" name="produto_descricao[]" value="<?php echo $venda_produto->produto_descricao; ?>" class="produto_descricao form-control form-control-user input-sm" data-cell="B<?php echo $i; ?>" readonly></td>
                                                <td><input title="Valor unitário do produto" name="produto_preco_venda[]" value="<?php echo $venda_produto->venda_produto_valor_unitario; ?>" class="form-control form-control-user input-sm text-right money pr-1" data-cell="C<?php echo $i; ?>" data-format="R$ 0,0.00" readonly></td>
                                                <td><input title="Digite a quantidade apenas em número inteiros" type="text" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" name="produto_quantidade[]" value="<?php echo $venda_produto->venda_produto_quantidade; ?>" class="qty form-control form-control-user text-center" data-cell="D<?php echo $i; ?>" data-format="0[.]00" required></td>
                                                <td><input title="Insira o desconto" name="produto_desconto[]" class="form-control form-control-user input-sm text-right" value="<?php echo $venda_produto->venda_produto_desconto; ?>" data-cell="E<?php echo $i; ?>" data-format="0,0[.]00 %" required></td>
                                                <td><input title="Valor total do produto selecionado" name="produto_item_total[]" value="<?php echo $venda_produto->venda_produto_valor_total; ?>" class="form-control form-control-user input-sm text-right pr-1" data-cell="F<?php echo $i; ?>" data-format="R$ 0,0.00" data-formula="D<?php echo $i; ?>*(C<?php echo $i; ?>-(C<?php echo $i; ?>*E<?php echo $i; ?>))" readonly></td>
                                                <td class="text-center"><input type="hidden" name="valor_desconto_produto[]" data-cell="H<?php echo $i; ?>" data-format="R$ 0,0.00" data-formula="((C<?php echo $i; ?>*D<?php echo $i; ?>)-F<?php echo $i; ?>)"><button title="Remover o produto" class="btn-remove btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                            </tr>


                                        <?php endforeach; ?>

                                        <?php // endif; 
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr class="">
                                            <td colspan="5" class="text-end border-0">
                                                <label class="font-weight-bold pt-1" for="total">Valor de desconto:</label>
                                            </td>
                                            <td class="text-end border-0">
                                                <input type="text" name="venda_valor_desconto" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="L1" data-formula="SUM(H1:H5)" readonly="">
                                            </td>
                                            <td class="border-0">&nbsp;</td>
                                        </tr>
                                        <tr class="">
                                            <td colspan="5" class="text-end border-0">
                                                <label class="font-weight-bold pt-1" for="total">Total a pagar:</label>
                                            </td>
                                            <td class="text-end border-0">
                                                <input type="text" name="venda_valor_total" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="G2" data-formula="SUM(F1:F5)" readonly="">
                                            </td>
                                            <td class="border-0">&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </fieldset>

                    <!--Row2-->

                    <!-- row3-->
                    <fieldset class="mt-3 border p-2">
                        <legend class="font-small"><i class="far fa-list-alt"></i>&nbsp;&nbsp;Dados da ordem</legend>

                        <div class="row">
                            <div class="form-group row">

                                <div class="col-sm-6 mb-1 mb-sm-0">
                                    <label class="small my-0">Escolha o cliente <span class="text-danger">*</span></label>
                                    <select class="form-select contas_receber" name="venda_cliente_id" required="">
                                        <?php foreach ($clientes as $cliente) : ?>
                                            <option value="<?php echo $cliente->cliente_id; ?>" <?php echo ($venda->venda_cliente_id == $cliente->cliente_id ? 'selected' : '') ?>><?php echo $cliente->cliente_nome . ' ' . $cliente->cliente_sobrenome . ' | CPF ou CNPJ: ' . $cliente->cliente_cpf_cnpj; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('venda_cliente_id', '<div class="text-danger small">', '</div>') ?>
                                </div>


                                <div class="col-sm-6 mb-1 mb-sm-0">
                                    <label class="small my-0">Tipo da venda<span class="text-danger">*</span></label>
                                    <select class="form-select" name="venda_tipo" required="">
                                        <option value="1" <?php echo ($venda->venda_tipo == 1 ? 'selected' : '') ?>>Venda à vista</option>
                                        <option value="2" <?php echo ($venda->venda_tipo == 2 ? 'selected' : '') ?>>Venda à prazo</option>
                                    </select>
                                    <?php echo form_error('venda_tipo', '<div class="text-danger small">', '</div>') ?>
                                </div>

                            </div>

                        </div>
                        <br>

                        <!-- row3-->

                        <!-- row4-->
                        <div class="row">
                        <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="small my-0">Forma de pagamento <span class="text-danger">*</span></label>
                                    <select id="id_pagamento" class="form-select forma-pagamento" name="venda_forma_pagamento_id" required="">
                                        <?php foreach ($formas_pagamentos as $forma_pagamento): ?>
                                            <option value="<?php echo $forma_pagamento->forma_pagamento_id; ?>" <?php echo ($forma_pagamento->forma_pagamento_id == $venda->venda_forma_pagamento_id ? 'selected' : '') ?> ><?php echo $forma_pagamento->forma_pagamento_nome; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('venda_forma_pagamento_id', '<div class="text-danger small">', '</div>') ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="small my-0">Escolha o vendedor <span class="text-danger">*</span></label>
                                    <select id="id_vendedor" class="form-select vendedor" name="venda_vendedor_id" required="">
                                        <?php foreach ($vendedores as $vendedor): ?>
                                            <option value="<?php echo $vendedor->vendedor_id; ?>" <?php echo ($vendedor->vendedor_id == $venda->venda_vendedor_id ? 'selected' : '') ?> ><?php echo $vendedor->vendedor_nome_completo . ' | ' . $vendedor->vendedor_codigo; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('venda_vendedor_id', '<div class="text-danger small">', '</div>') ?>
                                </div>


                            </div>

                        </div>
                        <br>
                        <!-- row4-->

                    </fieldset>
                </div>

                <input type="hidden" name="venda_id" value="<?php echo $venda->venda_id ?>" />

            </div>
    </div>
</div>
</form>
<!-- Content here -->
</div>