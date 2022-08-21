<?php
session_start();

$pageName = "Log Out";

$_SESSION["loggedin"] = false;
$_SESSION["id"] = null;
$_SESSION["username"] = null;

$_SESSION["characters"] = [

];

$_SESSION["dndCharacters"] = [

];

header("location: index.php");

?>

<p>
    Log Out In Progress
</p>