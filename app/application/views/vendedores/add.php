<?php $this->load->view('layout/navbar') ?>

<div class="content">
  <div class="container-fluid">
    <form action="" method="POST" name="form_vendedores">
      <!-- Page title -->
      <div class="page-header">
        <div class="row align-items-center mw-100">
          <div class="col">
            <div class="mb-1">
              <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="<?php echo base_url('vendedores') ?>">Lista de Vendedores</a></li>
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
                <a href="<?php echo base_url('vendedores') ?>" class="btn btn-white">
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
            <div class="form-group col-6 ">
              <label class="form-label required">Nome</label>
              <div>
                <input type="text" class="form-control" name="vendedor_nome" placeholder="Nome" 
                value="<?php echo set_value('vendedor_nome')?>">
                <?php echo form_error('vendedor_nome', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
            <div class="form-group col-2 ">
              <label class="form-label required">CPF</label>
              <div>
                <input type="text" class="form-control input_cpf " name="vendedor_cpf" placeholder="CPF" 
                value="<?php echo set_value('vendedor_cpf')?>">
                <?php echo form_error('vendedor_cpf', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
            <div class="form-group col-2 ">
              <label class="form-label required">RG</label>
              <div>
                <input type="text" class="form-control input_rg" name="vendedor_rg" placeholder="RG" 
                value="<?php echo set_value('vendedor_rg')?>">
                <?php echo form_error('vendedor_rg', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-2 ">
              <label class="form-label">Matrícula</label>
              <div>
                <input type="text" class="form-control" name="vendedor_codigo" placeholder="Matrícula" 
                value="<?php echo $vendedor_codigo ?>" readonly="">
              </div>
            </div>
          </div>
          <!--Row1-->
          <br>

          <div class="row">

            <div class="form-group col-2">
              <label class="form-label required">Telefone</label>
              <div>
                <input type="text" class="form-control input_telefone2" name="vendedor_telefone" placeholder="(00)0000-0000" 
                value="<?php echo set_value('vendedor_telefone')?>">
                <?php echo form_error('vendedor_telefone', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-2">
              <label class="form-label ">Celular</label>
              <div>
                <input type="text" class="form-control input_telefone2" name="vendedor_celular" placeholder="(00)00000-0000" 
                value="<?php echo set_value('vendedor_celular')?>">
                <?php echo form_error('vendedor_celular', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-6 ">
              <label class="form-label required">E-mail</label>
              <div>
                <input type="email" class="form-control" name="vendedor_email" placeholder="E-mail" 
                value="<?php echo set_value('vendedor_email')?>">
                <?php echo form_error('vendedor_email', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

              <div class="form-group col-2">
              <label class="form-label ">Ativo</label>
              <select class="form-select" name="vendedor_ativo">
                <option value="1">Sim</option>
                <option value="0">Não</option>
              </select>

            </div>
           
          </div><!--row2-->
          <br>

          <div class="row"><!--ROW4-->
          <div class="row">
          <label class="form-label required">CEP</label>
              <div class="col-2">
                 <input type="text" class="form-control input_cep" name="vendedor_cep" id="cep" placeholder="CEP" value="<?php echo set_value('vendedor_cep')?>">
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
                <input type="text" class="form-control" name="vendedor_endereco" id="endereco" placeholder="Endereço" 
                value="<?php echo set_value('vendedor_endereco')?>">
                <?php echo form_error('vendedor_endereco', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-1 ">
              <label class="form-label required">Numero</label>
              <div>
                <input type="text" class="form-control" name="vendedor_numero"  placeholder="N°" 
                value="<?php echo set_value('vendedor_numero')?>">
                <?php echo form_error('vendedor_numero', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-3 ">
              <label class="form-label required ">Bairro</label>
              <div>
                <input type="text" class="form-control" name="vendedor_bairro" id="bairro" placeholder="Bairro"
                 value="<?php echo set_value('vendedor_bairro')?>">
                <?php echo form_error('vendedor_bairro', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-3 ">
              <label class="form-label required ">Cidade</label>
              <div>
                <input type="text" class="form-control" name="vendedor_cidade" id="cidade" placeholder="Cidade"
                 value="<?php echo set_value('vendedor_cidade')?>">
                <?php echo form_error('vendedor_cidade', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-1">
            <label class="form-label required ">UF</label>
              <div>
                <input type="text" class="form-control" name="vendedor_estado" id="uf" placeholder="UF" 
                value="<?php echo set_value('vendedor_estado')?>">
                <?php echo form_error('vendedor_estado', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
           

          </div><!--ROW4-->    
          <br>
          
          <div class="row">
              
            <div class="form-group col-12">
            <label class="form-label">Observação <span class="form-label-description">0/100</span></label>
            <textarea class="form-control" name="vendedor_obs" rows="4" placeholder="Observação.."><?php echo set_value('vendedor_obs')?></textarea>
            </div>

         

          </div>
          <br>  
        
        </div>
      </div>
    </form>
    <!-- Content here -->
  </div>
