<?php
defined('BASEPATH') OR exit('Ação não permitida');


class Receber extends CI_Controller{

    public function __construct(){
        parent:: __construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }

        $this->load->model('financeiro_model');
    }

    public function index() {

        $data = array(

            'titulo' => 'Contas a Receber',

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),

            'contas_receber' => $this->financeiro_model->get_all_receber(),
        );

        //echo '<pre>';
        //print_r($data['contas_receber']);
       // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('receber/index');
        $this->load->view('layout/footer');
       
    }

    public function add(){

        $this->form_validation->set_rules('conta_receber_cliente_id','','required');
        $this->form_validation->set_rules('conta_receber_data_vencto', '', 'required');
        $this->form_validation->set_rules('conta_receber_valor', '' ,'required');
        $this->form_validation->set_rules('conta_receber_obs', '', 'required');

        if ($this->form_validation->run()) {

            $data['conta_receber_cliente_id'] = $this->input->post('conta_receber_cliente_id');
            $data['conta_receber_data_vencto'] = $this->input->post('conta_receber_data_vencto');
            $data['conta_receber_valor'] = $this->input->post('conta_receber_valor');
            $data['conta_receber_obs'] = $this->input->post('conta_receber_obs');

            $data = html_escape($data);
            $this->core_model->insert('contas_receber', $data);
            redirect('receber');
           
        }else{

            $data = array(

                'titulo' => 'Adicionar Conta a Receber',

                
                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',

                ),

                'clientes' => $this->core_model->get_all('clientes' , array('cliente_ativo' => 1)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('receber/add');
            $this->load->view('layout/footer');


        }
       
    }

    public function edit($conta_receber_id=NULL){
        
        $this->form_validation->set_rules('conta_receber_cliente_id','','required');
        $this->form_validation->set_rules('conta_receber_data_vencto', '', 'required');
        $this->form_validation->set_rules('conta_receber_valor', '' ,'required');
        $this->form_validation->set_rules('conta_receber_obs', '', 'required');

        if ($this->form_validation->run()) {

            $data['conta_receber_cliente_id'] = $this->input->post('conta_receber_cliente_id');
            $data['conta_receber_data_vencto'] = $this->input->post('conta_receber_data_vencto');
            $data['conta_receber_valor'] = $this->input->post('conta_receber_valor');
            $data['conta_receber_status'] = $this->input->post('conta_receber_status');
            $data['conta_receber_obs'] = $this->input->post('conta_receber_obs');

            $data = html_escape($data);
            $this->core_model->update('contas_receber', $data, array('conta_receber_id' => $conta_receber_id));
            redirect('receber');
            
        }else{

            $data = array(

                'titulo' => 'Atualizar Conta a Receber',

                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',
                    'public/assets/libs/select/custom.js',
                    'public/assets/libs/select/select2.min.js',
                ),

                'styles'  => array(
                    'public/assets/libs/select/select2.min.css'
                ),

                'contas_receber' => $this->core_model->get_by_id('contas_receber' , array('conta_receber_id' => $conta_receber_id)),
                'clientes'    => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),


            );

            $this->load->view('layout/header', $data);
            $this->load->view('receber/edit');
            $this->load->view('layout/footer');


        }
       
    }

    public function del($conta_receber_id=NULL){
        if (!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id))) {
            $this->session->set_flashdata('error', 'Conta não encontrado selecione um valido');
            redirect('receber');
        } else {

            $this->core_model->delete('contas_receber', array('conta_receber_id' => $conta_receber_id));
            redirect('receber');

        }
    }


}