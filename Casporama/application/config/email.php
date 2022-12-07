<?php defined('BASEPATH') || exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp',
    'smtp_host' => getenv("EmailHost"),
    'smtp_port' => getenv("EmailPort"),
    'smtp_user' => getenv("EmailUser"),
    'smtp_pass' => getenv("EmailPass"),
    'mailtype'  => 'html',
    'charset'   => 'utf-8',
    'newline'   => "\r\n"
);
