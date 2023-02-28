

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4><?php echo $titulo; ?></h4>
                    </div>
                    <div class="card-body">

                        <!--VALIDAÇÃO DE DADOS - Mensagens ERRO-->

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

                        <!--FIM - VALIDAÇÃO DE DADOS - Mensagens ERRO-->

                        <?php
                        $atributos = array(
                            'class' => 'needs-validation'
                        );
                        ?>

                        <?php echo form_open('restrita/login/auth'); ?>


                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" name="email" tabindex="1" required autofocus>
                        </div>
                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Senha</label>
                                <div class="float-right">
                                    <a href="auth-forgot-password.html" class="text-small">
                                        Esqueceu a senha?
                                    </a>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password" tabindex="2" required>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Manter conectado</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Entrar
                            </button>
                        </div>
                        <?php echo form_close(); ?>
                        <!--  <div class="text-center mt-4 mb-3">
                                  <div class="text-job text-muted">Login With Social</div>
                              </div>
                              <div class="row sm-gutters">
                                  <div class="col-6">
                                      <a class="btn btn-primary" href="#" role="button">
                                          <i class="fa fa-exclamation-circle fa-lg mr-2"></i>Google
                                      </a>
                                  </div>
                                  <div class="col-6">
                                      <a class="btn btn-block btn-social btn-twitter">
                                          <span class="fab fa-twitter"></span> Twitter
                                      </a>
                                  </div>
                              </div> -->
                    </div>
                </div>
                <!--<div class="mt-5 text-muted text-center">
                    Não tem conta? <a href="auth-register.html">Crie aqui.</a>
                </div>-->
            </div>
        </div>
    </div>
</section>




