<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Financeiro_model extends CI_Model{

    public function get_all_pagar(){
        
        $this->db->select([
            'contas_pagar.*',
            'fornecedor_id',
            'fornecedor_nome_fantasia as fornecedor_nome',
        ]);

        $this->db->join('fornecedores', 'fornecedor_id =  conta_pagar_fornecedor_id','left');
        return $this->db->get('contas_pagar')->result();
    }

    public function get_all_receber() {
        
        $this->db->select([
          'contas_receber.*',
          'cliente_id',
          'cliente_nome as cliente_nome',
        ]);
        $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'left');
        return $this->db->get('contas_receber')->result();
    }

    public function get_contas_receber_relatorio($conta_receber_status=NULL, $data_vencimento=NULL)
    {
        $this->db->select([
            'contas_receber.*',
            'clientes.cliente_id',
            'CONCAT(clientes.cliente_nome, " ", clientes.cliente_sobrenome)as cliente_nome_completo',
        ]);
        $this->db->where('conta_receber_status', $conta_receber_status);
        $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'left');

        if ($data_vencimento) {
            date_default_timezone_set('America/Fortaleza');
            $this->db->where('conta_receber_data_vencto <', date('Y-m-d'));
        }
        return $this->db->get('contas_receber')->result();
        
    }

    public function get_sum_contas_receber_relatorio($conta_receber_status=NULL, $data_vencimento=NULL)
    { 
        $this->db->select([
          'FORMAT(SUM(REPLACE(conta_receber_valor, ",", "")), 2) as valor_total',
        ]);
        $this->db->where('conta_receber_status', $conta_receber_status);
        
        if ($data_vencimento) {
            date_default_timezone_set('America/Fortaleza');
            $this->db->where('conta_receber_data_vencto <', date('Y-m-d'));

        }
      return $this->db->get('contas_receber')->row();
    }

    public function get_contas_pagar_relatorio()
    {
       
    }
}