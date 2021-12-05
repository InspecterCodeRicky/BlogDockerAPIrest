<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="<?=BASEDIR?>public/img/favicon.png" rel="icon">
    <link href="<?=BASEDIR?>public/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS File -->
    <link href="<?=BASEDIR?>public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="<?=BASEDIR?>public/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=BASEDIR?>public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?=BASEDIR?>public/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?=BASEDIR?>public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?=BASEDIR?>public/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="<?=BASEDIR?>public/css/style.css" rel="stylesheet">

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
                    <a class="nav-link js-scroll active" href="<?=BASEDIR?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll active" href="<?=BASEDIR?>">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll" >About</a>
                </li>
                <li class="nav-item">
                    <?php
                        if(isset($_SESSION['user_info'])) {
                    ?>
                        <a class="nav-link js-scroll" href="<?=BASEDIR?>profile">MY PROFIL</a>
                    <?php
                        } else {
                    ?>
                    <a class="nav-link js-scroll" href="<?=BASEDIR?>login">LOGIN</a>
                    <?php
                        }
                    ?>
                </li>
            </ul>
        </div>
        </div>
    </nav>

    <div class="mt-5">
        <?php
        $flash = new Flash();
        if ($flash->hasFlash()) : ?>
            <p style="color: red;"><?= $flash->getFlash()['flash']; ?></p>
        <?php
        endif; ?>
    </div>

    <?= $bodyContent ?>
    <!-- <p>footer</p> -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>

    <!-- JavaScript Libraries -->
    <script src="<?=BASEDIR?>public/lib/jquery/jquery.min.js"></script>
    <script src="<?=BASEDIR?>public/lib/jquery/jquery-migrate.min.js"></script>
    <script src="<?=BASEDIR?>public/lib/popper/popper.min.js"></script>
    <script src="<?=BASEDIR?>public/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=BASEDIR?>public/lib/easing/easing.min.js"></script>
    <script src="<?=BASEDIR?>public/lib/counterup/jquery.waypoints.min.js"></script>
    <script src="<?=BASEDIR?>public/lib/counterup/jquery.counterup.js"></script>
    <script src="<?=BASEDIR?>public/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?=BASEDIR?>public/lib/lightbox/js/lightbox.min.js"></script>
    <script src="<?=BASEDIR?>public/lib/typed/typed.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="<?=BASEDIR?>public/contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="<?=BASEDIR?>public/js/main.js"></script>
</body>

</html>