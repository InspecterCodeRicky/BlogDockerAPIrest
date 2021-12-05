
<?php
    $reply;
?>

<section class="blog-wrapper sect-pt4" id="blog">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="post-box">
            <div class="post-thumb">
              <img src="<?='/'.$data['dataPost']->getImage()?>" class="img-fluid" alt="">
            </div>
            <div class="post-meta">
                <h4><?=$data['dataPost']->getTitle()?></h4>
              <ul>
                <li>
                  <span class="ion-ios-person"></span>
                  <a><?=$data['authorPost']->getFirstname()?></a>
                </li>
                <li>
                  <span class="ion-pricetag"></span>
                  <a><?=$data['dataPost']->getCreatedAt()?></a>
                </li>
                <li>
                  <span class="ion-chatbox"></span>
                  <a href="#comments"><?=count($data['commentPost'])?></a>
                </li>
              </ul>
            </div>
            <div class="article-content">
                <p><?=$data['dataPost']->getContent()?></p>
            </div>
          </div>
          <div id="comments" class="box-comments">
            <div class="title-box-2">
              <h4 class="title-comments title-left">Commentaires (<?=count($data['commentPost'])?>)</h4>
            </div>
            <ul class="list-comments">
            <?php
            foreach ($data['commentPost'] as $comment) {?>
              <li>
                <div class="comment-avatar">
                  <img src="/<?=$comment->getAuthorAvatar()?>" alt="">
                </div>
                <div class="comment-details">
                  <h4 class="comment-author"><?=$comment->getAuthorPseudo()?></h4>
                  <span><?=$comment->getCreatedAt()?></span>
                  <p>
                  <?=$comment->getContent()?>
                  </p>
                  <a href="3">Reply</a>
                </div>
              </li>
              <?php } ?>   
            </ul>
          </div>
          <div class="form-comments">
            <div class="title-box-2">
              <h3 class="title-left">
                Leave a Reply
              </h3>
            </div>
            <form class="form-mf">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <textarea id="textMessage" class="form-control input-mf" placeholder="Comment *" name="post_comment"
                      cols="45" rows="8" required></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <button type="submit" class="button button-a button-big button-rouded">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-4">
          <div class="widget-sidebar sidebar-search">
            <h5 class="sidebar-title">Search</h5>
            <div class="sidebar-content">
              <form>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary btn-search" type="button">
                      <span class="ion-android-search"></span>
                    </button>
                  </span>
                </div>
              </form>
            </div>
          </div>
          <div class="widget-sidebar">
            <h5 class="sidebar-title">Recent Post</h5>
            <div class="sidebar-content">
              <ul class="list-sidebar">
                <li>
                  <a href="#">Lorem ipsum dolor sit amet consectetur</a>
                </li>
                <li>
                  <a href="#">Nam quo autem exercitationem.</a>
                </li>
                <li>
                  <a href="#">Atque placeat maiores nam quo autem</a>
                </li>
                <li>
                  <a href="#">Nam quo autem exercitationem.</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>