<?php

/**
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $active
 * @var $userId
 * @var $username
 */
$slots = $view['slots'];
?>

<!doctype html>

<html>
<head>
    <meta charset="utf-8"/>
    <link rel="icon" href="/pic/Title_Pic.png" type="image/png">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css" type="text/css">

    <title><?php $slots->output('title', 'Default title') ?></title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-fixed-top navbar-findcond">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/home">WebSiteName</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li <?= $active == 'home' ? 'class="active"' : '' ?> ><a href="/home"><span
                            class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
                <li <?= $active == 'blog' ? 'class="active"' : '' ?> ><a href="/blog"><span
                            class="glyphicon glyphicon-music" aria-hidden="true"></span> Blog</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (!$userId) : ?>
                    <li><a href="/signIn"><span
                                class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign in</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><span
                                class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login<span
                                class="caret"></span></a>
                        <ul id="loginDropdown" class="dropdown-menu" role="menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" method="POST" action="/login">
                                            <div class="form-group">
                                                <label class="sr-only" for="inputUsername">Email address</label>
                                                <input type="text" class="form-control" name="inputUsername"
                                                       id="inputUsername"
                                                       placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="inputPassword">Password</label>
                                                <input type="password" class="form-control" name="inputPassword"
                                                       id="inputPassword" placeholder="Passwort">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><?= $username ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li <?= $active == 'account' ? 'class="active"' : '' ?>><a
                                    href="/account">Account</a></li>
                            <li class="divider"></li>
                            <li><a href="/redirect/logout">Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="intro-header">

</div>
<div class="content">
    <?php
    $slots->output('_content');
    ?>
</div>
</body>
</html>