<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {

        require_once './dbh.inc.php';
        require_once './login_model.inc.php';
        require_once './login_contr.inc.php';

        //errors handlers
        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors['empty_input'] = "Fill in all Field!";
        };

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors['login_incorrect'] = 'Incorrect login Info!';
        }


        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header('location:../index.php');
            die();
        }

        $newsessionid = session_create_id();
        $sessionid = $newsessionid . '_' . $result["id"];
        session_id($sessionid);

        $_SESSION['user_id'] = $result["id"];
        $_SESSION['user_username'] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        header('location: ../index.php?login=success');

        $pdo = null;
        $statement = null;
    } catch (PDOException $e) {
        die("Query Failed : " . $e->getMessage());
    }
} else {
    header("location: ../index.php");
    die();
}
