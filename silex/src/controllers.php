<?php
use Symfony\Component\HttpFoundation\Request;

/**
 * @var $app Silex\Application
 * @var $dbConnection Doctrine\DBAL\Connection
 * @var $template \Symfony\Component\Templating\DelegatingEngine
 */
$dbConnection = $app['db'];
$template = $app['templating'];
$userId = $app['session']->get('userId');
$username = getUsername($userId, $dbConnection);

function getUsername($userId, $dbConnection)
{
    $user = $dbConnection->fetchAssoc( "SELECT * FROM user WHERE id = '" . $userId . "'");
    $username = $user['username'];

    return $username;
}

$app->get('/redirect/{type}', function (Request $request) use ($template, $app, $username, $userId) {
    $type = $request->get('type');
    $msg = '';
    $destination = '/blog';

    switch ($type) {
        case 'logout': {
            $app['session']->clear();
            $msg = 'Successfully logged out';
            break;
        }
        case 'loggedIn': {
            $msg = 'Already logged in';
            break;
        }
        case 'login': {
            $msg = 'Successfully logged in';
            break;
        }
        case 'blogPost': {
            $msg = 'Entry Successfully created';
            break;
        }
        case 'signIn': {
            $msg = 'Successfully signed in';
            break;
        }
        case 'account': {
            $msg = 'Successfully changed Attributes<br/>Please log in again';
            $destination = '/login';
            break;
        }
        case 'accDeleted': {
            $msg = 'Successfully deleted Account. Hope to see you again!';
            break;
        }
        case 'delete': {
            $msg = 'Successfully deleted';
            break;
        }
        default: {
            $msg = 'Site not defined';
            break;
        }
    }

    return $template->render(
        'redirect.html.php',
        array(
            'active' => '',
            'username' => $username,
            'userId' => $userId,
            'msg' => $msg,
            'destination' => $destination
        )
    );
});

$app->get('/home', function () use ($template, $username, $userId) {
    return $template->render(
        'home.html.php',
        array(
            'active' => 'home',
            'username' => $username,
            'userId' => $userId
        )
    );
});

$app->match('/blog', function (Request $request) use ($template, $dbConnection, $app, $username, $userId) {
    $msg = array(
        'status' => '',
        'content' => ''
    );

    $inputTitle = $request->get('inputTitle');
    $inputText = $request->get('inputText');

    /* Create a new blog post in the database */
    if ($request->isMethod('POST')) {

        if (!$inputTitle && !$inputText) {

            $msg['status'] .= 'error';
            $msg['content'] .= 'Please fill in all fields<br />';
        } else if (!$inputTitle) {
            $msg['status'] .= 'error';
            $msg['content'] .= 'Please enter a title<br />';
        } else if (!$inputText) {
            $msg['status'] .= 'error';
            $msg['content'] .= 'Please enter a text<br />';
        }
        if ($inputTitle && $inputText) {
            $dbConnection->insert(
                'blogPost',
                array(
                    'userId' => $userId,
                    'title' => $inputTitle,
                    'text' => $inputText
                )
            );
            return $app->redirect('/redirect/blogPost');
        }
    }
    if ($request->isMethod('POST') || $request->isMethod('GET')) {
        /* Loads blog posts from database, have to be this late in code so the new post is showed too*/
        $posts = $dbConnection->fetchAll(
            'SELECT blogPost.*, user.username AS author, IFNULL(comments.count, 0) AS numberOfComments FROM blogpost
            JOIN user ON blogpost.userId = user.id
            LEFT JOIN( SELECT postId AS commentPostId, COUNT(*) AS count FROM comment GROUP BY comment.postId) comments ON blogpost.id = comments.commentPostId
            ORDER BY id DESC
            '
        );

        /* Loads the newest 4 blog posts */
        $newestPosts = $dbConnection->fetchAll(
            'SELECT blogPost.*, user.username AS author, IFNULL(comments.count, 0) AS numberOfComments FROM blogpost
            JOIN user ON blogpost.userId = user.id
            LEFT JOIN( SELECT postId AS commentPostId, COUNT(*) AS count FROM comment GROUP BY comment.postId) comments ON blogpost.id = comments.commentPostId
            ORDER BY id DESC LIMIT 4'
        );

        /* Loads the newest 4 comments */
        $newestComments = $dbConnection->fetchAll(
            'SELECT comment.*, blogpost.title AS postTitle, user.username AS author FROM comment
            JOIN user ON user.id = comment.userId
            JOIN blogpost ON blogpost.id = comment.postId
            ORDER BY comment.createdAt DESC LIMIT 4'
        );


        return $template->render(
            'blog.html.php',
            array(
                'active' => 'blog',
                'userId' => $userId,
                'username' => $username,
                'msg' => $msg,
                'inputTitle' => $inputTitle,
                'inputText' => $inputText,
                'posts' => $posts,
                'newestPosts' => $newestPosts,
                'newestComments' => $newestComments
            )
        );
    }
    if (!$request->isMethod('POST') && !$request->isMethod('GET')) {
        $app->abort(405);
    }
});

$app->match('/blog/{postId}', function (Request $request) use ($template, $dbConnection, $app, $username, $userId) {
    $postId = $request->get('postId');
    $msg = array(
        'status' => '',
        'content' => ''
    );

    if ($request->isMethod('POST')) {
        $inputComment = $request->get('inputComment');

        if (!$inputComment) {
            $msg['status'] .= 'error';
            $msg['content'] .= 'Please enter a context<br />';
        }
        if ($inputComment) {
            $dbConnection->insert(
                'comment',
                array(
                    'postId' => $postId,
                    'userId' => $userId,
                    'comment' => $inputComment
                )
            );
            $msg['status'] .= 'success';
            $msg['content'] .= 'Comment successfully created<br />';
        }
    }
    if ($request->isMethod('POST') || $request->isMethod('GET')) {
        $post = $dbConnection->fetchAssoc(
            "SELECT blogpost.*, user.username AS author FROM blogpost JOIN user ON blogpost.userId = user.id WHERE blogpost.id = '" . $postId . "'"
        );

        $comments = $dbConnection->fetchAll(
            "SELECT comment.*, user.username AS author FROM comment JOIN user ON user.id = comment.userId WHERE comment.postId = '" . $postId . "'"
        );

        return $template->render(
            'blogPost.html.php',
            array(
                'active' => 'blog',
                'msg' => $msg,
                'postId' => $postId,
                'post' => $post,
                'userId' => $userId,
                'comments' => $comments,
                'username' => $username
            )
        );
    }
    if (!$request->isMethod('POST') && !$request->isMethod('GET')) {
        $app->abort(405);
    }
});

$app->get('/blog/user/{postUserId}', function (Request $request) use ($template, $dbConnection, $app, $username, $userId) {
    $postUserId = $request->get('postUserId');
    $msgEmpty = 'This person never posted anything';


    /* Loads blog posts from database, have to be this late in code so the new post is showed too*/
    $posts = $dbConnection->fetchAll(
        "SELECT blogPost.*, user.username AS author, IFNULL(comments.count, 0) AS numberOfComments FROM blogpost
            JOIN user ON blogpost.userId = user.id
            LEFT JOIN( SELECT postId AS commentPostId, COUNT(*) AS count FROM comment GROUP BY comment.postId) comments ON blogpost.id = comments.commentPostId
            WHERE user.id ='" . $postUserId . "' ORDER BY id DESC"
    );

    return $template->render(
        'blogFiltered.html.php',
        array(
            'active' => 'blog',
            'userId' => $userId,
            'username' => $username,
            'posts' => $posts,
            'msgEmpty' => $msgEmpty
        )
    );
});

$app->get('/blog/date/{postDate}', function (Request $request) use ($template, $dbConnection, $app, $username, $userId) {
    $postDate = $request->get('postDate');
    $msgEmpty = 'On this day nobody posted anything';

    /* Loads blog posts from database, have to be this late in code so the new post is showed too*/
    $posts = $dbConnection->fetchAll(
        "SELECT blogPost.*, user.username AS author, IFNULL(comments.count, 0) AS numberOfComments FROM blogpost
            JOIN user ON blogpost.userId = user.id
            LEFT JOIN( SELECT postId AS commentPostId, COUNT(*) AS count FROM comment GROUP BY comment.postId) comments ON blogpost.id = comments.commentPostId
            WHERE DATE(blogpost.createdAt) = '" . $postDate . "' ORDER BY id DESC"
    );

    return $template->render(
        'blogFiltered.html.php',
        array(
            'active' => 'blog',
            'userId' => $userId,
            'username' => $username,
            'posts' => $posts,
            'msgEmpty' => $msgEmpty
        )
    );
});

$app->match('/blog/delete/{postId}', function (Request $request) use ($template, $dbConnection, $app, $username, $userId) {
    $postId = $request->get('postId');

    $dbConnection->delete(
        'blogPost',
        array(
            'id' => $postId
        )
    );
    return $app->redirect('/redirect/delete');
});

$app->match('/blog/delete/{postId}/comment/{commentId}', function (Request $request) use ($template, $dbConnection, $app, $username, $userId) {
    $commentId = $request->get('commentId');
    $postId = $request->get('postId');

    $dbConnection->delete(
        'comment',
        array(
            'id' => $commentId
        )
    );
    return $app->redirect('/blog/' . $postId);
});

$app->match('/login', function (Request $request) use ($template, $app, $dbConnection, $username, $userId) {
    $msg = '';

    /* already logged in */
    if (isset($username)) {
        return $app->redirect('/redirect/loggedIn');
    }

    if ($request->isMethod('POST')) {
        $inputUsername = $request->get('inputUsername');
        $inputPassword = $request->get('inputPassword');
        if ($inputUsername && !$inputPassword) {
            $msg .= 'Please enter your password<br />';
        } else if (!$inputUsername || !$inputPassword) {
            $msg .= 'Please fill in all fields<br />';
        } else if ($inputUsername && $inputPassword) {
            $user = $dbConnection->fetchAssoc(
                "SELECT * FROM user WHERE username = '" . $inputUsername . "'" . " AND " . "password = '" . $inputPassword . "'"
            );
            if ($user != NULL) {
                /* */
                $app['session']->set('username', $inputUsername);

                $app['session']->set('userId', $user['id']);

                return $app->redirect('/redirect/login');
            } else {
                $msg .= 'Username and password do not match<br />';
            }
        }

    }
    if ($request->isMethod('POST') || $request->isMethod('GET')) {
        return $template->render(
            'login.html.php',
            array(
                'active' => 'login',
                'msg' => $msg,
                'username' => $username,
                'inputUsername' => $request->get('inputUsername'),
                'userId' => $userId
            )
        );
    }
});

$app->match('/signIn', function (Request $request) use ($template, $app, $dbConnection, $username, $userId) {
    $msg = '';

    /* already logged in */
    if (isset($username)) {
        return $app->redirect('/redirect/loggedIn');
    }

    if ($request->isMethod('POST')) {
        $inputUsername = $request->get('inputUsername');
        $inputPassword = $request->get('inputPassword');
        if ($inputUsername && !$inputPassword) {
            $msg .= 'Please enter a password<br />';
        } else if (!$inputUsername || !$inputPassword) {
            $msg .= 'Please fill in all fields<br />';
        } else if ($inputUsername && $inputPassword) {
            $user = $dbConnection->fetchAssoc(
                "SELECT * FROM user WHERE username = '" . $inputUsername . "'"
            );
            if ($user == NULL) {
                $dbConnection->insert(
                    'user',
                    array(
                        'username' => $inputUsername,
                        'password' => $inputPassword
                    )
                );
                $user = $dbConnection->fetchAssoc(
                    "SELECT * FROM user WHERE username = '" . $inputUsername . "'"
                );

                $app['session']->set('userId', $user['id']);
                $app['session']->set('username', $inputUsername);
                return $app->redirect('/redirect/signIn');
            } else {
                $msg .= 'Username is already taken<br />';
            }
        }

    }
    if ($request->isMethod('POST') || $request->isMethod('GET')) {
        return $template->render(
            'signIn.html.php',
            array(
                'active' => 'signIn',
                'username' => $username,
                'msg' => $msg,
                'userId' => $userId,
                'inputUsername' => $request->get('inputUsername')
            )
        );
    }
});

$app->match('/account', function (Request $request) use ($template, $app, $dbConnection, $userId, $username, $userId) {
    $msg = '';

    if ($request->isMethod('POST')) {

        /* not logged in */
        if (!$userId) {
            return $app->redirect('/login');
        }

        $inputOldPassword = $request->get('inputOldPassword');
        $inputNewUsername = $request->get('inputNewUsername');
        $inputNewPassword = $request->get('inputNewPassword');

        if (!$inputOldPassword) {
            $msg .= 'Please enter your old password';
        } else if (!$inputNewUsername && !$inputNewPassword) {
            $msg .= 'Please enter either a new password or new username';
        } else if ($inputOldPassword && ($inputNewUsername || $inputNewPassword)) {
            $user = $dbConnection->fetchAssoc(
                "SELECT * FROM user WHERE id = '" . $userId . "'"
            );
            if ($user['password'] != $inputOldPassword) {
                $msg .= 'Old Password was wrong';
            } else {
                $user = $dbConnection->fetchAssoc(
                    "SELECT * FROM user WHERE username = '" . $inputNewUsername . "'"
                );
                if ($user) {
                    $msg = 'Username is already taken';
                } else {
                    if ($inputNewPassword && $inputNewUsername)
                        $array = array('password' => $inputNewPassword, 'username' => $inputNewUsername);
                    else if ($inputNewPassword)
                        $array = array('password' => $inputNewPassword);
                    else if ($inputNewUsername)
                        $array = array('username' => $inputNewUsername);

                    $dbConnection->update(
                        'user',
                        $array,
                        array('id' => $userId)
                    );

                    $app['session']->clear();
                    return $app->redirect('/redirect/account');
                }
            }
        }
    }
    if ($request->isMethod('POST') || $request->isMethod('GET')) {
        return $template->render(
            'account.html.php',
            array(
                'active' => 'account',
                'username' => $username,
                'userId' => $userId,
                'msg' => $msg,
                'inputNewUsername' => $request->get('inputNewUsername')
            )
        );
    }
});

$app->match('/account/delete', function (Request $request) use ($app, $dbConnection, $userId) {
    if ($request->isMethod('POST')) {

        /* not logged in */
        if (!$userId) {
            return $app->redirect('/login');
        }

        $dbConnection->delete(
            'user',
            array(
                'id' => $userId)
        );

        $app['session']->clear();
        return $app->redirect('/redirect/accDeleted');
    }
});