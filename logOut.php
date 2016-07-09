<?php

require_once __DIR__ . '/Application/Manager/SessionManager.php';

if (SessionManager::existSession('email')) {
    SessionManager::deleteSessionValue('email');
    SessionManager::deleteSessionValue('tipoUser');
    setcookie('email','', -500);
    setcookie('password','', -500);
    header('location: index.php');
}


