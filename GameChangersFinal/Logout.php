<?php
session_start();

$pageName = "Log Out";

// Set user variables to null/empty
$_SESSION["loggedin"] = false;
$_SESSION["id"] = null;
$_SESSION["username"] = null;

$_SESSION["characters"] = [

];

$_SESSION["dndCharacters"] = [

];
//

// Return to home page
header("location: index.php");

?>

<p>
    Log Out In Progress
</p>