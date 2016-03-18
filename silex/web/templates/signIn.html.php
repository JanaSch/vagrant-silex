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

<?php $view['slots']->set('title', "Sign in") ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="panelHeading">Sign in</h3>
                        <hr>
                        <?php if ($msg != null) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $msg ?>
                            </div>
                            <?php endif; ?>
                        <form class="form-horizontal" method="POST" action="/signIn">
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
                            <button type="submit" class="btn">Sign in</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
