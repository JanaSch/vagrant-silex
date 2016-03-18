<?php
/**
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $posts
 * @var $msg
 * @var $username
 * @var $msgEmpty
 */
$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

<?php $view['slots']->set('title', "Blog") ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- BlogPosts ordered, newest first -->
            <?php foreach ($posts as $post) : ?>
                <div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php if ($username == $post['author']) : ?>
                                <div class="dropdown pull-right">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false" style="color: #000000"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/blog/delete/<?= $post['id'] ?>">Delete</a></li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <h3><a href="/blog/<?= $post['id'] ?>"
                                   style="color: #000000"><?= $post["title"] ?></a></h3>
                            <hr>
                            <b>
                                <span class="blogPostHeader">by <a
                                        href="/blog/user/<?= $post["userId"] ?>"
                                        class="attributes"><?= $post["author"] ?></a>
                                    <span class="placeholder">/</span>on <a
                                        href="/blog/date/<?= date('Y-m-d', strtotime($post["createdAt"])) ?>"
                                        class="attributes"><?= date('d. F Y', strtotime($post["createdAt"])) ?></a>
                                 at <?= date('H:i', strtotime($post["createdAt"])) ?>
                                    <span class="placeholder">/</span>
                                <a href="/blog/<?= $post['id'] ?>"
                                   class="attributes"><?= $post['numberOfComments'] ?> Comments</a>
                                </span>
                            </b><br/><br/><br/>
                            <?= substr(nl2br($post["text"]), 0, 500); ?>
                            <?php if (strlen($post["text"]) > 500) : ?>
                                <p>[...]</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- message if no posts exists -->
            <?php if (count($posts) == null) : ?>
                <div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p><?= $msgEmpty ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>