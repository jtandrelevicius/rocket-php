<?php
defined('BASEPATH') OR exit('Ação não permitida');


class Pagamento extends CI_Controller{

    public function __construct(){
        parent:: __construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }

    }

    public function index() {

        $data = array(

            'titulo' => 'Formas de Pagamento',


            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),


            'pagamentos' => $this->core_model->get_all('formas_pagamentos'),


        );

        $this->load->view('layout/header' ,$data);
        $this->load->view('pagamento/index');
        $this->load->view('layout/footer');
       
    }

    public function add(){

        $this->form_validation->set_rules('forma_pagamento_nome', '','required');
        $this->form_validation->set_rules('forma_pagamento_aceita_parc','','required');
      
        if ($this->form_validation->run()) {

            $data['forma_pagamento_nome'] = $this->input->post('forma_pagamento_nome');
            $data['forma_pagamento_aceita_parc'] = $this->input->post('forma_pagamento_aceita_parc');
            $data['forma_pagamento_ativa'] = $this->input->post('forma_pagamento_ativa');

            $data = html_escape($data);
            $this->core_model->insert('formas_pagamentos', $data);
            redirect('pagamento');
            
        }else{

            $data = array(

                'titulo' => 'Adicionar Forma de Pagamento',

                
                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',

                ),

            );

            $this->load->view('layout/header', $data);
            $this->load->view('pagamento/add');
            $this->load->view('layout/footer');
        }
       
    }

    public function edit($pagamento_id=NULL){

        $this->form_validation->set_rules('forma_pagamento_nome', '', 'required');
    
        if ($this->form_validation->run()) {

            $data['forma_pagamento_nome']= $this->input->post('forma_pagamento_nome');
            $data['forma_pagamento_aceita_parc'] = $this->input->post('forma_pagamento_aceita_parc');
            $data['forma_pagamento_ativa'] = $this->input->post('forma_pagamento_ativa');

            $data = html_escape($data);
            $this->core_model->update('formas_pagamentos', $data, array('forma_pagamento_id' => $pagamento_id));
            redirect('pagamento');

            
        }else{

            $data = array(

                'titulo' => 'Atualizar Forma de Pagamento',

                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',
                ),

                'pagamento' => $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $pagamento_id)),

            );

            $this->load->view('layout/header', $data);
            $this->load->view('pagamento/edit');
            $this->load->view('layout/footer');
        }
       
    }

    public function del($pagamento_id=NULL){
        
    }


}