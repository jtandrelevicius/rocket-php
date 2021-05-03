<?php $this->load->view('layout/navbar') ?>

<div class="content">
  <div class="container-fluid">
    <form action="" method="POST" name="form_forncedores">
      <!-- Page title -->
      <div class="page-header">
        <div class="row align-items-center mw-100">
          <div class="col">
            <div class="mb-1">
              <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="<?php echo base_url('fornecedores') ?>">Lista de Fornecedores</a></li>
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
                <a href="<?php echo base_url('fornecedores') ?>" class="btn btn-white">
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
            <div class="form-group col-5 ">
              <label class="form-label required">Razão Social</label>
              <div>
                <input type="text" class="form-control" name="fornecedor_razao" placeholder="Razão Social" 
                value="<?php echo set_value('fornecedor_razao')?>">
                <?php echo form_error('fornecedor_razao', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
            <div class="form-group col-5 ">
              <label class="form-label required">Nome Fantasia</label>
              <div>
                <input type="text" class="form-control" name="fornecedor_nome_fantasia" placeholder="Nome Fantasia" 
                value="<?php echo set_value('fornecedor_nome_fantasia')?>">
                <?php echo form_error('fornecedor_nome_fantasia', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
            <div class="form-group col-2 ">
              <label class="form-label required">CNPJ</label>
              <div>
                <input type="text" class="form-control input_cnpj" name="fornecedor_cnpj" placeholder="CNPJ" 
                value="<?php echo set_value('fornecedor_cnpj')?>">
                <?php echo form_error('fornecedor_cnpj', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
          </div>
          <!--Row1-->
          <br>

          <div class="row">
            <div class="form-group col-2 ">
              <label class="form-label required">Inscrição Estadual</label>
              <div>
                <input type="text" class="form-control input_ie" name="fornecedor_ie" placeholder="Inscrição Estadual" 
                value="<?php echo set_value('fornecedor_ie')?>">
                <?php echo form_error('fornecedor_ie', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-2">
              <label class="form-label required">Telefone</label>
              <div>
                <input type="text" class="form-control input_telefone2" name="fornecedor_telefone" placeholder="(00)0000-0000" 
                value="<?php echo set_value('fornecedor_telefone')?>">
                <?php echo form_error('fornecedor_telefone', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-2">
              <label class="form-label ">Celular</label>
              <div>
                <input type="text" class="form-control input_telefone2" name="fornecedor_celular" placeholder="(00)00000-0000" 
                value="<?php echo set_value('fornecedor_celular')?>">
                <?php echo form_error('fornecedor_celular', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-6 ">
              <label class="form-label required">E-mail</label>
              <div>
                <input type="email" class="form-control" name="fornecedor_email" placeholder="E-mail" 
                value="<?php echo set_value('fornecedor_email')?>">
                <?php echo form_error('fornecedor_email', '<small class="form-text text-danger">','</small>')?>
              </div>
          </div>

        
          </div><!--row2-->
          <br>


          <div class="row"><!--ROW3-->
          <div class="form-group col-3 ">
              <label class="form-label required">Contato</label>
              <div>
                <input type="text" class="form-control" name="fornecedor_contato" placeholder="Contato" 
                value="<?php echo set_value('fornecedor_contato')?>">
                <?php echo form_error('fornecedor_contato', '<small class="form-text text-danger">','</small>')?>
              </div>
          </div>

          <div class="form-group col-2">
              <label class="form-label ">Ativo</label>
              <select class="form-select" name="fornecedor_ativo">
                <option value="1">Sim</option>
                <option value="0">Não</option>
              </select>

            </div>
          
          </div><!--ROW3-->
          <br>

          <div class="row"><!--ROW4-->
          <div class="row">
          <label class="form-label required">CEP</label>
              <div class="col-2">
                 <input type="text" class="form-control input_cep" name="fornecedor_cep" id="cep" placeholder="CEP" value="<?php echo set_value('fornecedor_cep')?>">
                 <?php echo form_error('fornecedor_cep', '<small class="form-text text-danger">','</small>')?>
                 </div>
                   <div class="col-auto">
                    <a href="#" class="btn btn-white btn-icon" id="btn_cep" aria-label="Button">
                  <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                 </a>
               </div>   
           </div>
  </div><!--ROW3-->
          <br>

          <div class="row"><!--ROW4-->
          <div class="form-group col-4 ">
              <label class="form-label required">Endereço</label>
              <div>
                <input type="text" class="form-control" name="fornecedor_endereco" id="endereco" placeholder="Endereço" 
                value="<?php echo set_value('fornecedor_endereco')?>">
                <?php echo form_error('fornecedor_endereco', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-1 ">
              <label class="form-label required">Numero</label>
              <div>
                <input type="text" class="form-control" name="fornecedor_numero"  placeholder="N°" 
                value="<?php echo set_value('fornecedor_numero')?>">
                <?php echo form_error('fornecedor_numero', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-3 ">
              <label class="form-label required ">Bairro</label>
              <div>
                <input type="text" class="form-control" name="fornecedor_bairro" id="bairro" placeholder="Bairro"
                 value="<?php echo set_value('fornecedor_bairro')?>">
                <?php echo form_error('fornecedor_bairro', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-3 ">
              <label class="form-label required ">Cidade</label>
              <div>
                <input type="text" class="form-control" name="fornecedor_cidade" id="cidade" placeholder="Cidade"
                 value="<?php echo set_value('fornecedor_cidade')?>">
                <?php echo form_error('fornecedor_cidade', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-1">
            <label class="form-label required ">UF</label>
              <div>
                <input type="text" class="form-control" name="fornecedor_estado" id="uf" placeholder="UF" 
                value="<?php echo set_value('fornecedor_estado')?>">
                <?php echo form_error('fornecedor_estado', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
           

          </div><!--ROW4-->    
          <br>
          
          <div class="row">
              
            <div class="form-group col-12">
            <label class="form-label">Observação<span class="form-label-description">0/100</span></label>
            <textarea class="form-control" name="fornecedor_obs" rows="4" placeholder="Observação.."><?php echo set_value('fornecedor_obs')?></textarea>
            </div>

   
          </div>
          <br>
        
        </div>
      </div>
    </form>
    <!-- Content here -->
  </div>
