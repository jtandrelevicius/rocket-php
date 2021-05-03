<?php
defined('BASEPATH') or exit('Ação não permitida');

class Categorias extends CI_Controller
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

            'titulo' => 'Categorias',

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),
            
            'categorias' => $this->core_model->get_all('categorias'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');
    }

    public function add(){

        $this->form_validation->set_rules('categoria_nome', '', 'required');
        
        if ($this->form_validation->run()) {
            
            $data['categoria_nome'] = $this->input->post('categoria_nome');
            $data['categoria_ativa'] = $this->input->post('categoria_ativa');

            $data = html_escape($data);
            $this->core_model->insert('categorias', $data);
            redirect('categorias');

        } else {

            $data = array(

                'titulo' => 'Adicionar Categoria',


                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',

                ),

            );

            $this->load->view('layout/header', $data);
            $this->load->view('categorias/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($categoria_id = NULL){

        $this->form_validation->set_rules('categoria_nome', '', 'required');
        
        if ($this->form_validation->run()) {

            $data['categoria_nome'] = $this->input->post('categoria_nome');
            $data['categoria_ativa'] = $this->input->post('categoria_ativa');

            $data = html_escape($data);
            $this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));
            redirect('categorias');
            
        }else{

            $data = array(
              'titulo' => 'Atualizar Categoria',

              'scripts' => array(
                'public/assets/js/main.js',
                'public/assets/libs/jquery-mask/jquery.mask.min.js',

            ),

              'categoria' => $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('categorias/edit');
            $this->load->view('layout/footer');

        }
    }

    public function del($categoria_id = NULL){

        if (!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
            $this->session->set_flashdata('error', 'Categoria não encontrado selecione um valido');
            redirect('categorias');
        } else {

            $this->core_model->delete('categorias', array('categoria_id' => $categoria_id));
            redirect('categorias');

        }
    }
}
