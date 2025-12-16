<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false){
    $_SERVER['HTTPS']='on';
    $_SERVER['REQUEST_SCHEME']='https';
}


if (isset($_SERVER['HTTP_CF_VISITOR'])) {
    $cf_visitor = json_decode($_SERVER['HTTP_CF_VISITOR']);
    if (isset($cf_visitor->scheme) && $cf_visitor->scheme == 'https') {
        $_SERVER['HTTPS']='on';
        $_SERVER['REQUEST_SCHEME']='https';
    }
}


error_reporting(E_ALL);
$server = getenv('DB_SERVER');

if (!empty($server)){
    define("DB_SERVER",$server);
    define("DB_USERNAME",getenv('DB_USERNAME'));
    define("DB_PASSWORD",getenv('DB_PASSWORD'));
    define("DB_DATABASE",getenv('DB_DATABASE'));
}