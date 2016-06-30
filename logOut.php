<?php

require_once __DIR__ . '/Application/Manager/SessionManager.php';

if (SessionManager::existSession('email')) {
    SessionManager::deleteSessionValue('email');
    SessionManager::deleteSessionValue('tipoUser');
    header('location: index.php');
}


