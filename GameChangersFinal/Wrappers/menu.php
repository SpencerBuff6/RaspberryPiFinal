<?php
session_start();
// Menu When Logged Out
$menuOut = [
    0 => [
        0 => "Home Page",
        1 => "../index.php"
    ],
    1 => [
        0 => "Log In",
        1 => "../Login.php"
    ],
    2 => [
        0 => "Register Account",
        1 => "../Register.php"
    ]
];

// Menu When Logged In
$menuIn = [
    0 => [
        0 => "Home Page",
        1 => "../index.php"
    ],
    1 => [
        0 => "Add Character",
        1 => "../AddCharacter.php"
    ],
    2 => [
        0 => "Add D&D Character",
        1 => "../AddDndCharacter.php"
    ],
    3 => [
        0 => "Log Out",
        1 => "../Logout.php"
    ]
];

// Sets menu according to if user is logged in or not
$menu = (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) ? $menuIn : $menuOut;

?>

<br />
<?php
// Creates menu button for each link in menu array
foreach ($menu as [$name, $link])
{
    echo "<a href=$link> $name</a> &nbsp; &nbsp;";
}
?>
<br />