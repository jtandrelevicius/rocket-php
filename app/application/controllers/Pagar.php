<?php
defined('BASEPATH') or exit('Ação não permitida');

class Pagar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }
        $this->load->model('financeiro_model');
    }

    public function index()
    {

        $data = array(

            'titulo' => 'Contas a Pagar',

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),


            'contas_pagar' => $this->financeiro_model->get_all_pagar(),
        );

        // echo '<pre>';
        //print_r($data['contas_pagar']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/index');
        $this->load->view('layout/footer');
    }

    public function add(){

        $this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
        $this->form_validation->set_rules('conta_pagar_valor', '', 'required');
        $this->form_validation->set_rules('conta_pagar_obs', '', 'required');
        $this->form_validation->set_rules('conta_pagar_data_vencto', '', 'required');

        if ($this->form_validation->run()) { 

            $data['conta_pagar_fornecedor_id'] = $this->input->post('conta_pagar_fornecedor_id');
            $data['conta_pagar_valor']         = $this->input->post('conta_pagar_valor');
            $data['conta_pagar_obs']           = $this->input->post('conta_pagar_obs');
            $data['conta_pagar_data_vencto']    = $this->input->post('conta_pagar_data_vencto');

            $data= html_escape($data);
            $this->core_model->insert('contas_pagar', $data);
            redirect('pagar');
           
        }else{

            $data = array(

                'titulo' => 'Adicionar Conta a Pagar',

                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',

                ),

                'fornecedores' => $this->core_model->get_all('fornecedores', array('fornecedor_ativo' => 1)),

            );

            $this->load->view('layout/header' , $data);
            $this->load->view('pagar/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($conta_pagar_id = NULL)
    {
      

            $this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
            $this->form_validation->set_rules('conta_pagar_valor', '', 'required');
            $this->form_validation->set_rules('conta_pagar_status', '', 'required');
            $this->form_validation->set_rules('conta_pagar_obs', '', 'required');

            if ($this->form_validation->run()) {
             
                $data['conta_pagar_fornecedor_id'] = $this->input->post('conta_pagar_fornecedor_id');
                $data['conta_pagar_valor']         = $this->input->post('conta_pagar_valor');
                $data['conta_pagar_status']        = $this->input->post('conta_pagar_status');
                $data['conta_pagar_obs']           = $this->input->post('conta_pagar_obs');

                $conta_status = $this->input->post('conta_pagar_status');
                
                if ($conta_status == 1){
                  $data['conta_pagar_data_pagamento'] =  date('Y-m-d h:i:s');
                }

                $data= html_escape($data);
                $this->core_model->update('contas_pagar', $data, array('conta_pagar_id' => $conta_pagar_id));
                redirect('pagar');

            } else {

                $data = array(

                    'titulo' => 'Atualizar Contas a Pagar',

                    'scripts' => array(
                        'public/assets/js/main.js',
                        'public/assets/libs/jquery-mask/jquery.mask.min.js',
                        'public/assets/libs/select/custom.js',
                        'public/assets/libs/select/select2.min.js',
                    ),

                    'styles'  => array(
                        'public/assets/libs/select/select2.min.css'
                    ),

                    'contas_pagar' => $this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id)),
                    'fornecedores' => $this->core_model->get_all('fornecedores', array('fornecedor_ativo' => 1)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('pagar/edit');
                $this->load->view('layout/footer');
            }
        
    }

    public function del($conta_pagar_id = NULL){

        if (!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))) {
            $this->session->set_flashdata('error', 'Conta não encontrado selecione um valido');
            redirect('pagar');
        } else {

            $this->core_model->delete('contas_pagar', array('conta_pagar_id' => $conta_pagar_id));
            redirect('pagar');

        }
    }
}
