
<div>
    <h1>Mon article</h1>
    <img src="http://localhost:5555/app/<?=$data['dataPost']->getImage()?>" alt="">
    <h4><?=$data['dataPost']->getTitle()?></h4>
    <p><?=$data['dataPost']->getContent()?></p>
    <p><?=$data['dataPost']->getCreatedAt()?></p>
    <p><?=$data['authorPost']->getFirstname()?></p>
    <p><?=$data['authorPost']->getLastname()?></p>
    <p><a href="<?= BASEDIR."remove-article/".$data['dataPost']->getId()?>">supprimer l'article</a></p>

    <p>ajouter un commentaire</p>
    <form action="/add-comment/<?=$data['dataPost']->getId()?>" method="POST" enctype="multipart/form-data">
        <input value="<?= $_POST['post_comment']; ?>" type="text" name="post_content" id="post_content">
        <input type="submit" value="Valider">
    </form>
    
</div>