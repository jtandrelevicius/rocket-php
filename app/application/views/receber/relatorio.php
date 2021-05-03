<?php $this->load->view('layout/navbar') ?>

<div class="content">
    <div class="container-fluid">
    <form action="" class="user" name="form_receber" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <!-- Page title -->
            <div class="page-header">
                <div class="row align-items-center mw-100">
                    <div class="col">
                        <div class="mb-1">
                            <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Dashboard</a></li>
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
                                <a href="<?php echo base_url('/') ?>" class="btn btn-white">
                                    Cancelar
                                </a>
                            </span>

                            <button type="submit" class="btn btn-primary d-none d-sm-inline-block">Gerar Relatório</button>

                        </div>
                    </div>
                </div>
            </div>
            <?php if ($message = $this->session->flashdata('info')) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-important alert-info alert-dismissible" role="alert">
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


            <div class="card">

                <div class="card-body">

                <div class="row mt-4 mb-4">
            
                        <div class="mb-3">
                          <div class="form-label">Escolha uma das opções</div>
                          <div>
                            <label class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="contas" value="pagas" checked="">
                              <span class="form-check-label" for="customRadio1">Contas pagas</span>
                            </label>
                            <label class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="customRadio2" name="contas" value="receber" >
                              <span class="form-check-label" for="customRadio2">Contas a receber</span>
                            </label>
                            <label class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="customRadio3" name="contas" value="vencidas" >
                              <span class="form-check-label" for="customRadio3">Contas vencidas</span>
                            </label>
                          </div>
                        </div>

 
                </div>
                   
    </div>
</div>
</form>
<!-- Content here -->
</div>