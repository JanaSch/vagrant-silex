<?php
/**
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $posts
 * @var $msg
 * @var $newestPosts
 * @var $newestComments
 * @var $username
 */
$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

<?php $view['slots']->set('title', "Blog") ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-1">
            <!-- creating a new blog post, only visible when user is logged in -->
            <?php if (isset($username)) : ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="panelHeading">New Blog Post</h3>
                        <hr>
                        <?php if ($msg["status"] == 'error') : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $msg['content'] ?>
                            </div>
                        <?php elseif ($msg["status"] == 'success') : ?>
                            <div class="alert alert-success" role="alert">
                                <?= $msg['content'] ?>
                            </div>
                            <?php $inputTitle = '';
                            $inputText = ''; endif; ?>
                        <b><span class="blogPostHeader">
                                    By
                                    <span class="attributes">
                                        <?= $username ?>
                                    </span>
                            </span>
                        </b><br/><br/>
                        <form action="/blog" method="POST">
                            <input type="text" name="inputTitle" placeholder="Title" class="form-control"
                                   value="<?= $inputTitle ?>"> <br/>
                            <textarea name="inputText" cols="100" rows="5" placeholder="Entry"
                                      class="form-control"><?= $inputText ?></textarea><br/>
                            <button class="btn" type="submit" value="Submit">Submit</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
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
                            <p>Nobody has posted yet. Maybe you'll be the first one..?</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-3 extraContent">
            <span class="heading1">Latest Posts</span><br/><br/>
            <?php foreach ($newestPosts as $post) : ?>
                <a href="/blog/<?= $post['id'] ?>" class="linkColor">
                    <br/>
                    <span class="attributes"><?= $post['title'] ?></span>
                    from
                    <span class="attributes"><?= $post['author'] ?></span>
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a><br/>
            <?php endforeach; ?><br/><br/>
            <hr class="hrDark"><br/><br/>
            <span class="heading1">Latest Comments</span><br/><br/>
            <?php foreach ($newestComments as $comment) : ?>
                <a href="/blog/<?= $comment['postId'] ?>" class="linkColor">
                    <br/>
                    <span class="attributes"><?= $comment['author'] ?></span>
                    zu
                    <span class="attributes"><?= $comment['postTitle'] ?></span>
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a><br/>
            <?php endforeach; ?>
        </div>
    </div>
</div>