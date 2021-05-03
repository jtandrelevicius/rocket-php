<?php $this->load->view('layout/navbar') ?>

<div class="content">
  <div class="container-fluid">
    <form action="" method="POST" name="form_contas_pagar">
      <!-- Page title -->
      <div class="page-header">
        <div class="row align-items-center mw-100">
          <div class="col">
            <div class="mb-1">
              <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="<?php echo base_url('pagar') ?>">Lista de Contas a Pagar</a></li>
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
                <a href="<?php echo base_url('pagar') ?>" class="btn btn-white">
                  Cancelar
                </a>
              </span>
        
              <button type="submit" class="btn btn-primary d-none d-sm-inline-block" 
              <?php echo ($contas_pagar->conta_pagar_status == 1 ? 'disabled' : '')?> >Salvar</button>

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
            <div class="form-group col-6">
              <label class="form-label required">Fornecedor</label>
              <select class="form-select" name="conta_pagar_fornecedor_id">
              <option value=""></option>
              <?php foreach ($fornecedores as $fornecedor) : ?>
              <option value="<?php echo $fornecedor->fornecedor_id?>" <?php echo ($fornecedor->fornecedor_id == $contas_pagar->conta_pagar_fornecedor_id ? 'selected': '') ?>><?php echo $fornecedor->fornecedor_nome_fantasia?></option>
               <?php endforeach; ?> 
              </select>
              <?php echo form_error('conta_pagar_fornecedor_id', '<small class="form-text text-danger">','</small>')?>
            </div>

            <div class="form-group col-2 ">
              <label class="form-label required">Valor da Conta</label>
              <div>
                <input type="text" class="form-control input_dinheiro2" name="conta_pagar_valor" placeholder="R$ 0.00" 
                value="<?php echo $contas_pagar->conta_pagar_valor?>">
                <?php echo form_error('conta_pagar_valor', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-2 ">
                            <label class="form-label required">Data de Vencimento</label>
                            <div class="input-icon">
                                <span class="input-icon-addon "><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <line x1="11" y1="15" x2="12" y2="15"></line>
                                        <line x1="12" y1="15" x2="12" y2="18"></line>
                                    </svg>
                                </span>
                                <input class="form-control" type="date" name="conta_pagar_data_vencto" placeholder="00/00/0000" id="datepicker-icon-prepend" value="<?php echo formata_data_banco_sem_hora($contas_pagar->conta_pagar_data_vencto) ?>">
                            </div>
                        </div>
  
            <div class="form-group col-2">
              <label class="form-label ">Situação</label>
              <select class="form-select" name="conta_pagar_status">
                <option value="0" <?php echo $contas_pagar->conta_pagar_status == 0 ? 'selected' : '' ?>>Pendente</option>
                <option value="1" <?php echo $contas_pagar->conta_pagar_status == 1 ? 'selected' : '' ?>>Pago</option>
              </select>
            </div>
            
          </div>
          <!--Row1-->
          <br>

          <div class="row">
              
              <div class="form-group col-12">
              <label class="form-label required">Descrição<span class="form-label-description">0/50</span></label>
              <textarea class="form-control" name="conta_pagar_obs" rows="4" placeholder="Observação"><?php echo $contas_pagar->conta_pagar_obs?></textarea>
              <?php echo form_error('conta_pagar_obs', '<small class="form-text text-danger">','</small>')?>
              </div>
                 
     
            </div>
            <br>

          
        <input type="hidden" name="conta_pagar_id" value="<?php echo $contas_pagar->conta_pagar_id?>">
        </div>
      </div>
    </form>
    <!-- Content here -->
  </div>
