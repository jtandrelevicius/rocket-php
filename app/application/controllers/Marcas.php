<?php
defined('BASEPATH') or exit('Ação não permitida');

class Marcas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }
    }

    public function index() {

        $data = array(

            'titulo' => 'Marcas',

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),

            'marcas' => $this->core_model->get_all('marcas'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/index');
        $this->load->view('layout/footer');

    }

    public function add(){

        $this->form_validation->set_rules('marca_nome' ,'','required');

       if ($this->form_validation->run()) {

        $data['marca_nome'] = $this->input->post('marca_nome');
        $data['marca_ativa'] = $this->input->post('marca_ativa');

        $data = html_escape($data);
        $this->core_model->insert('marcas', $data);
        redirect('marcas');
           
       }else{

        $data = array(

            'titulo' => 'Adicionar Marca',

          
            'scripts' => array(
                'public/assets/js/main.js',
                'public/assets/libs/jquery-mask/jquery.mask.min.js',

            ),

            
        );

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/add');
        $this->load->view('layout/footer');


       }

    }

    public function edit($marca_id=NULL){

        $this->form_validation->set_rules('marca_nome' ,'','required');

        if ($this->form_validation->run()) {
            $data['marca_nome'] = $this->input->post('marca_nome');
            $data['marca_ativa'] = $this->input->post('marca_ativa');
    
            $data = html_escape($data);
            $this->core_model->update('marcas', $data, array('marca_id' => $marca_id));
            redirect('marcas');
        }else{

            $data = array(

                'titulo' => 'Atualizar Marca',

                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',
    
                ),

                'marca' => $this->core_model->get_by_id('marcas', array('marca_id' => $marca_id)),
    

            );

            $this->load->view('layout/header', $data);
            $this->load->view('marcas/edit');
            $this->load->view('layout/footer');
        }
        
    }

    public function del($marca_id=NULL){

        if (!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))) {
            $this->session->set_flashdata('error', 'Marcas não encontrado selecione um valido');
            redirect('marcas');
        } else {

            $this->core_model->delete('marcas', array('marca_id' => $marca_id));
            redirect('marcas');

        }
        
    }
}