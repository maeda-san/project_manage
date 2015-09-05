<?php
/**
 * フロントコントローラ
 *
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/04
 * Time: 12:57
 */

// load settings
require_once(__DIR__ . '/../Setting/db.php');

// auto load
spl_autoload_register(function($class) {
    $dir_list = [
            __DIR__ . '/../Engine/',
            __DIR__ . '/../Controller/',
            __DIR__ . '/../Model/',
            __DIR__ . '/../Model/Table/',
    ];
    foreach ($dir_list as $dir) {
        $file = $dir . $class . '.class.php';
        if (file_exists($file)) {
            include_once $file;
        }
    }
});

// get MVC name
$parser             = new UrlParser();
$controller_name    = $parser->controller . 'Action';
$action_name        = $parser->action;

// call Controller
$controller = new $controller_name($parser->controller, $action_name);
$controller->run();
