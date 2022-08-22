<?php
session_start();

$pageName = "Add Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<form method="post" action="">
    <fieldset>
        <label for="characterName">Name:</label><input type="text" name="characterName" size="20" /><br />
        <label for="characterGender">Gender:</label><input type="text" name="characterGender" size="20" /><br />
        <label for="characterHeight">Height:</label><input type="text" name="characterHeight" size="20" /><br />
        <label for="characterWeight">Weight:</label><input type="text" name="characterWeight" size="20" /><br />
        <label for="characterAge">Age:</label><input type="text" name="characterAge" size="20" /><br />
        <label for="characterHair">Hair Details:</label><input type="text" name="characterHair" size="20" /><br />
        <label for="characterEye">Eye Color</label><input type="text" name="characterEyes" size="20" /><br />
        <label for="characterRace">Race:</label><input type="text" name="characterRace" size="20" /><br />
        <label for="characterDetails">Additional Details:</label><input type="text" name="characterDetails" size="20" /><br />
    </fieldset>
    <input class="btn" type="submit" name="CharSubmit" value="Add Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>
