<?php if ($this->router->fetch_class() != 'login'): ?>

<footer class="main-footer">
    <div class="footer-left">
        <a href="teosinformatica.com.br">Teos - Informática</a></a>
    </div>
    <div class="footer-right">
    </div>
</footer>
<?php endif; ?>


</div>
</div>
<!-- General JS Scripts -->
<script src="<?php echo base_url('public/assets/js/app.min.js') ?>"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="<?php echo base_url('public/assets/js/scripts.js') ?>"></script>

<?php if (isset($scripts)): ?> <!-- Verifica se a variável $styles existe no Controller -->
    <?php foreach ($scripts as $scripts): ?> <!--resutados da $styles  -->
        <script src="<?php echo base_url('public/assets/' . $scripts) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<!-- Custom JS File -->
<script src="<?php echo base_url('public/assets/js/custom.js') ?>"></script>

<!--Confirma excluisão-->
<script>
    $('.delete').on("click", function (event) {
        event.preventDefault();

        var choice = confirm($(this).attr('data-confirm'));

        if (choice) {
            window.location.href = $(this).attr('href');
        }
    });
</script>
</body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>
