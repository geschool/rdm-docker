<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$server = getenv('DB_SERVER');

if (!empty($server)){
    define("DB_SERVER",$server);
    define("DB_USERNAME",getenv('DB_USERNAME'));
    define("DB_PASSWORD",getenv('DB_PASSWORD'));
    define("DB_DATABASE",getenv('DB_DATABASE'));
}