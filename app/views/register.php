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
            <form action="" method="post" class='loginForm' enctype="multipart/form-data">
                <div class='loginForm_inputLogin'>
                    <label for="firstname_register">First name</label>
                    <input value="<?= $_POST['firstname_register']; ?>" type="text" name="firstname_register" id="firstname_register">
                </div>
                <div class='loginForm_inputLogin'>
                    <label for="lastname_register">Last name</label>
                    <input value="<?= $_POST['lastname_register']; ?>" type="text" name="lastname_register" id="lastname_register">
                </div>
                <div class='loginForm_inputLogin'>
                    <label for="email_register">Email</label>
                    <input value="<?= $_POST['email_register']; ?>" type="text" name="email_register" id="email_register">
                </div>
                <div class='loginForm_inputLogin'>
                    <label for="email_register">Password</label>
                    <input value="<?= $_POST['password_register']; ?>" type="password" name="password_register" id="password_register">
                </div>

                <div class='loginForm_inputLogin'>
                    <label for="preview_input">Avatar</label>
                    <input name="fileToUpload" id="preview_input" type="file"/>
                </div>

                <input type="submit" value="se connecter" class='button buttonValid'>
            </form>
      </div>
    </div>
  </div>

    <!-- <h4>Modal Login</h4> -->
</div>
