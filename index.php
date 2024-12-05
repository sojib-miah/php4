<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP Form</title>
</head>

<body>

    <h3>
        <?php
        output_username();
        ?>
    </h3>

    <?php if (!isset($_SESSION['user_id'])) { ?>
        <form action="includes/login.inc.php" method="post">
            <h2>Login</h2>
            <table>
                <tr>
                    <td>
                        <input type="text" name="username" placeholder="username...">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="pwd" placeholder="password...">
                    </td>
                </tr>
                <tr>
                    <td><button type="submit">Login</button></td>
                </tr>
            </table>
        </form>
    <?php } ?>


    <?php
    check_login_errors();
    ?>

    <form action="includes/signup.inc.php" method="post">
        <h2>Sign up</h2>
        <table>
            <tr>
                <td>
                    <?php
                    signup_inputs();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Signup</button>
                </td>
            </tr>
        </table>
    </form>

    <?php
    check_signup_errors();
    ?>




    <form action="includes/logout.inc.php" method="post">
        <h2>Log Out</h2>
        <table>
            <tr>
                <td>
                    <button type="submit">Logout</button>
                </td>
            </tr>
        </table>
    </form>


</body>

</html>