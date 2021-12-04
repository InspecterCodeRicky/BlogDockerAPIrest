<div>
    <h4>Modal register</h4>
    <?php
    $flash = new Flash();
    if ($flash->hasFlash()) :?>
            <p style="color: red;"><?= $flash->getFlash()['flash']; ?></p>
    <?php 
    endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input name="fileToUpload" id="preview_input" multiple type="file"/>
        <input value="<?= $_POST['firstname_register']; ?>" type="text" name="firstname_register" id="firstname_register">
        <input value="<?= $_POST['lastname_register']; ?>" type="text" name="lastname_register" id="lastname_register">
        <input value="<?= $_POST['email_register']; ?>" type="text" name="email_register" id="email_register">
        <input value="<?= $_POST['password_register']; ?>" type="password" name="password_register" id="password_register">
        <input type="submit" value="se connecter">
    </form>
</div>