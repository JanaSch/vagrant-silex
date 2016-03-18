<?php
/**
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $comments
 * @var $inputUsername
 * @var $msg
 * @var $post
 * @var $username
 */
$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

<?php $view['slots']->set('title', "Blog Post") ?>

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="">
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
                        <h3><?= $post['title'] ?></h3>
                        <hr>
                        <b><span class="blogPostHeader">by <a
                                    href="/blog/user/<?= $post["userId"] ?>"
                                    class="attributes"><?= $post["author"] ?></a>
                                    <span class="placeholder">/</span>on <a
                                    href="/blog/date/<?= date('Y-m-d', strtotime($post["createdAt"])) ?>"
                                    class="attributes"><?= date('d. F Y', strtotime($post["createdAt"])) ?></a>
                                 at <?= date('H:i', strtotime($post["createdAt"])) ?>
                                </span>
                        </b><br/><br/><br/>
                        <p><?= nl2br($post['text']) ?></p>
                    </div>
                    <hr>
                    <div class="panel-body">
                        <!-- posting a comment, only visible when user is logged in -->
                        <?php if (isset($username)) : ?>
                            <h4>Add comment</h4>
                            <?php if ($msg["status"] == 'error') : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $msg['content'] ?>
                                </div>
                            <?php elseif ($msg["status"] == 'success') : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $msg['content'] ?>
                                </div>
                                <?php $inputComment = ''; endif; ?>
                            <form action="/blog/<?= $post['id'] ?>" method="POST">
                                <textarea name="inputComment" cols="100" rows="5" placeholder="Entry"
                                          class="form-control"></textarea><br/>
                                <button class="btn" type="submit" value="Submit">Submit</button>
                            </form>
                            <br/>
                            <br/>
                        <?php endif; ?>
                        <!-- Comments -->
                        <?php for ($i = 1; $i <= count($comments); $i++) : ?>
                            <?php $comment = $comments[count($comments) - $i]; ?>
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="thumbnail">
                                        <img class="img-responsive user-photo"
                                             src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                             alt="User Image from <?= $comment['author'] ?>">
                                    </div>
                                </div>
                                <div class="comment col-xs-10">
                                    <div class="panel panel-speechbubble">
                                        <div class="comment panel-heading">
                                            <?php if ($username == $comment['author']) : ?>
                                                <div class="dropdown pull-right">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                       role="button"
                                                       aria-expanded="false" style="color: #000000"><span
                                                            class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="/blog/delete/<?= $post['id'] ?>/comment/<?= $comment['id'] ?>">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                            <h4><?= $comment['author'] ?></h4><?= nl2br($comment['comment']) ?><br/><br/>
                                            <span
                                                class="text-muted"><span
                                                    class="glyphicon glyphicon-time" aria-hidden="true"></span> <?= date('d. F Y', strtotime($comment["createdAt"])) ?>
                                                at <?= date('H:i', strtotime($post["createdAt"])) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
