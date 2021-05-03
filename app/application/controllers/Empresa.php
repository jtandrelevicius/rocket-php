<?php
defined('BASEPATH') OR exit('Ação não permitida');


class Empresa extends CI_Controller{


    public function __construct(){
        parent:: __construct();
      
        if (!$this->ion_auth->logged_in()) {
           $this->session->set_flashdata('info', 'Sua sessão expirou');
           redirect('login');  
        }
        
    }

    public function index(){

        $data =array(
            'titulo' => 'Cadastro da Empresa',

            'scripts' => array(
                'public/assets/js/main.js',
                'public/assets/libs/jquery-mask/jquery.mask.min.js',
            ),

            'empresa' => $this->core_model->get_by_id('empresa', array('empresa_id' => 1)),

        );

        $this->form_validation->set_rules('empresa_razao_social', 'Razão Social', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('empresa_nome_fantasia' ,'Nome Fantasia', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('empresa_cnpj', '', 'required');
        $this->form_validation->set_rules('empresa_ie', '', 'required');
        $this->form_validation->set_rules('empresa_email_contabilidade', '', 'required|valid_email');
        $this->form_validation->set_rules('empresa_telefone_fixo', '', 'required');
        $this->form_validation->set_rules('empresa_cep', '', 'required');
        $this->form_validation->set_rules('empresa_endereco', '' ,'required');
        $this->form_validation->set_rules('empresa_numero', '' ,'required');
        $this->form_validation->set_rules('empresa_bairro', '' ,'required');
        $this->form_validation->set_rules('empresa_cidade', '' ,'required');
        $this->form_validation->set_rules('empresa_estado', '', 'required');

       
        if ($this->form_validation->run()) {
        
            $data = elements(
                array(
    
                    'empresa_razao_social',
                    'empresa_nome_fantasia',
                    'empresa_cnpj',
                    'empresa_ie',
                    'empresa_im',
                    'empresa_regime_tributario',
                    'empresa_cnae',
                    'empresa_email_contabilidade',
                    'empresa_email',
                    'empresa_telefone_fixo',
                    'empresa_telefone_movel',
                    'empresa_site_url',
                    'empresa_cep',
                    'empresa_endereco',
                    'empresa_numero',
                    'empresa_bairro',
                    'empresa_cidade',
                    'empresa_estado',
                    'empresa_ibge',
                    'empresa_txt_ordem_servico',

                ), $this->input->post()   
            );
         $data = html_escape($data);
         $this->core_model->update('empresa',$data, array('empresa_id' => 1));
         redirect('empresa');


        }else{

        $this->load->view('layout/header', $data);
        $this->load->view('empresa/index');
        $this->load->view('layout/footer');
           
      
        }
        
    }
}