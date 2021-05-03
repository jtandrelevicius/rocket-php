<?php
defined('BASEPATH') or exit('Ação não permitida');


class Fornecedores extends CI_Controller
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

            'titulo' => 'Fornecedores',

            'fornecedor' => $this->core_model->get_all('fornecedores'),

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/index');
        $this->load->view('layout/footer');
    }

    public function edit($fornecedor_id = NULL)
    {
        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))) {
            $this->session->set_flashdata('error', 'Fornecedor não encontrado selecione um valido');
            redirect('fornecedores');
        } else {

            $this->form_validation->set_rules('fornecedor_nome_fantasia', 'Nome ', 'required');
            $this->form_validation->set_rules('fornecedor_razao', '', 'required');
            $this->form_validation->set_rules('fornecedor_cnpj', '', 'required');
            $this->form_validation->set_rules('fornecedor_ie', '', 'required');
            $this->form_validation->set_rules('fornecedor_telefone', '','required');
            $this->form_validation->set_rules('fornecedor_email', '', 'required');
            $this->form_validation->set_rules('fornecedor_contato', '', 'required');
            $this->form_validation->set_rules('fornecedor_cep' , '', 'required');
            $this->form_validation->set_rules('fornecedor_endereco', '', 'required');
            $this->form_validation->set_rules('fornecedor_numero', '' ,'required');
            $this->form_validation->set_rules('fornecedor_bairro', '' ,'required');
            $this->form_validation->set_rules('fornecedor_cidade', '' ,'required');
            $this->form_validation->set_rules('fornecedor_estado', '','required');


            if ($this->form_validation->run()) {

                $data['fornecedor_razao']            = $this->input->post('fornecedor_razao');
                $data['fornecedor_nome_fantasia']    = $this->input->post('fornecedor_nome_fantasia');
                $data['fornecedor_cnpj']             = $this->input->post('fornecedor_cnpj');
                $data['fornecedor_ie']               = $this->input->post('fornecedor_ie');
                $data['fornecedor_telefone']         = $this->input->post('fornecedor_telefone');
                $data['fornecedor_celular']          = $this->input->post('fornecedor_celular');
                $data['fornecedor_email']            = $this->input->post('fornecedor_email');
                $data['fornecedor_contato']          = $this->input->post('fornecedor_contato');
                $data['fornecedor_ativo']            = $this->input->post('fornecedor_ativo');
                $data['fornecedor_cep']              = $this->input->post('fornecedor_cep');
                $data['fornecedor_endereco']         = $this->input->post('fornecedor_endereco');
                $data['fornecedor_numero_endereco']  = $this->input->post('fornecedor_numero');
                $data['fornecedor_bairro']           = $this->input->post('fornecedor_bairro');
                $data['fornecedor_cidade']           = $this->input->post('fornecedor_cidade');
                $data['fornecedor_estado']           = $this->input->post('fornecedor_estado');
                $data['fornecedor_obs']              = $this->input->post('fornecedor_obs');


                $data = html_escape($data);
                $this->core_model->update('fornecedores', $data, array('fornecedor_id' => $fornecedor_id));
                redirect('fornecedores');
            } else {
            
                $data = array(
                    'titulo' => 'Atualizar Fornecedor',

                    'fornecedor' => $this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id)),

                    'scripts' => array(
                        'public/assets/js/main.js',
                        'public/assets/libs/jquery-mask/jquery.mask.min.js',

                    ),

                );

                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function add(){

        $this->form_validation->set_rules('fornecedor_razao', '' ,'required');
        $this->form_validation->set_rules('fornecedor_nome_fantasia', '' ,'required');
        $this->form_validation->set_rules('fornecedor_cnpj', '','required|is_unique[fornecedores.fornecedor_cnpj]');
        $this->form_validation->set_rules('fornecedor_ie', '', 'required|is_unique[fornecedores.fornecedor_ie]');
        $this->form_validation->set_rules('fornecedor_telefone', '', 'required');
        $this->form_validation->set_rules('fornecedor_email', '', 'required|valid_email');
        $this->form_validation->set_rules('fornecedor_contato', '', 'required');
        $this->form_validation->set_rules('fornecedor_cep', '', 'required');
        $this->form_validation->set_rules('fornecedor_endereco', '', 'required');
        $this->form_validation->set_rules('fornecedor_numero', '', 'required');
        $this->form_validation->set_rules('fornecedor_bairro', '', 'required');
        $this->form_validation->set_rules('fornecedor_cidade', '', 'required');
        $this->form_validation->set_rules('fornecedor_estado' ,'', 'required');

        if ($this->form_validation->run()) {
            
            $data['fornecedor_razao']          =  $this->input->post('fornecedor_razao');
            $data['fornecedor_nome_fantasia']  =  $this->input->post('fornecedor_nome_fantasia');
            $data['fornecedor_cnpj']           =  $this->input->post('fornecedor_cnpj');
            $data['fornecedor_ie']             =  $this->input->post('fornecedor_ie');
            $data['fornecedor_telefone']       =  $this->input->post('fornecedor_telefone');
            $data['fornecedor_celular']        =  $this->input->post('fornecedor_celular');
            $data['fornecedor_email']          = $this->input->post('fornecedor_email');
            $data['fornecedor_contato']        = $this->input->post('fornecedor_contato');
            $data['fornecedor_cep']            = $this->input->post('fornecedor_cep');
            $data['fornecedor_endereco']       = $this->input->post('fornecedor_endereco');
            $data['fornecedor_numero_endereco']= $this->input->post('fornecedor_numero');
            $data['fornecedor_bairro']         = $this->input->post('fornecedor_bairro');
            $data['fornecedor_cidade']         = $this->input->post('fornecedor_cidade');
            $data['fornecedor_estado']         = $this->input->post('fornecedor_estado');

            $data = html_escape($data);
            $this->core_model->insert('fornecedores', $data);
            redirect('fornecedores');

        }else{

            $data = array(
                'titulo' => 'Adicionar Fornecedor',
    
                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',
    
                ),
    
    
            );
    
            $this->load->view('layout/header',$data);
            $this->load->view('fornecedores/add');
            $this->load->view('layout/footer');

        }

    }

    public function del($fornecedor_id){

        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))) {
            $this->session->set_flashdata('error', 'Fornecedor não encontrado selecione um valido');
            redirect('fornecedores');
        } else {

            $this->core_model->delete('fornecedores', array('fornecedor_id' => $fornecedor_id));
            redirect('fornecedores');

        }

    }
}
