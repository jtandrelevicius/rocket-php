<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Produtos_model extends CI_Model{

    public function get_all(){
       
        $this->db->select([
           'produtos.*',
           'categorias.categoria_id',
           'categorias.categoria_nome as categoria',
           'marcas.marca_id',
           'marcas.marca_nome as marca',
           'fornecedores.fornecedor_id',
           'fornecedores.fornecedor_nome_fantasia as fornecedor',
        ]);
        $this->db->join('categorias', 'categoria_id = produto_categoria_id','left');
        $this->db->join('marcas', 'marca_id = produto_marca_id', 'left');
        $this->db->join('fornecedores', 'fornecedor_id = produto_fornecedor_id', 'left');

        return $this->db->get('produtos')->result();

    }

    public function update($produto_id, $diferenca)
    {
       $this->db->set('produto_qtde_estoque', 'produto_qtde_estoque - ' .$diferenca, FALSE);
       $this->db->where('produto_id', $produto_id);
       $this->db->update('produtos');
    }


}