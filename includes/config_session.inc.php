<?php
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

if (isset($_SESSION["user_id"])) {
} else {
    if (!isset($_SESSION["last_regeneration"])) {
        regenarate_session_id();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenarate_session_id();
        }
    }
}

function regenarate_session_id_loggedin()
{
    session_regenerate_id(true);

    $userId = $_SESSION["user_id"];

    $newsessionid = session_create_id();
    $sessionid = $newsessionid . '_' . $userId;
    session_id($sessionid);

    $_SESSION["last_regeneration"] = time();
}

function regenarate_session_id()
{
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}
