<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width = device-width, initial-scale = 1.0, user-scalable = 0, minimal-ui">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8.0.0/dist/sweetalert2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/samsung-sharp-sans">

  <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/sweetalert/sweetalert.css') ?>">

  <script type="text/javascript" src="<?= base_url('assets/vendor/sweetalert/sweetalert.min.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>

  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/img/logo-1.png') ?>">

  <title><?= $title ?></title>

  <style>
    ::-webkit-scrollbar{
      width: 0px;
    }
  </style>
</head>

<?php if($this->session->flashdata('sukses')) : ?>
  <div class="sukses-data" data-sukses="<?= $this->session->flashdata('sukses') ?>"></div>
  <?php unset($_SESSION['sukses']) ?>
<?php endif ?>

<?php if($this->session->flashdata('gagal')) : ?>
  <div class="gagal-data" data-gagal="<?= $this->session->flashdata('gagal') ?>"></div>
  <?php unset($_SESSION['gagal']) ?>
<?php endif ?>

<?php if($this->session->flashdata('peringatan')) : ?>
  <div class="peringatan-data" data-peringatan="<?= $this->session->flashdata('peringatan') ?>"></div>
  <?php unset($_SESSION['peringatan']) ?>
<?php endif ?>

<body>
