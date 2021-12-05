

<div class="testimonials paralax-mf bg-image" style="background-image: url(img/overlay-bg.jpg)">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h4 class="title-a"><?=  $title ?></h4>
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
            <form action="" method="POST" enctype="multipart/form-data">
                <div class='loginForm_inputLogin'>
                  <label for="post_title">Title</label>
                  <input value="<?= $_POST['post_title']; ?>" type="text" name="post_title" id="post_title">
                </div>
                <div class='loginForm_inputLogin'>
                  <label for="post_content">Content</label>
                  <input value="<?= $_POST['post_content']; ?>" type="text" name="post_content" id="post_content">
                </div>
                <div class='loginForm_inputLogin'>
                  <label for="preview_input"></label>
                  <input name="fileToUpload" id="preview_input" type="file"/>
                </div>
                <input class='button createAcc' type="submit" value="Valider">
            </form>
      </div>
    </div>
  </div>
