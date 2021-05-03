<?php $this->load->view('layout/navbar') ?>

<div class="content">
    <div class="container-fluid">
        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $titulo ?></a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">
                        <span class="text-truncate"><?php echo $titulo ?></span>
                    </h2>
                </div>
             
                <div class="col-auto">
                    <div class="btn-list">

                        <a href="<?php echo base_url('vendas/add') ?>" class="btn btn-primary">
                            <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Adicionar
                        </a>
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
            <div class="card-header">
                <h3 class="card-title">Vendas</h3>

            </div>

            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap dataTable">
                    <thead>
                        <tr>
                            <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                            <th class="w-1">Código</th>
                            <th>Data Emissão</th>
                            <th>Cliente</th>
                            <th>Forma de Pagamento</th>
                            <th>Valor Total R$</th>
                            <th>Situação</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas as $venda) : ?>
                            <tr>
                                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                <td><?php echo $venda->venda_id ?></td>
                                <td><?php echo formata_data_banco_sem_hora($venda->venda_data_emissao) ?></td>

                                <td>
                                    <?php echo $venda->cliente_nome ?>
                                    <p class="text-muted" style="font-size: 11px;"><?php echo $venda->cliente_telefone ?></p>
                                </td>
                                <td><?php echo $venda->forma_pagamento ?>
                                </td>
                                <td><?php echo 'R$&nbsp;' . $venda->venda_valor_total ?></td>
                                <td>
                                    <?php
                                    if ($venda->venda_status == 1) {
                                        echo '<span class="badge bg-danger me-1"></span>cancelada';
                                    } else if ($venda->venda_status == 0) {
                                        echo '<span class="badge bg-success me-1"></span>finalizada';
                                    } else if ($venda->venda_status == 2) {
                                        echo '<span class="badge bg-purple me-1"></span>emitida nf-e';
                                    } else if ($venda->venda_status == 3) {
                                        echo '<span class="badge bg-yellow me-1"></span>emitida nfc-e';
                                    }

                                    ?>

                                </td>



                                <td class="text-end">

                                    <div class="dropdown">
                                        <?php if ($venda->venda_status == 2) {
                                            echo  '<a href="" class="btn btn-lista btn-green"><i class="fas fa-cloud-download-alt"></i></a>';
                                        }
                                        ?>

                                        <?php if ($venda->venda_status == 3) {
                                            echo  '<a href="" class="btn btn-lista btn-green"><i class="fas fa-cloud-download-alt"></i></a>';
                                        }
                                        ?>

                                        <a title="Imprimir" href="<?php echo base_url('vendas/visualizar_cupom/' . $venda->venda_id) ?>" class="btn btn-lista btn-primary" target="_blank"><i class="fas fa-print"></i></a>

                                        <a title="Cancelar Venda" href="<?php echo base_url('vendas/cancel/' . $venda->venda_id) ?>" class="btn btn-lista btn-danger"><i class="fas fa-ban"></i></a>

                                        <a class="btn btn-lista btn-default" href="#" class="card-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="margin: 0px;">
                                            <a href="<?php echo base_url('vendas/visualizar_cupom/' . $venda->venda_id) ?>" class="dropdown-item" target="_blank">Visualizar Pedido</a>
                                            <a href="#" class="dropdown-item">...</a>

                                        </div>

                                    </div>
                                </td>


                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Content here -->
    </div>

