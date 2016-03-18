<?php

/**
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 */
$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

<?php $view['slots']->set('title', "Home") ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="jumbotron">
                <h1>My first Bootstrap website!</h1>
                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</h4>
                <p><a class="btn btn-primary btn-lg" href="#" role="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Search</a></p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-info">Cras sit amet nibh libero</li>
                <li class="list-group-item list-group-item-danger">Dapibus ac facilisis in</li>
                <li class="list-group-item list-group-item-warning">Morbi leo risus</li>
                <li class="list-group-item list-group-item-success">Porta ac consectetur ac</li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                    sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                    sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                    sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                    sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam,
                </div>
            </div>
        </div>
    </div>
</div>
