<div>
    <h4>Modal Login</h4>
    <?php
    $flash = new Flash();
    if ($flash->hasFlash()) :?>
            <p style="color: red;"><?= $flash->getFlash()['flash']; ?></p>
    <?php 
    endif; ?>
    <form action="" method="post">
        <input value="<?= $_POST['email_login']; ?>" type="text" name="email_login" id="email_login">
        <input value="<?= $_POST['password_login']; ?>" type="password" name="password_login" id="password_login">
        <input type="submit" value="se connecter">
    </form>
    <a href="<?=BASEDIR?>register">Creer un compte</a>
</div>