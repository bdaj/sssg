<?php
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require dirname(__DIR__) . '/vendor/autoload.php';
} else {
    require dirname(dirname(dirname(__DIR__))) . '/autoload.php';
}
