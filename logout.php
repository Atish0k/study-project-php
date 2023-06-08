<?php
session_start();
require ('functions.php');
unset($_SESSION['auth']);
redirect_to('page_login.php');

?>