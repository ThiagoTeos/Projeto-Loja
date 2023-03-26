<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- add content here -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-block">
                            <h4><?php echo $titulo; ?></h4>
                        </div>


                        <div class="card-body">

                            <!--VALIDAÇÃO DE DADOS - Mensagens-->

                            <?php if ($message = $this->session->flashdata('sucesso')): ?>
                                <div class="alert alert-success alert-dismissible show fade">

                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <div class="alert-icon"><i class="fa fa-check-circle fa-lg mr-2"></i><?php echo $message; ?></div>

                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($message = $this->session->flashdata('erro')): ?>
                                <div class="alert alert-danger alert-dismissible show fade">

                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <div class="alert-icon"><i class="fa fa-exclamation-circle fa-lg mr-2"></i><?php echo $message; ?></div>

                                    </div>
                                </div>
                            <?php endif; ?>

                            <!--FIM - VALIDAÇÃO DE DADOS - Mensagens-->
                            
                            <a class="btn btn-primary float-left" href="<?php echo base_url('restrita/usuarios/core') ?>" style="margin-bottom: 20px">Cadastrar Usuário</a>
                            
                            <div class="table-responsive">
                                <table class="table table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Usuário</th>
                                            <th>Perfil</th>
                                            <th>Status</th>
                                            <th class="nosort">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($usuarios as $usuarios): ?>
                                            <tr>

                                                <td><?php echo $usuarios->id ?></td>
                                                <td><?php echo $usuarios->first_name . ' ' . $usuarios->last_name; ?></td>
                                                <td><?php echo $usuarios->email ?></td>
                                                <td><?php echo $usuarios->username ?></td>
                                                <td><?php echo ($this->ion_auth->is_admin($usuarios->id) ? 'Administrador' : 'Clientes') ?></td>
                                                <td><?php
                                                    echo ($usuarios->active == 1 ?
                                                            '<span class="badge badge-success">Ativo</span>' :
                                                            '<span class="badge badge-danger">Inativo</span>')
                                                    ?></td>
                                                <td>
                                                    <a title="Editar" href="<?php echo base_url('restrita/usuarios/core/' . $usuarios->id); ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                                    <a title="Excluir" href="<?php echo base_url('restrita/usuarios/delete/' . $usuarios->id); ?>" class="btn btn-icon btn-danger delete" data-confirm="Deseja realmente excluir o usuário?"><i class="fas fa-times"></i></a>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- engrenagem no layout  -->
    <?php $this->load->view('restrita/layout/sidebar_settings'); ?>

</div>
