<?php
defined('BASEPATH') or exit('Ação não permitida');

class Vendedores extends CI_Controller
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

            'titulo' => 'Vendedores',

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),

            'vendedores' => $this->core_model->get_all('vendedores'),

        );

        $this->load->view('layout/header', $data);
        $this->load->view('vendedores/index');
        $this->load->view('layout/footer');
    }

    public function add()
    {

        $this->form_validation->set_rules('vendedor_nome', '', 'required');
        $this->form_validation->set_rules('vendedor_cpf', '', 'trim|required|is_unique[vendedores.vendedor_cpf]');
        $this->form_validation->set_rules('vendedor_rg', '', 'trim|required|is_unique[vendedores.vendedor_rg]');
        $this->form_validation->set_rules('vendedor_telefone', '', 'required');
        $this->form_validation->set_rules('vendedor_email', '', 'required|valid_email');
        $this->form_validation->set_rules('vendedor_cep', '', 'required');
        $this->form_validation->set_rules('vendedor_endereco', '', 'required');
        $this->form_validation->set_rules('vendedor_numero', '', 'required');
        $this->form_validation->set_rules('vendedor_bairro', '', 'required');
        $this->form_validation->set_rules('vendedor_cidade', '', 'required');
        $this->form_validation->set_rules('vendedor_estado', '', 'required');

        if ($this->form_validation->run()) {

            $data['vendedor_nome_completo']      = $this->input->post('vendedor_nome');
            $data['vendedor_codigo']             = $this->input->post('vendedor_codigo');
            $data['vendedor_cpf']                = $this->input->post('vendedor_cpf');
            $data['vendedor_rg']                 = $this->input->post('vendedor_rg');
            $data['vendedor_telefone']           = $this->input->post('vendedor_telefone');
            $data['vendedor_celular']            = $this->input->post('vendedor_celular');
            $data['vendedor_email']              = $this->input->post('vendedor_email');
            $data['vendedor_cep']                = $this->input->post('vendedor_cep');
            $data['vendedor_endereco']           = $this->input->post('vendedor_endereco');
            $data['vendedor_numero_endereco']    = $this->input->post('vendedor_numero');
            $data['vendedor_bairro']             = $this->input->post('vendedor_bairro');
            $data['vendedor_cidade']             = $this->input->post('vendedor_cidade');
            $data['vendedor_estado']             = $this->input->post('vendedor_estado');
            $data['vendedor_ativo']              = $this->input->post('vendedor_ativo');
            $data['vendedor_obs']                = $this->input->post('vendedor_obs');

            $data = html_escape($data);
            $this->core_model->insert('vendedores', $data);
            redirect('vendedores');
        } else {

            $data = array(

                'titulo' => 'Adicionar Vendedor',

                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',

                ),

                'vendedor_codigo' => $this->core_model->generate_unique_code('vendedores', 'numeric', 8,  'vendedor_codigo'),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('vendedores/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($vendedor_id = NULL)
    {
        if (!$vendedor_id || !$this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id))) {
            $this->session->set_flashdata('error', 'vendedor não encontrado selecione um valido');
            redirect('vendedores');
        } else {

            $this->form_validation->set_rules('vendedor_nome', '', 'required');
            $this->form_validation->set_rules('vendedor_cpf', '', 'trim|required');
            $this->form_validation->set_rules('vendedor_rg', '', 'trim|required');
            $this->form_validation->set_rules('vendedor_telefone', '', 'required');
            $this->form_validation->set_rules('vendedor_email', '', 'required|valid_email');
            $this->form_validation->set_rules('vendedor_cep', '', 'required');
            $this->form_validation->set_rules('vendedor_endereco', '', 'required');
            $this->form_validation->set_rules('vendedor_numero', '', 'required');
            $this->form_validation->set_rules('vendedor_bairro', '', 'required');
            $this->form_validation->set_rules('vendedor_cidade', '', 'required');
            $this->form_validation->set_rules('vendedor_estado', '', 'required');


            if ($this->form_validation->run()) {

                $data['vendedor_nome_completo']      = $this->input->post('vendedor_nome');
                $data['vendedor_codigo']             = $this->input->post('vendedor_codigo');
                $data['vendedor_cpf']                = $this->input->post('vendedor_cpf');
                $data['vendedor_rg']                 = $this->input->post('vendedor_rg');
                $data['vendedor_telefone']           = $this->input->post('vendedor_telefone');
                $data['vendedor_celular']            = $this->input->post('vendedor_celular');
                $data['vendedor_email']              = $this->input->post('vendedor_email');
                $data['vendedor_cep']                = $this->input->post('vendedor_cep');
                $data['vendedor_endereco']           = $this->input->post('vendedor_endereco');
                $data['vendedor_numero_endereco']    = $this->input->post('vendedor_numero');
                $data['vendedor_bairro']             = $this->input->post('vendedor_bairro');
                $data['vendedor_cidade']             = $this->input->post('vendedor_cidade');
                $data['vendedor_estado']             = $this->input->post('vendedor_estado');
                $data['vendedor_ativo']              = $this->input->post('vendedor_ativo');
                $data['vendedor_obs']                = $this->input->post('vendedor_obs');

                $data =html_escape($data);
                $this->core_model->update('vendedores', $data, array('vendedor_id' => $vendedor_id));
                redirect('vendedores');
            } else {

                $data = array(

                    'titulo' => 'Atualizar Vendedor',

                    'scripts' => array(
                        'public/assets/js/main.js',
                        'public/assets/libs/jquery-mask/jquery.mask.min.js',

                    ),

                    'vendedor' => $this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id)),


                );

                $this->load->view('layout/header', $data);
                $this->load->view('vendedores/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($vendedor_id = NULL){

        if (!$vendedor_id || !$this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id))) {
            $this->session->set_flashdata('error', 'Vendedor não encontrado selecione um valido');
            redirect('vendedores');
        } else {

            $this->core_model->delete('vendedores', array('vendedor_id' => $vendedor_id));
            redirect('vendedores');

        }
        
    }
}
