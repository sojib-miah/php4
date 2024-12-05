<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once "dbh.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_contr.inc.php";

        $errors = [];

        if (is_input_empty($username, $pwd, $email)) {
            $errors['empty_input'] = "Fill in all Field!";
        };

        if (is_email_invalid($email)) {
            $errors['invalid_email'] = "Invalid Email Adress!";
        };

        if (is_username_taken($pdo, $username)) {
            $errors['username_taken'] = "Username Allready Takan!";
        };

        if (is_email_register($pdo, $email)) {
            $errors['email_used'] = "The Email Allready registered!";
        };

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupdata = [
                'username' => $username,
                'email' => $email
            ];

            $_SESSION["signup_data"] = $signupdata;


            header('location:../index.php');
            die();
        }

        create_user($pdo, $email, $username, $pwd);


        header("location:../index.php?signup=success");


        $pdo = null;
        $stmt = null;


        die();
    } catch (PDOException $e) {
        die("Query Failed : " . $e->getMessage());
    }
} else {
    header("location:../index.php");
    die();
}
