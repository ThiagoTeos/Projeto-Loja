<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Usuarios extends CI_Controller {

    public function __construct() {
        return parent::__construct();

        //SESSÃO Válida?
    }

    public function index() {

        $data = array(
            'titulo' => 'Usuários',
            'styles' => array(
                'bundles/datatables/datatables.min.css',
                'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'bundles/datatables/datatables.min.js',
                'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'bundles/jquery-ui/jquery-ui.min.js',
                'js/page/datatables.js',
            ),
            'usuarios' => $this->ion_auth->users()->result(), //obtém os usuários pelo Ion Auth
        );

//        echo '<pre>';
//        print_r($data['usuarios']);
//        exit();
//        
        //Enviar os dados para  View
        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/usuarios/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($usuario_id = NULL) { // O setar o valor com Null é para parâmetro opcional. 
        $usuario_id = (int) $usuario_id; //para receber valor inteiro

        if (!$usuario_id) {
            $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[2]|max_length[100]|valid_email|callback_valida_email'); // callback_validacaoCustomizada
            $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[2]|max_length[50]|callback_valida_usuario'); // callback_validacaoCustomizada
            $this->form_validation->set_rules('password', 'senha', 'trim|required|min_length[4]|max_length[200]'); //password - senha
            $this->form_validation->set_rules('confirma', 'Confirmação de Senha', 'trim|required|matches[password]'); //Confirmação de senha
            //Verificar se o form foi validado
            if ($this->form_validation->run()) {
                //echo'<pre>';
                //print_r($this->input->post());
                //exit();
                //[first_name] => Thiago
                //[last_name] => Elias
                //[email] => elias@admin.com
                //[username] => teste
                //[password] => 1234
                //[confirma] => 1234
                //[active] => 1
                //[perfil] => 1

                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $email = $this->input->post('email');
                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'active' => $this->input->post('active')
                );
                $group = array($this->input->post('perfil')); // Sets user to admin or customer


                if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
                    $this->session->set_flashdata('sucesso', 'Usuário cadastrado com sucesso!');
                } else {
                    $this->session->set_flashdata('erro', 'Erro ao cadastrar usuário. Por favor, verifique!');
                }
                redirect('restrita/usuarios');
            } else {
                //Erro de validação Cadastrar
                $data = array(
                    'titulo' => 'Cadastrar Usuário',
                    'grupos' => $this->ion_auth->groups()->result(), //grupos cadastrados
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/usuarios/core');
                $this->load->view('restrita/layout/footer');
            }
        } else {

            if (!$usuario = $this->ion_auth->user($usuario_id)->row()) {

                //Tratar erro de Usuário não encontrado.
                $this->session->set_flashdata('erro', 'Usuário não foi encontrado!');
                redirect('restrita/usuarios');
            } else {
                //Validacao
                //EDIÇÃO DO USUÁRIO
                //CAMPOS OBRIGATÓRIOS
//                [first_name] => Admin
//                [last_name] => istrator
//                [email] => admin@admin.com
//                [username] => administrator
//                [password] =>
//                [confirma] =>
//                [active] => 1
//                [perfil] => 1
//                [usuario_id] => 1

                $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[2]|max_length[45]');
                $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[2]|max_length[45]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[2]|max_length[100]|valid_email|callback_valida_email'); // callback_validacaoCustomizada
                $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[2]|max_length[50]|callback_valida_usuario'); // callback_validacaoCustomizada
                $this->form_validation->set_rules('password', 'senha', 'trim|min_length[4]|max_length[200]'); //password - senha
                $this->form_validation->set_rules('confirma', 'Confirmação de Senha', 'trim|matches[password]'); //Confirmação de senha

                if ($this->form_validation->run()) {
//                    echo'<pre>';
//                    print_r($this->input->post());
//                    exit();
//                    
                    //GRAVAÇÃO DOS DADOS NO BANCO DE DADOS
                    // Monte um array com os Input informado atravéz do método post
                    $data = elements(
                            array(
                                'first_name',
                                'last_name',
                                'email',
                                'username',
                                'password',
                                'active',
                            ), $this->input->post()
                    );

                    $password = $this->input->post('password');

                    /*
                     * Caso o password não for informado, não passará o campo para alteração no banco
                     * Retirada o name Input password das colunas no banco de dados
                     */

                    if (!$password) {
                        unset($data['password']);
                    }

                    /*
                     * Sanitizando o $data
                     */
                    $data = html_escape($data);

                    /*
                     * UPDATE dos dados
                     * Métódo update() do plugin - ion_auth
                     */

                    //echo'<pre>';
                    //print_r($data);
                    //exit();

                    if ($this->ion_auth->update($usuario_id, $data)) {

                        $perfil = (int) $this->input->post('perfil');

                        if ($perfil) {
                            //Para edição do perfil
                            //Remover o usuário dos grupos
                            $this->ion_auth->remove_from_group(NULL, $usuario_id);

                            //Adicionando o usuário no grupo
                            $this->ion_auth->add_to_group($perfil, $usuario_id);
                        }

                        $this->session->set_flashdata('sucesso', 'Dados do usuário alterados com sucesso!');
                    } else {
                        $this->session->set_flashdata('erro', 'Erro ao atualizar as informações do usuário. Por favor, verifique!');
                    }

                    redirect('restrita/usuarios'); //Capturar o Sucesso ou Não-sucesso
                } else {
                    //Erro de validação Editar
                    $data = array(
                        'titulo' => 'Editar Usuário',
                        'usuario' => $usuario,
                        'perfil' => $this->ion_auth->get_users_groups($usuario_id)->row(), //retorna o grupo do usuário
                        'grupos' => $this->ion_auth->groups()->result(), //grupos cadastrados
                    );

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/usuarios/core');
                    $this->load->view('restrita/layout/footer');
                }
            }
        }
    }

    public function valida_email($email) {

        $usuario_id = $this->input->post('usuario_id');

        if (!$usuario_id) {
            //cadastro

            if ($this->core_model->get_by_id('users', array('email' => $email))) { //Verifica na tabela users se já existe um email cadastrado com o valor recebino na variável $email
                $this->form_validation->set_message('valida_email', 'Esse e-mail já existe.');
                return false;
            } else {
                return true;
            }
        } else {
            //Editar

            if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {  // verifica se o email existe para outro usuário
                $this->form_validation->set_message('valida_email', 'Esse e-mail já existe.');
                return false;
            } else {
                return true;
            }
        }
    }

    public function valida_usuario($username) {

        $usuario_id = $this->input->post('usuario_id');

        if (!$usuario_id) {
            //cadastro Usuário

            if ($this->core_model->get_by_id('users', array('username' => $username))) { //Verifica na tabela users se já existe um email cadastrado com o valor recebino na variável $email
                $this->form_validation->set_message('valida_usuario', 'Esse usuário já existe.');
                return false;
            } else {
                return true;
            }
        } else {
            //Editar Usuário

            if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id))) {  // verifica se o email existe para outro usuário
                $this->form_validation->set_message('valida_usuario', 'Esse usuário já existe.');
                return false;
            } else {
                return true;
            }
        }
    }

    public function delete($usuario_id = NULL) {

        $usuario_id = (int) $usuario_id;

        //verifica se o usuário existe ou foi passado e nao existe
        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
            $this->session->set_flashdata('erro', 'O usuário não foi encontrado para a exclusão');
            redirect('restrita/usuarios');
        } else {
            //Começa a exclusao do usuário
            
            //Não permitir que o Admin Seja excluído
            if ($usuario_id == 1) {// Id do userid admin manager fixo
                $this->session->set_flashdata('erro', 'Não é permitido excluir o usuário Administrador Manager.');
                redirect('restrita/usuarios');
            } else {
                if ($this->ion_auth->is_admin($usuario_id)) {
                    $this->session->set_flashdata('erro', 'Não é permitido excluir o usuário Administrador.');
                    redirect('restrita/usuarios');
                } else {
                    if ($this->ion_auth->delete_user($usuario_id)) {
                        $user->username;
                        $this->session->set_flashdata('sucesso', 'O usuário foi excluído com sucesso');
                    } else {
                        $this->session->set_flashdata('erro', 'Não foi possível excluir o usuário.');
                    }
                }

                redirect('restrita/usuarios');
            }
        }
    }

}
