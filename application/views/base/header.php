<!DOCTYPE html>
<html lang="es">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png"> -->

    <title><?= $title ?: 'Dashboard' ?>::Legal Solutions</title>

    <!-- vendor css -->
    <link href="<?= base_url('public/lib/@fortawesome/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/lib/ionicons/css/ionicons.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/lib/jqvmap/jqvmap.min.css') ?>" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/dashforge.css')?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/dashforge.auth.css')?>">

    <!-- tema elegido -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/skin.charcoal.css')?>" />
    <link rel="stylesheet" href="<?= base_url('public/assets/css/skin.cool.css')?>" />
    
    <?php 
      //aqui mando una variable de mas estilos
      if( ! empty( $stylesheets ) ){
        foreach( $stylesheets as $sheet ){
          echo "<link rel='stylesheet' href='{base_url('$sheet')}' />";
        }
      }
    ?>

  </head>
  <body>