<?php
session_start();

$pageName = "Register Account";

require "config.php";
require "./Wrappers/header.php";
require "./Wrappers/menu.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // If username field is empty or just spaces
    if(empty(trim($_POST["username"])))
    {
        $username_err ="Please enter a username.";
    }
    else
    {
        $temp_user = trim($_POST['username']);

        // Grabs UserId based on UserName ($temp_user)
        $sql = "SELECT UserId FROM UserTable WHERE UserName = ?";
        if($stmt = mysqli_prepare($_SESSION["link"], $sql))
        {
            mysqli_stmt_bind_param($stmt, 's', $param_username);
            $param_username = trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt))
            {
                // Stores result of $sql query
                mysqli_stmt_store_result($stmt);

                // If UserId is returned (already exists)
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken.";
                }
                else
                {
                    $username = $temp_user;
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Closes prepared statement
            mysqli_stmt_close($stmt);
        }
    }

    // If password field is empty or just spaces
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";
    }

    // If password (excluding outer spaces) is less than 6 character long
    else if(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have at least 6 characters.";
    }
    else
    {
        $password = trim($_POST["password"]);
    }

    // If confirm password field is empty
    if (empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";
    }
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);

        // If no previous error, but password does not match confirm password
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }

    // If no errors so far
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {
        // Add user to database
        $sql = "INSERT INTO UserTable (UserName, password) VALUES (?, ?)";
        if($stmt = mysqli_prepare($_SESSION["link"], $sql))
        {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;

            // Hashes password
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // If user added successfully, go to login page
            if(mysqli_stmt_execute($stmt))
            {
                header("location: login.php");
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Closes prepared statement
            mysqli_stmt_close($stmt);
        }
    }

    // Closes db connection
    mysqli_close($_SESSION["link"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="" />
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control 
                        <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $username; ?>" />
                <span class="invalid-feedback">
                    <?php echo $username?>
                </span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control
                           <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $password; ?>" />
                <span class="invalid-feedback">
                    <?php echo $password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control
                           <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $confirm_password; ?>" />
                <span class="invalid_feedback">
                    <?php echo $confirm_password_err ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit" />
                <input type="reset" class="btn btn-secondary ml-2" value="Reset" />
            </div>
            <p>
                Already have an account?
                <a href="login.php">Login Here</a>
            </p>
        </form>
    </div>
</body>
</html>

<?php
require "./Wrappers/footer.php";
?>