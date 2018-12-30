<?php
session_start();
$configs = glob('config/*.php');
foreach($configs as $config) {
    require_once $config;
}
$libs = glob('libs/*.php');
foreach($libs as $lib) {
    require_once $lib;
}

$app = new Bootstrap();