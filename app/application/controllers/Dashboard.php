<?php
defined('BASEPATH') or exit('Ação não permitida');


class Dashboard extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
         }
    }
    

    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('dashboard/index');
        $this->load->view('layout/footer');
    }
}
