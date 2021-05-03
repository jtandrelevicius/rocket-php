<?php
defined('BASEPATH') or exit('Ação não permitida');

class Servicos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }
    }

    public function index()
    {

        $data = array(

            'titulo' => 'Serviços',

            'servicos' => $this->core_model->get_all('servicos'),

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),

        );

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/index');
        $this->load->view('layout/footer');
    }

    public function add() {

        $this->form_validation->set_rules('servico_nome' , '' , 'required');
        $this->form_validation->set_rules('servico_preco', '' ,'required');
        $this->form_validation->set_rules('servico_descricao', '' ,'required');

        if ($this->form_validation->run()) {

            $data['servico_nome']       = $this->input->post('servico_nome');
            $data['servico_preco']      = $this->input->post('servico_preco');
            $data['servico_descricao']  = $this->input->post('servico_descricao');
            $data['servico_ativo']      = $this->input->post('servico_ativo');

            $data = html_escape($data);
            $this->core_model->insert('servicos',$data);
            redirect('servicos');          

        } else {

            $data = array(

                'titulo' => 'Adicionar Serviço',

                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',

                ),

            );

            $this->load->view('layout/header', $data);
            $this->load->view('servicos/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($servico_id = NULL){

        if (!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))) {
            $this->session->set_flashdata('error', 'Serviço não encontrado selecione um valido');
            redirect('servicos');
        } else {

            $this->form_validation->set_rules('servico_nome' , '' , 'required');
            $this->form_validation->set_rules('servico_preco', '' ,'required');
            $this->form_validation->set_rules('servico_descricao', '' ,'required');

        if ($this->form_validation->run()) {

            $data['servico_nome']       = $this->input->post('servico_nome');
            $data['servico_preco']      = $this->input->post('servico_preco');
            $data['servico_descricao']  = $this->input->post('servico_descricao');
            $data['servico_ativo']      = $this->input->post('servico_ativo');

            $data = html_escape($data);
            $this->core_model->update('servicos', $data, array('servico_id' => $servico_id));
            redirect('servicos');          

        }else{

            
        $data = array(

            'titulo' => 'Atualizar Serviço',

            'scripts' => array(
                'public/assets/js/main.js',
                'public/assets/libs/jquery-mask/jquery.mask.min.js',

            ),

            'servicos' => $this->core_model->get_by_id('servicos', array('servico_id' => $servico_id)),

        );

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/edit');
        $this->load->view('layout/footer');

        }

    }
}

    public function del($servico_id = NULL){

        if (!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))) {
            $this->session->set_flashdata('error', 'Serviço não encontrado selecione um valido');
            redirect('servicos');
        } else {

            $this->core_model->delete('servicos', array('servico_id' => $servico_id));
            redirect('servicos');

        }
    }
}
