<?php
defined('BASEPATH') or exit('Ação não permitida');


class Clientes extends CI_Controller
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
            'titulo'  => 'Clientes',

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),

            'clientes' => $this->core_model->get_all('clientes'),
        );


        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
    }

    public function edit($cliente_id=NULL)
    {

        if (!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))) {
            $this->session->set_flashdata('error', 'Cliente não encontrado selecione um valido');
            redirect('clientes');
        } else {

            $this->form_validation->set_rules('cliente_nome', '', 'trim|required');
            
            if (!empty($this->input->post('cliente_telefone'))) {
                $this->form_validation->set_rules('cliente_telefone', '', 'required');
            }else{
                $this->form_validation->set_rules('cliente_telefone', '', 'required');
            }
            
            $cliente_tipo = $this->input->post('cliente_tipo');

            if ($cliente_tipo == 1) {
                $this->form_validation->set_rules('cliente_cpf', '', '');
            }else{
                $this->form_validation->set_rules('cliente_cnpj', '' ,'');
            }


            if ($this->form_validation->run()) {     
                $data['cliente_nome']             = $this->input->post('cliente_nome');
                $data['cliente_sobrenome']        = $this->input->post('cliente_sobrenome');
                $data['cliente_data_nascimento']  = $this->input->post('cliente_data_nascimento');
                $data['cliente_email']            = $this->input->post('cliente_email');
                $data['cliente_telefone']         = $this->input->post('cliente_telefone');
                $data['cliente_celular']          = $this->input->post('cliente_celular');
                $data['cliente_cep']              = $this->input->post('cliente_cep');
                $data['cliente_endereco']         = $this->input->post('cliente_endereco');
                $data['cliente_numero_endereco']  = $this->input->post('cliente_numero');
                $data['cliente_bairro']           = $this->input->post('cliente_bairro');
                $data['cliente_cidade']           = $this->input->post('cliente_cidade');
                $data['cliente_estado']           = $this->input->post('cliente_estado');
                $data['cliente_ativo']            = $this->input->post('cliente_ativo');
                $data['cliente_obs']              = $this->input->post('cliente_obs');
                $data['cliente_tipo']             = $this->input->post('cliente_tipo');

                if ($cliente_tipo == 1) {
                   $data['cliente_cpf_cnpj']     = $this->input->post('cliente_cpf');
                }else{
                   $data['cliente_cpf_cnpj']     = $this->input->post('cliente_cnpj');
                }

                if ($cliente_tipo == 1) {
                    $data['cliente_rg_ie']       = $this->input->post('cliente_rg');
                }else{ 
                   $data['cliente_rg_ie']        = $this->input->post('cliente_ie');
                }

                $data = html_escape($data);

                $this->core_model->update('clientes', $data, array('cliente_id' => $cliente_id));
                redirect('clientes');
        

            } else {

                $data =array(
                    'titulo' => 'Atualizar Cliente',
        
                    'scripts' => array(
                        'public/assets/js/main.js',
                        'public/assets/libs/jquery-mask/jquery.mask.min.js',
                      
                    ),
        
                    'cliente' => $this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id)),
                    
        
                );

                $this->load->view('layout/header', $data);
                $this->load->view('clientes/edit');
                $this->load->view('layout/footer');
            }
        }
        
    }

    public function add(){

        //$this->form_validation->set_rules('cliente_nome', '', 'trim|required');
            
            if (!empty($this->input->post('cliente_telefone'))) {
                $this->form_validation->set_rules('cliente_telefone', '', 'required');
            }else{
                $this->form_validation->set_rules('cliente_telefone', '', 'required');
            }
            
            $cliente_tipo = $this->input->post('cliente_tipo');

            if ($cliente_tipo == 1) {
                $this->form_validation->set_rules('cliente_cpf', '', 'is_unique[clientes.cliente_cpf_cnpj]');
                $this->form_validation->set_rules('cliente_nome', '', 'trim|required');
                $this->form_validation->set_rules('cliente_rg', '' ,'is_unique[clientes.cliente_rg_ie]');
            }else{
                $this->form_validation->set_rules('cliente_cnpj', '' ,'is_unique[clientes.cliente_cpf_cnpj]');
                $this->form_validation->set_rules('cliente_nome_fantasia', '', 'trim|required');
                $this->form_validation->set_rules('cliente_ie', '' ,'is_unique[clientes.cliente_rg_ie]');
            }

        if ($this->form_validation->run()) {

            $data['cliente_data_nascimento']  = $this->input->post('cliente_data_nascimento');
            $data['cliente_email']            = $this->input->post('cliente_email');
            $data['cliente_telefone']         = $this->input->post('cliente_telefone');
            $data['cliente_celular']          = $this->input->post('cliente_celular');
            $data['cliente_cep']              = $this->input->post('cliente_cep');
            $data['cliente_endereco']         = $this->input->post('cliente_endereco');
            $data['cliente_numero_endereco']  = $this->input->post('cliente_numero');
            $data['cliente_bairro']           = $this->input->post('cliente_bairro');
            $data['cliente_cidade']           = $this->input->post('cliente_cidade');
            $data['cliente_estado']           = $this->input->post('cliente_estado');
            $data['cliente_ativo']            = $this->input->post('cliente_ativo');
            $data['cliente_obs']              = $this->input->post('cliente_obs');
            $data['cliente_tipo']             = $this->input->post('cliente_tipo');

            if ($cliente_tipo == 1) {
               $data['cliente_cpf_cnpj']     = $this->input->post('cliente_cpf');
               $data['cliente_rg_ie']        = $this->input->post('cliente_rg');
               $data['cliente_nome']         = $this->input->post('cliente_nome');
               $data['cliente_sobrenome']    = $this->input->post('cliente_sobrenome');
            }else{
               $data['cliente_cpf_cnpj']     = $this->input->post('cliente_cnpj');
               $data['cliente_rg_ie']        = $this->input->post('cliente_ie');
               $data['cliente_nome']         = $this->input->post('cliente_razao');
               $data['cliente_sobrenome']    = $this->input->post('cliente_nome_fantasia');
            }

            $data = html_escape($data);

            $this->core_model->insert('clientes', $data);
            redirect('clientes');
           
        }else{

            $data = array(

                'titulo' => 'Adicionar Cliente',

                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',
                    'public/assets/js/clientes.js',

                ),

            );

            $this->load->view('layout/header', $data);
            $this->load->view('clientes/add');
            $this->load->view('layout/footer');
        }
    }
    
    public function del($cliente_id=NULL)
    {
        if (!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))) {
            $this->session->set_flashdata('error', 'Cliente não encontrado selecione um valido');
            redirect('clientes');
        } else {

            $this->core_model->delete('clientes', array('cliente_id' => $cliente_id));
            redirect('clientes');

        }
    }

    public function valida_cpf($cpf){

        if ($this->input->post('cliente_id')) {

            $cliente_id = $this->input->post('cliente_id');

            if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'Este CPF já existe');
                return FALSE;
            }
        }

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {

                    $d += $cpf[$c] * (($t + 1) - $c); 
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

    public function valida_cnpj($cnpj){
       
        // Verifica se um número foi informado
        if (empty($cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        if ($this->input->post('cliente_id')) {

            $cliente_id = $this->input->post('cliente_id');

            if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cnpj))) {
                $this->form_validation->set_message('valida_cnpj', 'Esse CNPJ já existe');
                return FALSE;
            }
        }

        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);


        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cnpj) != 14) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' ||
                $cnpj == '11111111111111' ||
                $cnpj == '22222222222222' ||
                $cnpj == '33333333333333' ||
                $cnpj == '44444444444444' ||
                $cnpj == '55555555555555' ||
                $cnpj == '66666666666666' ||
                $cnpj == '77777777777777' ||
                $cnpj == '88888888888888' ||
                $cnpj == '99999999999999') {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;

            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                //$soma2 += ($cnpj{$i} * $k);

                //$soma2 = intval($soma2) + ($cnpj{$i} * $k); //Para PHP com versão < 7.4
                $soma2 = intval($soma2) + ($cnpj[$i] * $k); //Para PHP com versão > 7.4

                if ($i < 12) {
                    //$soma1 = intval($soma1) + ($cnpj{$i} * $j); //Para PHP com versão < 7.4
                    $soma1 = intval($soma1) + ($cnpj[$i] * $j); //Para PHP com versão > 7.4
                }

                $k--;
                $j--;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

          //  if (!($cnpj{12} == $digito1) and ( $cnpj{13} == $digito2)) {
            //    $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
           //     return false;
           // } else {
           //     return true;
          //  }
        }
    }

    public function check_rg_ie($cliente_rg_ie){

        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', array('cliente_rg_ie' => $cliente_rg_ie, 'cliente_id !=' => $cliente_id))) {
           $this->form_validation->set_message('check_rg_ie', 'RG ou IE já cadastrado para um cliente!');
           return FALSE;
        }else{
           return TRUE;
        }
        
    }

    public function check_telefone($cliente_telefone){

        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', array('cliente_telefone' => $cliente_telefone, 'cliente_id !=' => $cliente_id))) {
           $this->form_validation->set_message('check_telefone', 'Telefone já cadastrado para um cliente!');
           return FALSE;
        }else{
            return TRUE;

        }
        
    }
}
