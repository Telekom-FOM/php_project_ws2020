<?php

function session_create($user) {
    session_start();
    $_SESSION['user'] = $user;
    echo $_SESSION['user'];
}