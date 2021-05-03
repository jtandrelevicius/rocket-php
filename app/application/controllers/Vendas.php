<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Vendas extends CI_Controller{

    public function __construct(){
        parent:: __construct();
         
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
         }

         $this->load->model('vendas_model');
         $this->load->model('produtos_model');
    }

    public function index()
    {

        $data = array(

            'titulo' => 'Vendas',

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),

            'vendas' => $this->vendas_model->get_all(),

        );

        //echo '<pre>';
        //print_r($data);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/index');
        $this->load->view('layout/footer');
        
    }

    public function add()
    {

        $this->form_validation->set_rules('venda_cliente_id','','required');
        $this->form_validation->set_rules('venda_forma_pagamento_id', '' ,'required');
        $this->form_validation->set_rules('venda_vendedor_id', '', 'required');
        $this->form_validation->set_rules('venda_tipo', '', 'required');
        $this->form_validation->set_rules('venda_valor_total','','required');
         
     if ($this->form_validation->run()) {

         $venda_valor_total = str_replace('R$', "", trim($this->input->post('venda_valor_total')));

         $data['venda_cliente_id'] = $this->input->post('venda_cliente_id');
         $data['venda_forma_pagamento_id'] = $this->input->post('venda_forma_pagamento_id');
         $data['venda_vendedor_id'] = $this->input->post('venda_vendedor_id');
         $data['venda_tipo'] = $this->input->post('venda_tipo');
         $data['venda_valor_desconto'] = $this->input->post('venda_valor_desconto');
         $data['venda_valor_total'] = $this->input->post('venda_valor_total');
         $data['venda_status'] = 0;
         
         $data['venda_valor_total'] = trim(preg_replace('/\$/','', $venda_valor_total ));

         $data = html_escape($data);
         $venda_id = $this->vendas_model->save($data);
   
         $produto_id = $this->input->post('produto_id');
         $produto_quantidade = $this->input->post('produto_quantidade');
         $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));      
         $produto_preco_venda = str_replace('R$', '', $this->input->post('produto_preco_venda'));    
         $produto_item_total = str_replace('R$', '', $this->input->post('produto_item_total'));       
         $produto_preco_venda = str_replace(',', '', $produto_preco_venda);    
         $produto_item_total = str_replace(',', '', $produto_item_total);     
         $produto_qty = count($produto_id);

         for ($i=0; $i < $produto_qty; $i++) {
             
             $data1['venda_produto_id_venda'] = $venda_id;
             $data1['venda_produto_id_produto'] = $produto_id[$i];
             $data1['venda_produto_quantidade'] = $produto_quantidade[$i];
             $data1['venda_produto_valor_unitario']  = $produto_preco_venda[$i];
             $data1['venda_produto_desconto'] = $produto_desconto[$i];
             $data1['venda_produto_valor_total'] = $produto_item_total[$i]; 

             $data1 = html_escape($data1);
             $this->core_model->insert('venda_produtos', $data1);

             //CONTROLE DE ESTOQUE

             $produto_qtde_estoque = 0;
             $produto_qtde_estoque += intval($produto_quantidade[$i]);
             $produtos = array(
                  'produto_qtde_estoque' => $produto_qtde_estoque,
             );
             $this->produtos_model->update($produto_id[$i], $produto_qtde_estoque);
         }


        redirect('vendas');

        }else{

            $data = array(

                'titulo' => 'Pedido de Venda',

                'styles'  => array(
                    'public/assets/libs/select2/select2.min.css',
                    'public/assets/libs/autocomplete/jquery-ui.css',
                    'public/assets/libs/autocomplete/estilo.css',

                ),

                'scripts' => array(
                    'public/assets/libs/autocomplete/jquery-migrate.js',
                    'public/assets/libs/calcx/jquery-calx-sample-2.2.8.min.js',
                    'public/assets/libs/calcx/venda.js',
                    'public/assets/libs/select2/select2.min.js',
                    'public/assets/libs/select2/app.js',
                    'public/assets/libs/sweetalert2/sweetalert2.js',
                    'public/assets/libs/autocomplete/jquery-ui.js',

                ),

                'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)), 
                'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),

            );

            $this->load->view('layout/header' , $data);
            $this->load->view('vendas/add');
            $this->load->view('layout/footer');
        }
        
    }

    public function edit($venda_id=NULL)
    {
        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {

            $this->session->set_falshdata('error', 'Venda não existente');
            redirect('vendas');

        } else {

          $venda_produto = $this->vendas_model->get_all_produtos_by_venda($venda_id);

           $this->form_validation->set_rules('venda_cliente_id','','required');
           $this->form_validation->set_rules('venda_forma_pagamento_id', '' ,'required');
           $this->form_validation->set_rules('venda_vendedor_id', '', 'required');
           $this->form_validation->set_rules('venda_tipo', '', 'required');
           $this->form_validation->set_rules('venda_valor_total','','required');
            
        if ($this->form_validation->run()) {

            $venda_valor_total = str_replace('R$', "", trim($this->input->post('venda_valor_total')));

            $data['venda_cliente_id'] = $this->input->post('venda_cliente_id');
            $data['venda_forma_pagamento_id'] = $this->input->post('venda_forma_pagamento_id');
            $data['venda_vendedor_id'] = $this->input->post('venda_vendedor_id');
            $data['venda_tipo'] = $this->input->post('venda_tipo');
            $data['venda_valor_desconto'] = $this->input->post('venda_valor_desconto');
            $data['venda_valor_total'] = $this->input->post('venda_valor_total');
            $data['venda_status'] = 0;
            
            $data['venda_valor_total'] = trim(preg_replace('/\$/','', $venda_valor_total ));

            $data = html_escape($data);
            $this->core_model->update('vendas', $data, array('venda_id' => $venda_id));

            $this->vendas_model->delete_old_produtos($venda_id);

            $produto_id = $this->input->post('produto_id');
            $produto_quantidade = $this->input->post('produto_quantidade');
            $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));      
            $produto_preco_venda = str_replace('R$', '', $this->input->post('produto_preco_venda'));    
            $produto_item_total = str_replace('R$', '', $this->input->post('produto_item_total'));       
            $produto_preco_venda = str_replace(',', '', $produto_preco_venda);    
            $produto_item_total = str_replace(',', '', $produto_item_total);     
            $produto_qty = count($produto_id);

            for ($i=0; $i < $produto_qty; $i++) {
                
                $data1['venda_produto_id_venda'] = $venda_id;
                $data1['venda_produto_id_produto'] = $produto_id[$i];
                $data1['venda_produto_quantidade'] = $produto_quantidade[$i];
                $data1['venda_produto_valor_unitario']  = $produto_preco_venda[$i];
                $data1['venda_produto_desconto'] = $produto_desconto[$i];
                $data1['venda_produto_valor_total'] = $produto_item_total[$i]; 

                $data1 = html_escape($data1);
                $this->core_model->insert('venda_produtos', $data1);


                //CONTROLE DE ESTOQUE
                foreach ($venda_produto as $venda_p){
                    if ($venda_p->venda_produto_quantidade < $produto_quantidade[$i]) {
                        
                        $produto_qtde_estoque = 0;
                        $produto_qtde_estoque += intval($produto_quantidade[$i]);
                        $direfenca = ($produto_qtde_estoque - $venda_p->venda_produto_quantidade);

                        $this->produtos_model->update($produto_id[$i], $direfenca);
                    }
                }

            }
           redirect('vendas');
 
        }else{
             
            $data = array(

                'titulo' => 'Atualizar Pedido de Venda',

                'styles'  => array(
                    'public/assets/libs/select2/select2.min.css',
                    'public/assets/libs/autocomplete/jquery-ui.css',
                    'public/assets/libs/autocomplete/estilo.css',

                ),

                'scripts' => array(
                    'public/assets/libs/autocomplete/jquery-migrate.js',
                    'public/assets/libs/calcx/jquery-calx-sample-2.2.8.min.js',
                    'public/assets/libs/calcx/venda.js',
                    'public/assets/libs/select2/select2.min.js',
                    'public/assets/libs/select2/app.js',
                    'public/assets/libs/sweetalert2/sweetalert2.js',
                    'public/assets/libs/autocomplete/jquery-ui.js',

                ),

                'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                'venda_produtos' => $this->vendas_model->get_all_produtos_by_venda($venda_id),
                'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
                
            );

            $venda = $data['venda'] = $this->vendas_model->get_by_id($venda_id);

           // echo '<pre>';
           // print_r($data);
           // exit();

            $this->load->view('layout/header', $data);
            $this->load->view('vendas/edit');
            $this->load->view('layout/footer');

        }
    }
       
    }

    public function cancel($venda_id=NULL)
    {
        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {

            $this->session->set_falshdata('error', 'Venda não existente');
            redirect('vendas');

        } else {

            $data['venda_status'] = 1;
            $data = html_escape($data);
            $this->core_model->update('vendas', $data, array('venda_id' => $venda_id));
            redirect('vendas');


        }
    }

    public function imprimir()
    {
        $data = array(
            'titulo' => 'Imprimir Venda',

                'styles'  => array(
                    'public/assets/css/cupom.css',
  
                ),

           
        );

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/imprimir');
        $this->load->view('layout/footer');
    }

    public function pdf_cupom($venda_id=NULL)
    {
        $data = array(
            'titulo' => 'Impressao Pedido',
  
            'styles' => array(
                'public/assets/css/cupom.css'
            ),
  
            
            'empresa' => $this->core_model->get_by_id('empresa', array('empresa_id' => 1)),
        
          );
  
          $venda = $data['venda'] = $this->vendas_model->get_by_id($venda_id);
          $produto = $data['produto'] = $this->vendas_model->get_all_produtos_by_venda($venda_id);
  
          $this->load->view('vendas/pdf_cupom', $data);
       
    }
    public function visualizar_cupom($venda_id=NULL)
    {
        $data = array(
          'titulo' => 'Impressao Pedido',

          'styles' => array(
              'public/assets/css/cupom.css'
          ),

          
          'empresa' => $this->core_model->get_by_id('empresa', array('empresa_id' => 1)),
      
        );

        $venda = $data['venda'] = $this->vendas_model->get_by_id($venda_id);
        $produto = $data['produto'] = $this->vendas_model->get_all_produtos_by_venda($venda_id);

        $this->load->view('vendas/visualizar_cupom', $data);
    }

   
}