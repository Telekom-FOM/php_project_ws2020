<?php
//saves user object session
function session_create($user)
{
    //when saving object in $_SESSION, serialization is required
    $_SESSION['user'] = serialize($user);
}

session_start();