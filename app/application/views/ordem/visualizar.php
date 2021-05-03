<?php $this->load->view('layout/navbar') ?>
<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                Ordem de Serviço # <?php echo $ordem_servico->ordem_servico_id ?>
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
              <a href="<?php echo base_url('OrdemServico') ?>" type="button" class="btn btn-ligth"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="9" y1="12" x2="15" y2="12" /></svg>
                 Cancelar</a>
              
               
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><rect x="7" y="13" width="10" height="8" rx="2"></rect></svg>
                 Imprimir
                </button>
              </div>
            </div>
          </div>
          <div class="card card-lg">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <p class="h3"><?php echo $empresa->empresa_nome_fantasia ?></p>
                  <address>
                    <?php echo $empresa->empresa_endereco?>, <?php echo $empresa->empresa_numero?> - <?php echo $empresa->empresa_bairro?><br>
                    <?php echo $empresa->empresa_cidade?> - <?php echo $empresa->empresa_estado?><br>
                   CNPJ: <?php echo $empresa->empresa_cnpj?><br>
                   Telefone: <?php echo $empresa->empresa_telefone_fixo?> <br>
                    <?php echo $empresa->empresa_email?>
                  </address>
                </div>
                
                <div class="col-6 text-end">
                  <p class="h3"><?php echo $clientes->cliente_nome?></p>
                  <address>
                    <?php echo $clientes->cliente_endereco?>, <?php echo $clientes->cliente_numero_endereco?> - <?php echo $clientes->cliente_bairro?><br>
                    <?php echo $clientes->cliente_cidade?> - <?php echo $clientes->cliente_estado?><br>
                    CNPJ/CPF: <?php echo $clientes->cliente_cpf_cnpj?> <br> 
                    Telefone: <?php echo $clientes->cliente_telefone?> <br>
                    <?php echo $clientes->cliente_email?>
                  </address>
                </div>
                <hr style="color: gray;">
              </div>

              <div class="row">
              <div class="col-6">
            <div class="font-weight-medium">Ordem de Serviço # <?php echo $ordem_servico->ordem_servico_id?></div>
            </div>
            <div class="col-6">
            <div class="font-weight-medium text-end">Data e Hora de emissão # <?php echo formata_data_banco_com_hora($ordem_servico->ordem_servico_data_emissao)?></div>
            </div>
              </div>
              <hr>
              <br>
          
            <div class="row">
            <div class="col-3">
            <div class="font-weight-medium">Equipamento</div>
            <div class="text-muted"><?php echo $ordem_servico->ordem_servico_equipamento?> - <?php echo $ordem_servico->ordem_servico_marca_equipamento?> - <?php echo $ordem_servico->ordem_servico_modelo_equipamento?></div>
            </div>
            <div class="col-2">
            <div class="font-weight-medium">Acessorios</div>
            <div class="text-muted"><?php echo $ordem_servico->ordem_servico_acessorios?></div>
            </div>
            <div class="col-4">
            <div class="font-weight-medium">Defeito apresentado</div>
              <div class="text-muted"><?php echo $ordem_servico->ordem_servico_defeito?></div>
            </div>
            <div class="col-3">
            <div class="font-weight-medium">Observação</div>
            <div class="text-muted"><?php echo $ordem_servico->ordem_servico_obs?></div>
            </div>
            </div>
            <hr style="color: gray;">
                
               <div class="row">

               <div class="col-5"> <p class="text-muted text-left mt-5"> <?php echo $empresa->empresa_txt_ordem_servico?></p></div>
               <div class="col-7"> <p class="text-muted text-end mt-5"> _____________________________________________________________</p>
               <div class="font-weight-medium text-end ">Assinatura do cliente autorzando checagem e manuteção</div>
              </div>
               </div>
              

            </div>
          </div>
       

      </div>