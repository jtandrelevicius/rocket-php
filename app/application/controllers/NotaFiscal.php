<?php
defined('BASEPATH') OR exit('Ação não permitida');

class NotaFiscal extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }

        $this->load->model('notafiscal_model');
    }

    public function index()
    {
       
    }

    public function add($venda_id)
    {
      
    }


}