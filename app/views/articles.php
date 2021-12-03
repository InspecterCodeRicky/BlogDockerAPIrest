
<div>
    <h1>Mes articles </h1>


    <?php
        foreach ($data as $article) {?>
            <h4><a href="article/<?=$article->getId()?>"><?=$article->getTitle()?></a></h4>
            <p><?=$article->getContent()?></p>

        <?php } ?>
    
</div>