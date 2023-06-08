<?php
function get_user_by_email($emailUser){
    require ('connectDB.php');
    $query = 'SELECT * FROM `users` WHERE `email` = :emailUser ';
    $statement = $pdo->prepare($query);
    $statement->execute(['emailUser' => $emailUser]);
    return $statement->fetch();
}

function set_flash_message($name , $message){
    $_SESSION[$name] = $message;
}

function display_flash_message($name)
{
    if (!empty($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}
function redirect_to($path){
    header('Location: '.$path);
    exit;
}

function add_user($emailUser, $passUser){
    require ('connectDB.php');
    $query = 'INSERT INTO `users` (`email` , `password`) VALUES (:emailUser, :passUser)';
    $statement = $pdo->prepare($query);
    $statement->execute(['emailUser' => $emailUser, 'passUser' => password_hash($passUser, PASSWORD_DEFAULT)]);

    return $pdo->lastInsertId();
}

function user_authorization($email, $password, $pathSuccess, $pathFailed){
    $user = get_user_by_email($email);
    if(empty($user) || !password_verify($password, $user['password'])){
        set_flash_message('danger' , 'Неправильный email или пароль');
        $_SESSION['auth'] = $user;
        redirect_to($pathFailed);
        exit();
    }
    set_flash_message('success', 'Авторизация успешна');
    $_SESSION['auth'] = $user;
    redirect_to($pathSuccess);
}

