<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Login extends CI_Controller {

    public function index() {
        
        

        $data = array(
            'titulo' => 'Login - Portal administrativo',
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/login/index');
        $this->load->view('restrita/layout/footer');
    }

    public function auth() {
        
        
        $identity = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = ($this->input->post('remember' ? TRUE : FALSE)); //Verifica se passa o remember
        
        $houvelogin = $this->ion_auth->login($identity, $password, $remember);
        
        if ($houvelogin){
            $this->session->set_flashdata('sucesso', 'Bem-vindo(a)!');
            redirect('restrita');
        }else{
            $this->session->set_flashdata('erro', 'O e-mail ou a senha inválido(s).');
            redirect('restrita/login');
        }
        
    }
    
    public function logout() {
        $this->ion_auth->logout();
        redirect('restrita/login');
        
    }

}
