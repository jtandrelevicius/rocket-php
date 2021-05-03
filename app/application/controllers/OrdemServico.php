<?php
defined('BASEPATH') or exit('Ação não permitida');


class OrdemServico extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }

        $this->load->model('ordem_servico_model');
    }

    public function index()
    {

        $data = array(

            'titulo' => 'Ordem de Serviço',

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),

            'ordem_servicos' => $this->ordem_servico_model->get_all(),
        );

        $this->load->view('layout/header' ,$data);
        $this->load->view('ordem/index');
        $this->load->view('layout/footer');
    }

    public function add()
    {

        $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
        $this->form_validation->set_rules('ordem_servico_equipamento', '', 'required');
        $this->form_validation->set_rules('ordem_servico_modelo_equipamento', '', 'required');
        $this->form_validation->set_rules('ordem_servico_marca_equipamento', '', 'required');
        $this->form_validation->set_rules('ordem_servico_acessorios', '', 'required');
        $this->form_validation->set_rules('ordem_servico_defeito', '', 'required');

        if ($this->form_validation->run()) {

            $ordem_servico_valor_total = str_replace('R$', "", trim($this->input->post('ordem_servico_valor_total')));

            $data['ordem_servico_forma_pagamento_id'] = $this->input->post('ordem_servico_forma_pagamento_id');
            $data['ordem_servico_cliente_id'] = $this->input->post('ordem_servico_cliente_id');
            $data['ordem_servico_equipamento'] = $this->input->post('ordem_servico_equipamento');
            $data['ordem_servico_marca_equipamento'] = $this->input->post('ordem_servico_marca_equipamento');
            $data['ordem_servico_modelo_equipamento'] = $this->input->post('ordem_servico_modelo_equipamento');
            $data['ordem_servico_acessorios'] = $this->input->post('ordem_servico_acessorios');
            $data['ordem_servico_valor_desconto'] = $this->input->post('ordem_servico_valor_desconto');
            $data['ordem_servico_valor_total'] =  $this->input->post('ordem_servico_valor_total');
            $data['ordem_servico_status']  = $this->input->post('ordem_servico_status');
            $data['ordem_servico_obs'] = $this->input->post('ordem_servico_obs');
            $data['ordem_servico_defeito'] = $this->input->post('ordem_servico_defeito');
            $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));

            $data = html_escape($data);
            $this->core_model->insert('ordens_servicos', $data, TRUE);

            $id_ordem_servico = $this->session->userdata('last_id');

            $servico_id = $this->input->post('servico_id');
            $servico_quantidade = $this->input->post('servico_quantidade');
            $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
            $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));
            $servico_item_total = str_replace('R$', '', $this->input->post('servico_item_total'));
            $servico_preco = str_replace(',', '', $servico_preco);
            $servico_item_total = str_replace(',', '', $servico_item_total);
            $servico_qty = count($servico_id);
            //$ordem_servico_id = $this->input->post('ordem_servico_id');

            for ($i = 0; $i < $servico_qty; $i++) {

                $data1['ordem_ts_id_ordem_servico'] = $id_ordem_servico;
                $data1['ordem_ts_id_servico'] = $servico_id[$i];
                $data1['ordem_ts_quantidade'] = $servico_quantidade[$i];
                $data1['ordem_ts_valor_desconto']  = $servico_desconto[$i];
                $data1['ordem_ts_valor_total'] = $servico_item_total[$i];
                $data1['ordem_ts_valor_unitario'] = $servico_preco[$i];

                $data1 = html_escape($data1);
                $this->core_model->insert('ordem_tem_servicos', $data1);
            }

            redirect('OrdemServico/imprimir' . $id_ordem_servico);
        } else {

            $data = array(

                'titulo' => 'Adicionar Ordem de Serviço',

                'styles'  => array(
                    'public/assets/libs/select2/select2.min.css',
                    'public/assets/libs/autocomplete/jquery-ui.css',
                    'public/assets/libs/autocomplete/estilo.css',

                ),

                'scripts' => array(
                    'public/assets/libs/autocomplete/jquery-migrate.js',
                    'public/assets/libs/calcx/jquery-calx-sample-2.2.8.min.js',
                    'public/assets/libs/calcx/os.js',
                    'public/assets/libs/select2/select2.min.js',
                    'public/assets/libs/select2/app.js',
                    'public/assets/libs/sweetalert2/sweetalert2.js',
                    'public/assets/libs/autocomplete/jquery-ui.js',

                ),

                'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
            );

            // echo '<pre>';
            /// print_r($data);
            // exit();

            $this->load->view('layout/header', $data);
            $this->load->view('ordem/add');
            $this->load->view('layout/footer');
        }
    }


    public function edit($ordem_servico_id = NULL)
    {

        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_falshdata('error', 'Ordem de Serviço não existente');
            redirect('OrdemServico');
        } else {

            // exit('Ordem existe');
            $ordem_servico_status = $this->input->post('ordem_servico_status');

            if ($ordem_servico_status == 1) {
                $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', '', 'required');
            }
            $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_equipamento', '', 'required');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento', '', 'required');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento', '', 'required');
            $this->form_validation->set_rules('ordem_servico_acessorios', '', 'required');


            if ($this->form_validation->run()) {

                $ordem_servico_valor_total = str_replace('R$', "", trim($this->input->post('ordem_servico_valor_total')));

                $data['ordem_servico_forma_pagamento_id'] = $this->input->post('ordem_servico_forma_pagamento_id');
                $data['ordem_servico_cliente_id'] = $this->input->post('ordem_servico_cliente_id');
                $data['ordem_servico_equipamento'] = $this->input->post('ordem_servico_equipamento');
                $data['ordem_servico_marca_equipamento'] = $this->input->post('ordem_servico_marca_equipamento');
                $data['ordem_servico_modelo_equipamento'] = $this->input->post('ordem_servico_modelo_equipamento');
                $data['ordem_servico_acessorios'] = $this->input->post('ordem_servico_acessorios');
                $data['ordem_servico_valor_desconto'] = $this->input->post('ordem_servico_valor_desconto');
                $data['ordem_servico_valor_total'] =  $this->input->post('ordem_servico_valor_total');
                $data['ordem_servico_status']  = $this->input->post('ordem_servico_status');
                $data['ordem_servico_obs'] = $this->input->post('ordem_servico_obs');
                $data['ordem_servico_defeito'] = $this->input->post('ordem_servico_defeito');
                $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));

                if ($ordem_servico_status == 0) {
                    unset($data['ordem_servico_forma_pagamento_id']);
                }

                $data = html_escape($data);

                $this->core_model->update('ordens_servicos', $data, array('ordem_servico_id' => $ordem_servico_id));

                $this->ordem_servico_model->delete_old_services($ordem_servico_id);

                $servico_id = $this->input->post('servico_id');
                $servico_quantidade = $this->input->post('servico_quantidade');
                $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
                $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));
                $servico_item_total = str_replace('R$', '', $this->input->post('servico_item_total'));
                $servico_preco = str_replace(',', '', $servico_preco);
                $servico_item_total = str_replace(',', '', $servico_item_total);
                $servico_qty = count($servico_id);
                $ordem_servico_id = $this->input->post('ordem_servico_id');

                for ($i = 0; $i < $servico_qty; $i++) {

                    $data1['ordem_ts_id_ordem_servico'] = $ordem_servico_id;
                    $data1['ordem_ts_id_servico'] = $servico_id[$i];
                    $data1['ordem_ts_quantidade'] = $servico_quantidade[$i];
                    $data1['ordem_ts_valor_desconto']  = $servico_desconto[$i];
                    $data1['ordem_ts_valor_total'] = $servico_item_total[$i];
                    $data1['ordem_ts_valor_unitario'] = $servico_preco[$i];

                    $data1 = html_escape($data1);
                    $this->core_model->insert('ordem_tem_servicos', $data1);
                }

                redirect('OrdemServico/imprimir' . $ordem_servico_id);
            } else {

                $data = array(

                    'titulo' => 'Atualizar Ordem de Serviço',

                    'styles'  => array(
                        'public/assets/libs/select2/select2.min.css',
                        'public/assets/libs/autocomplete/jquery-ui.css',
                        'public/assets/libs/autocomplete/estilo.css',

                    ),

                    'scripts' => array(
                        'public/assets/libs/autocomplete/jquery-migrate.js',
                        'public/assets/libs/calcx/jquery-calx-sample-2.2.8.min.js',
                        'public/assets/libs/calcx/os.js',
                        'public/assets/libs/select2/select2.min.js',
                        'public/assets/libs/select2/app.js',
                        'public/assets/libs/sweetalert2/sweetalert2.js',
                        'public/assets/libs/autocomplete/jquery-ui.js',

                    ),

                    'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                    'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                    'os_tem_servicos' => $this->ordem_servico_model->get_all_servicos_by_ordem($ordem_servico_id),

                );

                $ordem_servico = $data['ordem_servico'] = $this->ordem_servico_model->get_by_id($ordem_servico_id);

                // echo '<pre>';
                /// print_r($data);
                // exit();

                $this->load->view('layout/header', $data);
                $this->load->view('ordem/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($ordem_servico_id = NULL)
    {

        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {
            $this->session->set_flashdata('error', 'O.S não encontrado selecione um valido');
            redirect('OrdemServico');
        } else {

            if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id, 'ordem_servico_status' => 0))) {
                $this->session->set_flashdata('error', 'Não e possivel excluir uma O.S já finalizada');
                redirect('OrdemServico');
            } else {
                $this->core_model->delete('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id));
                redirect('OrdemServico');
            }
        }
    }

    public function visualizar($ordem_servico_id = NULL)
    {

        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {
            $this->session->set_falshdata('error', 'Ordem de Serviço não existente');
            redirect('OrdemServico');
        } else {

            // echo '<pre>';
            // print_r('Passou');
            // exit();

            $data = array(
                'titulo' => 'Visualizar a O.S',


                'ordem_servico' => $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id)),
                'empresa' => $this->core_model->get_by_id('empresa', array('empresa_id' => 1)),
                'clientes' => $this->core_model->get_by_id('clientes', array('cliente_ativo' => 1)),
                'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                'os_tem_servicos' => $this->ordem_servico_model->get_all_servicos_by_ordem($ordem_servico_id),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('ordem/visualizar');
            $this->load->view('layout/footer');
        }
    }

    public function pdf($ordem_servico_id = NULL)
    {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {
            $this->session->set_falshdata('error', 'Ordem de Serviço não existente');
            redirect('OrdemServico');
        } else {

            $empresa = $this->core_model->get_by_id('empresa', array('empresa_id' => 1));
            $ordem_servico = $this->ordem_servico_model->get_by_id($ordem_servico_id);

            $file_name = 'O.S&nbsp;' . $ordem_servico->ordem_servico_id;

            $html = '<html>';
            $html .= '<head>'; 
            $html .= '<title>'.'O.S #&nbsp;' .$ordem_servico->ordem_servico_id.'</title>';
            $html .= '</head>';
            $html .= '<body style="font-size: 12px">';
            


             $html .= '<table width="100%" border: solid $ddd 1px>';
                 $html .= '<tr>';
                    $html .= '<th>Código da venda</th>';
                    $html .= '<th>Data</th>';
                    $html .= '<th>Cliente</th>';
                    $html .= '<th>Forma de pagamento</th>';
                    $html .= '<th>Valor total</th>';
                 $html .= '</tr>';
             $valor_final_vendas = $this->vendas_model->get_valor_final_relatorios();   
             foreach ($ordem_servico as $servico) :
                 $html .= '<tr>';
                     $html .= '<td>'.$servico->venda_id.'</td>';
                     $html .= '<td>'.$servico->venda_data_emissao.'</td>';
                     $html .= '<td>'.$servico->cliente_nome_completo.'</td>';
                     $html .= '<td>'.$servico->forma_pagamento.'</td>';
                     $html .= '<td>'.'R$&nbsp;'.$servico->venda_valor_total.'</td>';
                 $html .= '</tr>';    
             endforeach;
             $html .= '<th colspan="4">';
             $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor Total</strong></td>';
             $html .= '<td style="border-top: solid #ddd 1px>">'. 'R$&nbsp;' . $valor_final_vendas->venda_valor_total.'</td>';
             $html .= '</th>';
             $html .= '</table>';

            $html .= '</body>';
            $html .= '</html>';

            echo '<pre>';
            print_r($html);
            exit();

            $this->pdf->createPDF($html, $file_name, false);
        }
    }
}
