<?php
/**
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $msg
 * @var $inputNewUsername
 */
$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

<?php $view['slots']->set('title', "Settings") ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="panelHeading">Change Account Data</h3>
                    <hr>
                    <?php if ($msg != null) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $msg ?>
                        </div>
                    <?php endif; ?>
                    <form class="form-horizontal" method="POST" action="/account">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Old password</label>
                            <div class="col-sm-9">
                                <input type="password" name="inputOldPassword" class="form-control"
                                       placeholder="Old password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">New Username</label>
                            <div class="col-sm-9">
                                <input type="text" name="inputNewUsername" class="form-control"
                                       placeholder="New username"
                                       value="<?= $inputNewUsername ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">New password</label>
                            <div class="col-sm-9">
                                <input type="password" name="inputNewPassword" class="form-control"
                                       placeholder="New password">
                            </div>
                        </div>
                        <button type="submit" class="btn">Save</button>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="panelHeading">Delete Account</h3>
                    <hr>
                    <form action="/account/delete" method="POST">
                        <p>Sure?</p>
                        <div class="wrapper">
                            <button class="btn center" type="submit" value="Submit">Yes, delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
