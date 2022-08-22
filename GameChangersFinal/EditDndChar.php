<?php
session_start();

$pageName = "Edit D&D Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

?>

<h1>
    <?php echo $pageName; ?>
</h1>

<form method="post" action="">
    <fieldset>
        <label for="dndcharacterName">dndName:</label><input type="text" name="dndcharacterName" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][0] ?>" size="20" /><br />
        <label for="dndcharacterRace">dndRace:</label><input type="text" name="dndcharacterRace" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][1] ?>" size="20" /><br />
        <label for="dndcharacterClass">dndClass:</label><input type="text" name="dndcharacterClass" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][2] ?>" size="20" /><br />
        <label for="dndcharacterLevel">dndLevel:</label><input type="text" name="dndcharacterLevel" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
        <label for="dndcharacterMaxHealth">dndMaxHealth:</label><input type="text" name="dndcharacterMaxHealth" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][4] ?>" size="20" /><br />
        <label for="dndcharacterStrength">dndStrength:</label><input type="text" name="dndcharacterStrength" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][5] ?>" size="20" /><br />
        <label for="dndcharacterDexterity">dndDexterity:</label><input type="text" name="dndcharacterDexterity" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][6] ?>" size="20" /><br />
        <label for="dndcharacterConstitution">dndConstitution:</label><input type="text" name="dndcharacterConstitution" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][7] ?>" size="20" /><br />
        <label for="dndcharacterIntelligence">dndIntelligence:</label><input type="text" name="dndcharacterIntelligence" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][8] ?>" size="20" /><br />
        <label for="dndcharacterWisdom">dndWisdom:</label><input type="text" name="dndcharacterWisdom" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][9] ?>" size="20" /><br />
        <label for="dndcharacterChrisma">dndChrisma:</label><input type="text" name="dndcharacterChrisma" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][10] ?>" size="20" /><br />
        <label for="dndcharacterAdditionalDetails">dndAdditionalDetails:</label><input type="text" name="dndcharacterAdditionalDetails" value="<?php echo $_SESSION['dndCharacter'][$_SESSION['EditIds'][0]][11] ?>" size="20" /><br />
    </fieldset>
    <input class="btn" type="submit" name="DndCharSubmit" value="Edit D&D Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>
