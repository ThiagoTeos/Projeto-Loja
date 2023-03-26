<!DOCTYPE html>
<html lang="pt-br">


    <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <?php
        echo (isset($titulo) ? '<title>LojTeos - ' . $titulo . '</title>' : '<title>LojTeos - Administrativo</title>')
        ?>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/app.min.css'); ?>">
        <!-- Template CSS -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/components.css'); ?>">

        <?php if (isset($styles)): ?> <!-- Verifica se a variável $styles existe no Controller -->
            <?php foreach ($styles as $styles): ?> <!--resutados da $styles  -->
            <link rel="stylesheet" href="<?php echo base_url('public/assets/'.$styles); ?>">
            <?php endforeach; ?>
        <?php endif; ?>
        <!-- Custom style CSS -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/custom.css'); ?>">
        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('public/assets/img/favicon.ico'); ?>" />
    </head>

    <body>
        <div class="loader"></div>
        <div id="app">
