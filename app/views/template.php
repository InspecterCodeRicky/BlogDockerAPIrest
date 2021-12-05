<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title><?=  $title ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="/img/favicon.png" rel="icon">
  <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap CSS File -->
  <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/lib/animate/animate.min.css" rel="stylesheet">
  <link href="/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="/css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: DevFolio
    Theme URL: https://bootstrapmade.com/devfolio-bootstrap-portfolio-html-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>
<body id="page-top">

    <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
        <div class="container">
        <a class="navbar-brand js-scroll" href="#page-top">Hello!</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
            aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link js-scroll active" href="#home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll" href="#service">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll" href="#work">Work</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll" href="<?=BASEDIR?>login">LOGIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll" href="#blog">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll" href="#contact">Contact</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>


    <!-- <div id="home" class="intro route bg-image" style="background-image: url(img/intro-bg.jpg)">
        <div class="overlay-itro"></div>
        <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container"> -->
            <!--<p class="display-6 color-d">Hello, world!</p>-->
            <!-- <h1 class="intro-title mb-4">Hello there !</h1>
            <p class="intro-subtitle"><span class="text-slider-items">Travel, Lifestyle</span><strong class="text-slider"></strong></p> -->
            <!-- <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4" href="#about" role="button">Learn More</a></p> -->
            <!-- </div>
        </div>
        </div>
    </div> -->



    <!-- <p>header</p>


    <p>
        <ul>
            <li><a href="<?=BASEDIR?>login">se connecter</a></li>
        </ul>
    </p> -->
    <div>
        
    <?php
    $flash = new Flash();
    if ($flash->hasFlash()) :?>
            <p style="color: red;"><?= $flash->getFlash()['flash']; ?></p>
    <?php 
    endif; ?>
    </div>
    <?=  $bodyContent ?>
    <!-- <p>footer</p> -->
</body>
</html>