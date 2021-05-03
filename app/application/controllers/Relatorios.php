<?php
defined('BASEPATH') OR exit('Ação não permitida');


class Relatorios extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }


    }

    public function vendas()
    {
        $data = array(
          'titulo' => 'Relatório de Vendas',

        );

        $data_inicial = $this->input->post('data_inicial');
        $data_final   = $this->input->post('data_final');
        //$this->load->model('vendas_model');
        
        if ($data_inicial) {
         $this->load->model('vendas_model');
     

        if ($this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final)) {
             

              /*Montagem do Relatorio */

              $empresa = $this->core_model->get_by_id('empresa', array('empresa_id' => 1));
              $vendas  = $this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final);
              $file_name = 'REL-VENDAS';

              $html = '<html>';
              $html .= '<head>'; 
              $html .= '<title>' .$empresa->empresa_nome_fantasia.'&nbsp;| Relatório de Vendas</title>';
              $html .= '</head>';
              $html .= '<body style="font-size: 12px">';
            
               $html .= '<p style="font-size: 12px ">Relatórios de vendas realizadas no periodo de</p>';
                      if ($data_inicial && $data_final) {
                          $html .= '<p style="font-size: 12px">'. formata_data_banco_sem_hora($data_inicial).'- '.formata_data_banco_sem_hora($data_final).' </p>';
                      }else{
                          $html .= '<p style="font-size: 12px">'. formata_data_banco_sem_hora($data_inicial).'</p>';
                      }       
               $html .= '<hr>';
               $html .= '<table width="100%" border: solid $ddd 1px>';
                   $html .= '<tr>';
                      $html .= '<th>Código da venda</th>';
                      $html .= '<th>Data</th>';
                      $html .= '<th>Cliente</th>';
                      $html .= '<th>Forma de pagamento</th>';
                      $html .= '<th>Valor total</th>';
                   $html .= '</tr>';
               $valor_final_vendas = $this->vendas_model->get_valor_final_relatorios($data_inicial, $data_final);   
               foreach ($vendas as $venda) :
                   $html .= '<tr>';
                       $html .= '<td>'.$venda->venda_id.'</td>';
                       $html .= '<td>'.formata_data_banco_com_hora($venda->venda_data_emissao).'</td>';
                       $html .= '<td>'.$venda->cliente_nome_completo.'</td>';
                       $html .= '<td>'.$venda->forma_pagamento.'</td>';
                       $html .= '<td>'.'R$&nbsp;'.$venda->venda_valor_total.'</td>';
                   $html .= '</tr>';    
               endforeach;
               $html .= '<th colspan="3">';
               $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor Total</strong></td>';
               $html .= '<td style="border-top: solid #ddd 1px>"><strong>'. 'R$&nbsp;' . $valor_final_vendas->venda_valor_total.'</strong></td>';
               $html .= '</th>';
               $html .= '</table>';

              $html .= '</body>';
              $html .= '</html>';

              //echo '<pre>';
             // print_r($html);
             // exit();

              $this->pdf->createPDF($html, $file_name, true);

        }else{
            if (!empty($data_inicial) && !empty($data_final)) {
               $this->session->set_flashdata('info', 'Não foram encontradas vendas entre as datas'. formata_data_banco_sem_hora($data_inicial). '&nbsp;e&nbsp;'.formata_data_banco_sem_hora($data_final));  
            }else{
               $this->session->set_flashdata('info', 'Não foi encontrada venda a partir da data'. formata_data_banco_sem_hora($data_inicial));
            }
            redirect('relatorios/vendas');
        }
    }

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/relatorio');
        $this->load->view('layout/footer');
    }

    public function ordens_servicos()
    {
       $data = array(
          'titulo' => 'Relatório de Ordens de Serviço',
       );

       $data_inicial = $this->input->post('data_inicial');
       $data_final   = $this->input->post('data_final');

       if ($data_inicial) {
           $this->load->model('ordem_servico_model');
           
           if ($this->ordem_servico_model->gerar_relatorio_os($data_inicial, $data_final)) {
           
             /*Montagem do Relatorio */
            $empresa = $this->core_model->get_by_id('empresa', array('empresa_id' => 1));
            $ordens_servico  = $this->ordem_servico_model->gerar_relatorio_os($data_inicial, $data_final);
            $file_name = 'REL-OS';

           
            $html = '<html>';
              $html .= '<head>'; 
              $html .= '<title>' .$empresa->empresa_nome_fantasia.'&nbsp;| Relatório de Vendas</title>';
              $html .= '</head>';
              $html .= '<body style="font-size: 12px">';
            
               $html .= '<p style="font-size: 12px ">Relatórios de vendas realizadas no periodo de</p>';
                      if ($data_inicial && $data_final) {
                          $html .= '<p style="font-size: 12px">'. formata_data_banco_sem_hora($data_inicial).'- '.formata_data_banco_sem_hora($data_final).' </p>';
                      }else{
                          $html .= '<p style="font-size: 12px">'. formata_data_banco_sem_hora($data_inicial).'</p>';
                      }       
               $html .= '<hr>';
               $html .= '<table width="100%" border: solid $ddd 1px>';
                   $html .= '<tr>';
                      $html .= '<th>N° da O.S</th>';
                      $html .= '<th>Data</th>';
                      $html .= '<th>Cliente</th>';
                      $html .= '<th>Forma de pagamento</th>';
                      $html .= '<th>Valor total</th>';
                   $html .= '</tr>';
               $valor_final_os = $this->ordem_servico_model->get_valor_final_relatorios_os($data_inicial, $data_final);   
               foreach ($ordens_servico as $os) :
                   $html .= '<tr>';
                       $html .= '<td>'.$os->ordem_servico_id.'</td>';
                       $html .= '<td>'.formata_data_banco_com_hora($os->ordem_servico_data_emissao).'</td>';
                       $html .= '<td>'.$os->cliente_nome_completo.'</td>';
                       $html .= '<td>'.$os->forma_pagamento.'</td>';
                       $html .= '<td>'.'R$&nbsp;'.$os->ordem_servico_valor_total.'</td>';
                   $html .= '</tr>';    
               endforeach;
               $html .= '<th colspan="3">';
               $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor Total</strong></td>';
               $html .= '<td style="border-top: solid #ddd 1px>"><strong>'. 'R$&nbsp;' . $valor_final_os->valor_total.'</strong></td>';
               $html .= '</th>';
               $html .= '</table>';

              $html .= '</body>';
              $html .= '</html>';

              //echo '<pre>';
              //print_r($html);
             // exit();

             $this->pdf->createPDF($html, $file_name, true);
              
           }else{

            if (!empty($data_inicial) && !empty($data_final)) {
                $this->session->set_flashdata('info', 'Não foram encontradas O.S entre as datas'. formata_data_banco_sem_hora($data_inicial). '&nbsp;e&nbsp;'.formata_data_banco_sem_hora($data_final));  
             }else{
                $this->session->set_flashdata('info', 'Não foi encontrada O.S a partir da data'. formata_data_banco_sem_hora($data_inicial));
             }
             redirect('relatorios/ordens_servicos');

           }
       }
        $this->load->view('layout/header', $data);
        $this->load->view('ordem/relatorio');
        $this->load->view('layout/footer');

    }

    public function servicos()
    {

        $data = array(
           'titulo' => 'Relatório de Serviços',
        );

        
    }

    public function produtos()
    {
        
    }

    public function pagar()
    {
        $data = array(
            'titulo' => 'Relatório de Contas a Pagar',
        );

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/relatorio');
        $this->load->view('layout/footer');

      
    }
    
    public function receber()
    {
        $data = array(
            'titulo' => 'Relatório de Contas a Receber',
        );
        
       $contas = $this->input->post('contas');

       if ($contas == 'vencidas' || $contas == 'pagas' || $contas == 'receber') {

        $this->load->model('financeiro_model');
          
        if ($contas == 'vencidas') {
           
            $conta_receber_status = 0;
            $data_vencimento = TRUE;

            if ($this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento)) {

                 /*Montagem do relatorio contas receber vencidas*/
                 $empresa = $this->core_model->get_by_id('empresa', array('empresa_id' => 1));
                 $contas  = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento);
                 $file_name = 'REL-CONTASRECEBER';
     
                
                 $html = '<html>';
                   $html .= '<head>'; 
                   $html .= '<title>' .$empresa->empresa_nome_fantasia.'&nbsp;| Relatório de contas vencidas</title>';
                   $html .= '</head>';
                   $html .= '<body style="font-size: 12px">';
                
                    $html .= '<table width="100%" border: solid $ddd 1px>';
                        $html .= '<tr>';
                           $html .= '<th>N° da Venda</th>';
                           $html .= '<th>Data Vencimento</th>';
                           $html .= '<th>Cliente</th>';
                           $html .= '<th>Situação</th>';
                           $html .= '<th>Valor total</th>';
                        $html .= '</tr>';
                    
                    foreach ($contas as $conta) :
                        $html .= '<tr>';
                            $html .= '<td>'.$conta->conta_receber_id.'</td>';
                            $html .= '<td>'.formata_data_banco_sem_hora($conta->conta_receber_data_vencto).'</td>';
                            $html .= '<td>'.$conta->cliente_nome_completo.'</td>';
                            $html .= '<td>Vencida</td>';
                            $html .= '<td>'.'R$&nbsp;'.$conta->conta_receber_valor.'</td>';
                        $html .= '</tr>';    
                    endforeach;

                    $valor_final = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status, $data_vencimento);

                    $html .= '<th colspan="3">';
                    $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor Total</strong></td>';
                    $html .= '<td style="border-top: solid #ddd 1px>"><strong>'. 'R$&nbsp;' . $valor_final->conta_receber_valor_total.'</strong></td>';
                    $html .= '</th>';
                    $html .= '</table>';
     
                   $html .= '</body>';
                   $html .= '</html>';
     
                  // echo '<pre>';
                  // print_r($html);
                  // exit();
     
                  $this->pdf->createPDF($html, $file_name, true);

            }else{
                $this->session->set_flashdata('info','Não existem contas a receber vencidas');
                redirect('relatorios/receber');
            }
        }

        if ($contas == 'pagas') {
            
            $conta_receber_status = 1;

            if ($this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)) {

                /*Montagem do relatorio contas receber vencidas*/
                $empresa = $this->core_model->get_by_id('empresa', array('empresa_id' => 1));
                $contas  = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);
                $file_name = 'REL-CONTASRECEBER';
    
               
                $html = '<html>';
                  $html .= '<head>'; 
                  $html .= '<title>' .$empresa->empresa_nome_fantasia.'&nbsp;| Relatório de contas pagas</title>';
                  $html .= '</head>';
                  $html .= '<body style="font-size: 12px">';
               
                   $html .= '<table width="100%" border: solid $ddd 1px>';
                       $html .= '<tr>';
                          $html .= '<th>N° da Venda</th>';
                          $html .= '<th>Data Pagamento</th>';
                          $html .= '<th>Cliente</th>';
                          $html .= '<th>Situação</th>';
                          $html .= '<th>Valor total</th>';
                       $html .= '</tr>';
                   
                   foreach ($contas as $conta) :
                       $html .= '<tr>';
                           $html .= '<td>'.$conta->conta_receber_id.'</td>';
                           $html .= '<td>'.formata_data_banco_com_hora($conta->conta_receber_data_pagamento).'</td>';
                           $html .= '<td>'.$conta->cliente_nome_completo.'</td>';
                           $html .= '<td>Paga</td>';
                           $html .= '<td>'.'R$&nbsp;'.$conta->conta_receber_valor.'</td>';
                       $html .= '</tr>';    
                   endforeach;

                   $valor_final = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);

                   $html .= '<th colspan="3">';
                   $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor Total</strong></td>';
                   $html .= '<td style="border-top: solid #ddd 1px>"><strong>'. 'R$&nbsp;' . $valor_final->conta_receber_valor_total.'</strong></td>';
                   $html .= '</th>';
                   $html .= '</table>';
    
                  $html .= '</body>';
                  $html .= '</html>';
    
                 // echo '<pre>';
                 // print_r($html);
                 // exit();
    
                 $this->pdf->createPDF($html, $file_name, true);

           }else{
               $this->session->set_flashdata('info','Não existem contas pagas na base de dados');
               redirect('relatorios/receber');
           }

        }

        if ($contas == 'receber') {
            $conta_receber_status = NULL;

            if ($this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)) {

                /*Montagem do relatorio contas receber vencidas*/
                $empresa = $this->core_model->get_by_id('empresa', array('empresa_id' => 1));
                $contas  = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);
                $file_name = 'REL-CONTASRECEBER';
    
               
                $html = '<html>';
                  $html .= '<head>'; 
                  $html .= '<title>' .$empresa->empresa_nome_fantasia.'&nbsp;| Relatório de contas a receber</title>';
                  $html .= '</head>';
                  $html .= '<body style="font-size: 12px">';
               
                   $html .= '<table width="100%" border: solid $ddd 1px>';
                       $html .= '<tr>';
                          $html .= '<th>N° da Venda</th>';
                          $html .= '<th>Data Vencimento</th>';
                          $html .= '<th>Cliente</th>';
                          $html .= '<th>Situação</th>';
                          $html .= '<th>Valor total</th>';
                       $html .= '</tr>';
                   
                   foreach ($contas as $conta) :
                       $html .= '<tr>';
                           $html .= '<td>'.$conta->conta_receber_id.'</td>';
                           $html .= '<td>'.formata_data_banco_sem_hora($conta->conta_receber_data_vencto).'</td>';
                           $html .= '<td>'.$conta->cliente_nome_completo.'</td>';
                           $html .= '<td>a receber</td>';
                           $html .= '<td>'.'R$&nbsp;'.$conta->conta_receber_valor.'</td>';
                       $html .= '</tr>';    
                   endforeach;

                   $valor_final = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);

                   $html .= '<th colspan="3">';
                   $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor Total</strong></td>';
                   $html .= '<td style="border-top: solid #ddd 1px>"><strong>'. 'R$&nbsp;' . $valor_final->valor_total.'</strong></td>';
                   $html .= '</th>';
                   $html .= '</table>';
    
                  $html .= '</body>';
                  $html .= '</html>';
    
                 // echo '<pre>';
                 // print_r($html);
                 // exit();
    
                 $this->pdf->createPDF($html, $file_name, true);

           }else{
               $this->session->set_flashdata('info','Não existem contas a receber na base de dados');
               redirect('relatorios/receber');
           }
        }

    }



        $this->load->view('layout/header', $data);
        $this->load->view('receber/relatorio');
        $this->load->view('layout/footer');
       
    }



}