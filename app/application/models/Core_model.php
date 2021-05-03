<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Core_model extends CI_Model{

    public function get_all($table=NULL, $condition=NULL){
        
        if ($table) {
            if (is_array($condition)) {
                $this->db->where($condition);
            }
            return $this->db->get($table)->result();
        }else{
            return FALSE;
        }
    }

    public function get_by_id($table=NULL, $condition=NULL){
       
        if ($table && is_array($condition)) {
            $this->db->where($condition);
            $this->db->limit(1);

            return $this->db->get($table)->row();
            
        }else{
            return FALSE;
        }
    }

    public function insert($table=NULL, $data=NULL, $get_last_id=NULL){
        
        if ($table && is_array($data)) {

            $this->db->insert($table, $data);

           if ($get_last_id) {
               $this->session->set_userdata('last_id', $this->db->insert_id());
           }

           if ($this->db->affected_rows() > 0) {

               $this->session->set_flashdata('sucesso','Dados salvo com sucesso!');
           }else{

               $this->session->set_flashdata('error', 'Erro ao salvar dados.');
           }

        }else{
              
            return FALSE;

        }

    }

    public function update($table=NULL, $data=NULL, $condition=NULL){
        
        if ($table && is_array($data) && is_array($condition)) {

            if ($this->db->update($table, $data, $condition)) {
                
                $this->session->set_flashdata('sucesso', 'Dados alterados com sucesso!');
            }else{
               $this->session->set_flashdata('error', 'Erro ao alterar dados.');
            }
          
        }else{
            return FALSE;

        }
    }

    public function delete($table=NULL, $condition=NULL){
        
        $this->db->db_debug = FALSE;

        if ($table && is_array($condition)) {

            $status = $this->db->delete($table, $condition);
            $error  = $this->db->error();

            if (!$status) {
                foreach ($error as $code) {
                    if ($code == 1451) {
                        $this->session->set_flashdata('error', 'Esse registro não pode ser excluido, pois esta sendo usado em outra tabela.');
                    }
                }
            }else{
                $this->session->set_flashdata('sucesso', 'Registro excluido com sucesso!');
            }

            $this->db->db_debug = TRUE;

        }else{
            return FALSE;
        }

    }

    public function generate_unique_code($table = NULL, $type_of_code = NULL, $size_of_code, $field_search) {

        do {
            $code = random_string($type_of_code, $size_of_code);
            $this->db->where($field_search, $code);
            $this->db->from($table);
        } while ($this->db->count_all_results() >= 1);

        return $code;
    }

    public function auto_complete_produtos($busca = NULL){

        if ($busca) {

            $this->db->like('produto_descricao', $busca, 'both');
            $this->db->where('produto_ativo', 1);
            $this->db->where('produto_qtde_estoque >', 0);
            return $this->db->get('produtos')->result();        

        }else{
            return FALSE;
        }
       
    }

    public function auto_complete_servicos($busca=NULL){

        if ($busca) {

            $this->db->like('servico_descricao', $busca, 'both');
            $this->db->where('servico_ativo', 1);
            return $this->db->get('servicos')->result();        
             
        }else{
            return FALSE;
        }
        
    }
    
}
