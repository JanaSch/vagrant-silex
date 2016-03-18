<?php
/**
 * @var $msg
 * @var $destination
 * @var $view
 */
$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

<?php $view['slots']->set('title', "Redirect") ?>

<?php header('refresh:5;' . $destination) ?>

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="alert alert-success" role="alert">
                <?= $msg ?>
                <br /><br />
                <p>Please wait 5 seconds...</p>
                <span>If you're not redirected automatically, please click <a href="<?= $destination ?>">here</a></span>
            </div>
        </div>
    </div>
</div>
