<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- add content here -->
            <div class="row">
                <div class="col-12">

                    <!--Dados para o form-->
                    <?php
                    $atributos = array(
                        'name' => 'form_core',
                    );

                    
                    ?>
                    <?php echo form_open('restrita/sistema/'); ?>

                    <div class="card">

                        <div class="card-header">
                            <h4><?php echo $titulo; ?></h4>
                        </div>
                        <div class="card-body">
                             
                            <div class="subtituloForm">Dados da Empresa</div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Razão social</label>
                                    <input type="text" name="sistema_razao_social" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_razao_social : set_value('sistema_razao_social')); ?>">
                                    <?php echo form_error('sistema_razao_social','<div class="text-danger">','</div>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Nome Fantasia</label>
                                    <input type="text" name="sistema_nome_fantasia" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_nome_fantasia : set_value('sistema_nome_fantasia')); ?>">
                                    <?php echo form_error('sistema_nome_fantasia','<div class="text-danger">','</div>') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>CNPJ</label>
                                    <input type="text" name="sistema_cnpj" class="form-control cnpj" value="<?php echo (isset($sistema) ? $sistema->sistema_cnpj : set_value('sistema_cnpj')); ?>">
                                    <?php echo form_error('sistema_cnpj','<div class="text-danger">','</div>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Inscrição Estadual</label>
                                    <input type="text" name="sistema_ie" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_ie : set_value('sistema_ie')); ?>">
                                    <?php echo form_error('sistema_ie','<div class="text-danger">','</div>') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>Telefone</label>
                                    <input type="text" name="sistema_telefone_fixo phone_with_ddd" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_telefone_fixo : set_value('sistema_telefone_fixo')); ?>">
                                    <?php echo form_error('sistema_telefone_fixo','<div class="text-danger">','</div>') ?>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Celular</label>
                                    <input type="text" name="sistema_telefone_movel sp_celphones" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_telefone_movel : set_value('sistema_telefone_movel')); ?>">
                                    <?php echo form_error('sistema_telefone_movel','<div class="text-danger">','</div>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>E-mail de contato</label>
                                    <input type="text" name="sistema_email" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_email : set_value('sistema_email')); ?>">
                                    <?php echo form_error('sistema_email','<div class="text-danger">','</div>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Site da loja</label>
                                    <input type="url" name="sistema_site_url" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_site_url : set_value('sistema_site_url')); ?>">
                                    <?php echo form_error('sistema_site_url','<div class="text-danger">','</div>') ?>
                                </div>
                            </div>
                            
                            <div class="subtituloForm">Dados do endereço</div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>CEP</label>
                                    <input type="text" name="sistema_cep" class="form-control cep" value="<?php echo (isset($sistema) ? $sistema->sistema_cep : set_value('sistema_cep')); ?>">
                                    <?php echo form_error('sistema_cep','<div class="text-danger">','</div>') ?>
                                </div>
                                <div class="form-group col-md-1">
                                    <label>Número</label>
                                    <input type="text" name="sistema_numero" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_numero : set_value('sistema_numero')); ?>">
                                    <?php echo form_error('sistema_numero','<div class="text-danger">','</div>') ?>
                                </div>
                                <div class="form-group col-md-9">
                                    <label>Logadouro</label>
                                    <input type="text" name="sistema_endereco" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_endereco : set_value('sistema_endereco')); ?>">
                                    <?php echo form_error('sistema_endereco','<div class="text-danger">','</div>') ?>
                                </div>
                                
                                <div class="form-group col-md-1">
                                    <label>UF</label>
                                    <input type="text" name="sistema_estado" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_estado : set_value('sistema_estado')); ?>">
                                    <?php echo form_error('sistema_estado','<div class="text-danger">','</div>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Cidade</label>
                                    <input type="text" name="sistema_cidade" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_cidade : set_value('sistema_cidade')); ?>">
                                    <?php echo form_error('sistema_cidade','<div class="text-danger">','</div>') ?>
                                </div>
                            </div>
                            
                            <div class="subtituloForm">Dados adicionais</div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>Produtos em destaque</label>
                                    <input type="number" name="sistema_produtos_destaques	" class="form-control" value="<?php echo (isset($sistema) ? $sistema->sistema_produtos_destaques: set_value('sistema_produtos_destaques	')); ?>">
                                    <?php echo form_error('sistema_produtos_destaques	','<div class="text-danger">','</div>') ?>
                                </div>
                            </div>
                                
                                
                            
                            

                            
                            <div class="card-footer">
                                <button class="btn btn-primary mr-2">Salvar</button>
                            </div>
                        </div>

                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- engrenagem no layout  -->
    <?php $this->load->view('restrita/layout/sidebar_settings'); ?>

</div>
