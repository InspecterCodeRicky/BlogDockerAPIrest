
<div>
    <h4><?=  $title ?></h4>
    <form action="" method="POST" enctype="multipart/form-data">
        <input name="fileToUpload" id="preview_input" type="file"/>
        <input value="<?= $_POST['post_title']; ?>" type="text" name="post_title" id="post_title">
        <input value="<?= $_POST['post_content']; ?>" type="text" name="post_content" id="post_content">
        <input type="submit" value="Valider">
    </form>
</div>