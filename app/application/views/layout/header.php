<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>ROCKET ERP - ONLINE</title>
    <!-- CSS files -->
    <link href="<?php echo base_url('public/assets/css/tabler.min.css')?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/assets/css/tabler-vendors.min.css')?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/assets/css/demo.min.css')?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/assets/css/styles.css')?>" rel="stylesheet"/>
   
    <link href="<?php echo base_url('public/assets/libs/@fortawesome/fontawesome-free/css/all.min.css')?>" rel="stylesheet"/>
    <link rel="icon" href="<?php echo base_url('/public/assets/img/logo.ico')?>" />

    <?php if(isset($styles)):   ?>

     <?php  foreach ($styles as $style): ?>
     
      <link href="<?php echo base_url('/'. $style)?>" rel="stylesheet"/>

     <?php   endforeach; ?>

    <?php endif;   ?>

  </head>
  <body class="antialiased">
    <div class="page">

 