<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=  $title ?></title>
</head>
<body>
    <p>header</p>
    <p>
        <ul>
            <li><a href="<?=BASEDIR?>login">se connecter</a></li>
        </ul>
    </p>
    <?=  $bodyContent ?>
    <p>footer</p>
</body>
</html>