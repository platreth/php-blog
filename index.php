<?php

require_once "vendor/autoload.php";
use Controllers\IndexController;
use Controllers\ErrorController;
use Controllers\PostController;
use Controllers\AdminController;
use Controllers\UserController;






// Spot2 ORM Configuration
function spot() {
    static $spot;
    if ($spot === null) {
      $cfg = new \Spot\Config();
      $cfg->addConnection('mysql', [
          'dbname' => 'phpblog',
          'user' => 'root',
          'password' => '',
          'host' => 'localhost',
          'driver' => 'pdo_mysql',
      ]);
      $spot = new \Spot\Locator($cfg);
    }

    return $spot;
}
//

// $class = "Controllers\\" . (isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'IndexController');
// $target = isset($_GET['t']) ? $_GET['t'] : "index";
// $getParams = isset($_GET['params']) ? $_GET['params'] : null;
// $postParams = isset($_POST['params']) ? $_POST['params'] : null;
// $params = [
//     "get"  => $getParams,
//     "post" => $postParams
// ];

// if (class_exists($class, true)) {
//     $class = new $class();
//     if (in_array($target, get_class_methods($class))) {
//         call_user_func_array([$class, $target], $params);
//     } else {
//         call_user_func([$class, "index"]);
//     }
// } else {
//     echo "404 - Error";
// }

// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
// Route it up!.

if (preg_match('@^/post/show/([a-zA-Z0-9-_]+)/?$@', $request_uri[0])):
        return (new PostController())->ArticleShow(explode('/', $request_uri[0])[3]);

elseif (preg_match('@^/post/edit/([a-zA-Z0-9-_]+)/?$@', $request_uri[0])):
  return (new PostController())->edit(explode('/', $request_uri[0])[3]);

elseif (preg_match('@^/admin/comment/approve/([a-zA-Z0-9-_]+)/?$@', $request_uri[0])):
  return (new AdminController())->approve(explode('/', $request_uri[0])[4]);

elseif (preg_match('@^/admin/comment/delete/([a-zA-Z0-9-_]+)/?$@', $request_uri[0])):
  return (new AdminController())->delete(explode('/', $request_uri[0])[4]);
else:

switch ($request_uri[0]) {
    // Home page
    case '/':
        return (new IndexController())->index();
        break;
    // Blog page
    case '/blog':
         return (new IndexController())->blog();
        break;
    case '/admin':
      return (new AdminController())->index();
      break;
    case '/register':
      return (new UserController())->create();
      break;
    case '/login':
        return (new UserController())->login();
        break;
    case '/logout':
        return (new UserController())->logout();
        break;
    case '/account':
        return (new UserController())->account();
        break;
    case '/post/new':
        return (new PostController())->new();
        break;
    case '/post/mypost':
        return (new PostController())->mypost();
        break;
    case '/user/information':
        return (new UserController())->information();
        break;
    case '/post/delete':
        return (new PostController())->delete();
        break;
    case '/reset-password':
        return (new UserController())->reset_password();
        break;
    case '/reset-password/reset':
        return (new UserController())->reset_password_reset($_GET['token'], $_GET['mail']);
        break;
    case '/admin/comment':
        return (new AdminController())->comment();
        break;
    case '/admin/user':
        return (new AdminController())->user();
        break;
    default:
        return (new ErrorController())->error404();
        break;
}
endif;