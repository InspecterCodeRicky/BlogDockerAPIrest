<section id="blog" class="blog-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
                Mes articles
            </h3>
            <p class="subtitle-a">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      
      <div class="row">

<<<<<<< HEAD
<div>
    <h1>Mes articles </h1>
    <p><a href="<?=BASEDIR. "add-article"?>">ajouter un article</a></p>
=======
        <?php
            foreach ($data as $article) {?>
                <div class="col-md-4">
                    <div class="card card-blog">
                        <div class="card-img">
                        <a href="article/<?=$article->getId()?>"><img src="img/post-3.jpg" alt="" class="img-fluid"></a>
                        </div>
                        <div class="card-body">
                        <div class="card-category-box">
                            <div class="card-category">
                            <h6 class="category">Web Design</h6>
                            </div>
                        </div>
                        <h3 class="card-title"><a href="article/<?=$article->getId()?>"><?=$article->getTitle()?></a></h3>
                        <p class="card-description"><?=$article->getContent()?></p>
                        </div>
                        <div class="card-footer">
                        <div class="post-author">
                            <a href="#">
                            <img src="img/testimonial-2.jpg" alt="" class="avatar rounded-circle">
                            <span class="author">Morgan Freeman</span>
                            </a>
                        </div>
>>>>>>> c80d88326f1f85623a10c9a8348a30d20d0681d9

                        </div>
                    </div>
                </div>

<<<<<<< HEAD
    <?php
        foreach ($data as $article) {?>
            <h4><a href="article/<?=$article->getId()?>"><?=$article->getTitle()?></a></h4>
            <p><?=$article->getContent()?></p>
            
        <?php } ?>

    
</div>
=======
            <?php } ?>      
      </div>
    </div>
  </section>
>>>>>>> c80d88326f1f85623a10c9a8348a30d20d0681d9
