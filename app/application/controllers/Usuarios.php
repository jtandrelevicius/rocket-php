<?php
defined('BASEPATH') or exit('Ação não permitida');

class Usuarios extends CI_Controller{

    public function __construct(){
        parent::__construct();
        
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
         }
    }

    public function index(){
        
        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Você não possui autorização para realizar essa opreção');
            redirect('/');
        }

        $data = array(
            'titulo'  => 'Usuários',

            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),

            'usuarios' => $this->ion_auth->users()->result(),
        );


        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function edit($user_id = NULL){

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Você não possui autorização para realizar essa opreção');
            redirect('/');
        }

        if (!$user_id || !$this->ion_auth->user($user_id)->row()) {

            $this->session->set_flashdata('error', 'Usuário não encotrado');
            redirect('usuarios');
           
        } else {

            $this->form_validation->set_rules('first_name', '', 'trim|required');
            $this->form_validation->set_rules('last_name','', 'trim|required');
            $this->form_validation->set_rules('username', '', 'trim|required|callback_user_check');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check');


            if ($this->form_validation->run()) {
               
                 $data = elements(
                    array(
                        'first_name',
                        'last_name',
                        'username',
                        'email',
                        'active',
                        'password'

                    ), $this->input->post()       
                 );

                 $data = $this->security->xss_clean($data);
                
                 $password = $this->input->post('password');

                 if (!$password) {
                     
                    unset($data['password']);
                 }
                 
                 if ($this->ion_auth->update($user_id, $data)) {
                    
                    $perfil_user_db = $this->ion_auth->get_users_groups($user_id)->row();

                    $perfil_user_post = $this->input->post('perfil');

                    if ($perfil_user_post != $perfil_user_db->id) {
                       
                        $this->ion_auth->remove_from_group($perfil_user_db->id, $user_id);
                        $this->ion_auth->add_to_group($perfil_user_post, $user_id);
                    }
                    
                    $this->session->set_flashdata('sucesso', 'Registro alterado com sucesso!');
                   
                 }else{
                     $this->session->set_flashdata('error', 'Erro ao alterar o registro');
                 }
                 redirect('usuarios');
            }else{

                $data = array(

                    'titulo' => 'Atualizar usuário',
    
                    'usuario' => $this->ion_auth->user($user_id)->row(),
    
                    'perfil_user' => $this->ion_auth->get_users_groups($user_id)->row(),
                );
    
                $this->load->view('layout/header',$data);
                $this->load->view('usuarios/edit');
                $this->load->view('layout/footer');
            }

            
        }
    }

    public function email_check($email){
        
        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {

            $this->form_validation->set_message('email_check', 'Esse e-mail ja existe cadastrado!');
            return FALSE;
            
        }else{

            return TRUE;

        }
    }

    public function user_check($username){
        
        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' =>$usuario_id))) {

            $this->form_validation->set_message('user_check', 'Esse usuário ja existe cadastrado!');
            return FALSE;
            
        }else{
            return TRUE;
        }
    }

    public function add(){

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Você não possui autorização para realizar essa opreção');
            redirect('/');
        }

        $this->form_validation->set_rules('first_name', '','trim|required');
        $this->form_validation->set_rules('last_name', '', 'trim|required');
        $this->form_validation->set_rules('username', '' ,'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('email', '', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('password', '' ,'required');

        if ($this->form_validation->run()) {

            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $email    = $this->security->xss_clean($this->input->post('email'));
            $additional_data = array(

                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'active'     => $this->input->post('active'),

            );
            
            $group = array($this->input->post('perfil'));

            $additional_data = $this->security->xss_clean($additional_data);
            $group           = $this->security->xss_clean($group);

            //;

            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
                
                $this->session->set_flashdata('sucesso', 'Registro adicionado com sucesso!');
            }else{
                $this->session->set_flashdata('error', 'Erro ao adicionar o registro.');
            }
            redirect('usuarios');

        }else{

            $data = array(

                'titulo' => 'Adicionar usuário',
                
                
            );
          
        $this->load->view('layout/header',$data);
        $this->load->view('usuarios/add');
        $this->load->view('layout/footer');
        }

    }

    public function del($user_id=NULL){
      
        if (!$user_id || !$this->ion_auth->user($user_id)->row()) {

            $this->session->set_flashdata('error','Usuário não encontrado.');
            redirect('usuarios');
        }

        if($this->ion_auth->is_admin($user_id)){
            $this->session->set_flashdata('error', 'O usuário administrado não pode ser excluido');
            redirect('usuarios');

        }else{

            if ($this->ion_auth->delete_user($user_id)) {

                $this->session->set_flashdata('sucesso', 'Usuário excluido com sucesso!');
                redirect('usuarios');
            }else{
                $this->sessicon->set_flashdata('error', 'Erro ao excluir o usuário.');
                redirect('usuarios');
             
            }
        }

   
 
    }
}
