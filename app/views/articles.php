<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <h1>Mes articles </h1>


    <?php
        foreach ($articles as $article) {?>
            <h4><?=$article->getTitle()?></h4>
            <p><?=$article->getContent()?></p>

        <?php } ?>
    
</body>
</html>