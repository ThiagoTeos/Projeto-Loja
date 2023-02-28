<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <!--VALIDAÇÃO DE MENSAGEM DO LOGIN - Mensagens SUCESSO-->
            
            <!--FIM VALIDAÇÃO DE MENSAGEM DO LOGIN - Mensagens SUCESSO-->
            
            <?php
            
            echo '<pre>';
            print_r($this->session->userdata());
            print_r($this->session->userdata('user_id'));
            echo '</pre>';
            
            ?>
            
        </div>
    </section>

    <!-- engrenagem no layout  -->
    <?php $this->load->view('restrita/layout/sidebar_settings'); ?>

</div>
