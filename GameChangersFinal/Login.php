<?php

session_start();

$pageName = "Log In";

// If user is logged in, go to home page
if(isset($_SESSION["logged in"]) && $_SESSION["logged in"] === true )
{
    header("location: index.php");
    exit;
}

require "config.php";
require "./Wrappers/header.php";
require "./Wrappers/menu.php";

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // If username field is empty or just spaces
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter username.";
    }
    else
    {
        $username = trim($_POST["username"]);
    }

    // If password field is empty or just spaces
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter password.";
    }
    else
    {
        $password = trim($_POST["password"]);
    }

    // If there is no error with username or password fields
    if(empty($username_err) && empty($password_err))
    {
        // Check if user exists
        $sql = "SELECT * FROM UserTable WHERE UserName = ?";

        if($stmt = mysqli_prepare($_SESSION["link"], $sql))
        {
            mysqli_stmt_bind_param($stmt, 's', $param_username);
            $param_username = $username;

            // If $sql query executes proper
            if(mysqli_stmt_execute($stmt))
            {
                // Stores result of query
                mysqli_stmt_store_result($stmt);

                // If 1 user returned
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        // If password is correct
                        if(password_verify($password, $hashed_password))
                        {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: index.php");
                        }
                        // If password wrong
                        else
                        {
                            $login_err = "Invalid username or password.";
                        }
                    }
                    else
                    {
                        $login_err = "Invalid username or password.";
                    }
                }
                else
                {
                    echo "Oops! Something went wrong. Please try again later";
                }
                // Closes prepared statement
                mysqli_stmt_close($stmt);
            }
        }
        // Close db connection
        mysqli_close($_SESSION["link"]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Login</title>
    <link rel="stylesheet" href=""/>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <?php 
        if(!empty($login_err))
        {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control"
                       <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> value="<?php echo $username; ?>"/>
                <span class="invalid-feedback">
                    <?php 
                    echo $username_err;
                    ?>
                </span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control"
                       <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>
                    value="<?php echo $password; ?>" />
                <span class="invalid-feedback">
                    <?php
                    echo $password_err;
                    ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primarily" value="Login"/>
            </div>
            <p>
                Dont have an account? 
                <a href="Register.php">Sign up now</a>
            </p>
        </form>
    </div>
    <?php    
    require "./Wrappers/footer.php";
    ?>
