<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Dashboard_model extends CI_Model{
 
  public function get_sum_vendas()
  {
      $this->db->select([
           'FORMAT(SUM(REPLACE(venda_valor_total, ",", "")),2) as venda_valor_total',
      ]);
      return $this->db->get('vendas')->row();
  }

  public function get_sum_ordem_servicos()
  {
      $this->db->select([
          'FORMAT(SUM(REPLACE(ordem_servico_total, ",", "")),2)as ordem_servico_total',
      ]);
    return $this->db->get('ordens_servicos')->row();
  }

  public function get_sum_conta_receber()
  {
      $this->db->select([
       'FORMAT(SUM(REPLACE(conta_receber_valor, ",", "")),2) as conta_receber_valor',
      ]);
      $this->db->where('conta_receber_status', 0);
      return $this->db->get('contas_receber');
  }

  public function get_sum_conta_pagar()
  {
    $this->db->select([
     'FORMAT(SUM(REPLACE(conta_pagar_valor, ",", "")),2)as conta_pagar_valor',
    ]);  
    $this->db->where('conta_pagar_status', 0);
    return $this->db->get('contas_pagar');
  }

  public function get_contas_pagar_vence_hoje()
  {
    $this->db->select([
        'contas_pagar.*',
        'fornecedor_id',
        'fornecedor_nome_fantasia as fornecedor_nome',
    ]);
    $this->db->where('conta_pagar_status' ,0);
    $this->db->where('conta_pagar_data_vencimento =', date('Y-m-d'));
    $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'left');
    return $this->db->get('contas_pagar')->result();

  }

  public function get_contas_receber_vence_hoje()
  {
      $this->db->select([
          'contas_receber.*',
          'cliente_id',
          'CONCAT(clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome',

      ]);
      $this->db->where('conta_receber_status', 0);
      $this->db->where('conta_receber_data_vencimento =', date('Y-m-d'));
      $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'left');
      return $this->db->get('contas_receber')->result();
  }

  public function get_produtos_mais_vendidos()
  {
      $this->db->select([
        'venda_produtos.*',
        'SUM(venda_produto_quantidade) as quantidade_vendidos',
        'produtos.produto_id',
        'produtos.produto_descricao',
      ]);
      $this->db->join('produtos', 'produto_id = venda_produto_id_produto', 'left');
      $this->db->limit(5);
      $this->db->group_by('venda_produto_id_produto');
      $this->db->order_by('quantidade_vendidos', 'DESC');
      return $this->db->get('venda_produtos')->result();
  }

  public function get_servicos_mais_vendidos()
  {
     $this->db->select([
       'ordem_tem_servicos.*',
       'SUM(ordem_ts_quantidade) as quantidade_servicos',
       'servicos.servico_id',
       'servicos.servico_descicao',
     ]);
     $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'left');
     $this->db->limit(5);
     $this->db->group_by('ordem_ts_id_servico');
     $this->db->order_by('quantidade_servicos','DESC');
     return $this->db->get('ordem_tem_servicos')->result();
  }


}