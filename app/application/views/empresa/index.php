<?php $this->load->view('layout/navbar') ?>

<div class="content">
  <div class="container-fluid">
    <form action="empresa" method="POST" name="form_empresa">
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
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <span class="d-none d-sm-inline">
                <a href="<?php echo base_url('/') ?>" class="btn btn-white">
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
                <input type="text" class="form-control" name="empresa_razao_social" placeholder="Razão Social" 
                value="<?php echo $empresa->empresa_razao_social?>">
                <?php echo form_error('empresa_razao_social', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
            <div class="form-group col-5 ">
              <label class="form-label required">Nome Fantasia</label>
              <div>
                <input type="text" class="form-control" name="empresa_nome_fantasia" placeholder="Nome Fantasia" 
                value="<?php echo $empresa->empresa_nome_fantasia?>">
                <?php echo form_error('empresa_nome_fantasia', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
            <div class="form-group col-2 ">
              <label class="form-label required">CNPJ</label>
              <div>
                <input type="text" class="form-control input_cnpj" name="empresa_cnpj" placeholder="CNPJ" 
                value="<?php echo $empresa->empresa_cnpj?>">
                <?php echo form_error('empresa_cnpj', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
          </div>
          <!--Row1-->
          <br>

          <div class="row">
            <div class="form-group col-2 ">
              <label class="form-label required">Inscrição Estadual</label>
              <div>
                <input type="text" class="form-control input_ie" name="empresa_ie" placeholder="Inscrição Estadual" 
                value="<?php echo $empresa->empresa_ie?>">
                <?php echo form_error('empresa_ie', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-2 ">
              <label class="form-label ">Inscrição Municipal</label>
              <div>
                <input type="text" class="form-control" name="empresa_im" placeholder="Inscrição Municipal" 
                value="<?php echo $empresa->empresa_im?>">
                <?php echo form_error('empresa_im', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
            

            <div class="form-group col-2">
              <label class="form-label required">Regime Tributario</label>
              <select class="form-select" name="empresa_regime_tributario">
                <option value="0">Não</option>
                <option value="1">Sim</option>
              </select>
            </div>
            
            <div class="form-group col-2 ">
              <label class="form-label ">CNAE</label>
              <div>
                <input type="text" class="form-control" name="empresa_cnae" placeholder="CNAE" 
                value="<?php echo $empresa->empresa_cnae?>">
                <?php echo form_error('empresa_cnae', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

             <div class="form-group col-4 ">
              <label class="form-label required">E-mail Contabilidade</label>
              <div>
                <input type="email" class="form-control" name="empresa_email_contabilidade" placeholder="E-mail" 
                value="<?php echo $empresa->empresa_email_contabilidade?>">
                <?php echo form_error('empresa_email_contabilidade', '<small class="form-text text-danger">','</small>')?>
              </div>
             </div>
          </div>
          <br>

          <div class="row"><!--ROW2-->
          <div class="form-group col-4 ">
              <label class="form-label">E-mail</label>
              <div>
                <input type="email" class="form-control" name="empresa_email" placeholder="E-mail" 
                value="<?php echo $empresa->empresa_email?>">
                <?php echo form_error('empresa_email', '<small class="form-text text-danger">','</small>')?>
              </div>
          </div>

              <div class="form-group col-2">
              <label class="form-label required">Telefone</label>
              <div>
                <input type="text" class="form-control input_telefone2" name="empresa_telefone_fixo" placeholder="(00)0000-0000" 
                value="<?php echo $empresa->empresa_telefone_fixo?>">
                <?php echo form_error('empresa_telefone_fixo', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-2">
              <label class="form-label ">Celular</label>
              <div>
                <input type="text" class="form-control input_telefone2" name="empresa_telefone_movel" placeholder="(00)00000-0000" 
                value="<?php echo $empresa->empresa_telefone_movel?>">
                <?php echo form_error('empresa_telefone_movel', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-4">
              <label class="form-label ">URL Site</label>
              <div>
                <input type="text" class="form-control" name="empresa_site_url" placeholder="http://exemplo.com.br" 
                    value="<?php echo $empresa->empresa_site_url?>">
                <?php echo form_error('empresa_site_url', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
          
          
          </div><!--ROW2-->
          <br>

          <div class="row"><!--ROW3-->
          <div class="row">
          <label class="form-label required">CEP</label>
              <div class="col-2">
                 <input type="text" class="form-control input_cep" name="empresa_cep" id="cep" placeholder="CEP" value="<?php echo $empresa->empresa_cep?>">
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
          <div class="form-group col-3 ">
              <label class="form-label required">Endereço</label>
              <div>
                <input type="text" class="form-control" name="empresa_endereco" id="endereco" placeholder="Endereço" 
                value="<?php echo $empresa->empresa_endereco?>">
                <?php echo form_error('empresa_endereco', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-1 ">
              <label class="form-label required">Numero</label>
              <div>
                <input type="text" class="form-control" name="empresa_numero"  placeholder="N°" 
                value="<?php echo $empresa->empresa_numero?>">
                <?php echo form_error('empresa_numero', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-3 ">
              <label class="form-label required ">Bairro</label>
              <div>
                <input type="text" class="form-control" name="empresa_bairro" id="bairro" placeholder="Bairro"
                 value="<?php echo $empresa->empresa_bairro?>">
                <?php echo form_error('empresa_bairro', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-3 ">
              <label class="form-label required ">Cidade</label>
              <div>
                <input type="text" class="form-control" name="empresa_cidade" id="cidade" placeholder="Cidade"
                 value="<?php echo $empresa->empresa_cidade?>">
                <?php echo form_error('empresa_cidade', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>

            <div class="form-group col-1">
            <label class="form-label required ">UF</label>
              <div>
                <input type="text" class="form-control" name="empresa_estado" id="uf" placeholder="UF" 
                value="<?php echo $empresa->empresa_estado?>">
                <?php echo form_error('empresa_estado', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
           

            <div class="form-group col-1 ">
              <label class="form-label ">Código IBGE</label>
              <div>
                <input type="text" class="form-control" name="empresa_ibge" id="ibge" placeholder="Código IBGE" 
                value="<?php echo $empresa->empresa_ibge?>">
                <?php echo form_error('empresa_ibge', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
          </div><!--ROW4-->    
          <br>
          
          <div class="row">
              
            <div class="form-group col-12">
            <label class="form-label">Mensagem Ordem de Serviço <span class="form-label-description">0/100</span></label>
            <textarea class="form-control" name="empresa_txt_ordem_servico" rows="4" placeholder="Conteudo.." 
            value=""><?php echo $empresa->empresa_txt_ordem_servico?></textarea>
            </div>

         

          </div>
          <br>
        
        </div>
      </div>
    </form>
    <!-- Content here -->
  </div>
