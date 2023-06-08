<?php
session_start();
require('functions.php');

$emailUser = $_POST['email'];
$passUser = $_POST['password'];

$user = get_user_by_email($emailUser);
    if(!empty($user)) {
        set_flash_message('danger', 'Такой пользователь уже зарегистрирован');
        redirect_to('page_register.php');
    }

if(!empty(add_user($emailUser, $passUser))){
    set_flash_message('success' , 'Регистрация прошла успешно');
    redirect_to('page_login.php');
    exit();
}
set_flash_message('danger', 'Что-то пошло не так');
redirect_to('page_register.php');



