<?php

//FIXME Laravel 5.1 出現 Maximum function nesting level of '100' reached, aborting! 的暫時解法
//來源：http://stackoverflow.com/questions/30803342
ini_set('xdebug.max_nesting_level', 120);

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$compiledPath = __DIR__ . '/cache/compiled.php';

if (file_exists($compiledPath)) {
    require $compiledPath;
}
