<?php
session_start();

$pageName = "Edit Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

?>

<h1>
    <?php echo $pageName; ?>
</h1>

<form method="post" action="">
    <fieldset>
        <label for="characterName">Name:</label><input type="text" name="characterName" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][0] ?>" size="20" /><br />
        <label for="characterGender">Gender:</label><input type="text" name="characterGender" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][1] ?>" size="20" /><br />
        <label for="characterHeight">Height:</label><input type="text" name="characterHeight" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][2] ?>" size="20" /><br />
        <label for="characterWeight">Weight:</label><input type="text" name="characterWeight" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
        <label for="characterAge">Age:</label><input type="text" name="characterAge" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
        <label for="characterHair">Hair Details:</label><input type="text" name="characterHair" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
        <label for="characterEyes">Eye Color:</label><input type="text" name="characterEyes" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
        <label for="characterRace">Race:</label><input type="text" name="characterRace" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
        <label for="characterDetails">Additional Details:</label><input type="text" name="characterDetails" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
    </fieldset>
    <input class="btn" type="submit" name="CharSubmit" value="Edit Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>
