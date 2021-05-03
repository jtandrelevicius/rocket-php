<?php $this->load->view('layout/navbar') ?>

<div class="content">
  <div class="container-fluid">
    <form action="" method="POST" name="form_pagamentos">
      <!-- Page title -->
      <div class="page-header">
        <div class="row align-items-center mw-100">
          <div class="col">
            <div class="mb-1">
              <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="<?php echo base_url('pagamento') ?>">Pagamentos</a></li>
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
                <a href="<?php echo base_url('pagamento') ?>" class="btn btn-white">
                  Cancelar
                </a>
              </span>

              <button type="submit" class="btn btn-primary d-none d-sm-inline-block">
                Salvar
              </button>

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
        
        </div>
        <div class="card-body">
          <div class="row">
            <!--Row1-->
            <div class="form-group col-8 ">
              <label class="form-label required">Descrição</label>
              <div>
                <input type="text" class="form-control" name="forma_pagamento_nome" placeholder="Descrição" 
                value="<?php echo $pagamento->forma_pagamento_nome?>">
                <?php echo form_error('forma_pagamento_nome', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-2">
              <label class="form-label ">Aceita Parcela</label>
              <select class="form-select" name="forma_pagamento_aceita_parc">
                <option value="0" <?php echo $pagamento->forma_pagamento_aceita_parc == 0 ? 'selected' : ''?>>Não</option>
                <option value="1" <?php echo $pagamento->forma_pagamento_aceita_parc == 1 ? 'selected' : ''?>>Sim</option>
              </select>

            </div>
         
            <div class="form-group col-2">
              <label class="form-label ">Ativo</label>
              <select class="form-select" name="forma_pagamento_ativa"> 
                <option value="0" <?php echo $pagamento->forma_pagamento_ativa == 0 ? 'selected' : ''?>>Não</option>
                <option value="1" <?php echo $pagamento->forma_pagamento_ativa == 1 ? 'selected' : ''?>>Sim</option>
              </select>

            </div>
          </div>
          <!--Row1-->
          <br>

          
        
        </div>
      </div>
    </form>
    <!-- Content here -->
  </div>
