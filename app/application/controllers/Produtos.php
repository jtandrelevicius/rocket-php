<?php
defined('BASEPATH') or exit('Ação não permitida');

class Produtos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }

        $this->load->model('produtos_model');
    }

    public function index(){

        $data = array(

            'titulo' => 'Produtos',
            
            'styles'  => array(
                'public/assets/libs/datatables/datatables.css'
            ),

            'scripts' => array(
                'public/assets/libs/datatables/datatables.js',
                'public/assets/libs/datatables/app.js',
            ),

            'produtos' => $this->produtos_model->get_all(),
        );


       // echo '<pre>';
        //print_r($data['produtos']);
       // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('produtos/index');
        $this->load->view('layout/footer');
    }

    public function edit($produto_id=NULL){

        $this->form_validation->set_rules('produto_descricao', '', 'required');
        $this->form_validation->set_rules('produto_preco_custo', '', 'required');
        $this->form_validation->set_rules('produto_preco_venda', '', 'required');

        if ($this->form_validation->run()) {
           
            $data['produto_codigo'] = $this->input->post('produto_codigo');
            $data['produto_categoria_id'] = $this->input->post('produto_categoria_id');
            $data['produto_marca_id'] = $this->input->post('produto_marca_id');
            $data['produto_fornecedor_id'] = $this->input->post('produto_fornecedor_id');
            $data['produto_descricao'] = $this->input->post('produto_descricao');
            $data['produto_unidade'] = $this->input->post('produto_unidade');
            $data['produto_codigo_barras'] = $this->input->post('produto_codigo_barras');
            $data['produto_preco_custo'] = $this->input->post('produto_preco_custo');
            $data['produto_preco_venda'] = $this->input->post('produto_preco_venda');
            $data['produto_estoque_minimo'] = $this->input->post('produto_estoque_minimo');
            $data['produto_qtde_estoque'] = $this->input->post('produto_qtde_estoque');
            $data['produto_ativo']   = $this->input->post('produto_ativo');
            $data['produto_obs']   = $this->input->post('produto_obs');

            $data = html_escape($data);
            $this->core_model->update('produtos', $data, array('produto_id' => $produto_id));
            redirect('produtos');

        }else{
            $data = array(
                 
                'titulo' => 'Atualizar Produto',

                'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                'fornecedores' => $this->core_model->get_all('fornecedores', array('fornecedor_ativo' => 1)),
                'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),

                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',

                ),

                'produtos' => $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id)),  
            );

            $this->load->view('layout/header', $data);
            $this->load->view('produtos/edit');
            $this->load->view('layout/footer');
        }
    }

    public function add(){

        $this->form_validation->set_rules('produto_descricao', '', 'required');
        $this->form_validation->set_rules('produto_preco_custo', '', 'required');
        $this->form_validation->set_rules('produto_preco_venda', '', 'required');
        $this->form_validation->set_rules('produto_codigo', '','is_unique[produtos.produto_codigo]');
        $this->form_validation->set_rules('produto_codigo_barras', '', 'is_unique[produtos.produto_codigo_barras]');

        if ($this->form_validation->run()) {

            $data['produto_codigo'] = $this->input->post('produto_codigo');
            $data['produto_categoria_id'] = $this->input->post('produto_categoria_id');
            $data['produto_marca_id'] = $this->input->post('produto_marca_id');
            $data['produto_fornecedor_id'] = $this->input->post('produto_fornecedor_id');
            $data['produto_descricao'] = $this->input->post('produto_descricao');
            $data['produto_unidade'] = $this->input->post('produto_unidade');
            $data['produto_codigo_barras'] = $this->input->post('produto_codigo_barras');
            $data['produto_preco_custo'] = $this->input->post('produto_preco_custo');
            $data['produto_preco_venda'] = $this->input->post('produto_preco_venda');
            $data['produto_estoque_minimo'] = $this->input->post('produto_estoque_minimo');
            $data['produto_qtde_estoque'] = $this->input->post('produto_qtde_estoque');
            $data['produto_ativo']   = $this->input->post('produto_ativo');
            $data['produto_obs']   = $this->input->post('produto_obs');

            $data = html_escape($data);
            $this->core_model->insert('produtos', $data);
            redirect('produtos');
           
        }else{

            $data = array(

                'titulo' => 'Adicionar Produto',

                'marcas' => $this->core_model->get_all('marcas'),
                'fornecedores' => $this->core_model->get_all('fornecedores'),
                'categorias' => $this->core_model->get_all('categorias'),
                
                'scripts' => array(
                    'public/assets/js/main.js',
                    'public/assets/libs/jquery-mask/jquery.mask.min.js',

                ),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('produtos/add');
            $this->load->view('layout/footer');
        }
        
    }

    public function del($produto_id) {
        if (!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
            $this->session->set_flashdata('error', 'Produto não encontrado selecione um valido');
            redirect('produtos');
        } else {

            $this->core_model->delete('produtos', array('produto_id' => $produto_id));
            redirect('produtos');

        }
    }
}
