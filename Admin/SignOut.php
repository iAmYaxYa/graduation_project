<?php
require '../includes/InitLogin/InitLogin.php';

if ($_GET['csrf']) {
    logOut();
    redirect('Login.php');
} else {
    redirect('index.php');
}
