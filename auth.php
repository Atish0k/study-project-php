<?php
session_start();
require('functions.php');

$emailUser = $_POST['email'];
$passUser = $_POST['password'];

user_authorization($emailUser, $passUser, 'users.php', 'page_login.php');
