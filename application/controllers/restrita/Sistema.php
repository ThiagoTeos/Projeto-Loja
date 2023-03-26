<?php

defined('BASEPATH') OR exite('Ação não permitida');

class Sistema extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $sessaoValida = $this->ion_auth->logged_in();

        if (!$sessaoValida) {
            redirect('restrita/login');
        }
    }

    public function index() {
        //Validação de campo obrigatórios, vazio e caracteres

        $this->form_validation->set_rules('sistema_razao_social', '<b>Razão Social</b>', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('sistema_nome_fantasia', '<b>Nome Fantasia</b>', 'trim|required|min_length[5]|max_length[145]');
        $this->form_validation->set_rules('sistema_cnpj', '<b>CNPJ</b>', 'trim|required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', '<b>Inscrição Estadual</b>', 'trim|required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo', '<b>Telefone Fixo</b>', 'trim|exact_length[14]');
        $this->form_validation->set_rules('sistema_telefone_movel', '<b>Celular</b>', 'trim|min_length[14]|max_length[15]');
        $this->form_validation->set_rules('sistema_email', '<b>E-mail</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('sistema_site_url', '<b>Site da loja</b>', 'trim|required|valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_cep', '<b>CEP</b>', 'trim|required|exact_length[9]');
        $this->form_validation->set_rules('sistema_numero', '<b>Número</b>', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('sistema_endereco', '<b>Logadouro</b>', 'trim|required|max_length[145]');
        $this->form_validation->set_rules('sistema_estado', '<b>UF</b>', 'trim|required|exact_length[2]');
        $this->form_validation->set_rules('sistema_cidade', '<b>Cidade</b>', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('sistema_produtos_destaques', '<b>Produtos em destaque</b>', 'trim|required|integer');



        if ($this->form_validation->run()) {


//            //Dados para serem enviados ao banco de dados
            $data = elements(
                    array(
                        'sistema_razao_social',
                        'sistema_nome_fantasia',
                        'sistema_cnpj',
                        'sistema_ie',
                        'sistema_telefone_fixo',
                        'sistema_telefone_movel',
                        'sistema_email',
                        'sistema_site_url',
                        'sistema_cep',
                        'sistema_numero',
                        'sistema_endereco',
                        'sistema_estado',
                        'sistema_cidade',
                        'sistema_produtos_destaques',
                    ), $this->input->post()
            );

            //Transformar o campo sistema_cidade em Maiusculo
            $data = html_escape($data); //Segurança no salvamento das informação contra código malicioso
            

            $this->core_model->update('sistema', $data, array('sistema_id' => 1));
            redirect('restrita/sistema');
        } else {
            //Erro de validacao

            $data = array(
                'titulo' => 'Informações da loja',
                'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
                'scripts' => array(
                    'mask/jquery.mask.min.js',
                    'mask/custom.js'
                ),
            );

            $this->load->view('restrita/layout/header', $data);
            $this->load->view('restrita/sistema/index');
            $this->load->view('restrita/layout/footer');
        }
    }

}
