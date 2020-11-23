<?php

function session_create($user) {
    $_SESSION['user'] = $user;
}

session_start();