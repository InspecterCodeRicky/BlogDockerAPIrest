<div>

<div class="testimonials paralax-mf bg-image" style="background-image: url(img/overlay-bg.jpg)">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Sign In
            </h3>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class='login'>
        <?php
            $flash = new Flash();
            if ($flash->hasFlash()) :?>
                    <p style="color: red;"><?= $flash->getFlash()['flash']; ?></p>
            <?php 
            endif; ?>
            <form action="" method="post" class='loginForm'>
                <div class='loginForm_inputLogin'>
                <label for="email_login">Email</label>
                <input value="<?= $_POST['email_login']; ?>" type="text" name="email_login" id="email_login">
                </div>
                <div class='loginForm_inputLogin'>
                    <label for="password_login">Password</label>
                    <input value="<?= $_POST['password_login']; ?>" type="password" name="password_login" id="password_login">
                </div>
                <input type="submit" value="se connecter" class='button buttonValid'>
            </form>
            <a href="<?=BASEDIR?>register" class='createAcc'>Creer un compte</a>
      </div>
    </div>
  </div>

    <!-- <h4>Modal Login</h4> -->
</div>