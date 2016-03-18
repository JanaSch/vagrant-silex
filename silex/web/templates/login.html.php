<?php

/**
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $inputUsername
 * @var $msg
 */
$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

<?php $view['slots']->set('title', "Login") ?>

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <?php if ($msg != NULL) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $msg ?>
                        </div>
                    <?php endif; ?>
                    <form class="form-horizontal" method="POST" action="/login">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="inputUsername" class="form-control" placeholder="Username"
                                       value="<?= $inputUsername ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="inputPassword" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>