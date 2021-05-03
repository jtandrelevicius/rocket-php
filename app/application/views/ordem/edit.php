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
                                <li class="breadcrumb-item"><a href="<?php echo base_url('OrdemServico') ?>">Ordens de Serviços</a></li>
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
                                <a href="<?php echo base_url('OrdemServico') ?>" class="btn btn-white">
                                    Cancelar
                                </a>
                            </span>

                            <button type="submit" class="btn btn-primary d-none d-sm-inline-block"
                            <?php echo ($ordem_servico->ordem_servico_status == 1 ? 'disabled' : '')?>>Salvar</button>

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

<legend class="font-small"><i class="fas fa-tools"></i>&nbsp;&nbsp;Escolha os serviços</legend>
                    <!--Row1-->
                    <div class="row">
                        <div class="ui-widget col-lg-12 mb-3 mt-1">
                            <input id="buscar_servicos" class="search form-control form-control-lg col-lg-12" placeholder="Que serviço você está buscando?">
                        </div>
                    </div>



                    <!--Row1-->

                    <!--Row2-->
                
                        <div class="row">
                            <div class="table-responsive">
                                <table id="table_servicos" class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="" style="width: 55%">Serviço</th>
                                            <th class="text-right pr-2" style="width: 12%">Valor unitário</th>
                                            <th class="text-center" style="width: 8%">Qty</th>
                                            <th class="" style="width: 8%">% Desc</th>
                                            <th class="text-right pr-2" style="width: 15%">Total</th>
                                            <th class="" style="width: 25%"></th>
                                            <th class="" style="width: 25%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="lista_servicos" class="">

                                        <?php if (isset($os_tem_servicos)) : ?>

                                            <?php $i = 0; ?>

                                            <?php foreach ($os_tem_servicos as $os_servico) : ?>

                                                <?php $i++; ?>

                                                <tr>
                                                    <td><input type="hidden" name="servico_id[]" value="<?php echo $os_servico->ordem_ts_id_servico ?>" data-cell="A<?php echo $i; ?>" data-format="0" readonly></td>
                                                    <td><input title="Descrição do servico" type="text" name="servico_descricao[]" value="<?php echo $os_servico->servico_descricao ?>" class="servico_descricao form-control form-control-user input-sm" data-cell="B<?php echo $i; ?>" readonly></td>
                                                    <td><input title="Valor unitário do servico" name="servico_preco[]" value="<?php echo $os_servico->ordem_ts_valor_unitario ?>" class="form-control form-control-user input-sm text-right money pr-1" data-cell="C<?php echo $i; ?>" data-format="R$ 0,0.00" readonly></td>
                                                    <td><input title="Digite a quantidade apenas em número inteiros" type="text" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" name="servico_quantidade[]" value="<?php echo $os_servico->ordem_ts_quantidade ?>" class="qty form-control form-control-user text-center" data-cell="D<?php echo $i; ?>" data-format="0[.]00" required></td>
                                                    <td><input title="Insira o desconto" name="servico_desconto[]" class="form-control form-control-user input-sm text-right" value="<?php echo $os_servico->ordem_ts_valor_desconto ?>" data-cell="E<?php echo $i; ?>" data-format="0,0[.]00 %" required></td>
                                                    <td><input title="Valor total do servico selecionado" name="servico_item_total[]" value="<?php echo $os_servico->ordem_ts_valor_total ?>" class="form-control form-control-user input-sm text-right pr-1" data-cell="F<?php echo $i; ?>" data-format="R$ 0,0.00" data-formula="D<?php echo $i; ?>*(C<?php echo $i; ?>-(C<?php echo $i; ?>*E<?php echo $i; ?>))" readonly></td>
                                                    <td class="text-center"><input type="hidden" name="valor_desconto_servico[]" data-cell="H<?php echo $i; ?>" data-format="R$ 0,0.00" data-formula="((C<?php echo $i; ?>*D<?php echo $i; ?>)-F<?php echo $i; ?>)"><button title="Remover o servico" class="btn-remove btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                                </tr>


                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr class="">
                                            <td colspan="5" class="text-end border-0">
                                                <label class="font-weight-bold pt-1" for="total">Valor de desconto:</label>
                                            </td>
                                            
                                            <td class="text-end border-0">
                                                <input type="text" name="ordem_servico_valor_desconto" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="L1" data-formula="SUM(H1:H5)" readonly="">
                                            </td>
                                            <td class="border-0">&nbsp;</td>
                                        </tr>
                                        <tr class="">
                                            <td colspan="5" class="text-end border-0">
                                                <label class="font-weight-bold pt-1" for="total">Total a pagar:</label>
                                            </td>
                                            <td class="text-end border-0">
                                                <input type="text" name="ordem_servico_valor_total" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="G2" data-formula="SUM(F1:F5)" readonly="">
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
                                    <select class="form-select contas_receber" name="ordem_servico_cliente_id" required="">
                                        <?php foreach ($clientes as $cliente) : ?>
                                            <option value="<?php echo $cliente->cliente_id; ?>" <?php echo ($cliente->cliente_id == $ordem_servico->ordem_servico_cliente_id ? 'selected' : '') ?>><?php echo $cliente->cliente_nome . ' ' . $cliente->cliente_sobrenome . ' | CPF ou CNPJ: ' . $cliente->cliente_cpf_cnpj; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('ordem_servico_cliente_id', '<div class="text-danger small">', '</div>') ?>
                                </div>

                                <div class="col-md-3">
                                    <label class="small my-0">Forma de pagamento <span class="text-danger">*</span></label>
                                    <select id="id_pagamento" class="form-select" name="ordem_servico_forma_pagamento_id">
                                        <?php foreach ($formas_pagamentos as $forma_pagamento) : ?>
                                            <option value="<?php echo $forma_pagamento->forma_pagamento_id; ?>" <?php echo ($forma_pagamento->forma_pagamento_id == $ordem_servico->ordem_servico_forma_pagamento_id ? 'selected' : '') ?>><?php echo $forma_pagamento->forma_pagamento_nome; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('ordem_servico_forma_pagamento_id', '<div class="text-danger small">', '</div>') ?>
                                </div>

                                <div class="col-md-3">
                                    <label class="small my-0">Status da ordem <span class="text-danger">*</span></label>
                                    <select class="form-select" name="ordem_servico_status">
                                        <option value="0" <?php echo $ordem_servico->ordem_servico_status == 0 ? 'selected' : '' ?>>Aberta</option>
                                        <option value="1" <?php echo $ordem_servico->ordem_servico_status == 1 ? 'selected' : '' ?>>Fechada</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <br>

                        <!-- row3-->

                        <!-- row4-->
                        <div class="row">
                        <div class="form-group row">

                            <div class="col-sm-6 mb-1 mb-sm-0">
                                <label class="small my-0">Equipamento <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-user" value="<?php echo set_value('ordem_servico_equipamento', $ordem_servico->ordem_servico_equipamento); ?>" name="ordem_servico_equipamento" required="">
                                <?php echo form_error('ordem_servico_equipamento', '<div class="text-danger small">', '</div>') ?>
                            </div>

                            <div class="col-sm-3 mb-1 mb-sm-0">
                                <label class="small my-0">Marca <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-user" value="<?php echo set_value('ordem_servico_marca_equipamento', $ordem_servico->ordem_servico_marca_equipamento); ?>" name="ordem_servico_marca_equipamento" required="">
                                <?php echo form_error('ordem_servico_marca_equipamento', '<div class="text-danger small">', '</div>') ?>
                            </div>

                            <div class="col-sm-3 mb-1 mb-sm-0">
                                <label class="small my-0">Modelo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-user" value="<?php echo set_value('ordem_servico_modelo_equipamento', $ordem_servico->ordem_servico_modelo_equipamento); ?>" name="ordem_servico_modelo_equipamento" required="">
                                <?php echo form_error('ordem_servico_modelo_equipamento', '<div class="text-danger small">', '</div>') ?>
                            </div>

                        </div>
                        
                        </div>
                        <br>
                        <!-- row4-->


                        <div class="row">
                            <div class="form-group row">

                                <div class="col-sm-6 mb-1 mb-sm-0">
                                    <label class="small my-0">Defeitos <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo set_value('ordem_servico_defeito', $ordem_servico->ordem_servico_defeito); ?>" name="ordem_servico_defeito" required="">
                                    <?php echo form_error('ordem_servico_defeito', '<div class="text-danger small">', '</div>') ?>
                                </div>

                                <div class="col-sm-6 mb-1 mb-sm-0">
                                    <label class="small my-0">Acessórios <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-user" value="<?php echo set_value('ordem_servico_acessorios', $ordem_servico->ordem_servico_acessorios); ?>" name="ordem_servico_acessorios" required="">
                                    <?php echo form_error('ordem_servico_acessorios', '<div class="text-danger small">', '</div>') ?>
                                </div>

                            </div>


                        </div>
                        <br>

                        <div class="row">
                            <div class="form-group row">

                                <div class="col-sm-12 mb-1 mb-sm-0">
                                    <label class="small my-0">Observações <span class="text-danger"></span></label>
                                    <textarea type="text" class="form-control form-control-user" value="" name="ordem_servico_obs"><?php echo set_value('ordem_servico_obs', $ordem_servico->ordem_servico_obs); ?></textarea>
                                </div>

                            </div>
                        </div>
                    </fieldset>
                </div>

                <input type="hidden" name="ordem_servico_id" value="<?php echo $ordem_servico->ordem_servico_id ?>">

            </div>
    </div>
</div>
</form>
<!-- Content here -->
</div>