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

                        <a href="<?php echo base_url('OrdemServico/add')?>" class="btn btn-primary">
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
                <h3 class="card-title">Suprimentos</h3>
                
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
                    <?php foreach ($ordem_servicos as $os) : ?>
                            <tr>
                                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                <td><?php echo $os->ordem_servico_id ?></td>
                                <td><?php echo formata_data_banco_sem_hora($os->ordem_servico_data_emissao)?></td>
                                
                                <td>
                                <?php echo $os->cliente_nome?>
                                <p class="text-muted" style="font-size: 11px;"><?php echo $os->cliente_telefone?></p>
                                </td>
                                <td><?php echo $os->forma_pagamento ?>
                                <p class="text-muted" style="font-size: 11px;"><?php echo 
                                ($os->ordem_servico_status == 1) ? 'pago' :'' ?></p>
                                </td>
                                <td><?php echo 'R$&nbsp;'.$os->ordem_servico_valor_total ?></td>
                                <td>
                                    <?php
                                        if ($os->ordem_servico_status == 1) {
                                           echo '<span class="badge bg-success me-1"></span>finalizada';
                                        }else if($os->ordem_servico_status == 0){
                                            echo '<span class="badge bg-info me-1"></span>pendente';   
                                        }
                                    ?>
                                   
                                </td>

                                <td class="text-end">
                                    <a title="Imprimir" href="" class="btn btn-lista btn-orange"><i class="fas fa-print"></i></a>
                                    <a title="Visualizar" href="<?php echo base_url('OrdemServico/visualizar/' .$os->ordem_servico_id) ?>" class="btn btn-lista btn-success"><i class="fas fa-eye"></i></a>
                                    <a title="Editar" href="<?php echo base_url('OrdemServico/edit/' .$os->ordem_servico_id) ?>" class="btn btn-lista btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                    <a title="Excluir" href="<?php echo base_url('OrdemServico/del/' .$os->ordem_servico_id) ?>" class="btn btn-lista btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>

        </div>
        <!-- Content here -->
    </div>