<?php

require_once "vendor/autoload.php";
use Controllers\IndexController;
use Controllers\ErrorController;



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
// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        return (new IndexController())->index();
        break;
    case '/blog/show':
        return (new IndexController())->ArticleShow($_GET['id']);
        break;
    // Blog page
    case '/blog':
         return (new IndexController())->blog();
        break;
    // Everything else
    case '/blog/post':
      require 'views/post-page.php';
      break;
    default:
        return (new ErrorController())->error404();
        break;
}