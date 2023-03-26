<?php

/*
 * Dados do banco de dados tendo como obrigatóriedade o Session do usuário
 */

defined('BASEPATH' OR exit('Ação não permitida'));

class Core_model extends CI_Model {

    //Recurar dados de determinda tabela

    public function get_all($tabela = NULL, $condicoes = NULL) {

        //verifica se a tabela existe
        if ($tabela && $this->db->table_exists($tabela)) {

            //verifica se foi passado alguma condição na query (where)
            if (is_array($condicoes)) {
                $this->db->where($condicoes);
            }
            return $this->db->get($tabela)->result();
        } else {
            return false;
        }
    }

    public function get_by_id($tabela = NULL, $condicoes = NULL) {
        //verifica se a tabela existe
        if ($tabela && $this->db->table_exists($tabela) && is_array($condicoes)) {

            $this->db->where($condicoes);
            $this->db->limit(1); //limite de linhas retornada

            return $this->db->get($tabela)->row();
        } else {
            return false;
        }
    }

    public function insert($tabela = NULL, $data = NULL, $get_last_id = Null) {
        //verifica se a tabela existe
        if ($tabela && $this->db->table_exists($tabela) && is_array($data)) {

            //Insere na sessão o último ID inserido na base de dados
            if ($get_last_id) {
                $this->session->set_userdata('last_id', $this->db->insert_id());
            }

            // Verificaão de inserção ao banco de dados
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso!');
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível salvar os dados!');
            }
        } else {
            return false;
        }
    }

    public function update($tabela = NULL, $data = NULL, $condicoes = null) {
        //verifica se a tabela existe - Verifica a lista de dados e verifica a lista de condicoes da query
        //if ($tabela && $this->db->table_exists($tabela) && is_array($data) && is_array($condicoes)) {
        if ( 1 == 1) {
            
            //Verifica se houve atualizaçao
            if($this->db->update($tabela, $data, $condicoes)){
                $this->session->set_flashdata('sucesso', 'Dados alterados com sucesso!');
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível salvar os dados!');
            }
        } else {
            return false;
        }
    }
    
    public function delete($tabela = NULL, $condicoes = NULL) {
        
         //verifica se a tabela existe -  verifica a lista de condicoes da query
        if ($tabela && $this->db->table_exists($tabela) && is_array($condicoes) ) {
            
            //Verifica a tabela e a condições da query (Where)
            if($this->db->delete($tabela,$condicoes)){
                $this->session->set_flashdata('sucesso', 'Registro excluído com sucesso!');
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível excluir o registro!');
            }
        } else {
            return false;
        }
    }
}
